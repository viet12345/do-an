 @extends('admin.layout.index')
 @section('noidung')
  <div id="page-wrapper">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">User
                                    <small>Thêm</small>
                                </h1>
                            </div>
                            <!-- /.col-lg-12 -->


                            <div class="col-lg-12" style="padding-bottom:120px">
                                <form action="index.php/admin/user/them" method="POST">

                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                    <div class="form-group">
                                        <label>Họ Tên</label>
                                        <input class="form-control" name="name" value="{{old('name')}}" placeholder="Please Enter Username"  />
                                        @if ($errors->has('name'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="txtPass" value="{{old('txtPass')}}" placeholder="Please Enter Password"/>
                                        @if ($errors->has('txtPass'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('txtPass') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>RePassword</label>
                                        <input type="password" class="form-control" name="txtRePass" placeholder="Please Enter Confirm Password" value="{{old('txtRePass')}}" />
                                        @if ($errors->has('txtRePass'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('txtRePass') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" id="email" class="form-control" name="email" placeholder="Please Enter Email" value="{{old('email')}}" />
                                        @if ($errors->has('email'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Số Điện Thoại</label>
                                        <input class="form-control" name="phone" value="{{old('phone')}}" placeholder="Please Enter Address" />
                                        @if ($errors->has('phone'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Địa Chỉ</label>
                                        <input class="form-control" name="address" value="{{old('address')}}" placeholder="Please Enter Address" />
                                        @if ($errors->has('address'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>User Level</label>
                                        <label class="radio-inline">
                                            <input name="idGroup" value="1" checked="" type="radio">Quản Trị
                                        </label>
                                        <label class="radio-inline">
                                            <input name="idGroup" value="0" type="radio">Thành Viên
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-default">Thêm </button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                <form>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection
