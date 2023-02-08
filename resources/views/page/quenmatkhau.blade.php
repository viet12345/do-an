@extends('welcome')
@section('noidung')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Quên mật khẩu</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{URL::to('trangchu')}}">Trang chủ</a> / <span>Quên mật khẩu</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div class="container">
		<div id="content">
			
			<form action="index.php/laylaimatkhau" method="post" class="beta-form-checkout">
				<input type="hidden" name="_token" value="{{csrf_token()}}"/>
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						@if(Session::has('loi_email'))
						<div class="alert alert-success">{{Session('loi_email')}}</div>
							
						@endif
						@if(Session::has('success'))
						<div class="alert alert-success">{{Session('success')}}</div>
							
						@endif
						
						<div class="form-block">
							<label for="email">Nhập email muốn lấy lại mật khẩu</label>
							<input type="email" name="email" id="email" value="{{old('email')}}">
							@if ($errors->has('email'))
							<span class="text-danger font-italic font-weight-lighter"
								style="font-size: 14px;">{{ $errors->first('email') }}</span>
							@endif
						</div>
						
						<div class="form-block">
							<button type="submit" class="btn btn-primary">Tiếp Tục</button>
						</div>
						
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
			
			
			
		</div> <!-- #content -->
	</div> <!-- .container -->
	
@endsection