@extends('public.inc.index')
@section('slider')
<div style="position: relative;z-index: 2;"> 

    <div class="slider-wrapper theme-default">

        <div class="w3-content w3-section" style="max-width:100%;">

            @foreach($sliders as $key => $obj)
            <img class="mySlides" src="{!! asset($obj->image) !!}" style="width:100%">
            @endforeach

        </div>

    </div>

</div>


<div class="clear"></div>

@endsection
@section('content')
<div class="content_wrapper">

    <div class="container">
        <div class="duan_wrapper">

            <div class="tilte_news wow fadeInUp"><span>Dự án mới nhất</span></div>

            <div style="position: relative;" class="row">  

                <ul id="ns-slider1" class="home_ul owl-carousel owl-theme">

                    @foreach($projects as $obj)
                    <li class="col-lg-12 wow fadeInUp">

                        <div class="boc">

                            <div style="position: relative;overflow: hidden;" class="contai"><a href="{!! route('public.chitietduan', ['name' => str_slug($obj->name), 'id' => $obj->id]) !!}"><img src="{!! asset($obj->image) !!}" alt="{!! $obj->name !!}" class="img-responsive" /></a>

                                <h3 class="ten"><a href="{!! route('public.chitietduan', ['name' => str_slug($obj->name), 'id' => $obj->id]) !!}">{!! $obj->name !!}</a></h3>

                            </div>

                            <div class="content_content">

                                <span class="ngay">{!! $obj->created_at !!}</span>

                                <div class="chu_thich">{!! $obj->name !!}</div>

                                <div class="chitiet"><a href="{!! route('public.chitietduan', ['name' => str_slug($obj->name), 'id' => $obj->id]) !!}">Xem thêm <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>

                                <div class="clear"></div>

                            </div>

                        </div>

                    </li>
                    @endforeach
                    
                </ul>

                <a href="#" class="slider-navl ns-slider1Next"><i class="fa fa-caret-right" aria-hidden="true"></i></a> 

                <a href="#" class="slider-navr ns-slider1Prev"><i class="fa fa-caret-left" aria-hidden="true"></i></a>

                <div class="clear"></div>

            </div>

        </div>

    </div>
</div>

<div class="news_wrapper">

    <div class="container">

        <div class="tilte_news wow fadeInUp"><span>Tin tức</span></div>

        <div class="clear"></div>

        <div class="row">

            @foreach($featureNews as $obj)
            <div class="col-md-4 col-sm-6  wow fadeInUp">

                
                <a href="{!! route('public.chitiettintuc', ['name' => str_slug($obj->name), 'id' => $obj->id]) !!}"><img src="{!! asset($obj->image) !!}" class="img-responsive immg"/></a>

                <h6 class="ten1"> <a href="{!! $obj->link !!}">{!! $obj->name !!}</a></h6>

                <span class="ngay">{!! $obj->created_at !!}</span>

                <div class="chu_thich1">{!! $obj->feature !!}</div>

                <div class="chitiet"><a href="{!! route('public.chitiettintuc', ['name' => str_slug($obj->name), 'id' => $obj->id]) !!}">Xem thêm <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>

            </div>
            @endforeach
            

            <div class="col-md-4 col-sm-12  wow fadeInRight">

                <ul class="ul_news_right">

                    @foreach($news as $obj)
                    <li>

                        <div class="col-md-3 col-sm-3 hidden-xs">

                            <div class="row">

                                <a href="{!! $obj->link !!}"><img src="{!! asset($obj->image) !!}" class="img-responsive"/></a>

                            </div>

                        </div>

                        <div class="col-md-9 col-sm-9 col-xs-12">

                            <h6 class="ten3"> <a href="{!! route('public.chitiettintuc', ['name' => str_slug($obj->name), 'id' => $obj->id]) !!}">{!! $obj->name !!}</a></h6>

                            

                            <div class="chu_thich1 hidden-xs">{!! $obj->feature !!}</div>

                        </div>

                        <div class="clear"></div>

                    </li>
                    @endforeach
                    
                </ul>

            </div>

        </div>

        <div class="clear"></div>

    </div>

</div>

@endsection
@section('script')
@endsection