@extends('public.inc.index')
@section('content')
@include('public.tuvansangiaodich')
<div class="content_wrapper">

    <div class="container">

        <div class="breakdum">

            <a href="{!! route('public.trangchu') !!}">Trang chủ</a><span> <i class="fa fa-caret-right" aria-hidden="true"></i><h1>Sàn giao dịch</h1></span>

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

                                <a href="{!! route('public.chitietsanbatdongsan', ['id' => $item->id]) !!}"><img src="{!! asset($item->image) !!}" alt="{{ asset($item->name) }}" class="img-responsive" style="width:265px;height:120px;" /></a>

                                <div class="bocne">

                                    <div class="thiet_bi_ten">
                                        <h2>
                                            <a href="{!! route('public.chitietsanbatdongsan', ['id' => $item->id]) !!}" id="title">{{ $item->name }}</a>
                                        </h2>

                                        <a title="Nhận tư vấn và thông tin ưu đãi" onclick="getcontact({!! $item->id !!})" href="javascript:void(0)" class="cliksao"><img src="{!! asset('/images/star.png') !!}" alt="{{ asset($item->name) }}" style="position: absolute;right: 3px;top: 13px;font-size: 16px; width: 20px; height: 20px;"/></a>

                                    </div>
                                    <div class="clear"></div>

                                </div>

                            </div>

                        </li>
                        @endforeach

                        <div>{!! $list->links() !!}</div>
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
        $('#name').html($('#title').text());
        $('#id').val(itemId);
        $('#tuvansangiaodich').modal('show');
    }
</script>
@endsection