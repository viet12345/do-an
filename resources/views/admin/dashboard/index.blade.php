@extends('admin.layout.index')
@section('noidung')
<!-- Container fluid  -->
<div id="page-wrapper">
<!-- ============================================================== -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row m-t-10">
                            <div class="col-md-4 col-sm-12 col-lg-4">
                                <div class="d-flex align-items-center">
                                    <div class="m-r-10"><span class="text-orange display-5"><i
                                                class="mdi mdi-wallet"></i></span></div>
                                    <div><span class="text-muted pl-2">Thể Loại</span>
                                        <h3 class="font-medium m-b-0 pl-2">{{ ($typeProducts  ) ?? 0 }}</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- col -->
                            <div class="col-md-4 col-sm-12 col-lg-4">
                                <div class="d-flex align-items-center">
                                    <div class="m-r-10"><span class="text-orange display-5"><i
                                                class="fas fa-calendar-check"></i></span></div>
                                    <div><span class="text-muted pl-2">Sản Phẩm</span>
                                        <h3 class="font-medium m-b-0 pl-2">{{ $products ?? 0 }}</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- col -->
                            <!-- col -->
                            <div class="col-md-4 col-sm-12 col-lg-4">
                                <div class="d-flex align-items-center">
                                    <div class="m-r-10"><span class="text-primary display-5"><i
                                                class="far fa-calendar-times"></i></span></div>
                                    <div><span class="text-muted pl-2">Slide</span>
                                        <h3 class="font-medium m-b-0 pl-2">{{ $slide ?? 0 }}</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- col -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body analytics-info">
                        <h4 class="card-title">Thống Kê Thanh Toán Hóa Đơn Theo Tháng</h4>
                        <div id="basic-area" style="height:400px;"></div>
                    </div>
                </div>
            </div>

        </div>

        <!-- ============================================================== -->
        <!-- Overview of the month -->
        <!-- ============================================================== -->
        <div class="row">

            <div class="col-12">
                <div id="messages"></div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">Hóa Đơn</h4>


                        <div class="table-responsive mt-2" id="table-contents">
                            <table id="datatable" class="table table-striped">
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
            </div>


        </div>
        {{-- <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    @include('admin.contacts.list_contacts')
                </div>
            </div>
        </div> --}}

    </div>
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
@endsection

@section("scrip")
<script src="{{ asset('xtreme/assets/libs/echarts/dist/echarts-en.min.js') }}"></script>
  <!-- This Page JS -->
{{-- <script src="../../dist/js/pages/echarts/line/line-charts.js"></script> --}}
<script>
    $('#datatable').DataTable({
        responsive : true,
			processing : true,
			serverSide : true,
			stateSave: false,
			searching: false,
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
    })

</script>
<script>
    $(function() {
    "use strict";
        var arrSeriesBills = JSON.parse('<?php echo json_encode($arrSeriesBills) ?>')
        var arrSeriesNames = JSON.parse('<?php echo json_encode($arrSeriesNames) ?>')
        var bareaChart = echarts.init(document.getElementById('basic-area'));
        var option = {
                // Setup grid
                grid: {
                    left: '1%',
                    right: '5%',
                    bottom: '3%',
                    containLabel: true
                },
                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    // data:['Max temp','Min temp']
                },
                color: ['#2962FF', '#109618', '#ff9900'],
                calculable : true,
                xAxis : [
                    {
                        type : 'category',
                        boundaryGap : false,
                        data : arrSeriesNames
                    }
                ],
                yAxis : [
                    {
                        type : 'value',
                        // axisLabel : {
                        //     formatter: '{value} °C'
                        // }
                    }
                ],
                series : arrSeriesBills
            };
        // use configuration item and data specified to show chart
        bareaChart.setOption(option);

});
</script>

@endsection
