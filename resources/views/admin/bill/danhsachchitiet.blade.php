 @extends('admin.layout.index')
@section('css')
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" type="text/css" href="{{asset('xtreme/assets/libs/select2/dist/css/select2.min.css')}}">
    <link type="text/css" href="{{asset('xtreme/dist/css/style.min.css')}}" rel="stylesheet">
@endsection
 @section('noidung')

 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">Hóa Đơn
                                    <small>Chi Tiết</small>
                                </h1>
                            </div>
                            {{-- <a href="index.php/admin/bill/pdf/{{$bill->id}}" class="btn btn-success mb-2">Export PDF</a> --}}
                            <!-- /.col-lg-12 -->
                            <p class="mb-2"></p>
                            <table class="table table-striped table-bordered table-hover" >
                                <thead>
                                    <tr align="center">
                                        <th>ID</th>
                                        <th>Tên Nguời Mua</th>
                                        <th>Gmail</th>
                                        <th>Địa Chỉ</th>
                                        <th>Số Điện Thoại</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="odd gradeX" align="center">
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->full_name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->address}}</td>
                                        <td>{{$user->phone}}</td>
                                    </tr>

                                </tbody>
                            </table>
                            <table class="table table-striped table-bordered table-hover" >
                                <thead>
                                    <tr align="center">
                                        <th>ID</th>
                                        <th>Tên Người Nhận</th>
                                        <th>Giới Tính</th>
                                        <th>Gmail</th>
                                        <th>Địa Chỉ</th>
                                        <th>Số Điện Thoại</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX" align="center">
                                        <td>{{$cus->id}}</td>
                                        <td>{{$cus->name}}</td>
                                        <td>{{$cus->gender}}</td>
                                        <td>{{$cus->email}}</td>
                                        <td>{{$cus->address}}</td>
                                        <td>{{$cus->phone_number}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">Shipper
                                    <small>Danh Sách</small>
                                </h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <select id="shipper_id" class="select2 form-control block" style="width:400px">
                                        <option value="0">--Select Shipper--</option>
                                        @foreach($shippers as $item)
                                    <option {{$bill->id_shipper == $item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->name}} - {{$item->phone}}</option>
                                        @endforeach
                                    </select>
                                    <p class="ship-err text-danger"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <!-- /.col-lg-12 -->
                        <table class="table table-striped table-bordered table-hover">
                                <thead >
                                    <tr align="center">
                                        <th>ID Sản Phẩm</th>
                                        <th>Tên</th>
                                        <th>Số Lượng Trong Kho</th>
                                        <th>Giá</th>
                                        <th>Số Lượng</th>
                                        <th>Size</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center;">
                                    @foreach($detail as $hi)
                                        <input type="hidden" class="qty_pro_sale_{{$hi->id}}" name="qty_pro_sale" value="{{$hi->qty}}">
                                        <input type="hidden" name="id_pro_sale" value="{{$hi->id}}">
                                        <input type="hidden" class="qty_pro_{{$hi->id}}" value="{{$hi->qty_pro}}">
                                        <tr class="odd gradeX error_qty_kho_{{$hi->id}}" align="center">
                                            <td>{{$hi->id}}</td>
                                            <td>{{$hi->name}}</td>
                                            <td>{{$hi->qty_pro}}</td>
                                            <td>{{number_format($hi->price)}} vnđ</td>
                                            <td>{{$hi->qty}}</td>
                                            {{-- <td>
                                                <input type="number" min="1" name="qty_pro_order" class="qty_pro_order_{{$hi->id}}" value="{{$hi->qty}}">
                                                <input type="hidden" class="id_bill_update" value="{{$bill->id}}">
                                                <button class="btn btn-default update-qty-order" data-id_pro_update="{{$hi->id}}">Cập Nhập</button>
                                            </td> --}}
                                            <td>{{$hi->size}}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center">Tổng tiền: </td>
                                        <td class="text-center">{{number_format($bill->total)}} vnd</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center">Phí vận chuyện đến: {{$t_data['diachi']}}</td>
                                        <td class="text-center">{{number_format($t_data['tienship'])}} vnd</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center">Tiền giảm: </td>
                                        <td class="text-center">{{number_format($t_data['tiengiam'])}} vnd</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center">Tổng : </td>
                                    <td class="text-center">{{number_format($bill->total + $t_data['tienship'] - $t_data['tiengiam'])}} vnd</td>
                                    </tr>
                                    <tr></tr>
                                    <tr>
                                        <td>Trạng Thái: </td>

                                        <td>
                                            <button class="btn btn-primary"
                                            @if($bill->status==1)
                                            style="display: none;"
                                            @endif
                                            id="chuaxuly" data-id_bill="{{$bill->id}}"> Chưa Xử Lý Đơn Hàng</button>

                                            <button class="btn btn-success"
                                            @if($bill->status==0)
                                                style="display: none;"
                                            @endif
                                            id="daxuly" data-id_bill="{{$bill->id}}"> Đã Xử Lý Đơn Hàng</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </div>

@endsection

@section('scrip')
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> --}}
{{-- <script>
    $(document).ready(function() {
    $('.select-shipper').select2();
});
</script> --}}
    <script type="text/javascript">
        $(document).ready(function(){
            $('.update-qty-order').click(function(){
               var id_pro_order_update=$(this).data("id_pro_update");
               var qty_pro_order_update=$('.qty_pro_order_'+id_pro_order_update).val();
               var id_bill_update=$('.id_bill_update').val();
              $.get('{{url("admin/bill/qty_pro_order_update")}}',{id_pro_order_update:id_pro_order_update,
              qty_pro_order_update:qty_pro_order_update,id_bill_update:id_bill_update},function(){
                     location.reload();
              })
            })
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#chuaxuly').click(function(){
                var shipId = $('#shipper_id').val();
                var id_bill = $(this).data('id_bill');
                qty_pro_sale = [];
                $("input[name='qty_pro_sale']").each(function(){
                    qty_pro_sale.push($(this).val());
                });
                id_pro_sale =[];
                $("input[name='id_pro_sale']").each(function(){
                    id_pro_sale.push($(this).val());
                });
                kt=0;
                for(i=0;i<id_pro_sale.length;i++){
                    var order_qty = $('.qty_pro_sale_'+id_pro_sale[i]).val();
                    var stock_qty =$('.qty_pro_'+id_pro_sale[i]).val();
                    if(parseInt(order_qty) > parseInt(stock_qty)){
                        kt =kt+1;
                        if(kt==1){
                             alert("Số lượng kho không đủ");
                        }
                        $('.error_qty_kho_'+id_pro_sale[i]).css('background','red');
                    }
                }
                var flag = true;
                if(shipId == 0){
                    $('.ship-err').html("You have to choose a shipper");
                    flag = false;
                }
                else{
                    $('.ship-err').html("");
                }

                if(kt==0 && flag==true){
                    $.get('{{url("admin/bill/giaohang")}}',{shipId:shipId,id_bill:id_bill,qty_pro_sale:qty_pro_sale,id_pro_sale:id_pro_sale},function(){
                    $('#chuaxuly').hide();
                    $('#daxuly').show();
                    location.reload();
                    });
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#daxuly').click(function(){
                var id_bill = $(this).data('id_bill');

                 qty_pro_sale = [];
                $("input[name='qty_pro_sale']").each(function(){
                    qty_pro_sale.push($(this).val());
                });
                id_pro_sale =[];
                $("input[name='id_pro_sale']").each(function(){
                    id_pro_sale.push($(this).val());
                });

                $.get('{{url("admin/bill/bogiaohang")}}',{id_bill:id_bill,id_pro_sale:id_pro_sale,qty_pro_sale:qty_pro_sale},function(){
                    $('#daxuly').hide();
                    $('#chuaxuly').show();
                   location.reload();
                });



            });
        });
    </script>
@endsection
