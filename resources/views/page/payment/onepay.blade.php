<?php


$SECURE_SECRET = "A3EFDFABA8653DF2342E8DAC29B51AF0";


$vpc_Txn_Secure_Hash = $_GET ["vpc_SecureHash"];
unset ( $_GET ["vpc_SecureHash"] );

// set a flag to indicate if hash has been validated
$errorExists = false;

ksort ($_GET);

if (strlen ( $SECURE_SECRET ) > 0 && $_GET ["vpc_TxnResponseCode"] != "7" && $_GET ["vpc_TxnResponseCode"] != "No Value Returned") {
    $stringHashData = "";

	// sort all the incoming vpc response fields and leave out any with no value
	foreach ( $_GET as $key => $value ) {
//        if ($key != "vpc_SecureHash" or strlen($value) > 0) {
//            $stringHashData .= $value;
//        }
//      *****************************chỉ lấy các tham số bắt đầu bằng "vpc_" hoặc "user_" và khác trống và không phải chuỗi hash code trả về*****************************
        if ($key != "vpc_SecureHash" && (strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
		    $stringHashData .= $key . "=" . $value . "&";
		}
	}
//  *****************************Xóa dấu & thừa cuối chuỗi dữ liệu*****************************
    $stringHashData = rtrim($stringHashData, "&");


//    if (strtoupper ( $vpc_Txn_Secure_Hash ) == strtoupper ( md5 ( $stringHashData ) )) {
//    *****************************Thay hàm tạo chuỗi mã hóa*****************************
	if (strtoupper ( $vpc_Txn_Secure_Hash ) == strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*',$SECURE_SECRET)))) {
		// Secure Hash validation succeeded, add a data field to be displayed
		// later.
		$hashValidated = "CORRECT";
	} else {
		// Secure Hash validation failed, add a data field to be displayed
		// later.
		$hashValidated = "INVALID HASH";
	}
} else {
	// Secure Hash was not validated, add a data field to be displayed later.
	$hashValidated = "INVALID HASH";
}

// Define Variables
// ----------------
// Extract the available receipt fields from the VPC Response
// If not present then let the value be equal to 'No Value Returned'
// Standard Receipt Data
$amount = null2unknown ( $_GET ["vpc_Amount"] );
$locale = null2unknown ( $_GET ["vpc_Locale"] );
//$batchNo = null2unknown ( $_GET ["vpc_BatchNo"] );
$command = null2unknown ( $_GET ["vpc_Command"] );
//$message = null2unknown ( $_GET ["vpc_Message"] );
$version = null2unknown ( $_GET ["vpc_Version"] );
//$cardType = null2unknown ( $_GET ["vpc_Card"] );
$orderInfo = null2unknown ( $_GET ["vpc_OrderInfo"] );
//$receiptNo = null2unknown ( $_GET ["vpc_ReceiptNo"] );
$merchantID = null2unknown ( $_GET ["vpc_Merchant"] );
//$authorizeID = null2unknown ( $_GET ["vpc_AuthorizeId"] );
$merchTxnRef = null2unknown ( $_GET ["vpc_MerchTxnRef"] );
$transactionNo = null2unknown ( $_GET ["vpc_TransactionNo"] );
//$acqResponseCode = null2unknown ( $_GET ["vpc_AcqResponseCode"] );
$txnResponseCode = null2unknown ( $_GET ["vpc_TxnResponseCode"] );
//
function getResponseDescription($responseCode) {

	switch ($responseCode) {
		case "0" :
			$result = "Giao dịch thành công - Approved";
			break;
		case "1" :
			$result = "Ngân hàng từ chối giao dịch - Bank Declined";
			break;
		case "3" :
			$result = "Mã đơn vị không tồn tại - Merchant not exist";
			break;
		case "4" :
			$result = "Không đúng access code - Invalid access code";
			break;
		case "5" :
			$result = "Số tiền không hợp lệ - Invalid amount";
			break;
		case "6" :
			$result = "Mã tiền tệ không tồn tại - Invalid currency code";
			break;
		case "7" :
			$result = "Lỗi không xác định - Unspecified Failure ";
			break;
		case "8" :
			$result = "Số thẻ không đúng - Invalid card Number";
			break;
		case "9" :
			$result = "Tên chủ thẻ không đúng - Invalid card name";
			break;
		case "10" :
			$result = "Thẻ hết hạn/Thẻ bị khóa - Expired Card";
			break;
		case "11" :
			$result = "Thẻ chưa đăng ký sử dụng dịch vụ - Card Not Registed Service(internet banking)";
			break;
		case "12" :
			$result = "Ngày phát hành/Hết hạn không đúng - Invalid card date";
			break;
		case "13" :
			$result = "Vượt quá hạn mức thanh toán - Exist Amount";
			break;
		case "21" :
			$result = "Số tiền không đủ để thanh toán - Insufficient fund";
			break;
		case "99" :
			$result = "Người sủ dụng hủy giao dịch - User cancel";
			break;
		default :
			$result = "Giao dịch thất bại - Failured";
	}
	return $result;
}

//  -----------------------------------------------------------------------------
// If input is null, returns string "No Value Returned", else returns input
function null2unknown($data) {
	if ($data == "") {
		return "No Value Returned";
	} else {
		return $data;
	}
}
//  ----------------------------------------------------------------------------

$transStatus = "";
if($hashValidated=="CORRECT" && $txnResponseCode=="0"){
	$transStatus = "Giao dịch thành công";
}elseif ($hashValidated=="INVALID HASH" && $txnResponseCode=="0"){
	$transStatus = "Giao dịch Pendding";
}else {
	$transStatus = "Giao dịch thất bại";
}




?>

@extends('welcome')
@section('noidung')
<meta http-equiv="Content-Type" content="text/html, charset=utf8">
<style type="text/css">
<!--
h1 {
	color: #08185A;
	font-weight: 100
}

h2.co {
	color: #08185A;
	margin-top: 0.1em;
	margin-bottom: 0.1em;
	font-weight: 100
}

h3.co {
	font-size: 16pt;
	color: #000000;
	margin-top: 0.1em;
	margin-bottom: 0.1em;
	font-weight: 100
}

body {
	color: #08185A background-color : #FFFFFF
}

a:link {
	color: #08185A
}

a:visited {
	color: #08185A
}


a:active {
	font-size: 8pt;
}


tr.title {
	height: 25px;
	background-color: #0074C4
}

td {
	font-family: Verdana, Arial, sans-serif;
	font-size: 8pt;
	color: #08185A
}

th {
	font-family: Verdana, Arial, sans-serif;
	font-size: 10pt;
	font-weight: bold;
	background-color: #CED7EF;
	padding-top: 0.5em;
	padding-bottom: 0.5em
}

input {
	font-size: 8pt;
	background-color: #CED7EF;
	font-weight: bold
}



#background-image {
	font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
	font-size: 12px;
	width: 80%;
	text-align: left;
	border-collapse: collapse;
	background: url("...") 330px 59px no-repeat;
	margin: 20px;
}

