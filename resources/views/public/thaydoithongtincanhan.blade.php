
@extends('public.inc.index')
@section('content')
@if (session('objCustomer'))
@php      
$objCustomer = Session::get("objCustomer");
@endphp
@endif
<div class="content_wrapper">

<div id="container">
<div class="main bg_white clearfix">

    <div class="box margin-center mt50 mb30">        

        <div class="title-tabs bor-bot-blue2 font-robotonormal normal uppercase font17 blue2 position normal w-700 fr">
            Thay đổi thông tin cá nhân
        </div>
        <div class="value-newsup clearfix">
            <div id="PH_Container_MainContent_pnMainContent">
                <form class="form-horizontal" role="form" method="post" action="{!! route('public.trangcanhan.postthaydoithongtincanhan') !!}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div id="boxUpadate" class="w-700 fr">
                        @if (session('error'))
                        <div class="alert alert-danger">
                            <p>{{ session('error') }}</p>
                        </div>
                        @endif

                        @if (session('success'))
                        <div class="alert alert-danger">
                            <p>Cập nhật thành công</p>
                        </div>
                        @endif
                        <div class="clearfix">
                            <ul class="mt10 clearfix bor-left bor-right bor-top pd20">
                                <li class="mb20 clearfix">
                                    <label class="w-20-100 fl mt5">Họ tên</label>
                                    <label class="w-80-100 fl pl20">
                                        <input name="name" type="text" value="{!! $objCustomer->poster->name !!}" id="txtFullName" class="width-full" />
                                        <input type="hidden" name="id" id="hddUserId" value="{!! $objCustomer->poster->id !!}" />
                                        @if ($errors->has('name'))
                                        <div class="alert alert-lightred alert-dismissable fade in">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <strong>{!! $errors->first('name') !!}</strong>
                                        </div>
                                        @endif
                                    </label>
                                </li>
                                <li class="mb20 clearfix">
                                    <label class="w-20-100 fl mt5">Email</label>
                                    <label class="w-80-100 fl mt5 pl20">
                                        <span id="txtEmail">{!! $objCustomer->email !!}</span>
                                    </label>
                                </li>
                                <li class="mb20 clearfix">
                                    <label class="w-20-100 fl mt5">Điện thoại<span class="request"> *</span></label>
                                    <label class="w-80-100 fl pl20">
                                        <input name="phone" type="text" value="{!! $objCustomer->poster->phone !!}" id="txtPhone" class="width-full" /><span class="null" id="spanDidong"></span></label>
                                        @if ($errors->has('phone'))
                                        <div class="alert alert-lightred alert-dismissable fade in">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <strong>{!! $errors->first('phone') !!}</strong>
                                        </div>
                                        @endif
                                    </li>
                                    <li class="mb20 clearfix">
                                        <label class="w-20-100 fl mt5">Địa chỉ</label>
                                        <label class="w-80-100 fl pl20">
                                            <input name="address" type="text" value="{!! $objCustomer->poster->address !!}" id="txtPhone" class="width-full" /><span class="null" id="spanDidong"></span></label>
                                            @if ($errors->has('address'))
                                            <div class="alert alert-lightred alert-dismissable fade in">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>{!! $errors->first('address') !!}</strong>
                                            </div>
                                            @endif
                                        </li>
                                    </ul>
                                </div>

                                <div class="mb30 clearfix bor-left bor-right bor-bot pl20 pb20 pr20">
                                    <input type="submit" class="fl bg-orange cursor white bold uppercase normal nobor lh35 ml23-100 pl20 pr20 radius font-roboto font15" value="Lưu thay đổi" style="padding: 10px;">
                                </div>

                            </div>
                        </form>
                        @include('public.inc.trangcanhan')
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
<script src="{!! asset('public_asset/js/jquery.cookie-1.4.1.js') !!}" type="text/javascript"></script>

<script src="{!! asset('public_asset/js/Common.min.js?v=201705015111') !!}" type="text/javascript"></script>

<script src="{!! asset('public_asset/js/jquery-ui.min.js') !!}"></script>

<script type="text/javascript" src="{!! asset('public_asset/js/jquery.placeholder.min.js') !!}"></script>

<script type="text/javascript" src="{!! asset('public_asset/js/jquery.selectbox-0.2.js') !!}"></script>

@endsection