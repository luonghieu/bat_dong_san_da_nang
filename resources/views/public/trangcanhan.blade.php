
@extends('public.inc.index')
@section('content')
@if (session('objUser'))
@php      
$objUser = Session::get("objUser");
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
                <div id="PH_Container_MainContent_pnMainContent">
                    <div class="w-700 fr">
                        <div class="fillter-news mb10 clearfix">
                            <div class="mix-select w-200 fl mr10 position">

                                <input name="" type="date" id="txtTungay" class="gray show-value" placeholder="Từ ngày" onkeypress="return false;" />
                                <s class="ic-search-arrow drop-doww"></s>
                            </div>
                            <div class="mix-select w-200 fl mr10 position">

                                <input name="" type="date" id="txtDenngay" class="gray show-value" placeholder="Đến ngày" onkeypress="return false;" />
                                <s class="ic-search-arrow drop-dow"></s>
                            </div>
                            <div class="mix-select w-200 fl mr10 position wr_select">

                                <select name="" id="ddlStatus" class="gray radius">
                                    <option selected="selected" value="0">--Chọn loai tin--</option>
                                    <option value="1">Hiển thị</option>
                                    <option value="2">Tin hết hạn</option>
                                    <option value="3">Tin bị xóa</option>
                                    <option value="4">Tin chưa duyệt</option>
                                </select>
                            </div>
                            <div class="mix-select w-200 fl mr10 position wr_select">

                                <select name="" id="ddlStatus" class="gray radius">
                                    <option selected="selected" value="0">--Chọn loai tin--</option>
                                    <option value="1">Tin VIP</option>
                                    <option value="2">Tin uu dai</option>
                                    <option value="3">Tin binh thuong</option>
                                </select>
                            </div>
                            <a id="btnSearch" class="bt-seaerch bg-blue nobor cursor bold uppercase font15 font-roboto" class="button" href="">
                                <s class="ic-searchmem fl mt2 mr5"></s>
                                <span class="mt2 fl"></span></a>
                            </div>
                            <div class="box-cont">
                                <table width="100%" cellspacing="0" cellpadding="0" border="0" class="bor-left bor-right bor-top">
                                    <tbody>
                                        <tr class="bg-gray3 font14">
                                            <td style="width: 5%">Mã tin</td>
                                            <td style="width: 30%">Tiêu đề</td>
                                            <td style="width: 15%">Loại tin</td>
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
                                                        <a class="mr5 font13" href="" target="_blank"><s class="ic-views mr5 mt3 fl"></s>Xem</a>
                                                  </div>
                                                  <div class="col-sm-4">
                                                    <a class='mr5 font13' href=""><s class="ic-edit mr5 fl"></s>Sửa</a>
                                                  </div>
                                                  <div class="col-sm-4">
                                                    <a class="mr5 font13" href=""><s class="ic-delete mr5 fl"></s>Xóa</a>
                                                  </div>
                                              </div>
                                          </td>
                                          <td class="bor-right bor-bot">{!! $item->typePost->name !!}</td>
                                          <td class="bor-right bor-bot">{!! $item->start_time !!}</td>
                                          <td class="bor-right bor-bot">{!! $item->end_time !!}</td>
                                          <td class="bor-bot"> <a class="mr5 font13" href="{!! route('public.trangcanhan.chitiettuvan', ['idPost' => $item->id ]) !!}"><s class="ic-delete mr5 fl"></s>Chi tiết</a></td>
                                          <td class="bor-bot">
                                            <div class="action">
                                                <div class="danglai">
                                                    @if($item->end_time>date("Y-m-d") )
                                                    <div class="post_tooltip">
                                                        <span class="imgPost">Đăng lại</span>
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

