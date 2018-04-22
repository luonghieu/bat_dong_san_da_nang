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
                    <div class="clearfix mb30">
                        <h5 class="font16 mb10 blue font-robotonormal normal">Thông tin cá nhân</h5>
                        <ul class="clearfix">
                            <li class="mb20 clearfix">
                                <span class="lh35">Họ tên</span>
                                <input name="" type="text" id="txtTendaydu" placeholder="Họ tên" class="w-70-100 gray border fr lh20" />
                            </li>
                            <li class="mb20 clearfix">
                                <span class="lh35">Email</span>
                                <input name="" type="text" id="txtEmail" placeholder="Email" class="w-70-100 gray border fr lh20" /><span class="request" id="spanEmail">*</span>
                            </li>
                            <li class="mb20 clearfix">
                                <span class="lh35">Mật khẩu</span>
                                <input name="" type="password" id="txtMatkhau" placeholder="Mật khẩu" class="w-70-100 gray border fr lh20" /><span class="request" id="spanMatkhau">*</span>
                            </li>
                            <li class="mb20 clearfix">
                                <span class="lh35">Xác nhận lại mật khẩu <span class="request">*</span></span>
                                <input name="" type="password" id="txtNhaplaimatkhau" placeholder="Xác nhận mật khẩu" class="w-70-100 gray border fr lh20" />
                            </li>
                            <li class="mb20 clearfix">
                                <span class="lh35">Điện thoại</span>
                                <input name="" type="text" maxlength="12" id="txtDidong" placeholder="Điện thoại" class="w-70-100 gray border fr lh20" /><span class="request" id="spanDidong">*</span>
                            </li>
                            <li class="mb20 clearfix">
                                <span class="lh35 fl">Địa chỉ</span>
                                <div class="fr wr_select ml65 w-30-100">
                                    <input type="hidden" name="" id="hddQuanHuyen" value="0" />
                                    <select id="Quanhuyen" onchange="ChangeQuanhuyen($(this).val())" class="selectn gray border-green2">
                                        <option value="-1">-- Chọn Quận/Huyện --</option>
                                    </select>
                                </div>
                                <div class="fr wr_select w-30-100">
                                    <input type="hidden" name="" id="hddTinhThanhPho" />
                                    <select id="tinhthanhpho" onchange="ChangeTinhthanhpho($(this).val())" class="selectn gray border-green2">
                                        <option value="-1">-- Chọn Tỉnh/Thành phố --</option>
                                    </select>
                                </div>

                            </li>
                        </ul>
                    </div>
                    <div class="clearfix mb20">
                        <h5 class="font16 mb10 blue font-robotonormal normal">Thông tin khác</h5>
                        <ul class="clearfix">
                            <li class="mb20 clearfix">
                                <span class="lh35">Yahoo Messeger/ MSN</span>
                                <input name="" type="text" id="txtYahoo" placeholder="Yahoo Messeger/ MSN" class="w-70-100 gray border fr lh20" />
                            </li>
                            <li class="mb20 clearfix">
                                <span class="lh35">Facebook</span>
                                <input name="" type="text" id="txtFacebook" placeholder="Facebook/ Twitter" class="w-70-100 gray border fr lh20" />
                            </li>
                            <li class="mb20 clearfix">
                                <span class="lh35">Skype</span>
                                <input name="" type="text" id="txtSkype" placeholder="Skype" class="w-70-100 gray border fr lh20" />
                            </li>
                            <li class="mb20 clearfix">
                                <label class="w-20-100 fl mt5">Mã đăng ký <span class="request">*</span></label>

                                <input name="" type="text" maxlength="4" id="txtcode" Placeholder="Nhập mã đăng ký" class="w-35-100 gray border fr lh20" />
                            </li>
                            <li class="w-70-100 tl fr position">

                                <span class="chkbox"><input id="chkAgree" type="checkbox" name="" checked="checked" /><label for="chkAgree">Tôi đồng ý với điều khoản và quy định của <a class='blue cursor' href='/'>dothidiaoc.com</a></label></span>
                            </li>
                        </ul>
                    </div>
                    <div class="bt-suces clearfix w-70-100 tl fr mb20">
                        <a onclick="return validate();" id="" class="bg-blue cursor white uppercase font15 nobor pt5 pb5 pl20 pr20 radius" href=""><s class="ic-register-white fl mr5"></s>
                            <span class="mt3 fl font-roboto">Đăng ký</span></a>
                        </div>
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