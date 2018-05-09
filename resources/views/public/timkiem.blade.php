@extends('public.inc.index')
@section('content')
<div class="content_wrapper">
<div class="container">
<div class="breakdum">
<a href="{!! route('public.trangchu') !!}">Trang chủ</a><span> <i class="fa fa-caret-right" aria-hidden="true"></i> <h1>Tìm kiếm</h1></span>
</div>
<div class="block_over">
<div id="container">
<div class="main bg_white clearfix">

  <div class="w-680 fl" id="leftPanel">

    <div class="productlist">

      <div class="box news bor-right bor-left bor-bot">
        <div class="font-robotonormal" style="border-top: 2px solid #0098bb">
          <div class="clearfix bor-bot">
            <div class="fl title" style="padding-top:0px;">
              <h1 class="bg_white pd5 font16 normal uppercase">
              Nhà đất bán tại Đà Nẵng</h1>
              <s class="ic-news-03"></s>
            </div>

          </div>
        </div>

        <h3 class="box-result w-70-100 fl ml10">

          <span class="spancount">Có <b>
          527,632</b> bất động sản.</span>
        </h3>
        <div class="fr wr_order mt5 mr10">
          <div class="lblorder none">Sắp xếp theo:</div>
          <select name="sort" onchange="sortchange()" id="ddlOrder">
            <option selected="selected" value="0">Thông thường</option>
            <option value="2">Giá thấp nhất</option>
            <option value="3">Giá cao nhất</option>
            <option value="4">Diện tích nhỏ nhất</option>
            <option value="5">Diện tích lớn nhất</option>

          </select>
        </div>
        <div class="clearfix"></div>
        <div class="box-cont pl10 pr10">
          <ul class="clearfix">

            <li class="clearfix pt20 pb20 bor-bot">
              <a class="pic w-190 h-145 fl position" href=""><img  title="" src="/Images/no-photo253.png" alt="" /></a>
              <div class="infor-descrip w-445 fr">
                <h4 class="font13 mb5">
                  <a class='block' title="" href="">GIA ĐÌNH MUỐN BÁN CHUNG CƯ N02.</a>
                </h4>
                <div class="price-time">
                  <span class="fl w-60-100">
                    <span class="label">Giá: </span>
                    <label class="pricevalue">
                      Thỏa thuận
                    </label>
                  </span>
                  <label class="clearfix mb5 fr">
                    <span class="time mr13 gray font12">08:48 PM</span><span class="date gray font12">05/05/2018</span>
                  </label>
                </div>
                <div class="clearfix">

                  <div class="width-full fl">
                    <label class="clearfix">
                      <s class="ic-area fl mt5"></s>
                      <span class="pd3-5 w-80-100 fl">
                      Không xác định</span>
                    </label>
                    <label class="clearfix">
                      <s class="ic-option fl mt5"></s>
                      <span class="pd3-5 w-80-100 fl">
                        <a href="/ban-can-ho-chung-cu-cau-giay.htm"></a></span>
                      </label>
                      <label class="clearfix">
                        <s class="ic-adress fl mt5"></s>
                        <span class="pd3-5 w-80-100 fl">
                        Cầu Giấy - Hà Nội</span>
                      </label>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="box page page_controll nobor position tr">
          <a href='/nha-dat-ban.htm' title='P1'><div  class='style-pager-row-selected' align='center'>1</div></a><a href='/nha-dat-ban/p2.htm' title='P2'><div  class='style-pager-row' align='center'>2</div></a><a href='/nha-dat-ban/p3.htm' title='P3'><div  class='style-pager-row' align='center'>3</div></a><a href='/nha-dat-ban/p4.htm' title='P4'><div  class='style-pager-row' align='center'>4</div></a><a href='/nha-dat-ban/p5.htm' title='P5'><div  class='style-pager-row' align='center'>5</div></a><a href='/nha-dat-ban/p2.htm'  title='P2'><div  class='style-pager-button-next-first-last' align='center'>></div></a><a href='/nha-dat-ban/p29313.htm' title='P29313'><div  class='style-pager-button-next-first-last' align='center'>Trang cuối</div></a><span id="PH_Container_ProductSearchResult_ProductsPager"></span>
        </div>

      </div>

      <script src="/Scripts/jquery.cookie.js"></script>

    </div>
    <div class="w-300 fr" id="rightPanel">
