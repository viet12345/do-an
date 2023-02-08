@extends('welcome')
@section('noidung')

<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đặt hàng</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="index.html">Trang chủ</a> / <span>Đặt hàng</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div class="container">
		<div id="content">
			<form action="index.php/thanhtoan" method="post" class="beta-form-checkout">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <div class="row">
                    <div class="col-sm-12">
                        @if(Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Danger!</strong>{{Session::get('error')}}
                        </div>
                        @endif
                    </div>
                </div>
				<div class="row">
					<div class="col-sm-6">
						<h4>Đặt hàng - Điền đầy đủ thông tin người nhận hàng</h4>
						<div class="space20">&nbsp;</div>

						<div class="form-block">
							<label for="name">Họ tên<span class="text-danger"> *</span></label>
                            <input type="text" name="name" value="{{old('name')}}" placeholder="Họ tên" >
                            <label for=""></label>
                            @if ($errors->has('name'))
                            <span class="text-danger font-italic font-weight-lighter"
                            style="font-size: 14px;">{{ $errors->first('name') }}
                            </span>
                            @endif
                            <span class="text-danger font-italic font-weight-lighter err-name"
                            style="font-size: 14px;"></span>
						</div>
						<div class="form-block">
							<label>Giới tính </label>
							<input id="gender" type="radio" class="input-radio" name="gender" value="nam" checked="checked" style="width: 10%"><span style="margin-right: 10%">Nam</span>
							<input id="gender" type="radio" class="input-radio" name="gender" value="nữ" style="width: 10%"><span>Nữ</span>

						</div>

						<div class="form-block">
							<label for="email">Email<span class="text-danger"> *</span></label>
							<input type="text" name="email" value="{{old('email')}}" id="email"  placeholder="expample@gmail.com">
                            <label for=""></label>
                            @if ($errors->has('email'))
                            <span class="text-danger font-italic font-weight-lighter"
                            style="font-size: 14px;">{{ $errors->first('email') }}
                            </span>
                            @endif
                            <span class="text-danger font-italic font-weight-lighter err-email"
                            style="font-size: 14px;"></span>
                        </div>

						<div class="form-block">
							<label for="adress">Địa chỉ<span class="text-danger"> *</span></label>
							<input type="text" name="adress" value="{{old('adress')}}" id="adress" placeholder="Street Address" >
                            <label for=""></label>
                            @if ($errors->has('adress'))
                            <span class="text-danger font-italic font-weight-lighter"
                            style="font-size: 14px;">{{ $errors->first('adress') }}
                            </span>
                            @endif
                            <span class="text-danger font-italic font-weight-lighter err-address"
                            style="font-size: 14px;"></span>
                        </div>


						<div class="form-block">
							<label for="phone">Điện thoại<span class="text-danger"> *</span></label>
							<input type="text" name="phone" value="{{old('phone')}}" id="phone" >
                            <label for=""></label>
                            @if ($errors->has('phone'))
                            <span class="text-danger font-italic font-weight-lighter"
                            style="font-size: 14px;">{{ $errors->first('phone') }}
                            </span>
                            @endif
                            <span class="text-danger font-italic font-weight-lighter err-phone"
                            style="font-size: 14px;"></span>
                        </div>

						<div class="form-block">
							<label for="notes">Ghi chú</label>
                            <textarea name="note"  id="notes">{{old('note')}}</textarea>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="your-order">

							<div class="your-order-head"><h5>Hình thức thanh toán</h5></div>

							<div class="your-order-body">
								<ul class="payment_methods methods">
									<li class="payment_method_bacs">
										<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="">
										<label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
										<div class="payment_box payment_method_bacs" style="display: block;">
											Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
										</div>
									</li>

									<li class="payment_method_cheque">
										<input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="">
										<label for="payment_method_cheque">Chuyển khoản </label>
										<div class="payment_box payment_method_cheque" style="display: none;">
                                            <button type="button" id="chechout_paypal"  class="beta-btn primary">Paypal</button>
                                            <button type="button" id="chechout_stripe"  class="beta-btn primary">Stripe</button>
                                            {{-- <button type="button" id="chechout_one_pay"  class="beta-btn primary">One Pay</button> --}}
                                        </div>
									</li>

								</ul>
							</div>
							<button type="submit" class="beta-btn primary btn-cod" name="proceed">Đặt Hàng</button>

						</div> <!-- .your-order -->
					</div>
				</div>
			</form>
				<!-- <button type="button" class="beta-btn primary xacnhan" name="proceed">Tiến Hành  <i class="fa fa-chevron-right"></i></button> -->
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection
@section('scrip')
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.xacnhan').click(function(){
									swal({
				  title: "Are you sure?",
				  text: "You will not be able to recover this imaginary file!",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonClass: "btn-danger",
				  confirmButtonText: "Yes, delete it!",
				  cancelButtonText: "No, cancel plx!",
				  closeOnConfirm: false,
				  closeOnCancel: false
				},
				function(isConfirm) {
				  if (isConfirm) {
				    swal("Deleted!", "Your imaginary file has been deleted.", "success");
				  } else {
				    swal("Cancelled", "Your imaginary file is safe :)", "error");
				  }
				});

			});
            $('#chechout_paypal').click(function(){
                var name = $("input[name=name]").val();
                var email = $("input[name=email]").val();
                var adress = $("input[name=adress]").val();
                var phone = $("input[name=phone]").val();
                var gender = $("input[name=gender]").val();
                var note = $("input[name=note]").val();
                var flag = true;
                if(name.length == 0){
                    flag = false;
                    $('.err-name').html("Nhập tên người nhận hàng");
                }
                else if(name.length > 150 ){
                    flag = false;
                    $('.err-name').html("Tên không được lớn hơn 150 ký tự");
                }
                else{
                    $('.err-name').html("");
                }
                if(email.length == 0){
                    flag = false;
                    $('.err-email').html("Nhập email người nhận hàng");
                }
                else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))) {
                    flag = false;
                    $('.err-email').html("Định dạng email không hợp lệ");
                }
                else if(email.length > 150 ){
                    flag = false;
                    $('.err-email').html("Tên không được lớn hơn 150 ký tự");
                }
                else{
                    $('.err-email').html("");
                }
                if(phone.length == 0){
                    flag = false;
                    $('.err-phone').html("Nhập số điện thoại người nhận hàng");
                }
                else if(phone.length > 20 ){
                    flag = false;
                    $('.err-phone').html("Số điện thoại không được lớn hơn 20 ký tự");
                }
                else{
                    $('.err-phone').html("");
                }
                if(adress.length == 0){
                    flag = false;
                    $('.err-address').html("Nhập địa chỉ người nhận hàng");
                }
                else if(adress.length > 150 ){
                    flag = false;
                    $('.err-address').html("Tên không được lớn hơn 150 ký tự");
                }
                else{
                    $('.err-address').html("");
                }
                if(flag ==  true){
                    $.ajax({
                    url: '{{ route("save.info.order") }}',
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        name: name,
                        email: email,
                        adress: adress,
                        phone: phone,
                        gender: gender,
                        note: note
                    },
                    success: function (data) {
                        window.location.href = "{{route('checkout')}}";
                    }
                    });
                }
            });
            $('#chechout_stripe').click(function(){
                var name = $("input[name=name]").val();
                var email = $("input[name=email]").val();
                var adress = $("input[name=adress]").val();
                var phone = $("input[name=phone]").val();
                var gender = $("input[name=gender]").val();
                var note = $("input[name=note]").val();
                var flag = true;
                if(name.length == 0){
                    flag = false;
                    $('.err-name').html("Nhập tên người nhận hàng");
                }
                else if(name.length > 150 ){
                    flag = false;
                    $('.err-name').html("Tên không được lớn hơn 150 ký tự");
                }
                else{
                    $('.err-name').html("");
                }
                if(email.length == 0){
                    flag = false;
                    $('.err-email').html("Nhập email người nhận hàng");
                }
                else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))) {
                    flag = false;
                    $('.err-email').html("Định dạng email không hợp lệ");
                }
                else if(email.length > 150 ){
                    flag = false;
                    $('.err-email').html("Tên không được lớn hơn 150 ký tự");
                }
                else{
                    $('.err-email').html("");
                }
                if(phone.length == 0){
                    flag = false;
                    $('.err-phone').html("Nhập số điện thoại người nhận hàng");
                }
                else if(phone.length > 20 ){
                    flag = false;
                    $('.err-phone').html("Số điện thoại không được lớn hơn 20 ký tự");
                }
                else{
                    $('.err-phone').html("");
                }
                if(adress.length == 0){
                    flag = false;
                    $('.err-address').html("Nhập địa chỉ người nhận hàng");
                }
                else if(adress.length > 150 ){
                    flag = false;
                    $('.err-address').html("Tên không được lớn hơn 150 ký tự");
                }
                else{
                    $('.err-address').html("");
                }
                if(flag ==  true){
                    $.ajax({
                    url: '{{ route("save.info.order") }}',
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        name: name,
                        email: email,
                        adress: adress,
                        phone: phone,
                        gender: gender,
                        note: note
                    },
                    success: function (data) {
                        window.location.href = "{{route('stripe')}}";
                    }
                    });
                }
            });
            $('#chechout_one_pay').click(function(){
                var name = $("input[name=name]").val();
                var email = $("input[name=email]").val();
                var adress = $("input[name=adress]").val();
                var phone = $("input[name=phone]").val();
                var gender = $("input[name=gender]").val();
                var note = $("input[name=note]").val();
                var flag = true;
                if(name.length == 0){
                    flag = false;
                    $('.err-name').html("Nhập tên người nhận hàng");
                }
                else if(name.length > 150 ){
                    flag = false;
                    $('.err-name').html("Tên không được lớn hơn 150 ký tự");
                }
                else{
                    $('.err-name').html("");
                }
                if(email.length == 0){
                    flag = false;
                    $('.err-email').html("Nhập email người nhận hàng");
                }
                else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))) {
                    flag = false;
                    $('.err-email').html("Định dạng email không hợp lệ");
                }
                else if(email.length > 150 ){
                    flag = false;
                    $('.err-email').html("Tên không được lớn hơn 150 ký tự");
                }
                else{
                    $('.err-email').html("");
                }
                if(phone.length == 0){
                    flag = false;
                    $('.err-phone').html("Nhập số điện thoại người nhận hàng");
                }
                else if(phone.length > 20 ){
                    flag = false;
                    $('.err-phone').html("Số điện thoại không được lớn hơn 20 ký tự");
                }
                else{
                    $('.err-phone').html("");
                }
                if(adress.length == 0){
                    flag = false;
                    $('.err-address').html("Nhập địa chỉ người nhận hàng");
                }
                else if(adress.length > 150 ){
                    flag = false;
                    $('.err-address').html("Tên không được lớn hơn 150 ký tự");
                }
                else{
                    $('.err-address').html("");
                }
                if(flag ==  true){
                    $.ajax({
                    url: '{{ route("save.info.order") }}',
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        name: name,
                        email: email,
                        adress: adress,
                        phone: phone,
                        gender: gender,
                        note: note
                    },
                    success: function (data) {
                        window.location.href = "{{route('onepay.do')}}";
                    }
                    });
                }
            });
            $('.payment_method_bacs').click(function(){
                $('.btn-cod').show();
            })
            $('.payment_method_cheque').click(function(){
                $('.btn-cod').hide();
            })
		});
	</script>
@endsection
