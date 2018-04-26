@extends('public.inc.index')
@section('content')
@include('public.tuvansangiaodich')
<div class="content_wrapper">

<div class="container">

<div class="breakdum">

    <a href="{!! route('public.index') !!}">Trang chủ</a><span> <i class="fa fa-caret-right" aria-hidden="true"></i><h1>Sàn giao dịch</h1></span>

</div>

<div class="row">

    <div class="col-md-3">

        <ul class="ct_left_ul1">

            <li class="havespan">

                <span>Sàn giao dịch</span>                

            </li>

            @foreach($menu as $key => $value)
            <li >

                <h3><a class="item_news_name_left" href="{!! route('public.sangiaodich.theloai', ['type' => $type, 'id' => $key]) !!}">{!! $value !!}</a></h3>

            </li>
            @endforeach

            
        </ul>

    </div>

    <div class="col-md-9">

    <div class="row">

    <ul class="thiet_bi_ul">

    @foreach($list as $item)
    <li class="col-lg-4 col-md-4 col-sm-6 col-479">

        <div class="boc">

            <a href="{!! route('public.chitietsanbatdongsan', ['id' => $item->id]) !!}"><img src="{{ asset($item->image) }}" alt="{{ asset($item->name) }}" class="img-responsive" /></a>

            <div class="bocne">

                <div class="thiet_bi_ten"><h2><a href="{!! route('public.chitietsanbatdongsan', ['id' => $item->id]) !!}" id="title">{{ asset($item->name) }}</a></h2>

                    <a title="Nhận tư vấn và thông tin ưu đãi" onclick="getcontact({!! $item->id !!})" href="javascript:void(0)" class="cliksao"><i class="fa fa-star" aria-hidden="true"></i></a>

                </div>

                <div class="thiet_bi_chu_thich"></div>

                <div class="thiet_bi_ct">

                <span class="block_span1">

                    
                </span>

                <span class="block_span2">

                    
                </span>

                <span class="gia">

                    <strong></strong>Liên hệ
                </span>

                </div>

            <div class="clear"></div>

            </div>

        </div>

    </li>
    @endforeach

    <div class="navigation"><span class="current_page_item">Trang <b>1</b> trên <b>5</b></span><span class="current_page_item">1</span><span class="page_item"><a href="http://phoson.vn/san-giao-dich/2">2</a></span><span class="page_item"><a href="http://phoson.vn/san-giao-dich/3">3</a></span><span class="page_item"><a href="http://phoson.vn/san-giao-dich/4">4</a></span><span class="page_item"><a href="http://phoson.vn/san-giao-dich/5">5</a></span><span class="page_item"><a href="http://phoson.vn/san-giao-dich/2">»</a></span></div>
    </ul>

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
            $('#name').val($('#title').text());
            $('#id').val(itemId);

        }
    </script>
@endsection