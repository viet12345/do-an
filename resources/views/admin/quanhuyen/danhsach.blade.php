 @extends('admin.layout.index')

 @section('noidung');
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-12">
                                <h1 class="page-header">Giá Vận Chuyển
                                    <small>Danh Sách</small>
                                </h1>
                            </div>
                            <!-- /.col-lg-12 -->
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="width: 100%">
                                <thead>
                                    <tr align="center">
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Thể Loại</th>
                                        <th>Gía Vận Chuyển</th>
                                        <th>Xóa</th>
                                        <th>Sửa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($danhsach as $hi)
                                    <tr id="{{$hi->id}}" class="odd gradeX" align="center">
                                        <td>{{$hi->id}}</td>
                                        <td>{{$hi->name}}</td>
                                        <td>{{$hi->type}}</td>
                                        <td>{{number_format($hi->fee)}} vnd</td>

                                    <td class="center">
                                            <button onclick="xoaQuan({{$hi->id}})" class="btn btn-danger" value="{{$hi->id}}"> <i class="fas fa-trash-alt"></i> </button>
                                        </td>
                                        <td class="center"><a class="btn btn-primary" href="index.php/admin/quanhuyen/sua/{{$hi->id}}"><i class="fas fa-eye"></i></a></td>
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
@section('scrip')
 <script type="text/javascript">
          function xoaQuan(id){
             var gt=id;
                       swal({
                          title: "Bạn có chắc không?",
                          text: "Bạn sẽ không thể khôi phục tập tin này!",
                          type: "warning",
                          showCancelButton: true,
                          confirmButtonClass: "btn-danger",
                          confirmButtonText: "Yes, delete it!",
                          cancelButtonText: "No, cancel plx!",
                          closeOnConfirm: false,
                          closeOnCancel: false
                        },
                        function(isConfirm) {
                          if (isConfirm) {
                            $.get('{{URL::to("admin/quanhuyen/xoa")}}',{id:gt},function(){
                                  $("#"+gt).remove();
                            });
                            swal("Đã Xóa!", "Đã xóa thành công", "success");
                          } else {
                            swal("Đã Hủy", "Hủy xóa thành công :)", "error");
                          }
                        });
          }

                    </script>
@endsection
