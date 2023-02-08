@extends('welcome')
@section('noidung')

<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản Phẩm</h6>

			</div>

			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index.php/trangchu">Trang Chủ</a> / <span>Sản Phẩm</span>
				</div>
			</div>

			<div class="clearfix"></div>
		</div>
	</div>

	<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-9">


					<div class="row">
						<div class="col-sm-4">
							<img  src="frontend//image/product/{{$chitiet->image}}" alt="">
						</div>



						<form>

						@csrf


						 <input type="hidden" value="{{$chitiet->id}}" class="cart_product_id_{{$chitiet->id}}">

						<div class="col-sm-8">
							<div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="true"></div>
							<div class="single-item-body">
								<p class="single-item-title">{{$chitiet->name}}</p>
								<p class="single-item-price">
									@if($chitiet->promotion_price ==0)
												<span class="flash-sale">${{number_format($chitiet->unit_price)}}</span>
												@else
												<span class="flash-del"> ${{number_format($chitiet->unit_price)}}</span>
												<span class="flash-sale">${{number_format($chitiet->promotion_price)}}</span>
												@endif
								</p>
							</div>

							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>

							<div class="single-item-desc">

							</div>
							<div>
								<?php
									echo($chitiet->description);
								?>
							</div>
							<div class="space20">&nbsp;</div>

							<p>Options:</p>
							<div class="single-item-options">
								<select class="wc-select size" name="size">

									<option value="XS">XS</option>
									<option value="S">S</option>
									<option value="M">M</option>
									<option value="L">L</option>
									<option value="XL">XL</option>
								</select>

								<select class="wc-select soluong" name="qty">

									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
								<button type="button" data-id_product="{{$chitiet->id}}" class="add-to-cart">
												<i class="fa fa-shopping-cart"></i>
												</button>
								<div class="clearfix"></div>
							</div>
						</div>
						</form>
					</div>

					<div class="space50">&nbsp;</div>

					<div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="10"></div>

					<div class="space50">&nbsp;</div>


					<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>



	                <div class="beta-products-list">
						<h4>Sản Phẩm Liên Quan</h4>
						<div class="space50">&nbsp;</div>
							<div class="row">
								@foreach($splienquan as $hi)
								<form method="post" action="index.php/themgiohang">
								@csrf
								<input type="hidden" value="{{$hi->id}}" class="cart_product_id_{{$hi->id}}">
								<div class="col-sm-4">
									<div class="single-item">
											@if(@$hi->promotion_price !=0)
											<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
											@endif
											<div class="single-item-header">
												<a href="index.php/chitiet/{{$hi->id}}"><img height="320px" src="frontend//image/product/{{$hi->image}}" alt=""></a>
											</div>
											<div class="single-item-body">
												<p class="single-item-title">{{$hi->name}}</p>
												<p class="single-item-price">
													@if(@$hi->promotion_price ==0)
													<span class="flash-sale">${{number_format($hi->unit_price)}}</span>
													@else
													<span class="flash-del"> ${{number_format($hi->unit_price)}}</span>
													<span class="flash-sale">${{number_format(@$hi->promotion_price)}}</span>
													@endif
												</p>
											</div>
											<div class="single-item-caption">
												<button type="button" data-id_product="{{$hi->id}}" class="add-to-cart">
												<i class="fa fa-shopping-cart"></i>
												</button>
												<a class="beta-btn primary" href="index.php/chitiet/{{$hi->id}}">Chi Tiết <i class="fa fa-chevron-right"></i></a>
												<div class="clearfix"></div>
											</div>
										</div>
								</div>
								</form>
								@endforeach
							</div>
					</div> <!-- .beta-products-list -->

					</div>



					<div class="col-sm-3 aside">
					<div class="widget">
						<h3 class="widget-title">Sản Phẩm Nổi Bật</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								@foreach($spnoibat as $hi)
								<div class="media beta-sales-item">
									<a class="pull-left" href="index.php/chitiet/{{$hi->id}}"><img  src="frontend/image/product/{{$hi->image}}" alt=""></a>
									<div class="media-body">
										{{$hi->name}}
										@if($hi->promotion_price ==0)
												<span class="flash-sale">${{number_format($hi->unit_price)}}</span>
												@else
												<span class="flash-del"> ${{number_format($hi->unit_price)}}</span>
												<span class="flash-sale">${{number_format($hi->promotion_price)}}</span>
												@endif
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div> <!-- best sellers widget -->
					<div class="widget">
						<h3 class="widget-title">New Products</h3>
						<div class="widget-body">
								<div class="beta-sales beta-lists">
								@foreach($spmoi as $hi)
								<div class="media beta-sales-item">
									<a class="pull-left" href="index.php/chitiet/{{$hi->id}}"><img  src="frontend/image/product/{{$hi->image}}" alt=""></a>
									<div class="media-body">
										{{$hi->name}}
										@if($hi->promotion_price ==0)
												<span class="flash-sale">${{number_format($hi->unit_price)}}</span>
												@else
												<span class="flash-del"> ${{number_format($hi->unit_price)}}</span>
												<span class="flash-sale">${{number_format($hi->promotion_price)}}</span>
												@endif
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div> <!-- best sellers widget -->
				</div>
				</div>

			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->

@endsection
@section('scrip')
	<script type="text/javascript">
		$(document).ready(function(){
			$(".add-to-cart").click(function(){
				var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
              	var size=$('.size').val();
              	var soluong=$('.soluong').val();
                var _token = $('input[name="_token"]').val();

                $.get('{{route('product.get.qty')}}', {id:id,soluong:soluong}, function(result){
                    if(result == 1){
                        $.ajax({
                        url: '{{url('themgiohangchitiet')}}',
                        method: 'POST',
                        data:{cart_product_id:cart_product_id,soluong:soluong,size:size,_token:_token},
                        success:function(data){
                                    //alert(data);
                                    swal({
                                    title: "Đã thêm sản phẩm vào giỏ hàng",
                                    text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                    showCancelButton: true,
                                    cancelButtonText: "Xem tiếp",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "Đi đến giỏ hàng",
                                    closeOnConfirm: false
                                },
                                function() {
                                    window.location.href = "{{url('/shopping_cart')}}";
                                });
                            }
                         });
                    }else{
                        toastr.options.positionClass = 'toast-bottom-right';
                        toastr.warning("Sản phẩm trong kho không đủ, vui lòng giảm số lượng mua");
                    }


                });



			});
		});
	</script>
@endsection
