@extends('public.inc.index')
@section('content')
@include('public.tuvansangiaodich')
<div class="content_wrapper">
  <div class="container">
    <div style="text-align: center;">
      <div class="thiet_bi_name" style="padding-bottom: 15px;" id="title">{!! $obj->name !!}</div>
      <span class="dangban">@if ($obj->cat->type_transaction == 1) Bất động sản bán @else Bất động sản cho thuê @endif</span><br />
      <ul class="tb_ul">
        <li>
          <strong>{{ $obj->number_of_room }}</strong>Phòng ngủ
        </li>
        <li><strong>{{ $obj->number_of_toilet }}</strong>Phòng vệ sinh</li>
        <li><strong>{{ $obj->number_of_floor }}</strong>Số tầng</li>        
        <li><strong>{{ $obj->area }}</strong>M2</li>        
      </ul><br />
      @if ($obj->status == 1 && ($obj->deleted_at == null) && $obj->start_time <= date('Y-m-d H:i') && $obj->end_time >= date('Y-m-d H:i'))
      <span class="nhantuvan"><a onclick="getcontact({!! $obj->id !!})" href="javascript:void(0)">Nhận tư vấn và thông tin ưu đãi</a></span>
      @endif
    </div>

    @if (!empty($obj->images))
    <div class="w3-content w3-section" style="max-width:100%;">
      @foreach(explode("|", $obj->images) as $key => $item)
      @if (!empty($item))
      <img class="mySlides" src="{{asset($item)}}" style="width:100%">
      @endif
      @endforeach
    </div>

    @endif
    <div class="clear"></div>
    <div class="noidungnema">
      <p>
        {!! $obj->description !!}
      </p>
      <p>
        Giá: {!! $obj->price !!} {{ $obj->unitPrice->name}}
      </p>
      <p>
        Tên: {{ explode('|',$obj->info_contact)[0]}}</br>
        Địa chỉ: {{ explode('|',$obj->info_contact)[1]}} </br>
        Email: {{ explode('|',$obj->info_contact)[2]}}</br>
        Số điện thoại: {{ explode('|',$obj->info_contact)[3]}}</br>
      </p>
    </div>
    <div>
      <span class="tb_detail_title">Vị trí</span>
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
      <div class="fb-send" data-href="{!! route('public.chitietsanbatdongsan', ['name' => str_slug($obj->name), 'id' => $obj->id]) !!}"></div>
    </div>
    <script type="text/javascript" src="https://apis.google.com/js/plusone.js" ></script>
    <g:plusone size="medium" ></g:plusone>
  </div>
  <div class="fb-comments" data-href="{!! route('public.chitietsanbatdongsan', ['name' => str_slug($obj->name), 'id' => $obj->id]) !!}" data-width="100%" data-numposts="5"></div>
</div>
<div class="tb_detail_title">Xem thêm bất động sản khác</div>
<div>
  <ul class="thiet_bi_ul">
    @foreach($objRelated as $item)
    <li class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-479">
      <div class="boc">
        <a href="{!! route('public.chitietsanbatdongsan', ['name' => str_slug($obj->name), 'id' => $item->id]) !!}"><img src="{!! asset((empty($item->images)) ? '/images/default.jpg' : explode('|', $item->images)[0] ) !!}" alt="{!! $obj->name !!}" class="img-responsive" /></a>
        <div class="bocne">
          <div class="thiet_bi_ten"><h2><a href="{!! route('public.chitietsanbatdongsan', ['name' => str_slug($obj->name), 'id' => $item->id]) !!}">{!! $obj->name !!}</a></h2>
            <a title="Nhận tư vấn và thông tin ưu đãi" onclick="getcontact(64)" href="javascript:;" class="cliksao"><i class="fa fa-star" aria-hidden="true"></i></a>
          </div>
          <div class="thiet_bi_chu_thich">
            <div class="thiet_bi_ct">
              <span class="block_span1">
                <strong>{!! $obj->number_of_room!!}</strong>Phòng ngủ</span>
                <span class="block_span2">
                 <strong>{{ $obj->number_of_toilet }}</strong>Phòng vệ sinh                </span>
                 <span class="gia">
                  <strong>{{ $obj->area }}</strong>M2 </span>
                </div>
                <div class="clear"></div>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
  <div id="showne" style="overflow-y: hidden;padding: 20px;display: none;"></div>

  @endsection
  @section('script')

  <script>
    function getcontact (itemId)
    {
      $('#name').html($('#title').text());
      $('#id').val(itemId);
      $('#tuvansangiaodich').modal('show');
    }
  </script>

  @endsection
