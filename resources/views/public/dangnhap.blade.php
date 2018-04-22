@extends('public.inc.index')
@section('content')
<div class="content_wrapper">

    <div class="container">

       <div class="main bg_white clearfix">

        <div class="box register margin-center w-650 mt30">
            <div class="title-tabs bor-bot-blue2 font-robotonormal position">
                <span class="active blue2 font17 uppercase normal">Đăng nhập</span>
            </div>
            <form action="{!! route('public.dangnhap') !!}" method="post">
            <div class="box-cont pt30 pb30 pl80 pr80 bor-left bor-right bor-bot">
                <div class="clearfix mb20">

                    <ul class="clearfix">
                        <li class="mb20 clearfix">
                            <input name="name" type="text" id="" placeholder="Tên đăng nhập hoặc Email" class="width-full gray border" />
                        </li>
                        <li class="mb20 clearfix">
                            <input name="password" type="password" id="txtPassword" placeholder="Mật khẩu" class="width-full gray border" />
                        </li>
                    </ul>
                </div>

                <div class="bt-suces mb20 clearfix">

                    <a id="btnLogin" class="white bold uppercase font13 nobor pt5 pb5 pl10 pr10 radius font-roboto font15 underline-none normal" href="">Đăng nhập</a>
                    <a href="/" id="login_cancel" class="bg-gray2 cursor bold uppercase font13 nobor pt5 pb5 pl10 pr10 radius font-roboto font15 underline-none none">Thoát
                    </a>
                </div>
                <div class="mb20 clearfix">
                    <label class="clearfix">
                        Bạn chưa có tài khoản? Đăng ký <a class="blue2" href="/dang-ky.htm" title="Đăng ký"> tại đây</a>
                    </label>
                </div>

            </div>
            </form>
        </div>
        <div class="clear">
        </div>
    </div>
</div>
</div>
@endsection
@section('script')
@endsection