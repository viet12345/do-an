<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                <!-- User Profile-->
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="{{route('dashboard.index')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard </span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="index.php/admin/bill/danhsach" aria-expanded="false"><i class="mdi mdi-tune-vertical"></i><span class="hide-menu">Hóa Đơn </span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-content-copy"></i><span class="hide-menu">Thể Loại </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="index.php/admin/theloai/danhsach" class="sidebar-link"><i class="mdi mdi-format-align-left"></i><span class="hide-menu"> Danh Sách </span></a></li>
                        <li class="sidebar-item"><a href="index.php/admin/theloai/them" class="sidebar-link"><i class="mdi mdi-format-align-right"></i><span class="hide-menu"> Thêm </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-inbox-arrow-down"></i><span class="hide-menu">Mã Giam Gía </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="index.php/admin/coupon/danhsach" class="sidebar-link"><i class="mdi mdi-email"></i><span class="hide-menu"> Danh Sách </span></a></li>
                        <li class="sidebar-item"><a href="index.php/admin/coupon/them" class="sidebar-link"><i class="mdi mdi-email-alert"></i><span class="hide-menu"> Thêm </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-bookmark-plus-outline"></i><span class="hide-menu">Gía Vận Chuyển </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="index.php/admin/quanhuyen/danhsach" class="sidebar-link"><i class="mdi mdi-book-multiple"></i><span class="hide-menu"> Danh Sách </span></a></li>
                        <li class="sidebar-item"><a href="index.php/admin/quanhuyen/them" class="sidebar-link"><i class="mdi mdi-book-plus"></i><span class="hide-menu"> Thêm </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-gradient"></i><span class="hide-menu">Slide </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="index.php/admin/slide/danhsach" class="sidebar-link"><i class="mdi mdi-comment-processing-outline"></i><span class="hide-menu"> Danh Sách </span></a></li>
                        <li class="sidebar-item"><a href="index.php/admin/slide/them" class="sidebar-link"><i class="mdi mdi-calendar"></i><span class="hide-menu"> Thêm </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-widgets"></i><span class="hide-menu">User </span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item"><a href="index.php/admin/user/danhsach" class="sidebar-link"><i class="mdi mdi-toggle-switch"></i><span class="hide-menu"> Danh Sách</span></a></li>
                        <li class="sidebar-item"><a href="index.php/admin/user/them" class="sidebar-link"><i class="mdi mdi-tablet"></i><span class="hide-menu"> Thêm</span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-credit-card-multiple"></i><span class="hide-menu">Sản Phẩm</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="index.php/admin/sanpham/danhsach" class="sidebar-link"><i class="mdi mdi-layers"></i><span class="hide-menu"> Danh Sách</span></a></li>
                        <li class="sidebar-item"><a href="index.php/admin/sanpham/them" class="sidebar-link"><i class="mdi mdi-credit-card-scan"></i><span class="hide-menu">Thêm</span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="index.php/admin/customer/danhsach" aria-expanded="false"><i class="mdi mdi-credit-card-multiple"></i><span class="hide-menu"> Khách Hàng</span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-gradient"></i><span class="hide-menu">Quản Lý Kho </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{route('warehouse.index')}}" class="sidebar-link"><i class="mdi mdi-comment-processing-outline"></i><span class="hide-menu"> Danh Sách  </span></a></li>
                        <li class="sidebar-item"><a href="{{route('warehouse.add')}}" class="sidebar-link"><i class="mdi mdi-calendar"></i><span class="hide-menu"> Thêm  </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-collage"></i><span class="hide-menu">Shipper</span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item"><a href="{{route('shipper.index')}}" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Danh Sách</span></a></li>
                        <li class="sidebar-item"><a href="{{route('shipper.add')}}" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Thêm</span></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
