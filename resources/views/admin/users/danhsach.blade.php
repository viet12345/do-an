 @extends('admin.layout.index')

 @section('noidung')
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                                    <div class="col-lg-12">
                                        <h1 class="page-header">User
                                            <small>Danh Sách</small>
                                        </h1>
                                    </div>
                                    <div align="center">
                                        <form method="POST" action="{{URL::to('admin/user/chenexcel')}}" enctype="multipart/form-data">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                                                <input  type="file"  name="excel" value="chen file excel">
                                                <input  type="submit" name="" value="Chen Excel" class="btn btn-success">

                                        </form>
                                    </div>
                                    <a href="{{URL::to('admin/user/excel')}}" class="btn btn-primary">Xuất Excel</a>
                                    <!-- /.col-lg-12 -->
                                    <div class="table-responsive hide-search-datatable custom-table">
                                        <table class="table table-striped table-bordered table-hover" id="datatable" style="width: 100%">
                                            <thead>
                                                <tr align="center">
                                                    <th>ID</th>
                                                    <th>Tên</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Địa Chỉ</th>
                                                    <th>Chức Vụ</th>
                                                    <th>Xóa</th>

                                                </tr>
                                            </thead>

                                        </table>
                                    </div>
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection
@section('scrip')
<script type="text/javascript">
    $('#datatable').DataTable({
        responsive : true,
        processing : true,
        serverSide : true,
        stateSave: true,
        searching: false,
        ajax: '{!! route('user.list') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'full_name', name: 'full_name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'address', name: 'address' },
            { data: 'idGroup', name: 'idGroup' },
            { data: 'delete', name: 'delete' }
        ]
    });
</script>

 <script type="text/javascript">
          function deleteUser(id){
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
                            $.get('{{URL::to("admin/user/xoa")}}',{id:gt},function(){
                                $('#user-table').DataTable().ajax.reload();
                            });
                            swal("Đã Xóa!", "Đã xóa thành công", "success");
                          } else {
                            swal("Đã Hủy", "Hủy xóa thành công :)", "error");
                          }
                        });
          }
                    </script>
                    @endsection
