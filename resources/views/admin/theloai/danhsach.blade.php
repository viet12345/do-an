@extends('admin.layout.index')
@section('noidung')
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                                    <div class="col-lg-12">
                                        <h1 class="page-header">Thể Loại
                                            <small>Danh Sách</small>
                                        </h1>
                                    </div>
                                    <!-- /.col-lg-12 -->
                                    <table class="table table-striped table-bordered table-hover" id="dataTable" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tên</th>
                                                <th>Key Word</th>
                                                <th>Mô Tả</th>
                                                <th>Hình Ảnh</th>
                                                <th>Trạng Thái</th>
                                                <th>Xóa</th>
                                                <th>Sửa</th>
                                            </tr>
                                        </thead>

                                    </table>

                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection
@section('scrip')
<script>
    $(function() {
    $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('theloai.list') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'key_word', name: 'key_word' },
            { data: 'description', name: 'description' },
            { data: 'image', name: 'image' },
            { data: 'status', name: 'status' },
            { data: 'delete', name: 'delete' },
            { data: 'edit', name: 'edit' }
        ]
    });
});
</script>
 <script type="text/javascript">

            function xoaSanpham(id){
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
                            // alert(gt);
                          if (isConfirm) {
                            $.get('{{URL::to("admin/theloai/xoa")}}',{id:gt},function(){
                                $('#dataTable').DataTable().ajax.reload();
                            });
                            swal("Đã Xóa!", "Đã xóa thành công", "success");
                          } else {
                            swal("Đã Hủy", "Hủy xóa thành công :)", "error");
                          }
                        });
    }

                    </script>

@endsection
