@extends('welcome')
@section('noidung')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đăng kí</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="index.html">Home</a> / <span>Đăng kí</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">
			
			
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<form action="index.php/dangky" method="post" class="beta-form-checkout">
						<input type="hidden" name="_token" value="{{csrf_token()}}"/>
						<h4>Đăng kí</h4> 
						<div>
							@if(Session::has('thongbaodk'))
						<div class="alert alert-success">Đăng Ký Thành Công</div>
					
						@endif
						</div>
						<div class="space20">&nbsp;</div>

						

						<div class="form-group">
							<label for="your_last_name">Fullname <span class="text-danger">*</span></label>
							
							<input class="form-control" type="text" name="name" id="your_last_name" value="{{old('name')}}">
							@if ($errors->has('name'))
							<span class="text-danger font-italic font-weight-lighter"
								style="font-size: 14px;">{{ $errors->first('name') }}</span>
							@endif
						</div>

						<div class="form-group">
							<label for="adress">Address*  </label>
							
							<input class="form-control" type="text" name="adress" value="{{old('adress')}}">
							@if ($errors->has('adress'))
							<span class="text-danger font-italic font-weight-lighter"
								style="font-size: 14px;">{{ $errors->first('adress') }}</span>
							@endif
						</div>


						<div class="form-group">
							<label for="adress">Email*</label>
							<input class="form-control" type="email" name="email" id="email" value="{{old('email')}}">
							@if ($errors->has('email'))
							<span class="text-danger font-italic font-weight-lighter"
								style="font-size: 14px;">{{ $errors->first('email') }}</span>
							@endif
						</div>

						<div class="form-group">
							<label for="phone">Phone*</label>
							<input class="form-control" type="text" name="phone" id="phone" value="{{old('phone')}}">
							@if ($errors->has('phone'))
							<span class="text-danger font-italic font-weight-lighter"
								style="font-size: 14px;">{{ $errors->first('phone') }}</span>
							@endif
						</div>
						<div class="form-group">
							<label for="password">Password*</label>
							<input class="form-control" type="password" name="password"  value="{{old('password')}}">
							@if ($errors->has('password'))
							<span class="text-danger font-italic font-weight-lighter"
								style="font-size: 14px;">{{ $errors->first('password') }}</span>
							@endif
						</div>
						<div class="form-group">
							<label for="password">Re password*</label>
							<input class="form-control" type="password" name="repassword" value="{{old('repassword')}}">
							@if ($errors->has('repassword'))
							<span class="text-danger font-italic font-weight-lighter"
								style="font-size: 14px;">{{ $errors->first('repassword') }}</span>
							@endif
						</div>
						
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Register</button>
						</div>
						</form>
					</div>
					<div class="col-sm-3"></div>
				</div>
		

		</div> <!-- #content -->
	</div> 
@endsection