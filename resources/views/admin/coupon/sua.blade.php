 @extends('admin.layout.index')
 @section('noidung')
  <div id="page-wrapper">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">Mã Giam Gía
                                    <small>Sửa</small>
                                </h1>
                            </div>
                            <!-- /.col-lg-12 -->
                            <div class="col-lg-7" style="padding-bottom:120px">


                                <form action="index.php/admin/coupon/sua/{{$coupon->id}}" method="post" >
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="form-group">
                                        <label>Tên Mã</label>
                                        <input class="form-control" value="{{$coupon->name}}" name="name" placeholder="Điền tên mã giảm giá" />
                                        @if ($errors->has('name'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Code Mã Giam Gía</label>
                                        <input type="text" class="form-control" value="{{$coupon->code}}" name="code" disabled="disabled" />
                                    </div>
                                    <div class="form-group">
                                        <label>Số Lượng Mã Giam Gía</label>
                                        <input class="form-control" value="{{$coupon->time}}" name="time" placeholder="Điền số lượng mã giảm giá" />
                                        @if ($errors->has('time'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('time') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Chọn Tính Năng</label>
                                        <select class="form-control" name="condition_coupon">

                                            <option
                                            @if($coupon->status==0)
                                            selected=""
                                            @endif
                                            value="0">Theo %</option>
                                            <option  @if($coupon->status==1)
                                            selected=""
                                            @endif value="1">Theo Tiền</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Số % hoặc số tiềm giảm</label>
                                        <input class="form-control" value="{{$coupon->number}}" name="number" placeholder="Điền số lượng mã giảm giá" />
                                    </div>

                                    <div class="form-group">
                                        <label>Trạng Thái</label>
                                        <label class="radio-inline">
                                            <input name="status" value="1"
                                            @if($coupon->status==1)
                                            checked=""
                                            @endif
                                            type="radio">Áp Dụng
                                        </label>
                                        <label class="radio-inline">
                                            <input name="status" value="0" @if($coupon->status==0)
                                            checked=""
                                            @endif type="radio">Chưa Áp Dụng
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Sửa </button>
                                    <button type="reset" class="btn btn-default">Làm Mới</button>
                                <form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection
@section('scrip')
@endsection
