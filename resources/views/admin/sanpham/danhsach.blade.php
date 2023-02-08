 @extends('admin.layout.index')
 @section('noidung')
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                                    <div class="col-lg-12">
                                        <h1 class="page-header">Sản Phẩm
                                            <small>Danh Sách</small>
                                        </h1>
                                    </div>
                                    <div class="table-responsive hide-search-datatable custom-table">
                                        <table class="table table-striped table-bordered table-hover" id="sanpham-table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Tên</th>
                                                    <th>Thể Loại</th>
                                                    <th>Key Word</th>
                                                    <th>Số Lượng Kho</th>
                                                    <th>Gía</th>
                                                    <th>Gía Khuyến Mãi</th>
                                                    <th>Hình Ảnh</th>
                                                    <th>Kiểu</th>
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
        $('#sanpham-table').DataTable({
            responsive : true,
			processing : true,
			serverSide : true,
			stateSave: true,
			searching: false,
            ajax: '{!! route('sanpham.list') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'typeProduct', name: 'typeProduct' },
                { data: 'key_word', name: 'key_word' },
                { data: 'qty_pro', name: 'qty_pro' },
                { data: 'unit_price', name: 'unit_price' },
                { data: 'promotion_price', name: 'promotion_price' },
                { data: 'image', name: 'image' },
                { data: 'unit', name: 'unit' },
                { data: 'new', name: 'new' },
                { data: 'delete', name: 'delete' },
                { data: 'edit', name: 'edit' }
            ]
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
                          if (isConfirm) {
                            $.get('{{URL::to("admin/sanpham/xoa")}}',{id:gt},function(){
                                $('#sanpham-table').DataTable().ajax.reload();
                            });
                            swal("Đã Xóa!", "Đã xóa thành công", "success");
                          } else {
                            swal("Đã Hủy", "Hủy xóa thành công :)", "error");
                          }
                        });
    }

                    </script>
                    @endsection
