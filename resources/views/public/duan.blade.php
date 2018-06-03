@extends('public.inc.index')
@section('content')
@include('public.tuvanduan')
<div class="content_wrapper">
    <div class="container">
        <div class="breakdum">
            <a href="http://phoson.vn">Trang chủ</a><span> <i class="fa fa-caret-right" aria-hidden="true"></i> <h1>Dự án</h1></span>
        </div>
        <div class="row">
            <div class="col-md-3">
                <ul class="ct_left_ul1">
                    <li class="havespan">
                        <span>Danh mục dự án</span>                
                    </li>
                    <li class="active">
                        <h3><a class="item_news_name_left" href="">Dự án nổi bật</a></h3>                
                    </li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <ul class="product_ul">
                        @foreach($list as $obj)
                        <li class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-479">
                            <div class="boc">
                                <div style="position: relative;overflow: hidden;" class="contai"><a href="{!! route('public.chitietduan', ['name' => str_slug($obj->name), 'id' => $obj->id ]) !!}"><img src="{{ asset($obj->image) }}" alt="{!! $obj->name !!}" class="img-responsive" style="width:265px;height:120px;"/></a>
                                    <h2 class="ten"><a href="{!! route('public.chitietduan', ['name' => str_slug($obj->name), 'id' => $obj->id ]) !!}" id="title">{!! $obj->name !!}</a></h2>
                                </div>
                                <div class="content_content">
                                    <span class="ngay" style="float:left">{!! $obj->created_at !!}</span>
                                    <div style="float:right"><a title="Nhận tư vấn và thông tin ưu đãi" onclick="getcontact({!! $obj->id !!})" href="javascript:void(0)"><img src="{!! asset('/images/star.png') !!}" alt="{{ asset($obj->name) }}" style="width: 20px; height: 20px;"/></a></div>
                                    <div class="clear"></div>
                                    <div class="chitiet"><span style="padding: 25px; color: blue">{!! getStatusProjectVN($obj->status) !!}</span><a href="{!! route('public.chitietduan', ['name' => str_slug($obj->name), 'id' => $obj->id ]) !!}">Xem thêm <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </div>

                                    <div class="clear"></div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                        
                    </ul>
                    <div>{!! $list->links() !!}</div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    function getcontact (itemId)
    {
        $('#name').html($('#title').text());
        $('#id').val(itemId);
        $('#tuvanduan').modal('show');
    }
</script>
@endsection