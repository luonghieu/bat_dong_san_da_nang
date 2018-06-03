@extends('public.inc.index')
@section('content')
<div class="content_wrapper">
    <div class="container">
        <div class="breakdum">
            <a href="{!! route('public.trangchu') !!}">Trang chủ</a><span> <i class="fa fa-caret-right" aria-hidden="true"></i> <h1>Liên hệ</h1></span>
        </div>
        <div class="block_over">
            <div class="row">
                
<div class="col-lg-8 col-md-8 col-sm-8 margintb10">

    <div class="box_form_lienhe">
        @if (session('error'))
        <div class="alert alert-danger">
            <p>{{ session('error') }}</p>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-danger">
            <p>Gửi thành công</p>
        </div>
        @endif
        <form action="{!! route('public.taolienhe') !!}" method="post" class="form_contact">
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <div class="row">
                <div class="width425 col-xs-12 col-sm-12 col-lg-12 col-md-12">
                    <input class="input_form" type="text" id="txtName" name="name" placeholder="Họ và tên"/>
                    @if ($errors->has('name'))
                    <div class="alert alert-lightred alert-dismissable fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>{!! $errors->first('name') !!}</strong>
                    </div>
                    @endif
                </div>
                <div class="width425 col-xs-12 col-sm-12 col-lg-12 col-md-12">
                    <input class="input_form" type="text" id="txtTel" name="phone" placeholder="SĐT..."/>
                    @if ($errors->has('phone'))
                    <div class="alert alert-lightred alert-dismissable fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>{!! $errors->first('phone') !!}</strong>
                    </div>
                    @endif
                </div>
                <div class="width425 col-xs-12 col-sm-12 col-lg-12 col-md-12">
                    <input class="input_form" type="email" id="txtEmail" name="email" placeholder="E-mail..."/>
                    @if ($errors->has('email'))
                    <div class="alert alert-lightred alert-dismissable fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>{!! $errors->first('email') !!}</strong>
                    </div>
                    @endif
                </div>
                <div class="width425 col-xs-12 col-sm-12 col-lg-12 col-md-12">
                    <textarea class="textarea_form" id="txtContent" rows="4" name="content" placeholder="Nội dung..."></textarea>
                    @if ($errors->has('content'))
                    <div class="alert alert-lightred alert-dismissable fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>{!! $errors->first('content') !!}</strong>
                    </div>
                    @endif
                </div>
            </div>
            <div class="clear"></div>
            <div class="box_button">
                <button type="submit" id="send" value="send">Gửi</button>
            </div>
        </form>
        <div class="clear"></div>                
    </div>
</div>
</div>
<div class="clear"></div>
</div>
</div>
</div>
@endsection
@section('script')
@endsection