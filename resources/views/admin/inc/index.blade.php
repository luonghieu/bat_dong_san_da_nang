<!doctype html>
<html class="no-js" lang=""> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Bất động sản Đà Nẵng</title>
    <link rel="icon" type="image/ico" href="{!! asset('public_asset/images/logo2.png') !!}" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ==== Stylesheets ==== -->
    <!-- vendor css files -->
    <link rel="stylesheet" href="{!! asset('admin_asset/css/vendor/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin_asset/css/vendor/animate.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin_asset/css/vendor/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin_asset/js/vendor/animsition/css/animsition.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin_asset/js/vendor/daterangepicker/daterangepicker-bs3.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin_asset/js/vendor/morris/morris.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin_asset/js/vendor/owl-carousel/owl.carousel.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin_asset/js/vendor/owl-carousel/owl.theme.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin_asset/js/vendor/rickshaw/rickshaw.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin_asset/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin_asset/js/vendor/datatables/css/jquery.dataTables.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin_asset/js/vendor/datatables/datatables.bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin_asset/js/vendor/chosen/chosen.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin_asset/js/vendor/summernote/summernote.css') !!}">

    <link rel="stylesheet" href="{!! asset('admin_asset/css/vendor/simple-line-icons.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin_asset/css/vendor/weather-icons.min.css') !!}">
    <!-- vendor css files -->
        <link rel="stylesheet" href="{!! asset('admin_asset/js/vendor/colorpicker/css/bootstrap-colorpicker.min.css') !!}">
        <link rel="stylesheet" href="{!! asset('admin_asset/js/vendor/touchspin/jquery.bootstrap-touchspin.min.css') !!}">

    @yield('css')

    <!-- project main css files -->
    <link rel="stylesheet" href="{!! asset('admin_asset/css/main.css') !!}">
    <!--/ stylesheets -->
<!-- === Vendor JavaScripts === -->
 <script src="{!! asset('admin_asset/js/jquery.min.js') !!}"></script>

        <!-- Latest compiled and minified JavaScript -->

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    
    <!--/ modernizr -->

</head>

<body id="minovate" class="appWrapper">
    <!-- ===Application Content=== -->
    <div id="wrap" class="animsition">
        @include('admin.inc.header')

             <!-- =================================================
            ================= CONTROLS Content ===================
            ================================================== -->
            <div id="controls">
                @include('admin.inc.sidebar')
                @include('admin.inc.rightbar')
            </div>
            <!--/ CONTROLS Content -->
             <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
            <section id="content">

                <div class="page page-dashboard">

                    <div class="pageheader">

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="{!! route('auth.profile') !!}"><i class="fa fa-home"></i> Home</a>
                                </li>
                                <li>
                                    @yield('title')
                                </li>
                            </ul>

                        </div>

                    </div>
                    @yield('content')
                </div>
            </section>
            <!--/ CONTENT -->
        </div>
        <!--/ Application Content -->

        @include('admin.inc.footer')