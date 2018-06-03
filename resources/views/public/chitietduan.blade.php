@extends('public.inc.index')
@section('content')
<div class="content_wrapper">

    <div class="container">

        <div class="breakdum">

            <a href="{!! route('public.trangchu') !!}">Trang chủ</a><span> <i class="fa fa-caret-right" aria-hidden="true"></i> <h2 style="display: inline-block;">Dự án</h2></span>

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

                                <li><a href="#vi-tri">Vị trí <span></span></a></li>

                                <li><a href="#san-pham">Sản phẩm <span></span></a></li>

                                <li><a href="#tien-ich">Tiện ích <span></span></a></li>
                                
                                <li><a href="#tien-do">Tiến độ <span></span></a></li>

                                <li><a href="#nha-mau">Nhà mẫu <span></span></a></li>
                                
                                <li><a href="#thanh-toan">Giá và thanh toán <span></span></a></li>

                                <li><a href="#tinh-trang">Tình trạng <span></span></a></li>
                                
                                <li><a href="#dang-ky">Đăng ký <span></span></a></li>
                                
                            </ul>

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
                                {!! $obj->detailProject->introduce !!}
                            </div>

                            <div class="clear"></div>

                            
                        </section> 

                        
                        <section id="tong-quan">

                            <h4 class="name-detail">Tổng quan dự án</h4>

                            <div class="blockcontent">
                                {!! $obj->detailProject->overview !!}
                            </div>

                        </section>

                        
                        
                        <section id="vi-tri">

                            <h4 class="name-detail">Vị trí</h4>

                            <div class="blockcontent">
                                {!! $obj->detailProject->position !!}
                                <div>
                                  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHnNC04F9_o08K9ImoQivLJua1rv94IWY&callback=initMap" type="text/javascript"></script>
                                  <script type="text/javascript">
                                    var map;
                                    function initiadivze() {
                                      var latitude = "{{ explode('|', $obj->map)[0]}}";
                                      var longitude = "{{ explode('|', $obj->map)[1]}}";
                                      var myLatlng = new google.maps.LatLng(latitude,longitude);
                                      var myOptions = {
                                        zoom: 16,
                                        center:new google.maps.LatLng(latitude,longitude),
                                        mapTypeId: google.maps.MapTypeId.ROADMAP,            


                                    }
                                    map = new google.maps.Map(document.getElementById("div_id"), myOptions); 
                  // Biến text chứa nội dung sẽ được hiển thị
                  var text;
                  text= "{{$obj->name}}";
                  var infowindow = new google.maps.InfoWindow(
                    { content: text,
                      size: new google.maps.Size(100,50),
                      position: myLatlng
                  });
                  infowindow.open(map); 
                  var marker = new google.maps.Marker({
                    position: myLatlng, 
                    map: map,
                    title:""
                });
              }
          </script>

          <body onLoad="initiadivze()">
            <div  id="div_id" style="height: 505px; width: 100%; color: #333;"></div>
        </body> 
    </div>
</div>

</section>

<section id="san-pham">

    <h4 class="name-detail">Sản phẩm </h4>

    <div class="blockcontent">
        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="bor-left bor-right bor-top">
            <tbody>
                <tr class="bg-gray3 font14">
                    <td>Khu</td>
                    <td>Lô</td>
                    <td>Căn hộ</td>
                    <td>Sản phẩm khác</td>
                    <td>Chi tiết</td>
                </tr>

                <tr class="bor-bot">
                    <td class="bor-right bor-bot">{!! $product->block !!}</td>
                    <td class="bor-right bor-bot">{!! $product->land !!}</td>
                    <td class="bor-right bor-bot">{!! $product->apartment !!}</td>
                    <td class="bor-right bor-bot">{!! $product->another!!}</td>
                    <td class="bor-right bor-bot">
                        <a href="{!! route('public.duan.sanpham', ['id' => $obj->id]) !!}">Chi tiết >>></a>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>

</section>

