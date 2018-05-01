@extends('public.inc.index')
@section('content')
<div class="content_wrapper">
    <div class="container">
        <div class="breakdum">
            <a href="{!! route('public.trangchu') !!}">Trang chủ</a><span> <i class="fa fa-caret-right" aria-hidden="true"></i> <h1>Tin tức</h1></span>
        </div>
        <div class="block_over">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 margintb10">
                    <h2 class="title-home"><span>Công Ty Cổ Phần Đầu Tư Bất Động Sản Phố Son</span></h2>
                    <div>
                        <ul class="tt_lienhe">
                            <li class="home1">
                                <span>Trụ sở chính: 05 Đào Tấn - Q. Hải Châu - TP. Đà Nẵng</span>
                                <span>Chi nhánh: 274 Đường 2 Tháng 9 - Q. Hải Châu - TP. Đà Nẵng</span>
                            </li>
                            <li class="phone1">
                               <span class="tel_hotline_email"><a href="tel:0943 822 922">0943 822 922</a></span>                        <span class="tel_hotline_email"><a href="tel:0963 822 922">0963 822 922</a></span>
                           </li>
                           <li class="mail1">
                               <span class="tel_hotline_email"><a href="mailto:phosonland@gmail.com">phosonland@gmail.com</a></span>
                           </li>
                           <div class="clear"></div>
                       </ul>
                       <div>
                        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHnNC04F9_o08K9ImoQivLJua1rv94IWY&callback=initMap" type="text/javascript"></script>
                        <script type="text/javascript">
                          var map;
                          function initiadivze() {
                              var myLatlng = new google.maps.LatLng(16.045584, 108.222650);
                              var myOptions = {
                                zoom: 16,
                                center:new google.maps.LatLng(16.045584, 108.222650),
                                mapTypeId: google.maps.MapTypeId.ROADMAP,            


                            }
                            map = new google.maps.Map(document.getElementById("div_id"), myOptions); 
                  // Biến text chứa nội dung sẽ được hiển thị
                  var text;
                  text= "<b>Bất động sản Phố Son</b> <br/> Địa chỉ: 05 Đào Tấn - Q. Hải Châu - TP. Đà Nẵng";
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
            <div  id="div_id" style="height: 205px; width: 100%; color: #333;padding: 2px;border: 1px solid #096EBA;margin-top: 10px;"></div>
        </body> 
    </div>
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 margintb10">

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