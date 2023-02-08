 @extends('admin.layout.index')
 @section('noidung')
  <div id="page-wrapper">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                                    <div class="col-lg-12">
                                        <h1 class="page-header">Mã Giam Gía
                                            <small>Thêm</small>
                                        </h1>
                                    </div>
                                    <!-- /.col-lg-12 -->
                                    <div class="col-lg-12" style="padding-bottom:120px">
                                        <form action="index.php/admin/coupon/them" method="post" >
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="form-group">
                                                <label>Tên Mã</label>
                                                <input class="form-control" name="name" value="{{old('name')}}" placeholder="Điền tên mã giảm giá" />
                                                @if ($errors->has('name'))
                                                <span class="text-danger font-italic font-weight-lighter"
                                                    style="font-size: 14px;">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label>Code Mã Giam Gía</label>

                                                <input type="text" class="form-control"  name="code"  value="{{$coderandom['code']}}">
                                                @if ($errors->has('code'))
                                                <span class="text-danger font-italic font-weight-lighter"
                                                    style="font-size: 14px;">{{ $errors->first('code') }}</span>
                                                @endif


                                            </div>
                                            <div class="form-group">
                                                <label>Số Lượng Mã Giam Gía</label>
                                                <input class="form-control" name="time" value="{{old('time')}}" placeholder="Điền số lượng mã giảm giá" />
                                                @if ($errors->has('time'))
                                                <span class="text-danger font-italic font-weight-lighter"
                                                    style="font-size: 14px;">{{ $errors->first('time') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label>Chọn Tính Năng</label>
                                                <select class="form-control" name="condition_coupon">

                                                    <option value="0">Theo %</option>
                                                    <option value="1">Theo Tiền</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Số % hoặc số tiềm giảm</label>
                                                <input class="form-control" name="number" value="{{old('number')}}" placeholder="Điền số lượng mã giảm giá" />
                                                @if ($errors->has('number'))
                                                <span class="text-danger font-italic font-weight-lighter"
                                                    style="font-size: 14px;">{{ $errors->first('number') }}</span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label>Trạng Thái</label>
                                                <label class="radio-inline">
                                                    <input name="status" value="1" checked="" type="radio">Áp Dụng
                                                </label>
                                                <label class="radio-inline">
                                                    <input name="status" value="0" type="radio">Chưa Áp Dụng
                                                </label>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Thêm </button>
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

