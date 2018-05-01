@extends('admin.inc.index')
@section('css')
@include('admin.project.css')
@endsection
@section('title')
Project
@endsection
@section('content')
<!-- tile -->
<section class="tile">

    <!-- tile header -->
    <div class="tile-header dvd dvd-btm">
        <h1 class="custom-font"><strong>{{ $obj->name }}</strong></h1>
        <ul class="controls">
            <li class="dropdown">

                <a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                    <i class="fa fa-spinner fa-spin"></i>
                </a>

                <ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
                    <li>
                        <a role="button" tabindex="0" class="tile-toggle">
                            <span class="minimize"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;&nbsp;Minimize</span>
                            <span class="expand"><i class="fa fa-angle-up"></i>&nbsp;&nbsp;&nbsp;Expand</span>
                        </a>
                    </li>
                    <li>
                        <a role="button" tabindex="0" class="tile-refresh">
                            <i class="fa fa-refresh"></i> Refresh
                        </a>
                    </li>
                    <li>
                        <a role="button" tabindex="0" class="tile-fullscreen">
                            <i class="fa fa-expand"></i> Fullscreen
                        </a>
                    </li>
                </ul>

            </li>
        </ul>
    </div>
    <!-- /tile header -->

    <!-- tile body -->
    <div class="tile-body">
        <div class="panel-body handling">
            <div class="search filter-search">
                <form class="navbar-form navbar-left form-search" action="{{ route('admins.project.searchTransaction') }}" method="GET">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <input type="hidden" name="projectId" value="{{ $obj->id }}" />
                    <label>Block</label>
                    <select class="form-control" name="block" id="block">
                        <option value="-1">--Choose--</option>
                        @foreach($products as $item)
                        <option {{ (isset($search)&&$search['block']==$item->id) ? 'selected="selected"' : '' }} value="{!! $item->id !!}">{!! $item->block !!}</option>
                        @endforeach
                    </select>
                    <label for="">Floor: </label>
                    <select class="form-control" name="floor" id="floor">
                        <option value="-1">--Choose--</option>
                        @if (isset($floor))
                        <option value="-1">--Choose--</option>
                        @foreach($floor as $value)
                        <option {{ (isset($search)&&$search['floor']==$value) ? 'selected="selected"' : '' }} value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                        @endif
                    </select>
                    <label for="">Status: </label>
                    <select class="form-control" name="status">
                        <option value="-1">--Choose--</option>
                        @foreach($status as $key => $value)
                        <option  {{ (isset($search)&&$search['status']==$value) ? 'selected="selected"' : '' }}  value="{{ $value }}">{{ $key }}</option>
                        @endforeach
                    </select>
                    <button class="form-control" type="submit" class="pull-right">Search</button>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Block</th>
                        <th>Floor</th>
                        <th>Status</th>
                        <th>Rating</th>
                        <th>Description</th>
                        <th>Created at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $obj)
                    <tr class="odd gradeX">
                        <td>{!! $obj->id !!}</td>
                        <td>{!! $obj->product->block !!}</td>
                        <td>{!! $obj->floor !!}</td>
                        <td>
                            {{ getTransactionStatus($obj->status) }}
                        </td>
                        <td>
                            <div class="rateit" data-rateit-value="{{ $obj->rating }}"  data-rateit-readonly="true"></div>
                        </td>
                        <td>{!! $obj->description !!}</td>
                        <td>{!! date( "d/m/Y", strtotime($obj->created_at)) !!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- /tile -->
@endsection

@section('script')
<script>
    $( document ).ready(function() {
        $('#add-entry').click(function (e) {
            $('#form-add').submit();
        });

        $('#block').change(function (e) {
            productId = $(this).val();
            if (productId == -1) {
                $('#floor').html('<option value="-1">--Choose--</option>');
                return false;
            }
            $.ajax({
                url: "{{ route('admins.project.getFloorByBlock') }}",
                method: "GET",
                data: {
                    'id' : productId,
                },
                dataType : 'json',
                success : function(result){
                    html = '<option value="-1">--Choose--</option>';
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