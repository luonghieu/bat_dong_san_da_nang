@extends('public.inc.index')
@section('content')
@if (session('objCustomer'))
@php      
$objCustomer = Session::get("objCustomer");
@endphp
@endif
<div class="content_wrapper">

    <div class="container">

     <div class="main bg_white clearfix">

        <div class="box margin-center mt50 mb30">        

            <div class="title-tabs bor-bot-blue2 font-robotonormal normal uppercase font17 blue2 position normal w-700 fr">
                Quản lý tin rao bán/cho thuê
            </div>
            <div class="value-newsup clearfix">
                <div>

                    <div class="w-700 fr">
                        <div class="fillter-news mb10 clearfix">
                            @if (session('success'))
                            <div class="alert alert-success">
                                <p>{{ session('success') }}</p>
                            </div>
                            @endif
                            <form action="{{ route('public.trangcanhan.timkiem') }}" method="post">
                                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <div class="mix-select w-200 fl mr10 position">

                                <input name="date_from" type="date" class="gray show-value"  onkeypress="return false;" value="{{ (isset($date_from)) ? $date_from : date('Y-m-d')}}" />
                                <s class="ic-search-arrow drop-doww"></s>
                            </div>
                            <div class="mix-select w-200 fl mr10 position">

                                <input name="date_to" type="date" class="gray show-value" onkeypress="return false;" value="{{ (isset($date_to)) ? $date_to : date('Y-m-d')}}"/>
                                <s class="ic-search-arrow drop-dow"></s>
                            </div>
                            <div class="mix-select w-200 fl mr10 position wr_select">
                                <select name="type" class="gray radius">
                                    <option {{ (!isset($type)) ? 'selected="selected"' : ''}}  value="0">--Chọn loai tin--</option>
                                    <option {{ (isset($type) && $type ==1) ? 'selected="selected"' : ''}} value="1">Hiển thị</option>
                                    <option {{ (isset($type) && $type ==2) ? 'selected="selected"' : ''}} value="2">Tin hết hạn</option>
                                    <option {{ (isset($type) && $type ==3) ? 'selected="selected"' : ''}} value="3">Tin bị xóa</option>
                                    <option {{ (isset($type) && $type ==4) ? 'selected="selected"' : ''}} value="4">Tin chưa duyệt</option>
                                    <option {{ (isset($type) && $type ==5) ? 'selected="selected"' : ''}} value="5">Tin bị hủy bỏ</option>
                                </select>
                            </div>
                            <input style="padding: 10px; background-color: #0C5BAD; color: white" class="btnUpNew" type="submit" value="Tìm kiếm">
                            </form>
                        </div>
                        <div class="box-cont">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="bor-left bor-right bor-top">
                                <tbody>
                                    <tr class="bg-gray3 font14">
                                        <td style="width: 5%">Mã tin</td>
                                        <td style="width: 30%">Tiêu đề</td>
                                        <td style="width: 15%">Ngày đăng</td>
                                        <td style="width: 15%">Hết hạn</td>
                                        <td style="width: 10%">Tư vấn</td>
                                        <td style="width: 10%">Thao tác</td>
                                    </tr>

                                    @foreach($posts as $item)
                                    <tr class="bor-bot">
                                        <td class="bor-right bor-bot">{!! $item->id !!}</td>
                                        <td class="tl bor-right bor-bot">
                                            <label>{!! $item->name !!}</label>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <a class="mr5 font13" href="{{ route('public.chitietsanbatdongsan', ['name' => str_slug($item->name), 'id' => $item->id]) }}" target="_blank">Xem</a>
                                                </div>
                                                <div class="col-sm-4">
                                                    <a class='mr5 font13' href="{{ route('public.suatin', ['id' => $item->id]) }}">Sửa</a>
                                                </div>
                                                <div class="col-sm-4">
                                                    <a class="mr5 font13" href="{{ route('public.xoatin', ['id' => $item->id]) }}">Xóa</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="bor-right bor-bot">{!! $item->start_time !!}</td>
                                        <td class="bor-right bor-bot">{!! $item->end_time !!}</td>
                                        <td class="bor-bot"> <a class="mr5 font13" href="{!! route('public.trangcanhan.chitiettuvan', ['idPost' => $item->id ]) !!}"><s class="ic-delete mr5 fl"></s>Chi tiết</a></td>
                                        <td class="bor-bot">
                                            <div class="action">
                                                <div class="danglai">
                                                    @if($item->end_time < date("Y-m-d H:i"))
                                                    <div class="post_tooltip">
                                                        <a class='mr5 font13' href="{{ route('public.danglai', ['id' => $item->id]) }}"><s class="ic-edit mr5 fl"></s>Đăng lại</a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="box page page_controll nobor position tr">
                            <span id="PH_Container_MainContent_ctl00_ProductsPager"></span>
                        </div>
                    </div>
                </div>
                @include('public.inc.trangcanhan')

            </div>

        </div>

    </div>

    <div class="clear">
    </div>
</div>
</div>
</div>
@endsection
@section('script')
<script src="{!! asset('public_asset/js/jquery.cookie-1.4.1.js') !!}" type="text/javascript"></script>

<script src="{!! asset('public_asset/js/Common.min.js?v=201705015111') !!}" type="text/javascript"></script>

<script src="{!! asset('public_asset/js/jquery-ui.min.js') !!}"></script>

<script type="text/javascript" src="{!! asset('public_asset/js/jquery.placeholder.min.js') !!}"></script>

<script type="text/javascript" src="{!! asset('public_asset/js/jquery.selectbox-0.2.js') !!}"></script>

@endsection

