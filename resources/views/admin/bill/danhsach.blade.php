 @extends('admin.layout.index')

 @section('noidung')
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">Hóa Đơn
                                    <small>Danh Sách</small>
                                </h1>
                            </div>
                            <!-- /.col-lg-12 -->
                            <table class="table table-striped table-bordered table-hover" id="bill-table"  style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Người Mua</th>
                                        <th>Người Nhận</th>
                                        <th>Tổng Tiền</th>
                                        <th>Hình Thức Thanh Toán</th>
                                        <th>Shipper</th>
                                        <th>Ngày</th>
                                        <th>Ghi Chú</th>
                                        <th>Trạng Thái</th>
                                        <th>Xóa</th>
                                        <th>Xem Chi Tiết</th>
                                    </tr>
                                </thead>
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
    $('#bill-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('bill.list') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'user', name: 'user' },
            { data: 'customer', name: 'customer' },
            { data: 'total', name: 'total' },
            { data: 'payment', name: 'payment' },
            { data: 'shipper', name: 'shipper' },
            { data: 'date_order', name: 'date_order' },
            { data: 'note', name: 'note' },
            { data: 'status', name: 'status' },
            { data: 'delete', name: 'delete' },
            { data: 'edit', name: 'edit' }
        ]
    });
</script>
        <script type="text/javascript">

                function deleteBill(id){
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
                    }
                    ,
                    function(isConfirm) {
                        if (isConfirm) {
                        $.get('{{URL::to("admin/bill/xoa")}}',{id:gt},function(){
                            $('#bill-table').DataTable().ajax.reload();
                        });
                        swal("Đã Xóa!", "Đã xóa thành công", "success");
                        } else {
                        swal("Đã Hủy", "Hủy xóa thành công :)", "error");
                        }
                    }
                    );

                };
        </script>
@endsection
