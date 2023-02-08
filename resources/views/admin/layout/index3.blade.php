<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>AdminLTE 3 | Dashboard 2</title>
  <base href="{{asset('')}}">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="LTE/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="LTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="LTE/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
 {{-- css by Custom --}}
  <!-- DataTables CSS -->
  {{-- <link href="admin/dist/css/sb-admin-2.css" rel="stylesheet"> --}}
  <link href="admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
 <link href="admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
 <!-- DataTables Responsive CSS -->
 <link href="admin/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
 <link rel="stylesheet" href="css/sweetalert.css">
 <link  rel="icon" type="image/x-icon" href="" />
 <link rel="shortcut icon" href="http://streaming1.danviet.vn/images/2014/favicon.png?v=1.00" />
  <script src="js/sweetalert.js"></script>
  <link rel="stylesheet" type="text/css" href="fontawesome-free-5.13.1-web/css/all.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
  {{-- <script src="css/mystyle.css"></script> --}}
  @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
       <!-- Left navbar links -->
    {{-- <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

      </ul> --}}
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="LTE/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="LTE/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      @include('admin.layout.leftbar')
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
    <!-- Main content -->
    {{-- <section class="content"> --}}
      {{-- <div class="container-fluid"> --}}
        @yield('noidung')
      {{-- </div><!--/. container-fluid --> --}}
    {{-- </section> --}}
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.4
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
{{-- <script src="LTE/plugins/jquery/jquery.min.js"></script> --}}
 <!-- jQuery -->
 <script src="admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
{{-- <script src="LTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
  <!-- Bootstrap Core JavaScript -->
  <script src="admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- overlayScrollbars -->
<script src="LTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="LTE/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
{{-- <script src="LTE/dist/js/demo.js"></script> --}}

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="LTE/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="LTE/plugins/raphael/raphael.min.js"></script>
<script src="LTE/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="LTE/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="LTE/plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="LTE/dist/js/pages/dashboard2.js"></script>
<script src="admin/ckeditor/ckeditor.js"></script>

<script type="text/javascript">

    CKEDITOR.replace('ckeditor');
    CKEDITOR.replace('ckeditor1');
    CKEDITOR.replace('ckeditor3');
    CKEDITOR.replace('ckeditor_themtl');
    CKEDITOR.replace('ckeditor_suatl');
</script>
<!-- DataTables JavaScript -->
<script src="admin/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
<script src="admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
$(document).ready(function() {
    $('#dataTables-example').DataTable({
            responsive: true
    });
});
</script>

<script>
function convertMsg(msg) {
    msg = msg.toLowerCase();
    msg = msg.charAt(0).toUpperCase() + msg.slice(1);
    return msg;
}
@if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.options.positionClass = 'toast-bottom-right';
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.options.positionClass = 'toast-bottom-right';
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  @endif
</script>
@yield('scrip')
</body>
</html>
