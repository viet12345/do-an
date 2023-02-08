 @extends('admin.layout.index')
 @section('noidung')
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                                    <div class="col-lg-12">
                                        <h1 class="page-header">Slide
                                            <small>Danh Sách</small>
                                        </h1>
                                    </div>
                                    <a href="index.php/admin/slide/excel" class="btn btn-success">Export to Excel</a>
                                    <!-- /.col-lg-12 -->
                                    <div class="table-responsive hide-search-datatable custom-table">
                                        <table class="table table-striped table-bordered table-hover" id="datatable" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Link</th>
                                                    <th>Hình Ảnh</th>
                                                    <th>Trạng Thái</th>
                                                    <th>Xóa</th>
                                                    <th>Sửa</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>

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
    $(function() {
        $('#datatable').DataTable({
            responsive : true,
			processing : true,
			serverSide : true,
			stateSave: true,
			searching: false,
            ajax: '{!! route('slide.list') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'link', name: 'link' },
                { data: 'image', name: 'image' },
                { data: 'status', name: 'status' },
                { data: 'delete', name: 'delete' },
                { data: 'edit', name: 'edit' }
            ]
        });
    });
    </script>
 <script type="text/javascript">
        function xoaSlide(id){
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
                            $.get('{{URL::to("admin/slide/xoa")}}',{id:gt},function(){
                                $('#datatable').DataTable().ajax.reload();
                            });
                            swal("Đã Xóa!", "Đã xóa thành công", "success");
                          } else {
                            swal("Đã Hủy", "Hủy xóa thành công :)", "error");
                          }
                        });
                   }
                    </script>
@endsection
