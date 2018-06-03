@extends('public.inc.index')
@section('content')
<div class="content_wrapper">

    <div class="container">

        <div class="breakdum">

            <a href="{!! route('public.trangchu') !!}">Trang chủ</a><span> <i class="fa fa-caret-right" aria-hidden="true"></i> <h2 style="display: inline-block;"><a href="{!! route('public.chitietduan', ['name' => str_slug($obj->name), 'id' => $obj->id ]) !!}">{!! $obj->name !!}</a></h2></span>

        </div>

        <div class="block-news">

            <div class="tile-body">
                <form class="navbar-form navbar-left form-search" action="{{ route('public.duan.timgiaodich') }}" method="GET">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <input type="hidden" id="projectId" name="projectId" value="{{ $obj->id }}" />
                    <div class="row">
                        <div class="col-sm-2">
                            <label>Khu</label>
                            <select class="form-control" name="block" id="block">
                                <option value="-1">--Chon--</option>
                                @foreach($blocks as $item)
                                <option {{ (isset($search)&&$search['block']==$item) ? 'selected="selected"' : '' }} value="{!! $item !!}">{!! $item !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label for="">Lô </label>
                            <select class="form-control" name="land" id="land">
                                <option value="-1">--Chon--</option>
                                @if (isset($lands))
                                @foreach($lands as $item)
                                <option {{ (isset($search)&&$search['land']==$item) ? 'selected="selected"' : '' }} value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label for="">Tầng </label>
                            <select class="form-control" name="floor" id="floor">
                                <option value="-1">--Chon--</option>
                                @if (isset($floors))
                                @foreach($floors as $item)
                                <option {{ (isset($search)&&$search['floor']==$item) ? 'selected="selected"' : '' }} value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label for="">Trạng thái: </label>
                            <select class="form-control" name="status">
                                <option value="-1">--Chọn--</option>
                                @foreach($status as $key => $value)
                                <option  {{ (isset($search)&&$search['status']==$value) ? 'selected="selected"' : '' }}  value="{{ $value }}">{{ $key }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-1">
                           <button style="margin-left: 30px; margin-top: 25px" class="form-control" type="submit">Tìm</button>
                       </div>
                       <div class="col-sm-3">
                        <a href="{!! route('public.duan.tinhtrang', ['id' => $obj->id]) !!}" role="button" tabindex="0" style="text-decoration: none; margin-left: 30px; margin-top: 25px" class="form-control">Hiển thị</a>
                    </div>
                </div>
            </form>
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Khu</th>
                        <th>Lô</th>
                        <th>Tầng</th>
                        <th>Căn hộ</th>
                        <th>Trạng thái</th>
                        <th>Diện tích</th>
                        <th>Giá</th>
                        <th>Hướng</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($transactions))
                    @foreach($transactions as $obj)
                    <tr class="odd gradeX">
                        <td>{!! $obj->id !!}</td>
                        <td>{!! $obj->product->block !!}</td>
                        <td>{!! $obj->product->land !!}</td>
                        <td>
                            @if (isset($obj->apartment))
                            {!! $obj->apartment->floor !!}
                            @else
                            <span>0</span>
                            @endif
                        </td>
                        <td>
                            @if (isset($obj->apartment))
                            {!! $obj->apartment->position !!}
                            @else
                            <span>0</span>
                            @endif
                        </td>
                        <td>
                            {{ getTransactionStatusVN($obj->status) }}
                        </td>
                        <td>
                           @if (isset($obj->apartment))
                           {!! $obj->apartment->area !!}(m2)
                           @else
                           {!! $obj->product->area !!}(m2)
                           @endif
                       </td>
                       <td>
                           @if (isset($obj->apartment))
                           {!! $obj->apartment->price !!} {!! $obj->apartment->unitPrice->name !!}
                           @else
                           {!! $obj->product->price !!} {!! $obj->product->unitPrice->name !!}
                           @endif
                       </td>
                       <td>
                           @if (isset($obj->apartment))
                           {!! $obj->apartment->direction !!}
                           @else
                           {!! $obj->product->direction !!}
                           @endif
                       </td>
                   </tr>
                   @endforeach
                   @else
                   <tr>
                    <td colspan="8">No data</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

</div>

</div>

</div>

@endsection

@section('script')
@section('script')
<script src="{!! asset('admin_asset/js/jquery.rateyo.min.js') !!}"></script>

<script>
    $( document ).ready(function() {
        $('#add-entry').click(function (e) {
            $('#form-add').submit();
        });
        $('#block').change(function () {
            $("#land").html('<option value="-1">--Chọn--</option>');
            $("#floor").html('<option value="-1">--Chọn--</option>');
            block = $(this).val();
            if (block == -1) {
                $("#land").html('<option value="-1">--Chọn--</option>');
                $("#floor").html('<option value="-1">--Chọn--</option>');
                return false;
            }
            $.ajax({
                url: "{{ route('public.duan.getLandByBlock') }}",
                method: "GET",
                data: {
                    'block' : block,
                    'projectId' : $('#projectId').val(),
                },
                dataType : 'json',
                success : function(result){
                    html = '<option value="-1">--Chọn--</option>';
                    $.each (result, function (key, item){
                      html += '<option value="' + item + '">' + item + '</option>';
                  });
                    $("#land").html(html);
                }
            });
        });

        $('#land').change(function () {
            $("#floor").html('<option value="-1">--Chọn--</option>');
            land = $(this).val();
            if (land == -1) {
                $("#floor").html('<option value="-1">--Chọn--</option>');
                return false;
            }
            $.ajax({
                url: "{{ route('public.duan.getFloorByLand') }}",
                method: "GET",
                data: {
                    'block' : $('#block').val(),
                    'land' : land,
                    'projectId' : $('#projectId').val(),
                },
                dataType : 'json',
                success : function(result){
                 html = '<option value="-1">--Chọn--</option>';
                 $.each (result, function (key, item){
                    html += '<option value="' + item + '">' + item + '</option>'
                }); 
                 $('#floor').html(html);
             }
         });
        });

    });
</script>
@endsection
@endsection