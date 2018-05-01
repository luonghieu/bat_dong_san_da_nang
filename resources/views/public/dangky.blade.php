@extends('public.inc.index')
@section('content')
<div class="content_wrapper">

    <div class="container">

     <div class="main bg_white clearfix">

        <div id="box_register" class="box register margin-center w-800 mt30 mb40">
            <div class="title-tabs bor-bot-blue2 font-robotonormal position">
                <span class="active blue2 font17 uppercase">Đăng ký thành viên</span>
            </div>
            <div class="box-cont pt30 pb30 pl80 pr80 bor-left bor-right bor-bot">
                <div id="pnBox">

                    <h6 class="clearfix mb20 orange font14 normal">Mời Quý vị đăng ký thành viên để được hưởng nhiều lợi ích và hỗ trợ từ chúng tôi!
                    </h6>
                    @if (session('error'))
                    <div class="alert alert-danger">
                        <p>{{ session('error') }}</p>
                    </div>
                    @endif

                    @if (session('success'))
                    <div class="alert alert-danger">
                        <p>Đăng ký thành công</p>
                    </div>
                    @endif
                    <form action="{!! route('public.postdangky') !!}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <div class="clearfix mb30">
                            <h5 class="font16 mb10 blue font-robotonormal normal">Thông tin cá nhân</h5>
                            <ul class="clearfix">
                                <li class="mb20 clearfix">
                                    <span class="lh35">Họ tên</span>
                                    <input name="name" type="text" id="txtTendaydu" placeholder="Họ tên" class="w-70-100 gray border fr lh20" />
                                    @if ($errors->has('name'))
                                    <div class="alert alert-lightred alert-dismissable fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <strong>{!! $errors->first('name') !!}</strong>
                                    </div>
                                    @endif
                                </li>
                                <li class="mb20 clearfix">
                                    <span class="lh35">Email</span>
                                    <input name="email" type="text" id="txtEmail" placeholder="Email" class="w-70-100 gray border fr lh20" /><span class="request" id="spanEmail">*</span>
                                    @if ($errors->has('email'))
                                    <div class="alert alert-lightred alert-dismissable fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <strong>{!! $errors->first('email') !!}</strong>
                                    </div>
                                    @endif
                                </li>
                                <li class="mb20 clearfix">
                                    <span class="lh35">Mật khẩu</span>
                                    <input name="password" type="password" id="txtMatkhau" placeholder="Mật khẩu" class="w-70-100 gray border fr lh20" /><span class="request" id="spanMatkhau">*</span>
                                    @if ($errors->has('password'))
                                    <div class="alert alert-lightred alert-dismissable fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <strong>{!! $errors->first('password') !!}</strong>
                                    </div>
                                    @endif
                                </li>
                                <li class="mb20 clearfix">
                                    <span class="lh35">Xác nhận lại mật khẩu <span class="request">*</span></span>
                                    <input name="passwordagain" type="password" id="txtNhaplaimatkhau" placeholder="Xác nhận mật khẩu" class="w-70-100 gray border fr lh20" />
                                    @if ($errors->has('passwordagain'))
                                    <div class="alert alert-lightred alert-dismissable fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <strong>{!! $errors->first('passwordagain') !!}</strong>
                                    </div>
                                    @endif
                                </li>
                                <li class="mb20 clearfix">
                                    <span class="lh35">Điện thoại</span>
                                    <input name="phone" type="text" maxlength="12" id="txtDidong" placeholder="Điện thoại" class="w-70-100 gray border fr lh20" /><span class="request" id="spanDidong">*</span>
                                    @if ($errors->has('phone'))
                                    <div class="alert alert-lightred alert-dismissable fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <strong>{!! $errors->first('phone') !!}</strong>
                                    </div>
                                    @endif
                                </li>
                                <li class="mb20 clearfix">
                                    <span class="lh35 fl">Địa chỉ</span>
                                    <input name="address" type="text" maxlength="12" id="txtDidong" placeholder="Địa chỉ" class="w-70-100 gray border fr lh20" /><span class="request" id="spanDidong">*</span>
                                    @if ($errors->has('address'))
                                    <div class="alert alert-lightred alert-dismissable fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <strong>{!! $errors->first('address') !!}</strong>
                                    </div>
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <div class="bt-suces clearfix w-70-100 tl fr mb20">
                            <input type="submit" value="Đăng ký" class="bg-blue cursor white uppercase font15 nobor pt5 pb5 pl20 pr20 radius" style="padding: 10px;" />
                        </div>
                    </form>
                    <div class="clearfix"></div>

                </div>

            </div>
        </div>
        <div class="clear">
        </div>
    </div>
</div>
</div>
@endsection
@section('script')
@endsection