@extends('public.inc.index')
@section('content')
<div class="content_wrapper">
    <div class="container">
        <div class="breakdum">
            <a href="{!! route('public.trangchu') !!}">Trang chủ</a><span> ><h1>Giới thiệu</h1></span>
        </div>
        <div class="noi_dung"><p>
            <br />
            @foreach($list as $obj)
            <span style="color:#003366;"><span style="font-size:20px;"><strong>{!! $obj->name !!}</strong></span></span></p>
            <p>
            {!! $obj->description !!}</p>
            <p>
            &nbsp;</p>
            <p>
            @endforeach

        </div>
    </div>
</div>
@endsection
@section('script')
@endsection
