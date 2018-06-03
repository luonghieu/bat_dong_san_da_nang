<!doctype html>

<html class="no-js" lang=""> <!--<![endif]-->
<head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Bất động sản Đà Nẵng</title>
        <link rel="icon" type="image/ico" href="assets/images/favicon.ico" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- vendor css files -->
        <link rel="stylesheet" href="{!! asset('admin_asset/css/vendor/bootstrap.min.css') !!}">
        <link rel="stylesheet" href="{!! asset('admin_asset/css/vendor/animate.css') !!}">
        <link rel="stylesheet" href="{!! asset('admin_asset/css/vendor/font-awesome.min.css') !!}">
        <link rel="stylesheet" href="{!! asset('admin_asset/css/vendor/animsition.min.css') !!}">


        <link rel="stylesheet" href="{!! asset('admin_asset/css/main.css') !!}">
        <!--/ stylesheets -->
        <script src="{!! asset('admin_asset/s/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js') !!}"></script>
        <!--/ modernizr -->
    </head>

    <body id="minovate" class="appWrapper">
        <div id="wrap" class="animsition">

            <div class="page page-core page-login">

                <div class="container w-420 p-15 bg-white mt-40 text-center">


                    <h2 class="text-light text-greensea">Log In</h2>
                    @if (session('fail'))
                    <div class="alert alert-lightred alert-dismissable fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Account is incorrect!</strong>
                    </div>
                    @endif

                    <form name="form" class="form-validation mt-20" method="post" action="{!! route('auth.login') !!}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <div class="form-group">
                            <input type="text" name="username" class="form-control underline-input" placeholder="username">
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password" class="form-control underline-input">
                        </div>

                        <div class="form-group text-left mt-20">
                            <input type="submit" class="btn btn-greensea b-0 br-2 mr-5" value="Login">
                        </div>

                    </form>


                </div>

            </div>

        </div>
      
        <script src="{!! asset('admin_asset/js/vendor/jquery/jquery-1.11.2.min.js') !!}"></script>

        <script src="{!! asset('admin_asset/js/vendor/bootstrap/bootstrap.min.js') !!}"></script>

        <script src="{!! asset('admin_asset/js/vendor/jRespond/jRespond.min.js') !!}"></script>

        <script src="{!! asset('admin_asset/js/vendor/sparkline/jquery.sparkline.min.js') !!}"></script>

        <script src="{!! asset('admin_asset/js/vendor/slimscroll/jquery.slimscroll.min.js') !!}"></script>

        <script src="{!! asset('admin_asset/js/vendor/animsition/js/jquery.animsition.min.js') !!}"></script>

        <script src="{!! asset('admin_asset/js/vendor/screenfull/screenfull.min.js') !!}"></script>
        <!--/ vendor javascripts -->

        <script src="{!! asset('admin_asset/js/main.js') !!}"></script>
        <!--/ custom javascripts -->


    </body>

</html>
