@extends('welcome')
@section('noidung')
<script type="text/javascript" src="https://use.fortawesome.com/349cfdf6.js"></script>
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Đăng nhập</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb">
                <a href="index.html">Home</a> / <span>Đăng nhập</span>
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
                    <form action="index.php/dangnhap" method="post" class="beta-form-checkout">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                    <div>
                    @if(Session::has('thongbaodn'))
                        <div class="alert alert-success">{{Session('thongbaodn')}}</div>
                    @elseif(Session::has('exit_email'))
                        <div class="alert alert-danger">{{Session('exit_email')}}</div>
                    @elseif(Session::has('error'))
                    <div class="alert alert-danger">{{Session('error')}}</div>
                    @endif
                    </div>
                    <div class="space20">&nbsp;</div>


                    <div class="form-group">
                        <label for="email">Email address*</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">
                        @if ($errors->has('email'))
                        <span class="text-danger font-italic font-weight-lighter"
                            style="font-size: 14px;">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="phone">Password*</label>
                        <input type="password" class="form-control" name="password" value="{{old('password')}}">
                        @if ($errors->has('password'))
                        <span class="text-danger font-italic font-weight-lighter"
                            style="font-size: 14px;">{{ $errors->first('password') }}</span>
                        @endif

                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Đăng Nhập</button>
                    </div>


                    </form>

                        <div class="tex-center">
                                {{-- <button style="float: left;"  class="btn btn-primary">
                                <a href="{{URL::to('login-facebook')}}"><span  style="font-size : 14px !important; background-color: #428BCA;padding: 6px 12px;color: white; "><i class="fab fa-facebook-f"></i>Facebook</span></a>
                                </button> --}}
                                {{-- <button class="btn btn-primary">
                                <a style="float: right;" href="{{URL::to('login-google')}}"><span  style="font-size : 14px !important; background-color: #428BCA;padding: 6px 12px;color: white; "><i class="fab fa-google"></i></i>Google</span></a>
                                </button> --}}
                                <a style="float: right;" href="{{URL::to('laylaimatkhau')}}">Quên mật khẩu</a>
                        </div>

                </div>
                <div class="col-sm-3"></div>
            </div>




    </div> <!-- #content -->
</div> <!-- .container -->

@endsection
