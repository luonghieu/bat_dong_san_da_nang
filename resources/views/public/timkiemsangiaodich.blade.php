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

                  <span class="spancount">Có <b>{!! $list->count() !!}</b> bất động sản.</span>
                </h3>
                
                <div class="clearfix"></div>
                <div class="box-cont pl10 pr10">
                  <ul class="clearfix">
                    @foreach($list as $obj)
                    <li class="clearfix pt20 pb20 bor-bot">
                      <a class="pic w-190 h-145 fl position" href="{!! route('public.chitietsanbatdongsan', ['name' => str_slug($obj->name), 'id' => $obj->id]) !!}"><img  title="" src="{!! asset((empty($obj->images)) ? '/images/default.jpg' : explode('|', $obj->images)[0] ) !!}" alt="" /></a>
                      <div class="infor-descrip w-445 fr">
                        <h4 class="font13 mb5">
                          <a class='block' title="" href="{!! route('public.chitietsanbatdongsan', ['name' => str_slug($obj->name), 'id' => $obj->id]) !!}">{!! $obj->name !!}</a>
                        </h4>
                        <div class="price-time">
                          <span class="fl w-60-100">
                            <span class="label">Giá: </span>
                            <label class="pricevalue">
                              {!! $obj->price !!} {!! $obj->unitPrice->name !!}
                            </label>
                          </span>
                          <label class="clearfix mb5 fr">
                            <span class="time mr13 gray font12">{!! $obj->start_time !!}</span><span class="date gray font12">{!! $obj->start_time !!}</span>
                          </label>
                        </div>
                        <div class="clearfix">

                          <div class="width-full fl">
                            <label class="clearfix">
                              <s class="ic-area fl mt5"></s>
                              <span class="pd3-5 w-80-100 fl">{!! $obj->area !!}(m2)</span>
                            </label>
                            <label class="clearfix">
                              <s class="ic-option fl mt5"></s>
                              <span class="pd3-5 w-80-100 fl">
                                <a href="/ban-can-ho-chung-cu-cau-giay.htm"></a></span>
                              </label>
                              <label class="clearfix">
                                <s class="ic-adress fl mt5"></s>
                                <span class="pd3-5 w-80-100 fl">{!! $obj->district->name !!}</span>
                              </label>
                            </div>
                          </div>
                        </div>
                      </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
                <div class="box page page_controll nobor position tr">
                  {{ $list->links() }}
                </div>

              </div>

              <script src="/Scripts/jquery.cookie.js"></script>

            </div>
            <div class="w-300 fr" id="rightPanel">
              <form method="post" action="{{ route('public.posttimkiemsangiaodich') }}">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <input type="hidden" name="type" value="{{ $type ?? 1 }}" id="type" />
                <div class="box search_list mb20">
                  <div class="title-tabs bor-bot-blue2 font-robotonormal position">
                    <ul class="clearfix type_bds">
                     <li id="sale_div" class="font16 normal uppercase fl" {!! isset($type) ? (($type == 1) ? 'style="background-color: #0097b7"' : '') : 'style="background-color: #0097b7"' !!}><a id="sale" href="javascript:void(0)">BĐS bán</a></li>
                     <li id="lease_div" class="font16 normal uppercase fl" {!! isset($type) ? (($type == 2) ? 'style="background-color: #0097b7"' : '') : '' !!}><a id="lease" href="javascript:void(0)">BĐS cho thuê</a></li>
                   </ul>
                 </div>
                 <div class="box-cont bor-left bor-right bor-bot pd5">
                  <ul class="listbox">
                    <li class="item">
                      <select id="cat" name="cat">
                        <option value="-1">-- Loại nhà đất--</option>
                        @foreach($lcat as $id => $name)
                        <option {{isset($cat) ? (($cat == $id) ? 'selected="selected"' : '') : ''}} value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                      </select>
                    </li>
                    <li class="item">
                      <div class="lblorder none">--Sắp xếp --</div>
                      <select name="sort">
                        @foreach($lsort as $id => $name)
                        <option {{isset($sort) ? (($sort == $id) ? 'selected="selected"' : '') : ''}} value="{{ $id }}">{{ $name }}</option>
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
                        @foreach($larea as $id => $name)
                        <option {{isset($area) ? (($area == $id) ? 'selected="selected"' : '') : ''}} value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                      </select>
                    </li>
                    <li class="item">
                      <select id="district" name="district">
                        <option value="-1">-- Quận / Huyện --</option>
                        @foreach($ldistrict as $id => $name)
                        <option value="{!! $id !!}" {{isset($district) ? (($district == $id) ? 'selected="selected"' : '') : ''}}>{!! $name !!}</option>
                        @endforeach
                      </select>
                    </li>
                    <li class="item">
                      <select id="price" name="price">
                        <option value="-1">-- Mức giá --</option>
                        @foreach($lprice as $id => $name)
                        <option value="{{ $id }}" {{isset($price) ? (($price == $id) ? 'selected="selected"' : '') : ''}}>{{ $name }}</option>
                        @endforeach
                      </select>
                    </li>
                    <li id="advanced" class="width-full" >
                      <ul>
                        <li class="item">
                          <select id="village" name="village">
                            <option value="-1">-- Phường / Xã --</option>
                            @if(isset($lvillage))
                            @foreach($lvillage as $id => $name)
                            <option value="{!! $id !!}" {{isset($village) ? (($village == $id) ? 'selected="selected"' : '') : ''}}>{!! $name !!}</option>
                            @endforeach
                            @endif
                          </select>
                        </li>
                        <li class="item">
                          <select id="direction" name="direction">
                            <option value="-1">-- Hướng nhà --</option>
                            @foreach($ldirection as $id => $name)
                            <option value="{!! $id !!}" {{isset($direction) ? (($direction == $id) ? 'selected="selected"' : '') : ''}}>{!! $name !!}</option>
                            @endforeach
                          </select>
                        </li>
                        <li class="item">
                          <select id="street" name="street">
                            <option value="-1">-- Đường / Phố --</option>
                            @if(isset($lstreet))
                            @foreach($lstreet as $id => $name)
                            <option value="{!! $id !!}" {{isset($street) ? (($street == $id) ? 'selected="selected"' : '') : ''}}>{!! $name !!}</option>
                            @endforeach
                            @endif
                          </select>
                        </li>
                        <li class="item">
                          <select id="room" name="room">
                            <option value="-1">-- Phòng ngủ --</option>
                            @foreach($lroom as $id => $name)
                            <option {{isset($room) ? (($room == $id) ? 'selected="selected"' : '') : ''}} value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                          </select>
                        </li>

                      </ul>
                    </li>
                    <li class="width-full pt10 clear">
                      <label class="tl ml5 clearfix"><center>
                        <input class="bt-seaerch bg-orange nobor cursor white bold uppercase font15 font-roboto" type="submit" name="timkiem" value="Tìm kiếm" style="padding: 10px"/></center>
                      </label>
                      
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
                Bất động sản
              </h2>
              <s class="ic-count"></s>
            </div>
            <div class="box-cont pd10 border">

              <ul>
                @foreach($ldistrict as $key => $value)
                <li style="padding: 5px;">
                  <strong>{!! $value !!}</strong>   {!! $report[$key] !!}
                </li>
                @endforeach
              </ul>
            </div>
            <div class="clear"></div>
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
    $('#village').html('<option value="-1">-- Phường / Xã --</option>');
    $('#street').html('<option value="-1">-- Đường / Phố --</option>');
    $('#project').html('<option value="-1">-- Dự án --</option>');
    district = $('#district').val();
    if (district == -1) {
      $('#village').html('<option value="-1">-- Phường / Xã --</option>');
      $('#street').html('<option value="-1">-- Đường / Phố --</option>');
      $('#project').html('<option value="-1">-- Dự án --</option>');
      return;
    }
    $.ajax({
      url: "{!! route('common.getVillageByDistrict') !!}",
      method: "GET",
      data: {
        'districtId' : district
      },
      dataType : 'json',
      success : function(result){
        html = '<option value="-1">-- Phường/Xã --</option>';
        $.each (result, function (key, item){
          html += '<option value="' + key + '">' + item + '</option>';
        });

        $("#village").html(html);
      }
    });
  });

  $('#village').change(function() {
    $('#street').html('<option value="-1">-- Đường / Phố --</option>');
    village = $('#village').val();
    if (village == -1) {
      $('#street').html('<option value="-1">-- Đường / Phố --</option>');
      return;
    }
    $.ajax({
      url: "{!! route('common.getStreetByVillage') !!}",
      method: "GET",
      data: {
        'villageId' : village
      },
      dataType : 'json',
      success : function(result){
        html = '<option value="-1">-- PĐường / Phố --</option>';
        $.each (result, function (key, item){
          html += '<option value="' + key + '">' + item + '</option>';
        });

        $("#street").html(html);
      }
    });
  });

  $('#sale').click(function() {
    $('#type').val(1);
    $('#sale_div').attr('style', 'background-color: #0097b7');
    $('#lease_div').removeAttr('style');
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
    $('#type').val(2);
    $('#lease_div').attr('style', 'background-color: #0097b7');
    $('#sale_div').removeAttr('style');
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