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
                      Dự án tại Đà Nẵng</h1>
                      <s class="ic-news-03"></s>
                    </div>

                  </div>
                </div>

                <h3 class="box-result w-70-100 fl ml10">

                  <span class="spancount">Có <b>{!! $list->count() !!}</b> dự án.</span>
                </h3>
                
                <div class="clearfix"></div>
                <div class="box-cont pl10 pr10">
                  <ul class="clearfix">
                    @foreach($list as $obj)
                    <li class="clearfix pt20 pb20 bor-bot">
                      <a class="pic w-190 h-145 fl position" href="{!! route('public.chitietduan', ['name' => str_slug($obj->name), 'id' => $obj->id ]) !!}"><img  title="" src="{!! asset((empty($obj->image)) ? '/images/default.jpg' : $obj->image ) !!}" alt="" /></a>
                      <div class="infor-descrip w-445 fr">
                        <h4 class="font13 mb5">
                          <a class='block' title="" href="{!! route('public.chitietduan', ['name' => str_slug($obj->name), 'id' => $obj->id ]) !!}">{!! $obj->name !!}</a>
                        </h4>
                        <div class="price-time"> 
                          <span class="fl w-60-100">
                            <span class="label">Trạng thái: </span>
                            <label class="pricevalue">
                              {!! getStatusProjectVN($obj->status) !!}
                            </label>
                          </span>
                        </div>
                        <div class="clearfix">
                          <div class="width-full fl">
                            <label class="clearfix">
                              <s class="ic-adress fl mt5"></s>
                              <span class="pd3-5 w-80-100 fl">{!! $obj->street->name !!}, {!! $obj->village->name !!}, {!! $obj->district->name !!}</span>
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
            <form method="post" action="{{ route('public.posttimkiemduan') }}">
              <input type="hidden" name="_token" value="{{csrf_token()}}" />
              <input type="hidden" name="type" value="1" id="type" />
              <div class="box search_list mb20">
                <div class="title-tabs bor-bot-blue2 font-robotonormal position">
                  <div class="clearfix font16 normal uppercase fl" style="background-color: #0097b7">
                    Dự án
                  </div>
                </div>
                <div class="box-cont bor-left bor-right bor-bot pd5">
                  <ul class="listbox">
                    <li class="item">
                      <div class="lblorder none">--Trạng thái --</div>
                      <select name="status">
                        <option value="-1">--Chọn--</option>
                        @foreach($status as $name => $id)
                        <option {{isset($search) ? (($search['status'] == $id) ? 'selected="selected"' : '') : ''}} value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                      </select>
                    </li>
                    <li class="item">
                      <select>
                        <option value="-1">Đà Nẵng</option>
                      </select>
                    </li>
                    <li class="item">
                      <select id="district" name="district">
                        <option value="-1">-- Quận / Huyện --</option>
                        @foreach($districts as $id => $name)
                        <option value="{!! $id !!}" {{(isset($search) && $search['district']== $id) ? 'selected="selected"' : ''}}>{!! $name !!}</option>
                        @endforeach
                      </select>
                    </li>
                    <li id="advanced" class="width-full" >
                      <ul>
                        <li class="item">
                          <select id="village" name="village">
                            <option value="-1">-- Phường / Xã --</option>
                            @if(isset($villages))
                            @foreach($villages as $id => $name)
                            <option value="{!! $id !!}" {{(isset($search) && $search['village']== $id) ? 'selected="selected"' : ''}}>{!! $name !!}</option>
                            @endforeach
                            @endif
                          </select>
                        </li>
                        <li class="item">
                          <select id="street" name="street">
                            <option value="-1">-- Đường / Phố --</option>
                            @if(isset($streets))
                            @foreach($streets as $id => $name)
                            <option value="{!! $id !!}" {{(isset($search) && $search['street']== $id) ? 'selected="selected"' : ''}}>{!! $name !!}</option>
                            @endforeach
                            @endif
                          </select>
                        </li>
                      </ul>
                    </li>
                    <li class="width-full pt10 clear">
                      <label class="tl ml5 clearfix">
                        <input class="bt-seaerch bg-orange nobor cursor white bold uppercase font15 font-roboto" type="submit" name="timkiem" value="Tìm kiếm" style="padding: 5px"/>
                        <a href="{!! route('public.timkiem.duan') !!}" role="button" tabindex="0" style="margin-left: 15px; text-decoration: none" class="bt-seaerch bg-orange nobor cursor white bold uppercase font15 font-roboto">Hiển thị tất cả</a>
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
                  Dự án
                </h2>
                <s class="ic-count"></s>
              </div>
              <div class="box-cont pd10 border">

                <ul>
                  @foreach($districts as $key => $value)
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
    district = $('#district').val();
    if (district == -1) {
      $('#village').html('<option value="-1">-- Phường / Xã --</option>');
      $('#street').html('<option value="-1">-- Đường / Phố --</option>');
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
        html = '<option value="-1">-- Phường / Xã --</option>';
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
        html = '<option value="-1">-- Đường / Phố --</option>';
        $.each (result, function (key, item){
          html += '<option value="' + key + '">' + item + '</option>';
        });
        $("#street").html(html);
      }
    });
  });

  

</script>
@endsection