#background-image th {
	font-weight: normal;
	font-size: 14px;
	color: #339;
	padding: 12px;
}

#background-image td {
	color: #669;
	border-top: 1px solid #fff;
	padding: 9px 12px;
}

#background-image tfoot td {
	font-size: 11px;
}

#background-image tbody td {
	background: url("./back.png");
}

* html
#background-image tbody td {
	filter: progid : DXImageTransform.Microsoft.AlphaImageLoader ( src =
		'table-images/back.png', sizingMethod = 'crop' );
	background: none;
}

#background-image tbody tr:hover td {
	color: #339;
	background: none;
}
-->
</style>
<!-- End Branding Table -->
<center>
	<h1><?php echo $transStatus;?></h1>
</center>
<center>
<table id="background-image" summary="Meeting Results">
	<thead>
		<tr>
			<th scope="col">Name</th>
			<th scope="col">Value</th>
			<th scope="col">Description</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td align="center" colspan="4"></td>
		</tr>
	</tfoot>
	<tbody>
		<tr>
			<td><strong><i>Merchant ID </i></strong></td>
			<td><?php
			echo $merchantID;
			?></td>
			<td>Được cấp bởi OnePAY</td>
		</tr>
		<tr>
			<td><strong><i>Merchant Transaction Reference</i></strong></td>
			<td><?php
			echo $merchTxnRef;
			?></td>
			<td>ID của giao dịch gửi từ website merchant</td>
		</tr>
		<tr>
			<td><strong><i>Transaction OrderInfo</i></strong></td>
			<td><?php
			echo $orderInfo;
			?></td>
			<td>Tên hóa đơn</td>
		</tr>
		<tr>
			<td><strong><i>Purchase Amount</i></strong></td>
			<td><?php
			echo $amount;
			?></td>
			<td>Số tiền được thanh toán</td>
		</tr>

		<tr>
			<td><strong><i>VPC Transaction Response Code </i></strong></td>
			<td><?php
			echo $txnResponseCode;
			?></td>
			<td>Mã trạng thái giao dịch trả về</td>
		</tr>
		<tr>
			<td><strong><i>Transaction Response Code Description </i></strong></td>
			<td><?php echo getResponseDescription ( $txnResponseCode );
			?></td>
			<td>Trạng thái giao dịch</td>
		</tr>
		<tr>
			<td><strong><i>Message</i></strong></td>
			<td>Message</td>
			<td>Thông báo từ cổng thanh toán</td>
		</tr>
<?php
// only display the following fields if not an error condition
if ($txnResponseCode != "7" && $txnResponseCode != "No Value Returned") {
	?>
            <tr>
			<td><strong><i>Transaction Number</i></strong></td>
			<td><?php
	echo $transactionNo;
	?></td>
			<td>ID giao dịch trên cổng thanh toán</td>
		</tr>
<?php
}
?>
	</tbody>
</table>
<div class="container">
		<div id="content">
			<div class="review-payment">
				<h3>Cảm ơn đã mua hàng, chúng tôi sẽ sớm liên hệ với bạn.</h3>
				<h4><a href="index.php/trangchu">Quay Lại Trang Chủ</a></h4>
			</div>
		</div> <!-- #content -->
	</div>
</center>
@endsection
