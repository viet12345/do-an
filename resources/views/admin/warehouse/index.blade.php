@extends('admin.layout.index')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

@section('noidung');
<div id="page-wrapper">
           <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                                    <div class="col-lg-12">
                                        <h1 class="page-header">Quản lý kho
                                            <small>Danh Sách</small>
                                        </h1>
                                    </div>
                                    <!-- /.col-lg-12 -->
                                    <table class="table table-striped table-bordered table-hover" id="sanpham-table">
                                        <thead>
                                            <tr align="center">
                                                <th>ID</th>
                                                <th>Tên</th>
                                                <th>Số Lượng nhập</th>
                                                <th>Gía</th>
                                                <th>Hình Ảnh</th>
                                                <th>Ngày nhập hàng</th>
                                                <th>Ngày sản xuất</th>
                                                <th>Ngày hết hạn</th>
                                                {{-- <th>Xóa</th> --}}
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
       $('#sanpham-table').DataTable({
           processing: true,
           serverSide: true,
           ajax: '{!! route('warehouse.data') !!}',
           columns: [
               { data: 'id', name: 'id' },
               { data: 'name', name: 'name' },
               { data: 'number', name: 'number' },
               { data: 'price', name: 'price' },
               { data: 'image', name: 'image' },
               { data: 'pick_up_date', name: 'pick_up_date' },
               { data: 'manufacture_date', name: 'manufacture_date' },
               { data: 'expired_date', name: 'expired_date' },
            //    { data: 'delete', name: 'delete' },
               { data: 'edit', name: 'edit' }
           ]
       });

    $("body" ).on( "click", ".delete", function() {
        var id=$(this).data('id');
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
            $.get('{{route('warehouse.destroy')}}',{id:id},function(){
                   // $("#"+gt).remove();
                   $('#sanpham-table').DataTable().ajax.reload();
            });
            swal("Đã Xóa!", "Đã xóa thành công", "success");
            } else {
            swal("Đã Hủy", "Hủy xóa thành công :)", "error");
            }
            });
    });
</script>
@endsection
