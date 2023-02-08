<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Session;
use App\User;
use App\TypeProducts;
use Stripe;
use Config;
use Gloudemans\Shoppingcart\Facades\Cart;
use GuzzleHttp\Client;
use Redirect;
use URL;
use App\BillDetail;
use App\Bills;
use App\Customer;
use App\Products;
use App\Quanhuyen;

class PaymentController extends Controller
{

    public function __construct(Request $re, User $user)
    {
        $this->user = $user;
        $meta_desc = "ngoc hien";
        $url_canonical = $re->url();
        $meta_keywords = "key";
        $meta_title = "tittle";
        $image_og = "cc";
        $theloai = TypeProducts::all();
        view()->share(['theloai' => $theloai, 'meta_desc' => $meta_desc, 'url_canonical' => $url_canonical,
            'meta_keywords' => $meta_keywords, 'meta_title' => $meta_title, 'image_og' => $image_og]);
    }
    /**
     * [Payment] view payment
     * @author hien.nn
     */
    public function stripe()
    {
        return view('page.payment.stripe');

    }

    /**
     * [Payment] save payment
     * @author hien.nn
     */
    public function stripePost(Request $request, Customer $customer, Bills $bill, BillDetail $billDetail)
    {
        try {
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
            } else {
                $tongtien = $tongtien + $fee_ship;
            }
            //$currency = convertCurrency('USD','VND');
            $currency = 23000;
            $totalUsd = \round($tongtien/$currency,2);
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $charge = Stripe\Charge::create([
                "amount" => $totalUsd * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => $request->name,
            ]);

            if ($charge['status'] == 'succeeded') {
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
    } catch(\Stripe\Exception\CardException $e) {
        $text = $e->getError()->message ;
        return redirect()->route('stripe')->with('errorStripe', $text);
      } catch (\Stripe\Exception\RateLimitException $e) {
        // Too many requests made to the API too quickly
        $text = 'Too many requests made to the API too quickly';
        return redirect()->route('stripe')->with('errorStripe', $text);
      } catch (\Stripe\Exception\InvalidRequestException $e) {
        // Invalid parameters were supplied to Stripe's API
        $text = 'Too many requests made to the API too quickly';
        return redirect()->route('stripe')->with('errorStripe', $text);
      } catch (\Stripe\Exception\AuthenticationException $e) {
        // (maybe you changed API keys recently)
        $text = "Authentication with Stripe's API failed";
        return redirect()->route('stripe')->with('errorStripe', $text);
      } catch (\Stripe\Exception\ApiConnectionException $e) {
        $text = "Network communication with Stripe failed";
        return redirect()->route('stripe')->with('errorStripe', $text);
      } catch (\Stripe\Exception\ApiErrorException $e) {
        // yourself an email
        $text = "Display a very generic error to the user, and maybe send";
        return redirect()->route('stripe')->with('errorStripe', $text);
      } catch (Exception $e) {
        $text = 'Something else happened, completely unrelated to Stripe';
        return redirect()->route('stripe')->with('errorStripe', $text);
      }

    }
    //payment one pay

    public function onepay(Request $request, Customer $customer, Bills $bill, BillDetail $billDetail)
    {
        $SECURE_SECRET = "A3EFDFABA8653DF2342E8DAC29B51AF0";
        $vpc_Txn_Secure_Hash = $_GET ["vpc_SecureHash"];
        $errorExists = false;
        ksort ($_GET);
        if (strlen ( $SECURE_SECRET ) > 0 && $_GET ["vpc_TxnResponseCode"] != "7" && $_GET ["vpc_TxnResponseCode"] != "No Value Returned") {
            $stringHashData = "";
            foreach ( $_GET as $key => $value ) {
                if ($key != "vpc_SecureHash" && (strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
                    $stringHashData .= $key . "=" . $value . "&";
                }
            }
            $stringHashData = rtrim($stringHashData, "&");
            if (strtoupper ( $vpc_Txn_Secure_Hash ) == strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*',$SECURE_SECRET)))) {
                $hashValidated = "CORRECT";
            } else {
                $hashValidated = "INVALID HASH";
            }
        } else {
            $hashValidated = "INVALID HASH";
        }
        $txnResponseCode = $_GET ["vpc_TxnResponseCode"] !=null ? $_GET ["vpc_TxnResponseCode"] : '';
        if($hashValidated=="CORRECT" && $txnResponseCode=="0"){
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
               //return redirect('camon');
        }

        return view('page.payment.onepay');
    }

    public function onepayDO(Request $request)
    {
        $vpc_ReturnUrl = route('onepay');
        $coupon=Session::get('coupon');
        $tongtien=Cart::subtotal();
        $tongtien =str_replace( ',', '', $tongtien );
        $fee_ship=Session::get('fee_ship');
        if ($coupon) {
            $total = ($tongtien - $tongtien * $coupon[0]['number'] /100 +$fee_ship[0]['fee']) * 100;
        } else {
            $total = ($tongtien + $fee_ship[0]['fee']) * 100;
        }
        $params = [
        "Title" => "VPC 3-Party",
        "vpc_AccessCode" => "D67342C2",
        "vpc_Amount" => $total,
        "vpc_Command" => "pay",
        "vpc_Currency" => "VND",
        "vpc_Customer_Email" => "support@onepay.vn",
        "vpc_Customer_Id" => "thanhvt",
        "vpc_Customer_Phone" => "840904280949",
        "vpc_Locale" => "vn",
        "vpc_MerchTxnRef" => date ( 'YmdHis' ) . rand (),
        "vpc_Merchant" => "ONEPAY",
        "vpc_OrderInfo" => "JSECURETEST01",
        "vpc_ReturnURL" => $vpc_ReturnUrl,
        "vpc_SHIP_City" => "Ha Noi",
        "vpc_SHIP_Country" => "Viet Nam",
        "vpc_SHIP_Provice" => "Hoan Kiem",
        "vpc_SHIP_Street01" => "39A Ngo Quyen",
        "vpc_TicketNo" => "::1",
        "vpc_Version" => "2",
        ];
        $virtualPaymentClientURL = "https://mtf.onepay.vn/onecomm-pay/vpc.op";
        // Khóa bí mật - được cấp bởi OnePAY
        $SECURE_SECRET = "A3EFDFABA8653DF2342E8DAC29B51AF0";
        $vpcURL = $virtualPaymentClientURL . "?";
        $stringHashData = "";
        $appendAmp = 0;
        foreach($params as $key => $value) {
            if (strlen($value) > 0) {
                if ($appendAmp == 0) {
                    $vpcURL .= urlencode($key) . '=' . urlencode($value);
                    $appendAmp = 1;
                } else {
                    $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
                }
                if ((strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
                    $stringHashData .= $key . "=" . $value . "&";
                }
            }
        }

        $stringHashData = rtrim($stringHashData, "&");
        if (strlen($SECURE_SECRET) > 0) {
            $vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*',$SECURE_SECRET)));
        }
        return \redirect($vpcURL);
    }

    public function onepayDR(Request $request)
    {

        return view('page.payment.dr_one_pay');
    }
}
