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
			<?php
				$co=$data['code'];
				$mail=$data['mail'];
			?>
			<form action="{{route('post-reset-matkhau')}}" method="post" class="beta-form-checkout">
				<input type="hidden" name="_token" value="{{csrf_token()}}"/>
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<input type="hidden" name="code" value="{{$co}}"/>
						<input type="hidden" name="mail" value="{{$mail}}"/>
						
						@if(Session::has('danger'))
							<div class="alert alert-danger">{{Session('danger')}}</div>
						@endif
						@if(Session::has('success'))
							<div class="alert alert-success">{{Session('success')}}</div>
						@endif
						
						<div class="form-group">
							<label for="password">Password*</label>
							<input class="form-control" type="password" name="pass" value="{{old('pass')}}" >
							@if ($errors->has('pass'))
							<span class="text-danger font-italic font-weight-lighter"
								style="font-size: 14px;">{{ $errors->first('pass') }}</span>
							@endif
						</div>
						<div class="form-group">
							<label for="password">Re password*</label>
							<input class="form-control" type="password" name="repassword"  value="{{old('repassword')}}">
							@if ($errors->has('repassword'))
							<span class="text-danger font-italic font-weight-lighter"
								style="font-size: 14px;">{{ $errors->first('repassword') }}</span>
							@endif
						</div>
						
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Tiếp Tục</button>
						</div>
						
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
			
			
			
		</div> <!-- #content -->
	</div> <!-- .container -->
	
@endsection