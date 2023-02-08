@extends('welcome')
@section('noidung')
<div class="rev-slider">
    <div class="fullwidthbanner-container">
        <div class="fullwidthbanner">
            <div class="bannercontainer">
                <div class="banner">
                    <ul>
                        <!-- THE FIRST SLIDE -->
                        @foreach($slide as $hi)

                            <li data-transition="boxfade" data-slotamount="20" class="active-revslide"
                                style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
                                <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined"
                                    data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined"
                                    data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined"
                                    data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined"
                                    data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined"
                                    data-oheight="undefined">
                                    <div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover"
                                        data-bgposition="center center" data-bgrepeat="no-repeat"
                                        data-lazydone="undefined" src="frontend/image/slide/{{ $hi->image }}"
                                        data-src="frontend/image/slide/{{ $hi->image }}"
                                        style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('frontend/image/slide/{{ $hi->image }}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
                                    </div>
                                </div>

                            </li>

                        @endforeach
                    </ul>
                </div>
            </div>


        </div>
    </div>
    <!--slider-->
</div>
<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="beta-products-list">
                        <h4>Sản Phẩm Mới</h4>
                        <div class="row">
                            @foreach($spmoi as $hi)
                                <form>
                                    @csrf
                                    <input type="hidden" value="{{ $hi->id }}"
                                        class="cart_product_id_{{ $hi->id }}">
                                    <div class="col-sm-3">
                                        <div class="single-item">
                                            @if($hi->promotion_price !=0)
                                                <div class="ribbon-wrapper">
                                                    <div class="ribbon sale">Sale</div>
                                                </div>
                                            @endif
                                            <div class="single-item-header">
                                                <a href="index.php/chitiet/{{$hi->id}}"><img height="320px"
                                                        src="frontend//image/product/{{ $hi->image }}" alt=""></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{ $hi->name }}</p>
                                                <p class="single-item-price">
                                                    @if($hi->promotion_price ==0)
                                                        <span
                                                            class="flash-sale">${{ number_format($hi->unit_price) }}</span>
                                                    @else
                                                        <span class="flash-del">
                                                            ${{ number_format($hi->unit_price) }}</span>
                                                        <span
                                                            class="flash-sale">${{ number_format($hi->promotion_price) }}</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="single-item-caption">

                                                <button type="button" data-id_product="{{ $hi->id }}"
                                                    class="add-to-cart">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </button>
                                                <a class="beta-btn primary" href="index.php/chitiet/{{ $hi->id }}">Chi
                                                    Tiết <i class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            @endforeach
                        </div>
                        <div class="row">
                            {{ $spmoi->links() }}
                        </div>
                    </div> <!-- .beta-products-list -->

                    <div class="space50">&nbsp;</div>
                    <div class="beta-products-list">
                        <h4>Sản Phẩm Nổi Bật</h4>
                        <div class="row">
                            @foreach($spnoibat as $hi)
                                <form>

                                    @csrf
                                    <input type="hidden" value="{{ $hi->id }}"
                                        class="cart_product_id_{{ $hi->id }}">
                                    <div class="col-sm-3">
                                        <div class="single-item">
                                            @if($hi->promotion_price !=0)
                                                <div class="ribbon-wrapper">
                                                    <div class="ribbon sale">Sale</div>
                                                </div>
                                            @endif
                                            <div class="single-item-header">
                                                <a href="index.php/chitiet/{{$hi->id}}"><img height="320px"
                                                        src="frontend//image/product/{{ $hi->image }}" alt=""></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{ $hi->name }}</p>
                                                <p class="single-item-price">
                                                    @if($hi->promotion_price ==0)
                                                        <span
                                                            class="flash-sale">${{ number_format($hi->unit_price) }}</span>
                                                    @else
                                                        <span class="flash-del">
                                                            ${{ number_format($hi->unit_price) }}</span>
                                                        <span
                                                            class="flash-sale">${{ number_format($hi->promotion_price) }}</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="single-item-caption">

                                                <button type="button" data-id_product="{{ $hi->id }}"
                                                    class="add-to-cart">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </button>
                                                <a class="beta-btn primary" href="index.php/chitiet/{{ $hi->id }}">Chi
                                                    Tiết <i class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            @endforeach
                        </div>
                        <div class="row">
                            {{ $spnoibat->links() }}
                        </div>
                        <div class="space40">&nbsp;</div>

                    </div> <!-- .beta-products-list -->
                </div>
            </div> <!-- end section with sidebar and main content -->


        </div> <!-- .main-content -->
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection
@section('scrip')
<script type="text/javascript">
    $(document).ready(function () {
        $(".add-to-cart").click(function () {
            var id = $(this).data('id_product');
            var cart_product_id = $('.cart_product_id_' + id).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{ url('themgiohang') }}',
                method: 'POST',
                data: {
                    cart_product_id: cart_product_id,
                    _token: _token
                },
                success: function (data) {
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
                        function () {
                            window.location.href =
                                "{{ url('/shopping_cart') }}";
                        });
                }

            });

        });
    });

</script>

@endsection
