@extends('welcome')
@section('noidung')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Giỏ hàng</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{url('trangchu')}}">Trang Chủ</a> / <span>Giỏ hàng</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div class="container">
		<div id="content">

			<div class="table-responsive">
				<!-- Shop Products Table -->
				<table class="shop_table beta-shopping-cart-table" cellspacing="0">
					<thead>
						<tr>
							<th class="product-name">Sản Phẩm</th>
							<th class="product-price">Gía</th>

							<th class="product-quantity">Số Lượng.</th>
							<th class="product-quantity">Kích Cỡ</th>

							<th class="product-subtotal">Tiền</th>
							<th class="product-status">Cập Nhập</th>
							<th class="product-remove">Xóa</th>
						</tr>
					</thead>
					<?php
                        $data=Cart::content();
					?>
					<tbody>
						@foreach($data as $hi)
						<form action="index.php/suagiohang" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}"/>
						<input type="hidden" name="rowId" value="{{$hi->rowId}}"/>
                        <input type="hidden" name="image" value="{{$hi->options->image}}"/>
                        <input type="hidden" name="id" value="{{$hi->id}}"/>
						<tr class="cart_item">
							<td class="product-name">
								<div class="media">
									<img  src="frontend//image/product/{{$hi->options->image}}" alt="">
									<div class="media-body">
										<p class="font-large table-title">{{$hi->name}}</p>

									</div>
								</div>
							</td>
							<td class="product-price">
								<span class="amount">{{$hi->price}}</span>
							</td>
							<td class="product-quantity">
								<input class="wc-select" type="number" min="1" id="product-qty" name="qty" value="{{$hi->qty}}">
							</td>

							<td class="product-quantity">
								<select class="wc-select" name="size">
									<option @if($hi->options->size =="XS")
                                        selected=""
                                        @endif value="XS">XS</option>
									<option @if($hi->options->size =="S")
                                        selected=""
                                        @endif value="S">S</option>
									<option @if($hi->options->size =="M")
                                        selected=""
                                        @endif value="M">M</option>
									<option @if($hi->options->size =="L")
                                        selected=""
                                        @endif value="L">L</option>
									<option @if($hi->options->size =="XL")
                                        selected=""
                                        @endif value="XL">XL</option>
								</select>
							</td>
							<td class="product-subtotal">
								<span class="amount">{{number_format($hi->subtotal)}} </span>
							</td>
							<td class="product-status">
								<button type="submit" class="add-to-cart">
								<i class="fa fa-edit"></i>
								</button>
							</td>
							<td class="product-remove">
								<a href="index.php/xoagiohang/{{$hi->rowId}}" class="remove xoasanphamgiohnag add-to-cart"  title="Remove this item"><i style="line-height: 35px !important;     color: #fff;" class="fas fa-trash-alt"></i></a>
							</td>

						</tr>
						</form>
						@endforeach
					</tbody>
				</table>
				<!-- End of Shop Table Products -->
			</div>
			<div class="row">
						<div class="col-md-6">

								@if(Session::has('succes_coupon'))
                                    <div class="alert alert-success">
                                        {{Session::get('succes_coupon')}}
                                    </div>
	                            @elseif(Session::has('error_coupon'))
                                    <div class="alert alert-success">
                                        {{Session::get('error_coupon')}}
                                    </div>
	                            @endif
                                <div class="col-md-12 row coupon" style="margin-bottom: 30px;">
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="mt-4"  method="POST" action="{{url('apply_coupon')}}">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Mã giảm giá</label>
                                                    <input type="text" name="coupon_code" value="" placeholder="Mã giảm giá">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Áp Dụng</button>
                                                @if(Session::has('coupon'))
                                                <a href="{{url('xoamagiamgia')}}" class="btn btn-default">
                                                    Xóa Mã Giảm Gía <i class="fa fa-trash"></i>
                                                </a>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
								@php
		 						    $fee_ship=Session::get('fee_ship');
								@endphp
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Chọn Quận - Huyện:
                                                @if(Session::has('fee_ship'))
                                                {{$fee_ship[0]['name']}} - {{number_format($fee_ship[0]['fee'])}} VND
                                                @endif
                                            </label>
                                            <select class="form-control custom-select id_fee_ship" data-placeholder="Choose a quận huyện" tabindex="1">
                                                <option value="">Chưa chọn<option>
                                                    @foreach($quanhuyen as $hi)
                                                     <option value="{{$hi->id}}"
															@if(Session::has('fee_ship'))
																{{-- $fee_ship=Session::get('fee_ship'); --}}
																@if($fee_ship[0]['id_fee_ship'] == $hi->id)
																selected=""
																@endif
															@endif
                                                         >{{$hi->name}} - {{number_format($hi->fee)}} vnd</option>
                                                         
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="card-body">
                                        @if(Session::has('fee_ship'))
                                        <a href="index.php/thanhtoan" class="btn btn-primary">
                                        Tiến Hành Thanh Toán <i class="fa fa-check"></i></a>
                                        @else
                                            <div class="cart-totals-row">Quận Huyện:Chưa Chọn </div>
                                        @endif
                                    </div>
                                </div>

						</div>
						<div class="col-md-6 row">
                            @php
                                $coupon=Session::get('coupon');
                                $tongtien=Cart::subtotal();
                                $tongtien =str_replace( ',', '', $tongtien );
                            @endphp

							<div class="cart-totals pull-right" style="width: 500px;">
								<div class="cart-totals-row"><h5 class="cart-total-title">Tổng số giỏ hàng</h5></div>
								<div class="cart-totals-row">Tổng tiền:{{Cart::subtotal()}} VND</div>
								@if(Session::has('fee_ship'))
									<div class="cart-totals-row">Phí Vận Chuyển: {{$fee_ship[0]['name']}} - {{number_format($fee_ship[0]['fee'])}} VND</div>
								@else
									<div class="cart-totals-row">Phí Vận Chuyển:Chưa Chọn </div>
								@endif
                                @if(!empty($coupon))
                                    @if($coupon[0]['condition']==0)
                                        <div class="cart-totals-row">Số Tiền Giảm : {{$coupon[0]['number']}} %</div>
                                        <div class="cart-totals-row">Tổng Tiền Giảm: {{number_format($tongtien * $coupon[0]['number'] /100)}} VND</div>
										@if ($fee_ship)
                                        	<div class="cart-totals-row">Tổng :{{number_format($tongtien - $tongtien * $coupon[0]['number'] /100 +$fee_ship[0]['fee']) }} VND</div>
										@else 
                                        	<div class="cart-totals-row">Tổng :{{number_format($tongtien - $tongtien * $coupon[0]['number'] /100) }} VND</div>
										@endif
                                    @elseif($coupon[0]['condition']==1)
                                        <div class="cart-totals-row">Số Tiền Giảm: {{number_format($coupon[0]['number'])}} VND</div>
                                        <div class="cart-totals-row">Tổng Tiền Giảm: {{number_format($coupon[0]['number'])}} VND</div>
										@if ($fee_ship) 
                                        	<div class="cart-totals-row">Tổng :{{number_format($tongtien -  $coupon[0]['number'] + $fee_ship[0]['fee']) }} VND</div>
										@else 
                                        	<div class="cart-totals-row">Tổng :{{number_format($tongtien -  $coupon[0]['number']) }} VND</div>
										@endif
                                    @endif
                                @else
									@if ($fee_ship)
										<div class="cart-totals-row">Tổng :{{number_format($tongtien + $fee_ship[0]['fee']) }} VND</div>
									@else 
										<div class="cart-totals-row">Tổng :{{number_format($tongtien) }} VND</div>
									@endif
                                @endif
							</div>

						</div>
					</div>

			<!-- Cart Collaterals -->

			<!-- End of Cart Collaterals -->
			<div class="clearfix"></div>

		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection
@section('scrip')
	<script type="text/javascript">
		$(document).ready(function(){
			$('.id_fee_ship').change(function(){
				var id_fee_ship=$(this).val();
				$.get('{{URL::to("fee_apply")}}',{id_fee_ship:id_fee_ship},function(){
					window.location.href = "{{url('/shopping_cart')}}";
					//alert(data);
				});

			});
		});
	</script>
@endsection