<section id="tien-ich">

    <h4 class="name-detail">Tiện ích</h4>

    <div class="blockcontent">
        {!! $obj->detailProject->utilities !!}
    </div>

</section>

<section id="tien-do">

    <h4 class="name-detail">Tiến độ</h4>

    <div class="blockcontent">
        {!! $obj->detailProject->progress !!}

    </div>

</section>

<section id="nha-mau">

    <h4 class="name-detail">Nhà mẫu</h4>

    <div class="blockcontent">
        @if (!empty($obj->library_images))
        <div class="w3-content w3-section" style="max-width:100%;">
          @foreach(explode("|", $obj->library_images) as $key => $item)
          @if (!empty($item))
          <img class="mySlides" src="{{asset($item)}}" style="width:100%">
          @endif
          @endforeach
      </div>
      @endif

  </div>

</section>

<section id="thanh-toan">

    <h4 class="name-detail">Giá và thanh toán </h4>

    <div class="blockcontent">
        {!! $obj->detailProject->price_payment !!}

    </div>

</section>

<section id="tinh-trang">

    <h4 class="name-detail">Tình trạng giao dịch bất động sản </h4>

    <div class="blockcontent">
        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="bor-left bor-right bor-top">
            <tbody>
                <tr class="bg-gray3 font14">
                    <td style="width: 5%">Tổng số giao dịch</td>
                    <td style="width: 30%">Đang xử lý</td>
                    <td style="width: 15%">Đã đăng ký</td>
                    <td style="width: 10%">Đã đặt cọc</td>
                    <td style="width: 10%">Đã thanh toán</td>
                    <td style="width: 15%">Chi tiết</td>
                </tr>

                <tr class="bor-bot">
                    <td class="bor-right bor-bot">{!! $report->total !!}</td>
                    <td class="bor-right bor-bot">{!! $report->sum_processing !!}</td>
                    <td class="bor-right bor-bot">{!! $report->sum_registered !!}</td>
                    <td class="bor-right bor-bot">{!! $report->sum_deposit !!}</td>
                    <td class="bor-right bor-bot">{!! $report->sum_payment !!}</td>
                    <td class="bor-right bor-bot">
                        <a href="{!! route('public.duan.tinhtrang', ['id' => $obj->id]) !!}">Chi tiết >>></a>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>

</section>

<section id="dang-ky">

    <h4 class="name-detail">Đăng ký </h4>

    <div class="blockcontent">
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
    <form action="{!! route('public.dangkyduan') !!}" method="post" class="form_contact">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <input type="hidden" name="id" value="{{ $obj->id }}" />
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
                <textarea class="textarea_form" id="txtContent" rows="4" name="message" placeholder="Nội dung..."></textarea>
                @if ($errors->has('message'))
                <div class="alert alert-lightred alert-dismissable fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>{!! $errors->first('message') !!}</strong>
                </div>
                @endif
            </div>
        </div>
        <div class="clear"></div>
        <div class="box_button">
            <button type="submit" id="send" value="send">Gửi</button>
        </div>
    </form>

</div>

</section>

<div style="padding:25px 0 10px;">
  <div>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6";
      fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
  <div style="display: inline-block;float: left;margin-right: 4px;">
      <div class="fb-send" data-href="{!! route('public.chitietduan', ['name' => str_slug($obj->name), 'id' => $obj->id]) !!}"></div>
  </div>
  <script type="text/javascript" src="https://apis.google.com/js/plusone.js" ></script>
  <g:plusone size="medium" ></g:plusone>
</div>
<div class="fb-comments" data-href="{!! route('public.chitietduan', ['name' => str_slug($obj->name), 'id' => $obj->id]) !!}" data-width="100%" data-numposts="5"></div>
</div>

<div class="clear"></div>

<div class="box-title-other">

    <h5 class="title-other">Dự án khác</h5>

</div>

<ul class="list-other">

    @foreach($featureProjects as $obj)
    <li><h3><a href="{!! route('public.chitietduan', ['name' => str_slug($obj->name), 'id' => $obj->id]) !!}">{!! $obj->name !!}</a></h3></li>
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