@extends('admin.inc.index')
@section('css')
@include('admin.project.css')
@endsection
@section('title')
<a href="{!! route('admins.project.list') !!}">Project</a>
@endsection
@section('content')
<!-- tile -->
<section class="tile">

    <!-- tile header -->
    <div class="tile-header dvd dvd-btm">
        <h1 class="custom-font"><strong>Project</strong></h1>
        <ul class="controls">
            @if(!isEmployee())
            <li>
                <a href="{!! route('admins.project.create') !!}" role="button" tabindex="0" id="add-entry"><i class="fa fa-plus mr-5"></i> Add</a>
            </li>
            @endif
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
                        <a href="{!! route('admins.project.list') !!}" role="button" tabindex="0" class="tile-refresh">
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
    <div class="panel-body handling">
        <div class="search filter-search">
            <form class="navbar-form navbar-left form-search" action="{{ route('admins.project.searchProject') }}" method="GET">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <div>
                    <label>District</label>
                    <select class="form-control" name="district_id" id="district_id">
                        <option value="-1">--Choose--</option>
                        @foreach($districts as $id => $name)
                        <option {{ (isset($search)&&$search['district_id']==$id) ? 'selected="selected"' : '' }} value="{!! $id !!}">{!! $name !!}</option>
                        @endforeach
                    </select>
                    <label for="">Village: </label>
                    <select class="form-control" name="village_id" id="village_id">
                        <option value="-1">--Choose--</option>
                        @if (isset($villages))
                        @foreach($villages as $id => $name)
                        <option {{ (isset($search)&&$search['village_id']==$id) ? 'selected="selected"' : '' }} value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                        @endif
                    </select>
                    <label for="">Street: </label>
                    <select class="form-control" name="street_id" id="street_id">
                        <option value="-1">--Choose--</option>
                        @if (isset($streets))
                        @foreach($streets as $id => $name)
                        <option {{ (isset($search)&&$search['street_id']==$id) ? 'selected="selected"' : '' }} value="{{ $id }}">{{ $name }}</option>
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
                </div><br>
                <div>
                    <center>
                        <button style="margin-left: 15px" class="form-control" type="submit" class="pull-right">Search</button>
                        <a href="{!! route('admins.project.list') !!}" role="button" tabindex="0" style="margin-left: 15px; text-decoration: none" class="form-control" class="pull-right">Show all</a></center>
                    </div>
                </form>
            </div>
        </div>
        <form class="form-horizontal" role="form" method="post" action="{!! route('admins.project.action') !!}">
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <div class="tile-body">
                <div class="table-responsive">
                    @if (session('success'))
                    <div class="alert alert-success">
                        <p><strong>{{ session('success') }}</strong></p>
                    </div>
                    @endif
                    <div class="clearfix"></div>
                    <table class="table table-custom" id="editable-usage">
                        <thead>
                            <tr>
                                <th>
                                    <label class="checkbox checkbox-custom-alt checkbox-custom-sm m-0">
                                        <input type="checkbox" id="select-all"><i></i>
                                    </label>
                                </th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Detail</th>
                                <th>Products</th>
                                <th>View</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Created at</th>
                                <th>Transaction status</th>
                                <th style="width: 160px;" class="no-sort">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list as $obj)
                            <tr class="odd gradeX">
                                <td>
                                    <label class="checkbox checkbox-custom-alt checkbox-custom-sm m-0"><input type="checkbox" class="selectMe" name="selected[]" value="{!! $obj->id !!}" ><i></i></label>
                                </td>
                                <td>{!! $obj->id !!}</td>
                                <td>{!! $obj->name !!}</td>
                                <td>{!! $obj->street->name !!}, {!! $obj->village->name !!}, {!! $obj->district->name !!}</td>
                                <td>
                                    <a href="{!! route('admins.project.edit', ['id' => $obj->id ]) !!}" role="button" tabindex="0" class="text-uppercase text-strong text-sm mr-10">Detail</a>
                                </td>
                                <td>
                                    <a href="{{ route('admins.product.list', ['projectId' => $obj->id]) }}" role="button" tabindex="0" class="text-uppercase text-strong text-sm mr-10">Products</a>
                                </td>
                                <td>{!! $obj->view !!}</td>
                                <td>
                                    <select name="status-{{ $obj->id }}" @if(!isEmployee()) onchange="statusProject({!! $obj->id !!})" @endif>
                                        @foreach($status as $key => $value)
                                        <option value="{!! $value !!}" {{ ($obj->status == $value) ? 'selected="selected"' : ''}}>{!! $key !!}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <img src="{!! asset((empty($obj->image)) ? '/images/default.jpg' : $obj->image ) !!}" class="img-responsive text-center" />
                                </td>
                                <td>{!! date( "d/m/Y", strtotime($obj->created_at)) !!}</td>
                                <td>
                                    <a href="{!! route('admins.project.status', ['id' => $obj->id ]) !!}" role="button" tabindex="0" class="text-uppercase text-strong text-sm mr-10">Detail</a>
                                </td>
                                <td class="actions">
                                    @if (isEmployee())
                                    No permission
                                    @else
                                    <a href="{!! route('admins.project.edit', ['id' => $obj->id ]) !!}" role="button" tabindex="0" class="edit text-primary text-uppercase text-strong text-sm mr-10">Edit</a>
                                    <a role="button" tabindex="0" class="delete text-danger text-uppercase text-strong text-sm mr-10">Remove</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /tile body -->
            <!-- tile footer -->
            @if (!isEmployee())
            <div class="tile-footer dvd dvd-top">
                <div class="row">

                    <div class="col-sm-5 hidden-xs">
                        <select class="input-sm form-control w-sm inline" name="option">
                            <option value="1">Delete selected</option>
                            <option value="2">Change to ready status</option>
                            <option value="3">Change to salling status</option>
                            <option value="4">Change to coming soon status</option>
                            <option value="5">Change to stop status</option>
                        </select>
                        <input type="submit" id="apply" class="btn btn-sm btn-default" value="Apply">
                    </div>
                </div>
            </div>
            @endif
            <!-- /tile footer -->
        </form>
    </section>
    <!-- /tile -->
    @endsection

    @section('script')
    @include('admin.project.script')
    <script>
