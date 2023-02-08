<?php

namespace App\Http\Controllers;

use Config;
use Gloudemans\Shoppingcart\Facades\Cart;
use GuzzleHttp\Client;
use PayPal\Api\Amount;
use PayPal\Api\InputFields;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\WebProfile;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Request;
use Session;
use URL;
use App\BillDetail;
use App\Bills;
use App\Customer;
use App\Products;
use App\Quanhuyen;
use App\TypeProducts;

class PaypalController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        # Main configuration in constructor
        $paypalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(new OAuthTokenCredential(
            $paypalConfig['client_id'],
            $paypalConfig['secret'])
        );

        $this->apiContext->setConfig($paypalConfig['settings']);
    }

    public function index()
    {
        return view('store.index');
    }

    public function payWithpaypal(Request $request)
    {

        # We initialize the payer object and set the payment method to PayPal
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        # We need to update the order if the payment is complete, so we save it to the session
        # We get all the items from the cart and parse the array into the Item object
        $items = [];
        $coupon = Session::get('coupon');
        $tongtien = Cart::subtotal();
        $tongtien = str_replace(',', '', $tongtien);
        $ship = Session::get('fee_ship');
        $fee_ship = $ship[0]['fee'];
        if ($coupon) {
            if ($coupon[0]['condition']==0) {
                $tongtien = $tongtien - $tongtien * $coupon[0]['number'] / 100 + $fee_ship;
            } else {
                $tongtien = $tongtien -  $coupon[0]['number'] + $fee_ship;
            }
            // $tongtien = $tongtien - $tongtien * $coupon[0]['number'] / 100 + $fee_ship;
        } else {
            $tongtien = $tongtien + $fee_ship;
        }
     
        //$currency = convertCurrency('USD','VND');
        $currency = 23000;
        $totalUsd = \round($tongtien/$currency,2);
        $items[] = (new Item())
        ->setName('abc')
        ->setCurrency('USD')
        ->setQuantity(1)
        ->setPrice($totalUsd);
        # We create a new item list and assign the items to it
        $itemList = new ItemList();
        $itemList->setItems($items);

        # Disable all irrelevant PayPal aspects in payment
        $inputFields = new InputFields();
        $inputFields->setAllowNote(true)
            ->setNoShipping(1)
            ->setAddressOverride(0);

        $webProfile = new WebProfile();
        $webProfile->setName(uniqid())
            ->setInputFields($inputFields)
            ->setTemporary(true);

        $createProfile = $webProfile->create($this->apiContext);

        # We get the total price of the cart

        $amount = new Amount();
        $amount->setCurrency('USD')
           ->setTotal($totalUsd);
        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setItemList($itemList)
            ->setDescription('Your transaction description');

        $redirectURLs = new RedirectUrls();
        $redirectURLs->setReturnUrl(URL::to('status'))
            ->setCancelUrl(URL::to('status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectURLs)
            ->setTransactions(array($transaction));

        $payment->setExperienceProfileId($createProfile->getId());
        $payment->create($this->apiContext);

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirectURL = $link->getHref();
                break;
            }
        }

        # We store the payment ID into the session
        Session::put('paypalPaymentId', $payment->getId());

        if (isset($redirectURL)) {
            return Redirect::away($redirectURL);
        }

        session()->flash('error', 'Đã xảy ra sự cố khi xử lý thanh toán của bạn. Vui lòng liên hệ với bộ phận hỗ trợ.');

        return redirect()->route('thanhtoan');
    }

    public function getPaymentStatus(Customer $customer, Bills $bill, BillDetail $billDetail)
    {
        $paymentId = Session::get('paypalPaymentId');
        $orderId = Session::get('orderId');

        # We now erase the payment ID from the session to avoid fraud
        Session::forget('paypalPaymentId');

        # If the payer ID or token isn't set, there was a corrupt response and instantly abort
        if (empty(Request::get('PayerID')) || empty(Request::get('token'))) {
         //   session()->flash('error', 'Đã xảy ra sự cố khi xử lý thanh toán của bạn. Vui lòng liên hệ với bộ phận hỗ trợ.');
            return redirect()->route('thanhtoan');
        }

        $payment = Payment::get($paymentId, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId(Request::get('PayerID'));

        $result = $payment->execute($execution, $this->apiContext);

        # Payment is processing but may still fail due e.g to insufficient funds

        if ($result->getState() == 'approved') {
            $cus = $customer->saveInfoPayment();
            $id_customer = $cus->id;
            $bi = $bill->saveInfoPayment($id_customer);
            $content = Cart::content();
            foreach ($content as $key => $value) {
                $billDetail->saveInfo($bi->id, $value);
            }
            Cart::destroy();
            if (Session::has('coupon')) {
                Session::forget('coupon');
            }
            Session::forget('orName');
            Session::forget('orGender');
            Session::forget('orEmail');
            Session::forget('orAdress');
            Session::forget('orPhone');
            Session::forget('orNote');
            Session::put('success', 'Your payment was successful. Thank you.');

            return redirect('camon');
        }
        session()->flash('error', 'Đã xảy ra sự cố khi xử lý thanh toán của bạn. Vui lòng liên hệ với bộ phận hỗ trợ.');

        return redirect()->route('thanhtoan');
    }
}
