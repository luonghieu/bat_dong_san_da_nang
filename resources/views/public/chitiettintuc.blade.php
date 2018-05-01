@extends('public.inc.index')
@section('content')
<div class="content_wrapper">
    <div class="container">
        <div class="breakdum">
            <a href="http://phoson.vn">Trang chủ</a> <i class="fa fa-caret-right" aria-hidden="true"></i> <a href="{!! route('public.tintuc', ['catId' => $obj->cat_id]) !!}">{!! $obj->catNew->name !!}</a> <span> <i class="fa fa-caret-right" aria-hidden="true"></i>{!! $obj->name !!}</span>
        </div>
        <div class="row">
            <div class="col-md-8">
                <span class="item_news_date" style="float:left">{!! $obj->created_at !!}</span>
                <span class="item_news_date" style="float:right">Lượt xem: {!! $obj->view !!}</span>
                <div class="clear"></div>
                <h1 class="item_news_name">{!! $obj->name !!}</h1>
                <h2 class="chu_thich_detail"></h2>
                <div class="noi_dung">
                    {!! $obj->detail !!}
                </div>
            </div>
            <div class="col-md-4">
                <span class="ct_left_title">Bài viết liên quan</span>
                <ul class="ct_left_ul">
                    @foreach($relatedNews as $obj)
                    <li>
                        <h3><a class="item_news_name_left" href="{!! route('public.chitiettintuc', ['id' => $obj->id]) !!}">{!! $obj->name !!}</a></h3>
                        <span class="item_news_date_left">{!! $obj->created_at !!}</span>
                    </li>
                    @endforeach
                    
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection