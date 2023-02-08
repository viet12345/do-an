 @extends('admin.layout.index')

 @section('noidung')
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-12">
                                <h1 class="page-header">Shipper
                                    <small>Danh Sách</small>
                                </h1>
                            </div>
                            <!-- /.col-lg-12 -->
                            <div class="table-responsive hide-search-datatable custom-table">
                            <table class="table table-striped table-bordered table-hover" id="datatable" style="width: 100%">
                                <thead>
                                    <tr align="center">
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Địa Chỉ</th>
                                        <th>Số Điện Thoại</th>
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
<script>
    $(function() {
    $('#datatable').DataTable({
        responsive : true,
			processing : true,
			serverSide : true,
			stateSave: true,
			searching: false,
        ajax: '{!! route('shipper.data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'address', name: 'address' },
            { data: 'phone', name: 'phone' },
            { data: 'image', name: 'image' },
            { data: 'status', name: 'status' },
            { data: 'delete', name: 'delete' },
            { data: 'edit', name: 'edit' }
        ]
    });
});
</script>
 <script type="text/javascript">

$("body" ).on( "click", ".delete", function() {
        var id= $(this).data('id');
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
            $.get('{{route('shipper.destroy')}}',{id:id},function(){
                   $('#datatable').DataTable().ajax.reload();
            });
            swal("Đã Xóa!", "Đã xóa thành công", "success");
            } else {
            swal("Đã Hủy", "Hủy xóa thành công :)", "error");
            }
            });
    });

</script>

@endsection
