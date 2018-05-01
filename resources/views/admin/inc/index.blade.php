<!doctype html>
<html class="no-js" lang=""> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Minovate - Admin Dashboard</title>
    <link rel="icon" type="image/ico" href="{!! asset('admin_asset/images/favicon.ico') !!}" />
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

    <!-- ===Modernizr=== -->
    <script src="{!! asset('admin_asset/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js') !!}"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <link href="{{ asset('admin_asset/css/rateit.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('admin_asset/js/jquery.rateit.min.js') }}" type="text/javascript"></script>
    
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

                        <h2>Dashboard <span>@yield('title')</span></h2>
                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="index-2.html"><i class="fa fa-home"></i> Home</a>
                                </li>
                                <li>
                                    <a href="index-2.html">@yield('title')</a>
                                </li>
                            </ul>

                            <div class="page-toolbar">
                                <a role="button" tabindex="0" class="btn btn-lightred no-border pickDate">
                                    <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span></span>&nbsp;&nbsp;<i class="fa fa-angle-down"></i>
                                </a>
                            </div>

                        </div>

                    </div>
                    @yield('content')
                </div>
            </section>
            <!--/ CONTENT -->
        </div>
        <!--/ Application Content -->

        @include('admin.inc.footer')