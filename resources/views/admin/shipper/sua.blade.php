@extends('admin.layout.index')
@section('noidung')
<div id="page-wrapper">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Shipper
                                <small>Sửa</small>
                            </h1>
                        </div>
                        <!-- /.col-lg-12 -->
                        <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="{{route('shipper.update', $shipper->id)}}" method="post"  enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label>Tên Shipper</label>
                                    <input class="form-control" name="name" value="{{old('name', $shipper->name)}}" placeholder="Nhập tên" />
                                    @if ($errors->has('name'))
                                    <span class="text-danger font-italic font-weight-lighter"
                                        style="font-size: 14px;">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Địa Chỉ</label>
                                    <input class="form-control" name="address" value="{{old('address', $shipper->address)}}" placeholder="Nhập địa chỉ" />
                                    @if ($errors->has('address'))
                                    <span class="text-danger font-italic font-weight-lighter"
                                        style="font-size: 14px;">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Số Điện Thoại</label>
                                    <input class="form-control" name="phone" value="{{old('phone', $shipper->phone)}}" placeholder="Nhập số điện thoại" />
                                    @if ($errors->has('phone'))
                                    <span class="text-danger font-italic font-weight-lighter"
                                        style="font-size: 14px;">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                                    <div class="form-group">
                                    <label>Hình Đại Diện</label>
                                    <input type="file" name="avatar" class="form-control"/>
                                    @if ($errors->has('avatar'))
                                    <span class="text-danger font-italic font-weight-lighter"
                                        style="font-size: 14px;">{{ $errors->first('avatar') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Trạng Thái</label>
                                    <label class="radio-inline">
                                        <input name="status" value="1" {{$shipper->status==1 ? 'checked' : '' }} checked="" type="radio">Hiện
                                    </label>
                                    <label class="radio-inline">
                                        <input name="status" value="0" type="radio" {{$shipper->status==0 ? 'checked' : '' }} >Ẩn
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-default">Cập Nhật</button>
                                <button type="reset" class="btn btn-default">Làm Mới</button>
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
