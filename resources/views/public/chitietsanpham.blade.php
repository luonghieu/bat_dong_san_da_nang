@extends('public.inc.index')

@section('content')
@include('public.tuvansanpham')
<div class="content_wrapper">
  <div class="container">
    <div style="text-align: center;">
      <div class="thiet_bi_name" style="padding-bottom: 15px;"><a href="{!! route('public.chitietduan', ['name' => str_slug($obj->project->name), 'id' => $obj->project_id ]) !!}" id="title">{!! $obj->project->name !!}</a></div>
      <span class="dangban">{!! $obj->cat->name !!}</span><br />
      <span class="dangban">
        @if($obj->status == 'Remaining')
        <span>Còn hàng</span>
        @else
        <span>Hết hàng</span>
        @endif
      </span><br />
      <ul class="tb_ul">
        <li> 
          <strong>{{ $obj->block }}</strong>Khu
        </li>
        <li><strong>{{ $obj->land }}</strong>Lô</li>
        
        <li><strong>{{ $obj->price }} </strong>Giá ({{$obj->unitPrice->name}})</li>        
        <li><strong>{{ $obj->area }}</strong>Diện tích(m2)</li>        
      </ul><br />
      <span class="vitri"><strong>Lượt xem: </strong>  {!! ($obj->view) !!}</span> 
      @if($obj->status == 'Remaining')
      <span class="nhantuvan"><a onclick="getcontact({!! $obj->project_id !!},{!! $obj->id !!})" href="javascript:void(0)">Nhận tư vấn và thông tin ưu đãi</a></span>     
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
    
    <div class="noidungnema">
      <p>
        {!! $obj->description !!}
      </p>
    </p>
  </div>

  <div class="tb_detail_title">Xem thêm bất động sản khác</div>
  <div>
    <ul class="thiet_bi_ul">
      @foreach($objRelated as $item)
      <li class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-479">
        <div class="boc">
          <div class="bocne">
            <div class="thiet_bi_ten"><h2><a href="{!! route('public.duan.chitietsanpham', ['id' => $item->id]) !!}">{!! $item->block !!}</a></h2>

            </div>
            <div class="thiet_bi_chu_thich">
              <div class="thiet_bi_ct">
                <span class="block_span1">
                  <strong>{!! $item->land!!}</strong>Lô</span>
                <span class="block_span1">
                  <strong>{!! $item->price!!}</strong>Giá</span>
                  <span class="block_span2">
                   <strong>{{ $item->area }}</strong>Diện tích</span>
                   <span class="gia">
                    <strong>{{ $item->floor }}</strong>Số tầng </span>
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
      function getcontact (projectId, productId)
      {
        $('#name').html($('#title').text());
        $('#projectId').val(projectId);
        $('#productId').val(productId);
        $('#tuvansanpham').modal('show');
      }
    </script>
    @endsection