// $( document ).ready(function() {
    $('#select-all').change(function() {
        if ($(this).is(":checked")) {
            $('#editable-usage .selectMe').prop('checked', true);
        } else {
            $('#editable-usage .selectMe').prop('checked', false);
        }
    });

    $('#apply').click(function() {
        var list = $('input[name="selected[]"]:checked');
        if (list.length == 0) {
            alert('No obj is selected!');
            return false;
        }
        return true;
    });

    function statusProject(id) {
        status = $('select[name = "status-' + id + '"]').val();
        $.ajax({
            url: "{!! route('admins.project.statusProject') !!}",
            method: "GET", 
            data: {
                'id' : id,
                'status' : status
            },
            dataType : 'json',
            success : function(result){
                if(result == 'ok') {
                    alert('Action success!');
                } else {
                    alert('Project is in transaction');
                }
            }
        });
    }


    $('#district_id').change(function() {
        $('#village_id').html('<option value="-1">-- Choose --</option>');
        $('#street_id').html('<option value="-1">-- Choose --</option>');
        district_id = $('#district_id').val();
        if (district_id == -1) {
            $('#village_id').html('<option value="-1">-- Choose --</option>');
            $('#street_id').html('<option value="-1">-- Choose --</option>');
            return;
        }

        $.ajax({
            url: "{!! route('admins.project.getVillageByDistrict') !!}",
            method: "GET",
            data: {
                'district_id' : district_id
            },
            dataType : 'json',
            success : function(result){
                html = '<option value="-1">-- Choose --</option>';
                $.each (result, function (key, item){
                    html += '<option value="' + key + '">' + item + '</option>';
                });

                $("#village_id").html(html);
            }
        });
    });

    $('#village_id').change(function() {
        $('#street_id').html('<option value="-1">-- Choose --</option>');
        village_id = $('#village_id').val();
        if (village_id == -1) {
            $('#street_id').html('<option value="-1">-- Choose --</option>');
        }

        $.ajax({
            url: "{!! route('admins.project.getStreetByVillage') !!}",
            method: "GET",
            data: {
                'village_id' : village_id
            },
            dataType : 'json',
            success : function(result){
                html = '<option value="-1">-- Choose --</option>';
                $.each (result, function (key, item){
                    html += '<option value="' + key + '">' + item + '</option>';
                });

                $("#street_id").html(html);
            }
        });
    });

// });
</script>
@endsection