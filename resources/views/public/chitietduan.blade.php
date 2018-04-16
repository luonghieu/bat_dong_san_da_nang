@extends('public.inc.index')
<div class="content_wrapper">

    <div class="container">

        <div class="breakdum">

            <a href="http://phoson.vn">Trang chủ</a><span> <i class="fa fa-caret-right" aria-hidden="true"></i> <h2 style="display: inline-block;">Dự án</h2></span>

        </div>

        <div class="block-news">

            <div class="row">

                <div class="col425 col-xs-12 col-sm-4 col-md-3 col-lg-3">

                    <div id="sidebar">

                        <div id="checkdiv"></div>

                        <div class="menupage">

                            <ul>

                                <li><a href="#gioi-thieu" class="active">Giới thiệu <span></span></a></li>
                                
                                <li><a href="#tong-quan">Tổng quan dự án <span></span></a></li>

                                <li><a class="moeno" href="#vi-tri">Vị trí <span></span></a></li>

                                <li><a href="#tien-ich">Tiện ích <span></span></a></li>
                                
                                <li><a href="#tien-do">Tiến độ <span></span></a></li>
                                
                                <li><a href="#thanh-toan">Giá và thanh toán <span></span></a></li>
                                
                            </ul>

                            <div class="info-detail">

                                <div class="hotline_bg">

                                    <div class="img_hotline"></div>

                                    <div class="info_hotline">

                                        <a href="tel:0963 822 922" target="_blank">0963 822 922</a><br />

                                        <a href="mailto:phosonland@gmail.com" target="_blank">phosonland@gmail.com</a>

                                    </div>

                                </div>

                            </div><!-- end info-detail -->

                        </div>

                    </div>     

                </div>

                <div class="col425 col-xs-12 col-sm-8 col-md-9 col-lg-9">

                    <div style="padding:10px 0">

                        <section id="gioi-thieu">

                            <h1 class="page_title">{!! $obj->name !!}</h1>

                            <p class="date-view">

                                <span>Date: {!! $obj->created_at !!}</span> - <span>View: {!! $obj->view !!}</span>

                            </p>

                            <div class="blockcontent">
                                {!! $obj->introduce !!}
                            </div>

                            <div class="clear"></div>

                            
                        </section> 

                        
                        <section id="tong-quan">

                            <h4 class="name-detail">Tổng quan dự án</h4>

                            <div class="blockcontent">
                                {!! $obj->overview !!}
                            </div>

                        </section>

                        
                        
                        <section id="vi-tri">

                            <h4 class="name-detail">Vị trí</h4>

                            <div class="blockcontent">
                                {!! $obj->position !!}
                            </div>

                        </section>

                        <section id="tien-ich">

                            <h4 class="name-detail">Tiện ích</h4>

                            <div class="blockcontent">
                                {!! $obj->utilities !!}
                            </div>

                        </section>

                        <section id="tien-do">

                            <h4 class="name-detail">Tiến độ</h4>

                            <div class="blockcontent">
                                {!! $obj->progress !!}

                            </div>

                        </section>

                        <section id="thanh-toan">

                            <h4 class="name-detail">Giá và thanh toán </h4>

                            <div class="blockcontent">
                                {!! $obj->price_payment !!}

                            </div>

                        </section>
                        

                        <div style="padding: 10px 0 0;">
                            <div style="display: inline-block;float: left;">
                                <div class="fb-like" data-href="http://phoson.vn/Array" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>

                                <!-- Your send button code -->

                                <div class="fb-send" 

                                data-href="https://www.facebook.com/phosonrealestate/" 

                                data-layout="button_count">

                            </div>
                        </div>
                        <div style="display: inline-block;float: left;margin-left: 5px;" class="right_xh">

                            <script >

                              window.___gcfg = {

                                lang: 'vi',

                                parsetags: 'onload'

                            };

                        </script>

                        <script src="https://apis.google.com/js/platform.js" async defer></script>

                        <g:plus action="share" Annotation="bubble"></g:plus>

                    </div>

                    <div class="fb-comments" data-href="http://phoson.vn/the-sunrise-bay-khu-do-thi-quoc-te-5-sao-bac-nhat-da-nang.html" data-numposts="5" data-width="100%"></div>

                </div><!-- end mang xa hoi -->

                <div class="clear"></div>

                <div class="box-title-other">

                    <h5 class="title-other">Dự án khác</h5>

                </div>

                <ul class="list-other">

                    @foreach($featureProjects as $obj)
                    <li><h3><a href="{!! route('public.chitietduan', ['id' => $obj->id]) !!}">{!! $obj->name !!}</a></h3></li>
                    @endforeach
                    
                </ul>   

            </div> 

        </div>

    </div>    

</div>

</div>

</div>

@endsection

@section('script')
@endsection