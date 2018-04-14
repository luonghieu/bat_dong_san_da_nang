@extends('public.inc.index')

@section('content')
<div class="content_wrapper">
    <div class="container">
        <div style="text-align: center;">
            <div class="thiet_bi_name" style="padding-bottom: 15px;">Cho thuê KS đường  Nguyễn Văn Linh, 5 tầng, 16 phòng</div>
            <span class="dangban">Bất động sản bán</span><br />
            <ul class="tb_ul">
                <li><strong>16</strong>Phòng ngủ</li>                        <li><strong>16</strong>Phòng vệ sinh</li>                        <li><strong>210</strong>M2</li>        </ul><br />
                <span class="vitri"><strong>Vị trí: </strong> 362 Nguyễn Văn Linh</span>        <span class="nhantuvan"><a onclick="getcontact(255)" href="javascript:;">Nhận tư vấn và thông tin ưu đãi</a></span>
            </div>
            <div class="noidungnema">
                <p>
                Cho thu&ecirc; Kh&aacute;ch sạn Rose - 326 đường Nguyễn Văn Linh</p>
                <p>
                Đường trung t&acirc;m, khu vực sầm uất nhất Đ&agrave; Nẵng</p>
                <p>
                - Diện t&iacute;ch: 210m2</p>
                <p>
                - 5 tầng, 16 ph&ograve;ng</p>
                <p>
                - Gi&aacute; thu&ecirc;: 160 triệu/th&aacute;ng</p>
                <p>
                Li&ecirc;n hệ: 0963 822 922 - 0943 822 922</p>
                <p>
                &nbsp;</p>
                <p>
                &nbsp;</p>
            </div>
            <div>
                <span class="tb_detail_title">Vị trí</span>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHnNC04F9_o08K9ImoQivLJua1rv94IWY&callback=initMap" type="text/javascript"></script>
                <script type="text/javascript">
                  var map;
                  function initiadivze() {
                      var myLatlng = new google.maps.LatLng(16.0589188,108.2044113,17);
                      var myOptions = {
                        zoom: 16,
                        center:new google.maps.LatLng(16.0589188,108.2044113,17),
                        mapTypeId: google.maps.MapTypeId.ROADMAP,            
                        
                        
                    }
                    map = new google.maps.Map(document.getElementById("div_id"), myOptions); 
                  // Biến text chứa nội dung sẽ được hiển thị
                  var text;
                  text= "<b>Cho thuê KS đường  Nguyễn Văn Linh, 5 tầng, 16 phòng</b>";
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
          <div style="display: inline-block;float: left;margin-right: 4px;"><div class="fb-like" data-href="http://phoson.vn/cho-thue-ks-duong-nguyen-van-linh-5-tang-16-phong.html" data-layout="button" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
          <div class="fb-send" data-href="http://phoson.vn/cho-thue-ks-duong-nguyen-van-linh-5-tang-16-phong.html"></div>
      </div>
      <script type="text/javascript" src="https://apis.google.com/js/plusone.js" ></script>
      <g:plusone size="medium" ></g:plusone>
  </div>
  <div class="fb-comments" data-href="http://phoson.vn/cho-thue-ks-duong-nguyen-van-linh-5-tang-16-phong.html" data-width="100%" data-numposts="5"></div>
</div>
<div class="tb_detail_title">Xem thêm bất động sản khác</div>
<div>
    <ul class="thiet_bi_ul">
        <li class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-479">
            <div class="boc">
                <a href="http://phoson.vn/ban-khach-san-30-phong-tai-duong-ho-nghinh-canh-alacarte-hotel.html"><img src="http://phoson.vn/uploads/2017-02-22/post/64-ban-khach-san-30-phong-tai-duong-ho-nghinh-canh-alacarte-hotel.jpg" alt="Bán khách sạn 30 phòng tại đường Hồ Nghinh, cạnh ALaCarte Hotel" class="img-responsive" /></a>
                <div class="bocne">
                    <div class="thiet_bi_ten"><h2><a href="http://phoson.vn/ban-khach-san-30-phong-tai-duong-ho-nghinh-canh-alacarte-hotel.html">Bán khách sạn 30 phòng tại đường Hồ Nghinh, cạnh ALaCarte Hotel</a></h2>
                        <a title="Nhận tư vấn và thông tin ưu đãi" onclick="getcontact(64)" href="javascript:;" class="cliksao"><i class="fa fa-star" aria-hidden="true"></i></a>
                    </div>
                    <div class="thiet_bi_chu_thich">
                        <br/>ĐÃ BÁN</div>
                        <div class="thiet_bi_ct">
                            <span class="block_span1">
                                <strong>30</strong>Phòng ngủ                </span>
                                <span class="block_span2">
                                   <strong>30</strong>Phòng vệ sinh                </span>
                                   <span class="gia">
                                    <strong></strong>Liên hệ                </span>
                                </div>
                                
                                
                                <div class="clear"></div>
                            </div>
                        </div>
                    </li>
                    <li class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-479">
                        <div class="boc">
                            <a href="http://phoson.vn/ban-khach-san-2-sao-bien-my-khe-2-mat-tien-dtsd-1200m2-canh-serene-hotel.html"><img src="http://phoson.vn/uploads/2017-03-31/post/63-ban-khach-san-2-sao-bien-my-khe-2-mat-tien-dtsd-1200m2-canh-serene-hotel.jpg" alt="Bán khách sạn 2 sao, biển Mỹ Khê, 2 mặt tiền, DTSD 1200m2, cạnh Serene Hotel" class="img-responsive" /></a>
                            <div class="bocne">
                                <div class="thiet_bi_ten"><h2><a href="http://phoson.vn/ban-khach-san-2-sao-bien-my-khe-2-mat-tien-dtsd-1200m2-canh-serene-hotel.html">Bán khách sạn 2 sao, biển Mỹ Khê, 2 mặt tiền, DTSD 1200m2, cạnh Serene Hotel</a></h2>
                                    <a title="Nhận tư vấn và thông tin ưu đãi" onclick="getcontact(63)" href="javascript:;" class="cliksao"><i class="fa fa-star" aria-hidden="true"></i></a>
                                </div>
                                <div class="thiet_bi_chu_thich">
                                    <br/>ĐÃ BÁN</div>
                                    <div class="thiet_bi_ct">
                                        <span class="block_span1">
                                            <strong>30</strong>Phòng ngủ                </span>
                                            <span class="block_span2">
                                               <strong>30</strong>Phòng vệ sinh                </span>
                                               <span class="gia">
                                                <strong></strong>Liên hệ                </span>
                                            </div>
                                            
                                            
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="showne" style="overflow-y: hidden;padding: 20px;display: none;"></div>
                
                @endsection
                @section('script')
                @endsection
