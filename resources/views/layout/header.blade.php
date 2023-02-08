<div class="header-top">
            <div class="container">
                <div class="pull-left auto-width-left">
                    <ul class="top-menu menu-beta l-inline">
                        <li><a href=""><i class="fa fa-home"></i> Hà Nội</a></li>
                        <li><a href=""><i class="fa fa-phone"></i> 0365042345</a></li>
                    </ul>
                </div>
                <div class="pull-right auto-width-right">
                    <ul class="top-details menu-beta l-inline">
                        @if(Session::has('user_id'))
                        <li><a href="#"><i class="fa fa-user"></i>Chào: {{Session::get('user_name')}}</a></li>
                        <li><a href="index.php/dangxuat"><i class="fa fa-user"></i>Đang Xuất</a></li>
                        @else
                        <li><a href="index.php/dangky">Đăng kí</a></li>
                        <li><a href="index.php/dangnhap">Đăng nhập</a></li>
                         @endif
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div> <!-- .container -->
        </div> <!-- .header-top -->
        <div class="header-body">
            <div class="container beta-relative">
                <div class="pull-left">
                    <a href="{{url('trangchu')}}" id="logo"><img src="{{ asset('image/logo.jpg') }}" width="200px" alt=""></a>
                </div>
                <div class="pull-right beta-components space-left ov">
                    <div class="space10">&nbsp;</div>
                    <div class="beta-comp">
                        <form role="search" method="get" id="searchform" action="index.php/timkiem">
                            <input type="text" value="" name="key" id="s" placeholder="Nhập từ khóa..." />
                            <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                        </form>
                    </div>
                                 <?php
                                    $data=Cart::content();
                                ?>
                    <div class="beta-comp">
                        <div class="cart">
                            <div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng (
                                @if(count($data) >0)
                                 {{$data->count()}}
                                @else
                                Trống
                                @endif
                                ) <i class="fa fa-chevron-down"></i></div>
                            <div class="beta-dropdown cart-body">
                               
                                @foreach($data as $hi)
                                <div class="cart-item">
                                    <div class="media">
                                        <a class="pull-left" href="#"><img src="frontend/image/product/{{$hi->options->image}}" alt=""></a>
                                        <div class="media-body">
                                            <span class="cart-item-title">{{$hi->name}}</span>
                                            <span class="cart-item-options">Size: {{$hi->options->size}}; Color: {{$hi->options->color}}</span>
                                            <span class="cart-item-amount">1*<span>{{number_format($hi->qty)}}</span></span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                               

                                <div class="cart-caption">
                                    <div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">{{Cart::subtotal()}}</span></div>
                                    <div class="clearfix"></div>

                                    <div class="center">
                                        <div class="space10">&nbsp;</div>
                                        <a href="index.php/shopping_cart" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .cart -->
                    </div>
                </div>
                <div class="clearfix"></div>
            </div> <!-- .container -->
        </div> <!-- .header-body -->
        <div class="header-bottom" style="background-color: #0277b8;">
            <div class="container">
                <a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
                <div class="visible-xs clearfix"></div>
                <nav class="main-menu">
                    <ul class="l-inline ov">
                        <li><a href="index.php/trangchu">Trang chủ</a></li>
                        <li><a href="#">Sản phẩm</a>
                            <ul class="sub-menu">
                                @foreach($theloai as $hi)
                                <li><a href="index.php/theloai/{{$hi->id}}">{{$hi->name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                       
                    </ul>
                    <div class="clearfix"></div>
                </nav>
            </div> <!-- .container -->
        </div> <!-- .header-bottom -->