<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<title>Hóa Đơn Sản Phẩm</title>
</head>
<body style="font-family: DejaVu Sans;">
           <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <p style="font-family: DejaVu Sans; font-size: 30px; font-style: bold;" class="page-header">Hóa Đơn
                        </p>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" >
                        <thead>
                            <tr align="center">
                                <th>Tên Người Mua</th>
                                <th>Gmail</th>
                                <th>Địa Chỉ</th>
                                <th>Số Điện Thoại</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr class="odd gradeX" align="center">
                                <td>{{$user->full_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->address}}</td>
                                <td>{{$user->phone}}</td>
                            </tr>
                        </tbody>
                    </table>
                   <table class="table" >
                        <thead>
                            <tr align="center">

                                <th>Tên Người Nhận</th>
                                <th>Gioi Tính</th>
                                <th>Gmail</th>
                                <th>Địa Chỉ</th>
                                <th>Số Điện Thoại</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd gradeX" align="center">
                                <td>{{$cus->name}}</td>
                                <td>{{$cus->gender}}</td>
                                <td>{{$cus->email}}</td>
                                <td>{{$cus->address}}</td>
                                <td>{{$cus->phone_number}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <p style="font-family: DejaVu Sans; font-size: 30px; font-style: bold;"  class="page-header">Hóa Đơn Chi Tiết:
                        </p>
                    </div>
                    <div>
                        <span class="ml-2">Người giao hàng: </span>
                        {{$bill->shipper !=null ? $bill->shipper->name." - ". $bill->shipper->phone :''}}
                    </div>
                    <!-- /.col-lg-12 -->
                   <table class="table">
                        <thead>
                            <tr align="center">
                                <th>Tên</th>
                                <th>Gía</th>
                                <th>Số Lượng</th>
                                <th>Size</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($detail as $hi)
                            <tr class="odd gradeX" align="center">
                                <td>{{$hi->name}}</td>
                                <td>{{number_format($hi->price)}} vnđ</td>
                                <td>{{$hi->qty}}</td>
                                <td>{{$hi->size}}</td>
                            </tr>
                           	@endforeach
                            <tr>
                                <td></td>
                                <td class="text-center">Tổng tiền: </td>
                                <td class="text-center">{{$bill->total}} vnd</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-center">Phí vận chuyện đến: {{$t_data['diachi']}}</td>
                                <td class="text-center">{{number_format($t_data['tienship'])}} vnd</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-center">Tiền giảm: </td>
                                <td class="text-center">{{number_format($t_data['tiengiam'])}} vnd</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-center">Tổng : </td>
                               <td class="text-center">{{number_format($bill->total + $t_data['tienship'] - $t_data['tiengiam'])}} vnd</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>

</body>
</html>
