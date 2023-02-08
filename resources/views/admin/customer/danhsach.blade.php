 @extends('admin.layout.index')

 @section('noidung')
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-12">
                                <h1 class="page-header">Khách Hàng
                                    <small>Danh Sách</small>
                                </h1>
                            </div>
                            <div align="center">
                                <a href="{{URL::to('admin/customer/excel')}}" class="btn btn-primary">Xuất Excel</a>
                            </div>
                            <!-- /.col-lg-12 -->
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="width: 100%">
                                <thead>
                                    <tr align="center">
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Giới Tính</th>
                                        <th>Gmail</th>
                                        <th>Địa Chỉ</th>
                                        <th>Số Điện Thoại</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($danhsach as $hi)
                                    <tr class="odd gradeX" align="center">
                                        <td>{{$hi->id}}</td>
                                        <td>{{$hi->name}}</td>
                                        <td>{{$hi->gender}}</td>
                                        <td>{{$hi->email}}</td>
                                        <td>{{$hi->address}}</td>
                                        <td>{{$hi->phone_number}}</td>


                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection
