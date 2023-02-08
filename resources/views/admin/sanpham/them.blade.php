 @extends('admin.layout.index')
 @section('noidung')
  <div id="page-wrapper">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">Sản Phẩm
                                    <small>Thêm</small>
                                </h1>
                            </div>
                            <!-- /.col-lg-12 -->
                            <div class="col-lg-7" style="padding-bottom:120px">
                                <form action="index.php/admin/sanpham/them" method="post"  enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="form-group">
                                        <label>Tên Sản Phẩm</label>
                                        <input class="form-control" name="name" value="{{old('name')}}" placeholder="Please Enter Product Name" />
                                        @if ($errors->has('name'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Thể Loại</label>
                                        <select class="form-control" name="theloai">
                                            @foreach($theloai as $hi)
                                            <option value="{{$hi->id}}">{{$hi->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Key Word</label>
                                        <textarea rows="3" class="form-control" name="key_word" placeholder="Please Enter Key Word" >{{old('key_word')}}</textarea>
                                        @if ($errors->has('key_word'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('key_word') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Mô Tả</label>
                                        <textarea rows="3" class="form-control" name="mota" placeholder="Please Enter Description" id="ckeditor1">
                                            {{old('mota')}}
                                        </textarea>
                                        @if ($errors->has('mota'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('mota') }}</span>
                                        @endif

                                    </div>
                                    <div class="form-group">
                                        <label>Số Lượng</label>
                                        <input class="form-control" name="qty_pro" value="{{old('qty_pro')}}" placeholder="Please Enter Qty" />
                                        @if ($errors->has('qty_pro'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('qty_pro') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Giá Gốc</label>
                                        <input class="form-control" name="unit_price" value="{{old('unit_price')}}" placeholder="Please Enter Description" />
                                        @if ($errors->has('unit_price'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('unit_price') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Gía Khuyến Mãi</label>
                                        <input class="form-control" name="promotion_price" value="{{old('promotion_price')}}" placeholder="Please Enter Description" />
                                        @if ($errors->has('promotion_price'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('promotion_price') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Hình Đại Diện</label>
                                        <input type="file" name="Hinh" class="form-control"/>
                                        @if ($errors->has('Hinh'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('Hinh') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Kiểu</label>
                                        <select class="form-control" name="unit">

                                            <option value="cái">cái</option>
                                            <option value="hộp">hộp</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Trạng Thái</label>
                                        <label class="radio-inline">
                                            <input name="status" value="1" checked="" type="radio">Nổi Bật
                                        </label>
                                        <label class="radio-inline">
                                            <input name="status" value="0" type="radio">Không
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-default">Thêm Sản Phẩm</button>
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
