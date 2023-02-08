 @extends('admin.layout.index')
 @section('noidung')
  <div id="page-wrapper">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">Slide
                                    <small>Sửa</small>
                                </h1>
                            </div>
                            <!-- /.col-lg-12 -->
                            <div class="col-lg-7" style="padding-bottom:120px">
                                <form action="index.php/admin/slide/sua/{{$slide->id}}" method="post"  enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                        <label>Link</label>
                                        <input class="form-control" value="{{$slide->link}}" name="link" placeholder="Please Enter Link" />
                                        @if ($errors->has('link'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('link') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Hình Ảnh</label>
                                        <input type="file" name="Hinh" class="form-control"/>
                                        @if ($errors->has('link'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('link') }}</span>
                                        @endif
                                        </div>

                                    <div class="form-group">
                                        <label>Trạng Thái</label>
                                        <label class="radio-inline">
                                            <input name="status" value="1" checked="" type="radio">Hiện
                                        </label>
                                        <label class="radio-inline">
                                            <input name="status" value="0" type="radio">Ẩn
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-default">Sửa Slide</button>
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
