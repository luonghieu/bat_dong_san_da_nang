@extends('public.inc.index')
@section('content')
<div class="content_wrapper">
    <div class="container">
        <div class="breakdum">
            <a href="http://phoson.vn">Trang chủ</a><span> <i class="fa fa-caret-right" aria-hidden="true"></i> <h1>Dự án</h1></span>
        </div>
        <div class="row">
            <div class="col-md-3">
                <ul class="ct_left_ul1">
                    <li class="havespan">
                        <span>Danh mục dự án</span>                
                    </li>
                    <li class="active">
                        <h3><a class="item_news_name_left" href="http://phoson.vn/du-an-noi-bat/">Dự án nổi bật</a></h3>                
                    </li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <ul class="product_ul">
                        @foreach($list as $obj)
                        <li class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-479">
                            <div class="boc">
                                <div style="position: relative;overflow: hidden;" class="contai"><a href="{!! route('public.chitietduan', ['id' => $obj->id ]) !!}"><img src="{{ asset($obj->image) }}" alt="{!! $obj->name !!}" class="img-responsive" /></a>
                                    <h2 class="ten"><a href="{!! route('public.chitietduan', ['id' => $obj->id ]) !!}">{!! $obj->name !!}</a></h2>
                                </div>
                                <div class="content_content">
                                    <span class="ngay">{!! $obj->created_at !!}</span>
                                    <div class="chu_thich">{!! $obj->name !!}</div>
                                    <div class="chitiet"><a href="{!! route('public.chitietduan', ['id' => $obj->id ]) !!}">Xem thêm <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>

                                    <div class="clear"></div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                        
                        <div class="navigation"><span class="current_page_item">Trang <b>1</b> trên <b>3</b></span><span class="current_page_item">1</span><span class="page_item"><a href="http://phoson.vn/du-an-noi-bat/2">2</a></span><span class="page_item"><a href="http://phoson.vn/du-an-noi-bat/3">3</a></span><span class="page_item"><a href="http://phoson.vn/du-an-noi-bat/2">»</a></span></div>   
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('script')
@endsection