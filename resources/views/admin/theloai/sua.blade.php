 @extends('admin.layout.index')
 @section('noidung')
  <div id="page-wrapper">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">Thể Loại
                                    <small>Sửa</small>
                                </h1>
                            </div>
                            <!-- /.col-lg-12 -->
                            <div class="col-lg-12" style="padding-bottom:120px">
                                <form action="index.php/admin/theloai/sua/{{$theloai->id}}" method="post"  enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="form-group">
                                        <label>Tên Thể Loại</label>
                                        <input class="form-control" name="name" value="{{old('name',$theloai->name)}}" placeholder="Please Enter Category Name" />
                                        @if ($errors->has('name'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Key Word</label>
                                        <textarea rows="3" class="form-control" name="key_word" placeholder="Please Enter Key Word" >{{$theloai->key_word}}
                                        </textarea>
                                        @if ($errors->has('key_word'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('key_word') }}</span>
                                        @endif

                                    </div>
                                    <div class="form-group">
                                        <label>Mô Tả</label>
                                        <textarea rows="5" class="form-control" name="mota" placeholder="Please Enter Description">{{$theloai->description}}
                                        </textarea>
                                        @if ($errors->has('mota'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('mota') }}</span>
                                        @endif

                                    </div>
                                    <div class="form-group">
                                        <label>Hình Đại Diện</label>
                                        <input type="file" name="Hinh" class="form-control"/>
                                        </div>
                                        @if ($errors->has('Hinh'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('Hinh') }}</span>
                                        @endif

                                    <div class="form-group">
                                        <label>Trạng Thái</label>
                                        <label class="radio-inline">
                                            <input name="status" value="1" checked="" type="radio">Hiện
                                        </label>
                                        <label class="radio-inline">
                                            <input name="status" value="0" type="radio">Ẩn
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-default">Sửa Thể Loại</button>
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
