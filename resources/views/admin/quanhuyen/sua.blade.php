 @extends('admin.layout.index');
 @section('noidung');
  <div id="page-wrapper">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">Quân Huyện
                                    <small>Sửa</small>
                                </h1>
                            </div>
                            <!-- /.col-lg-12 -->
                            <div class="col-lg-7" style="padding-bottom:120px">
                                <div>

                                </div>
                                <form action="{{url('admin/quanhuyen/sua/'.$quanhuyen->id)}}" method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="form-group">
                                        <label>Tên</label>
                                        <input class="form-control" value="{{$quanhuyen->name}}" name="name" placeholder="Please Enter  Name" />
                                        @if ($errors->has('name'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                <div class="form-group">
                                    <label>Chọn Quận - Huyện</label>
                                    <select class="form-control" name="type">
                                            <option
                                            @if($quanhuyen->type == "Quận")
                                                selected=""

                                            @endif
                                            value="Quận">Quận</option>
                                            <option   @if($quanhuyen->type == "Huyện")
                                                selected=""

                                            @endif value="Huyện">Huyện</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                        <label>Gía Vận Chuyển</label>
                                        <input value="{{$quanhuyen->fee}}" class="form-control" name="fee" placeholder="Please Enter  Fee" />
                                        @if ($errors->has('fee'))
                                        <span class="text-danger font-italic font-weight-lighter"
                                            style="font-size: 14px;">{{ $errors->first('fee') }}</span>
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-default">Sửa </button>
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
