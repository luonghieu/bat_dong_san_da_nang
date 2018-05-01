
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
                        <div class="box-cont">

                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Created_at</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list as $item)
                                    <tr>
                                        <td>{!! $item->id !!}</td>
                                        <td>{!! $item->email !!}</td>
                                        <td>{!! $item->phone !!}</td>
                                        <td>{!! $item->created_at !!}</td>
                                        <td>{!! $item->created_at !!}</td>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
<script src="{!! asset('public_asset/js/jquery.cookie-1.4.1.js') !!}" type="text/javascript"></script>

<script src="{!! asset('public_asset/js/Common.min.js?v=201705015111') !!}" type="text/javascript"></script>

<script src="{!! asset('public_asset/js/jquery-ui.min.js') !!}"></script>

<script type="text/javascript" src="{!! asset('public_asset/js/jquery.placeholder.min.js') !!}"></script>

<script type="text/javascript" src="{!! asset('public_asset/js/jquery.selectbox-0.2.js') !!}"></script>

@endsection