<form method="post" action="{{ route('public.posttimkiem') }}">
      <div class="box search_list mb20">
        <div class="title-tabs bor-bot-blue2 font-robotonormal position">
          <ul class="clearfix type_bds">
            <li class="font16 normal uppercase fl" style="background-color: #0097b7"><a id="sale" href="javascript:void(0)">BĐS bán</a></li>
            <li class="font16 normal uppercase fl"><a id="lease" href="javascript:void(0)">BĐS cho thuê</a></li>
          </ul>
        </div>
        <div class="box-cont bor-left bor-right bor-bot pd5">
          <ul class="listbox">
            <li class="item">
              <select id="cat" name="cat">
                <option value="-1">-- Loại nhà đất--</option>
                @foreach($sale as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
              </select>
            </li>
            <li class="item">
              <select>
                <option value="-1">Đà Nẵng</option>
              </select>
            </li>
            <li class="item">
              <select id="area" name="area">
                <option value="-1">-- Diện tích --</option>
                <option value="-1">Không xác định</option>
                <option value="-1"><= 30 m2</option>
                <option value="-1">30-80 m2</option>
                <option value="-1">80-150 m2</option>
                <option value="-1">150-300 m2</option>
                <option value="-1">300-500 m2</option>
                <option value="-1">=500 m2</option>
              </select>
            </li>
            <li class="item">
              <select id="district" name="district">
                <option value="-1">-- Quận / Huyện --</option>
                @foreach($district as $id => $name)
                <option value="{!! $id !!}">{!! $name !!}</option>
                @endforeach
              </select>
            </li>
            <li class="item">
              <select id="price" name="price">
                <option value="-1">-- Mức giá --</option>
                <option value="0">Thỏa thuận</option>
                <option value="1">< 500 triệu</option>
                <option value="2">500 - 800 triệu</option>
                <option value="2"> 800 - 1 tỷ</option>
                <option value="3">1 - 5 tỷ</option>
                <option value="4">> 5 tỷ</option>
              </select>
            </li>
            <li id="advanced" class="width-full" >
              <ul>
                <li class="item">
                  <select id="village" name="village">
                    <option value="-1">-- Phường / Xã --
                    </option>
                  </select>
                </li>
                <li class="item">
                  <select id="direction" name="direction">
                    <option value="-1">-- Hướng nhà --</option>
                    @foreach($direction as $id => $name)
                    <option value="{!! $id !!}">{!! $name !!}</option>
                    @endforeach
                  </select>
                </li>
                <li class="item">
                  <select id="street" name="price">
                    <option value="-1">-- Đường / Phố --</option>
                  </select>
                </li>
                <li class="item">
                  <select id="room" name="room">
                    <option value="-1">-- Phòng ngủ --</option>
                    <option value="0">Không xác định</option>
                    <option value="2">1+</option>
                    <option value="3">2+</option>
                    <option value="4">3+</option>
                    <option value="5">4+</option>
                    <option value="6">5+</option>
                  </select>
                </li>
                <li class="item">
                  <select id="project" name="project">
                    <option value="-1">-- Dự án --</option>
                  </select>
                </li>

              </ul>
            </li>
            <li class="width-full pt10 clear">
              <label class="tl ml5 clearfix">
                <input class="bt-seaerch bg-orange nobor cursor white bold uppercase font15 font-roboto" type="submit" name="timkiem" value="Tìm kiếm" type="padding: 10px"/>
              </label>
            </li>
          </ul>
          <div class="clear"></div>
        </div>
      </div>
    </form>
      <script src="/Scripts/Search.min.js?v=20140425" type="text/javascript"></script>
      <div class="box-link mb20">
        <div class="title font-robotonormal">
          <h2 class="bg_white pd5 bor-right font16 normal uppercase">
            Nhà đất bán
          </h2>
          <s class="ic-count"></s>
        </div>
        <div class="box-cont pd10 border">

          <ul>

            <li>
              <h3><a href='/nha-dat-ban-tp-hcm.htm'>
                Hồ Chí Minh <b>(109,241) </b></a></h3>
              </li>

              <li>
                <h3><a href='/nha-dat-ban-ha-noi.htm'>
                  Hà Nội <b>(98,704) </b></a></h3>
                </li>

                <li>
                  <h3><a href='/nha-dat-ban-binh-duong.htm'>
                    Bình Dương <b>(19,809) </b></a></h3>
                  </li>

                </ul>
              </div>
              <div class="clear"></div>
            </div>

            <div id="PH_Container_BoxHotLink_pnLink">

              <div class="box-link mb20">
                <div class="title font-robotonormal">
                  <h3 class="bg_white pd5 bor-right font16 normal uppercase">Liên kết nổi bật</h3>
                  <s class="ic-link"></s>
                </div>
                <div class="box-cont pd10 border">
                  <ul>

                    <li>
                      <a href="/nha-dat-ban-duong-ton-that-tung-53">Nhà đất bán Đường Tôn Thất Tùng</a>
                    </li>

                    <li>
                      <a href="/ban-can-ho-chung-cu-quan-2">Bán căn hộ chung cư Quận 2</a>
                    </li>

                    <li>
                      <a href="/ban-can-ho-chung-cu-cao-oc-thinh-vuong">Bán căn hộ chung cư Cao ốc Thịnh Vượng</a>
                    </li>

                  </ul>
                </div>
                <div class="clear"></div>
              </div>

            </div>



            <div class="box tools-subport hidden">
              <div class="title font-roboto">
                <h3 class="bg_white pd5 bor-bot bor-right font15 uppercase">Công cụ hỗ trợ</h3>
                <s class="ic-news-04"></s>
              </div>
              <div class="box-cont pd10 bor-left bor-right bor-bot">
                <ul class="clearfix">
                  <li class="rows-tools tc">
                    <a href="#" class="name-tools font-roboto font14">
                      <s class="ic-tools-email"></s>
                      <span class="block mt5">Nhận BĐS qua Email</span>
                    </a>
                  </li>
                  <li class="rows-tools tc">
                    <a href="#" class="name-tools font-roboto font14">
                      <s class="ic-price-list"></s>
                      <span class="block mt5">Bảng giá VLXD</span>
                    </a>
                  </li>
                  <li class="rows-tools tc">
                    <a href="#" class="name-tools font-roboto font14">
                      <s class="ic-price-home"></s>
                      <span class="block mt5">Bảng giá đất</span>
                    </a>
                  </li>
                  <li class="rows-tools tc">
                    <a href="#" class="name-tools font-roboto font14">
                      <s class="ic-textvd"></s>
                      <span class="block mt5">Văn bản nghành VD</span>
                    </a>
                  </li>
                  <li class="rows-tools tc">
                    <a href="#" class="name-tools font-roboto font14">
                      <s class="ic-fengshui"></s>
                      <span class="block mt5">Phong thủy</span>
                    </a>
                  </li>
                  <li class="rows-tools tc">
                    <a href="#" class="name-tools font-roboto font14">
                      <s class="ic-interest"></s>
                      <span class="block mt5">Phong thủy</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div id="PH_Container_AutoCheap_autoCheap" class="productlist mb20 mt10">
              <div class="title font-robotonormal">
                <h3 class="bg_white pd5 bor-right font16 normal uppercase"><a rel="nofollow" target="_blank" href="http://banxehoi.com/">Banxehoi.com</a></h3>
                <s class="ic-auto2"></s>
              </div>
              <div class="box-cont pl10 pr10 pb10 border">
                <div id="autocheaps">
                  <div class="wapper-autocheaps">
                    <ul id="autoContainer" class="clearfix sidebar-post">
                    </ul>

                  </div>
                </div>
              </div>
              <a rel="nofollow" class="readmoroAuto" target="_blank" href="https://banxehoi.com/" title="Mua bán, cho thuê ô tô, xe hơi cũ, mới giá rẻ">Xem thêm >></a>
            </div>
            <script type="text/javascript">
              $(document).ready(function () {
                BuildAutoBox();
              })
            </script>



            <div class="box-link mb20">
              <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FDothidiaocDV%2F&tabs=timeline&width=300&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=282156201795763" width="300" height="500" style="border: none; overflow: hidden" scrolling="no" frameborder="0" allowtransparency="true"></iframe>
            </div>

          </div>

          <div class="clear">
          </div>
        </div>
      </div>

      <div class="clear"></div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
  $('#district').change(function() {
    district = $('#district').val();
    if (district == -1) {
      $('#village').html('<option value="-1">-- Phường / Xã --</option>');
      $('#street').html('<option value="-1">-- Đường / Phố --</option>');
      $('#project').html('<option value="-1">-- Dự án --</option>');
      return;
    }
    $.ajax({
      url: "{!! route('common.getItemByDistrict') !!}",
      method: "GET",
      data: {
        'districtId' : district
      },
      dataType : 'json',
      success : function(result){
        villages = result['villages'];
        streets = result['streets'];

        htmlVillage = '<option value="-1">-- Phường/Xã --</option>';
        $.each (villages, function (key, item){
          htmlVillage += '<option value="' + item.id + '">' + item.name + '</option>';
        });

        htmlStreet = '<option value="-1">-- Chọn Đường/Phố --</option>';
        $.each (streets, function (key, item){
          htmlStreet += '<option value="' + item.id + '">' + item.name + '</option>';
        });
        $("#village").html(htmlVillage);
        $("#street").html(htmlStreet);
      }
    });
  });

  $('#sale').click(function() {
    $('#district').val(-1);
    $('#village').html('<option value="-1">-- Phường / Xã --</option>');
    $('#street').html('<option value="-1">-- Đường / Phố --</option>');
    $('#project').html('<option value="-1">-- Dự án --</option>');
    $('#direction').val(-1);
    $('#room').val(-1);
    $('#price').val(-1);
    $('#area').val(-1);

    $.ajax({
      url: "{!! route('common.getSaleSearch') !!}",
      method: "GET",
      data: {},
      dataType : 'json',
      success : function(result){
        cat = result['cat'];
        price = result['price'];

        htmlCat = '<option value="-1">-- Loại nhà đất--</option>';
        $.each (cat, function (key, item){
          htmlCat += '<option value="' + key + '">' + item + '</option>';
        });

        htmlPrice = '<option value="-1">-- Mức giá --</option>';
        $.each (price, function (key, item){
          htmlPrice += '<option value="' + key + '">' + item + '</option>';
        });
        $("#cat").html(htmlCat);
        $("#price").html(htmlPrice);
      }
    });
  });

  $('#lease').click(function() {
    $('#district').val(-1);
    $('#village').html('<option value="-1">-- Phường / Xã --</option>');
    $('#street').html('<option value="-1">-- Đường / Phố --</option>');
    $('#project').html('<option value="-1">-- Dự án --</option>');
    $('#direction').val(-1);
    $('#room').val(-1);
    $('#price').val(-1);
    $('#area').val(-1);

    $.ajax({
      url: "{!! route('common.getLeaseSearch') !!}",
      method: "GET",
      data: {},
      dataType : 'json',
      success : function(result){
        cat = result['cat'];
        price = result['price'];

        htmlCat = '<option value="-1">-- Loại nhà đất--</option>';
        $.each (cat, function (key, item){
          htmlCat += '<option value="' + key + '">' + item + '</option>';
        });

        htmlPrice = '<option value="-1">-- Mức giá --</option>';
        $.each (price, function (key, item){
          htmlPrice += '<option value="' + key + '">' + item + '</option>';
        });
        $("#cat").html(htmlCat);
        $("#price").html(htmlPrice);
      }
    });
  });

</script>
@endsection