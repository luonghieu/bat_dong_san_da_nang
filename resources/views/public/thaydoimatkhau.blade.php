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
                Thay đổi mật khẩu
            </div>
            <div class="value-newsup clearfix">
                <div id="PH_Container_MainContent_pnMainContent">
                    <form class="form-horizontal" role="form" method="post" action="{!! route('public.trangcanhan.postthaydoimatkhau') !!}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <input type="hidden" name="id" value="{!! $objCustomer->id !!}" />

                        <div class="w-700 fr">
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
                        <div class="clearfix border pd20 mt10">
                            <ul>
                                <li class="mb20 clearfix">
                                    <label class="w-20-100 fl mt5">Mật khẩu cũ <span class="request">(*)</span></label>
                                    <label class="w-80-100 fl pl20">
                                       <input type="password" name="oldpassword" class="width-full" /></label>
                                       @if ($errors->has('oldpassword'))
                                       <div class="alert alert-lightred alert-dismissable fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <strong>{!! $errors->first('oldpassword') !!}</strong>
                                    </div>
                                    @endif
                                </li>
                                <li class="mb20 clearfix">
                                    <label class="w-20-100 fl mt5">Mật khẩu mới <span class="request">(*)</span></label>
                                    <label class="w-80-100 fl pl20">
                                        <input type="password" name="newpassword" class="width-full"/></label>
                                        @if ($errors->has('newpassword'))
                                        <div class="alert alert-lightred alert-dismissable fade in">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <strong>{!! $errors->first('newpassword') !!}</strong>
                                        </div>
                                        @endif
                                    </li>
                                    <li class="mb20 clearfix">
                                        <label class="w-20-100 fl mt5">Xác nhận mật khẩu <span class="request">(*)</span></label>
                                        <label class="w-80-100 fl pl20">
                                            <input type="password" name="passwordagain" class="width-full"/></label>
                                            @if ($errors->has('passwordagain'))
                                            <div class="alert alert-lightred alert-dismissable fade in">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>{!! $errors->first('passwordagain') !!}</strong>
                                            </div>
                                            @endif
                                        </li>
                                    </ul>
                                    <label class="tr">
                                        <input type="submit" class="fl bg-orange cursor white bold uppercase normal nobor lh35 ml23-100 pl20 pr20 radius font-roboto font15" value="Hoàn tất" style="padding: 10px;">
                                    </label>
                                </div>

                            </div>
                            @include('public.inc.trangcanhan')
                        </form>
                    </div>
                </div>
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

