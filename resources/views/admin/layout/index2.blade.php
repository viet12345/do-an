<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Admin">
    <meta name="author" content="">
    <meta name="robots" content="INDEX,FOLLOW"/>

    <base href="{{asset('')}}">
    <link href="admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="admin/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="admin/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- DataTables CSS -->
    <link href="admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="admin/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
   <!-- sweetalert-->
    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> -->


    <link rel="stylesheet" href="css/sweetalert.css">
    <link  rel="icon" type="image/x-icon" href="" />
    <link rel="shortcut icon" href="http://streaming1.danviet.vn/images/2014/favicon.png?v=1.00" />
     <script src="js/sweetalert.js"></script>
     <link rel="stylesheet" type="text/css" href="fontawesome-free-5.13.1-web/css/all.css">
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    @yield('css')

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->

      	@include('admin.layout.header')

        <!-- Page Content -->
       	@yield('noidung')
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="admin/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="admin/dist/js/sb-admin-2.js"></script>

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
