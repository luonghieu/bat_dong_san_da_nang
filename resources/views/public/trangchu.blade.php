@extends('public.inc.index')
@section('slider')
<div style="position: relative;z-index: 2;"> 

<div class="slider-wrapper theme-default">

        <div id="slider" class="nivoSlider">

            @foreach($sliders as $key => $obj)
                <img src="{!! asset($obj->image) !!}" alt="" title="#caption{!! $key !!}" />
            @endforeach

        </div>

        @foreach($sliders as $key => $obj)
            <div id="caption{!! $key !!}" class="nivo-html-caption">

                <div class="box-captionnv">

                    <p class="p1-caption animated {{ ($key%2) ? 'fadeInUp' : 'fadeInDown'}}">{!! $obj->name !!}</p>

                    <p class="p2-caption animated hidden-xs {{ ($key%2) ? 'fadeInLeft' : 'fadeInRight'}}">{!! $obj->description !!}</p>

                    <a class="a-caption animated {{ ($key%2) ? 'fadeInLeft' : 'fadeInRight'}}" href="{!! $obj->link !!}">Chi tiết</a>

                </div>

            </div>

        @endforeach

    </div>

<a href="javascript:;" class="down"><i class="fa fa-angle-double-down" aria-hidden="true"></i></a>

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

                        <div style="position: relative;overflow: hidden;" class="contai"><a href="http://phoson.vn/flc-eco-charm-dao-thien-duong-giua-long-da-nang.html"><img src="{!! asset($obj->image) !!}" alt="{!! asset($obj->name) !!}" class="img-responsive" /></a>

                            <h3 class="ten"><a href="http://phoson.vn/flc-eco-charm-dao-thien-duong-giua-long-da-nang.html">{!! asset($obj->name) !!}</a></h3>

                        </div>

                        <div class="content_content">

                            <span class="ngay">{!! asset($obj->created_at) !!}</span>

                            <div class="chu_thich">{!! asset($obj->name) !!}</div>

                            <div class="chitiet"><a href="http://phoson.vn/flc-eco-charm-dao-thien-duong-giua-long-da-nang.html">Xem thêm <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>

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

            
            <a href="{!! $obj->link !!}"><img src="{!! asset($obj->image) !!}" class="img-responsive immg"/></a>

            <h6 class="ten1"> <a href="{!! $obj->link !!}">{!! $obj->name !!}</a></h6>

            <span class="ngay">{!! $obj->created_at !!}</span>

            <div class="chu_thich1">{!! $obj->feature !!}</div>

            <div class="chitiet"><a href="{!! $obj->link !!}">Xem thêm <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>

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

                        <h6 class="ten3"> <a href="http://phoson.vn/ngay-hoi-tuyen-dung-lon-nhat-trong-nam-2018.html">{!! asset($obj->name) !!}</a></h6>

                        

                        <div class="chu_thich1 hidden-xs">{!! asset($obj->feature) !!}</div>

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

<div class="doi_tac_wrapper">

<div class="container">

<div class="slide_doitac">

    <div class="container">

        <div class="col-md-3">

            <div class="row">

            <span class="doi_tac_title wow fadeInLeft">Đối tác & Khách hàng</span>

            </div>

        </div>

        <div class="col-md-9">

            <div class="slider re_album_slider">

                <div id="cc-slider" class="owl-carousel owl-theme">

                
                    <div class="col-md-12 hehi wow bounceInUp">

                        <div class="item sk_content">

                           <a target="_blank" href="http://gaiacitydanang.com/"><img src="http://phoson.vn/uploads/2017-08-22/gal/204-gaia.png" class="img-responsive" /></a>

                       </div>

                    </div>

                    
                    <div class="col-md-12 hehi wow bounceInUp">

                        <div class="item sk_content">

                           <a target="_blank" href=""><img src="http://phoson.vn/uploads/2017-08-22/gal/203-hoi-an.png" class="img-responsive" /></a>

                       </div>

                    </div>

                    
                    <div class="col-md-12 hehi wow bounceInUp">

                        <div class="item sk_content">

                           <a target="_blank" href="http://www.cocorivergarden.com/"><img src="http://phoson.vn/uploads/2016-07-07/gal/17-cocoriver-garden.jpg" class="img-responsive" /></a>

                       </div>

                    </div>

                    
                    <div class="col-md-12 hehi wow bounceInUp">

                        <div class="item sk_content">

                           <a target="_blank" href="http://alacarteliving.com"><img src="http://phoson.vn/uploads/2016-07-07/gal/16-a-lacarte.jpg" class="img-responsive" /></a>

                       </div>

                    </div>

                    
                    <div class="col-md-12 hehi wow bounceInUp">

                        <div class="item sk_content">

                           <a target="_blank" href="http://www.vinacapital.com/"><img src="http://phoson.vn/uploads/2016-07-07/gal/7-vinacapital.jpg" class="img-responsive" /></a>

                       </div>

                    </div>

                    
                    <div class="col-md-12 hehi wow bounceInUp">

                        <div class="item sk_content">

                           <a target="_blank" href="http://fhome.com.vn/"><img src="http://phoson.vn/uploads/2016-07-07/gal/6-httpfhomecomvn.jpg" class="img-responsive" /></a>

                       </div>

                    </div>

                    
                    <div class="col-md-12 hehi wow bounceInUp">

                        <div class="item sk_content">

                           <a target="_blank" href="http://www.furamavietnam.com/"><img src="http://phoson.vn/uploads/2016-07-07/gal/4-furama-resort.jpg" class="img-responsive" /></a>

                       </div>

                    </div>

                    
                    <div class="col-md-12 hehi wow bounceInUp">

                        <div class="item sk_content">

                           <a target="_blank" href="http://cocobaydanang.com.vn/"><img src="http://phoson.vn/uploads/2016-07-07/gal/3-cocobay.jpg" class="img-responsive" /></a>

                       </div>

                    </div>

                    
                </div>

                <div class="clear"></div>

            </div>

        </div>

        <div class="clear"></div>

    </div>

</div>

</div>

</div>
@endsection
@section('script')
@endsection