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
                   <!-- /.col-lg-12 -->

                        <form action="{{route('warehouse.srote')}}" method="post"  enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Sản Phẩm</label>
                                            <select class="form-control select2" name="product_id" style="width:350px">
                                                <option value="" selected >Chọn sản phẩm</option>
                                                @foreach($products as $product)
                                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('product_id'))
                                            <span class="text-danger font-italic font-weight-lighter"
                                                style="font-size: 14px;">{{ $errors->first('product_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Số Lượng</label>
                                            <input class="form-control" name="number" value="{{old('number')}}" placeholder="Please Enter Number" />
                                            @if ($errors->has('number'))
                                                <span class="text-danger font-italic font-weight-lighter"
                                                    style="font-size: 14px;">{{ $errors->first('number') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Giá</label>
                                            <input class="form-control" name="price" value="{{old('price')}}" placeholder="Please Enter Price" />
                                                @if ($errors->has('price'))
                                            <span class="text-danger font-italic font-weight-lighter"
                                                style="font-size: 14px;">{{ $errors->first('price') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ngày nhập hàng</label>
                                            <input type="date" class="form-control" name="pick_up_date" value="{{old('pick_up_date')}}" placeholder="Please Enter Pick Up Date" />
                                                @if ($errors->has('pick_up_date'))
                                            <span class="text-danger font-italic font-weight-lighter"
                                                style="font-size: 14px;">{{ $errors->first('pick_up_date') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ngày sản xuất</label>
                                            <input type="date" class="form-control" name="manufacture_date" value="{{old('manufacture_date')}}" placeholder="Please Enter Manufacture Date" />
                                                @if ($errors->has('manufacture_date'))
                                            <span class="text-danger font-italic font-weight-lighter"
                                                style="font-size: 14px;">{{ $errors->first('manufacture_date') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ngày hết hạn</label>
                                            <input type="date" class="form-control" name="expired_date" value="{{old('expired_date')}}" placeholder="Please Enter Expired Date" />
                                                @if ($errors->has('expired_date'))
                                            <span class="text-danger font-italic font-weight-lighter"
                                                style="font-size: 14px;">{{ $errors->first('expired_date') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
                                            <button type="reset" class="btn btn-default">Làm Mới</button>
                                        </div>
                                    </div> --}}
                                </div>
                        <form>

               <!-- /.row -->
                        </div>
                </div>
             </div>
           <!-- /.container-fluid -->
       </div>
@endsection

@section('scrip')
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
@endsection
