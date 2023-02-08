 @extends('admin.layout.index')

 @section('noidung')
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">Mã giảm giá
                                    <small>Danh Sách</small>
                                </h1>
                            </div>
                            <!-- /.col-lg-12 -->
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="width: 100%;">
                                <thead>
                                    <tr align="center">
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Code</th>
                                        <th>Tính Năng</th>
                                        <th>Số Lượng</th>
                                        <th>Số Tiền giảm</th>
                                        <th>Trạng Thái</th>
                                        <th>Xóa</th>
                                        <th>Sửa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lists as $hi)
                                    <tr id="{{$hi->id}}" class="odd gradeX" align="center">
                                        <td>{{$hi->id}}</td>
                                        <td>{{$hi->name}}</td>

                                        <td>{{$hi->code}}</td>
                                        <td>
                                            @if($hi->condition_coupon== 1)
                                        1-Theo Tiền
                                            @else
                                            0-Theo %
                                            @endif
                                        </td>
                                        <td>{{$hi->time}}</td>
                                        <td>
                                            @if($hi->condition_coupon== 1)
                                        {{number_format($hi->number)}} vnd
                                            @else
                                            {{$hi->number}} %
                                            @endif
                                        </td>
                                        <td>
                                            @if($hi->status== 1)
                                            Áp Dụng
                                            @else
                                            Không Áp Dụng
                                            @endif
                                        </td>
                                        <td class="center">
                                            <button  class="btn btn-danger xoa" value="{{$hi->id}}"> <i class="fas fa-trash-alt"></i> </button>
                                        </td>
                                        <td class="center"> <a class="btn btn-primary" href="index.php/admin/coupon/sua/{{$hi->id}}"><i class="fas fa-eye"></i></a></td>
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
                         $(document).ready(function(){
                    $('.xoa').click(function(){
                        var gt=$(this).val();
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
                            $.get('{{URL::to("admin/coupon/xoa")}}',{id:gt},function(){
                                  $("#"+gt).remove();
                            });
                            swal("Đã Xóa!", "Đã xóa thành công", "success");
                          } else {
                            swal("Đã Hủy", "Hủy xóa thành công :)", "error");
                          }
                        });

                    });
            });
                    </script>
                    @endsection
