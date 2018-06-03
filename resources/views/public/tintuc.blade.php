@extends('public.inc.index')
@section('content')
<div class="content_wrapper">

    <div class="container">

        <div class="breakdum">

            <a href="{{route('public.trangchu')}}">Trang chủ</a><span> <i class="fa fa-caret-right" aria-hidden="true"></i> <h1>Tin tức</h1>
                @if(isset($cat))
                <i class="fa fa-caret-right" aria-hidden="true"></i><h1>{!! $cat->name !!}</h1>
                @endif
            </span>

        </div>


        <div class="row">

            <div class="col-md-8">
                @foreach($list as $obj)

                <div class="item_news">

                    <a href="{!! route('public.chitiettintuc', ['name' => str_slug($obj->name), 'id' => $obj->id]) !!}"><img src="{{ asset($obj->image) }}" class="img-responsive"/></a>

                    <div class="item_news_content">

                        <span class="item_news_date">{!! $obj->created_at !!}</span>

                        <h2><a class="item_news_name" href="{!! route('public.chitiettintuc', ['name' => str_slug($obj->name), 'id' => $obj->id]) !!}">{!! $obj->name !!}</a></h2>

                        <div class="item_news_ct">{!! $obj->feature !!}</div>

                    </div>

                </div>
                @endforeach

                <div>{!! $list->links() !!}</div>
            </div>

            <div class="col-md-4">

                <span class="ct_left_title">Bài viết nổi bật</span>

                <ul class="ct_left_ul">
                    @foreach($featureNews as $obj)

                    <li>

                        <h3><a class="item_news_name_left" href="{!! route('public.chitiettintuc', ['name' => str_slug($obj->name), 'id' => $obj->id]) !!}">{!! $obj->name !!}</a></h3>

                        <span class="item_news_date_left">{!! $obj->created_at !!}</span>

                    </li>

                    @endforeach

                </ul>

            </div>

        </div>

    </div>
</div>
@endsection
@section('script')
@endsection