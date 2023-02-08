<script src="js/sweetalert.js"></script>
    <link rel="stylesheet" href="css/sweetalert.css">

								@foreach($timkiem as $hi)
								<form>

						        @csrf
                           		 <input type="hidden" value="{{$hi->id}}" class="cart_product_id_{{$hi->id}}">


								<div class="col-sm-3">
									<div class="single-item">
										@if($hi->promotion_price !=0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										@endif
										<div class="single-item-header">
											<a href="index.php/chitiet/{{$hi->id}}"><img height="320px" src="frontend//image/product/{{$hi->image}}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$hi->name}}</p>
											<p class="single-item-price">
												@if($hi->promotion_price ==0)
												<span class="flash-sale">${{number_format($hi->unit_price)}}</span>
												@else
												<span class="flash-del"> ${{number_format($hi->unit_price)}}</span>
												<span class="flash-sale">${{number_format($hi->promotion_price)}}</span>
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

<script type="text/javascript">
		$(document).ready(function(){
			$(".add-to-cart").click(function(){
				var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();

                var _token = $('input[name="_token"]').val();


                    $.ajax({
                    url: '{{url('themgiohang')}}',
                    method: 'POST',
                    data:{cart_product_id:cart_product_id,_token:_token},
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

			});
		});
	</script>
