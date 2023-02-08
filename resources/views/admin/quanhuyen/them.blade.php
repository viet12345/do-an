 @extends('admin.layout.index');
 @section('noidung');
  <div id="page-wrapper">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">Thể Loại
                                    <small>Thêm</small>
                                </h1>
                            </div>
                            <!-- /.col-lg-12 -->
                            <div class="col-lg-7" style="padding-bottom:120px">
                                <div>

                                </div>
                                <form action="index.php/admin/quanhuyen/them" method="post"  >
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="form-group">
                                        <label>Tên</label>
                                        <input class="form-control" name="name" value="{{old('name')}}" placeholder="Please Enter  Name" />
                                        @if ($errors->has('name'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                <div class="form-group">
                                    <label>Chọn Quận - Huyện</label>
                                    <select class="form-control" name="type">
                                            <option value="Quận">Quận</option>
                                            <option value="Huyện">Huyện</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                        <label>Gía Vận Chuyển</label>
                                        <input class="form-control" name="fee" value="{{old('fee')}}" placeholder="Please Enter  Fee" />
                                        @if ($errors->has('fee'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('fee') }}</span>
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-default">Thêm </button>
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
