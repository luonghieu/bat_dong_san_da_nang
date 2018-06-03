@extends('admin.inc.index')
@section('css')
@include('admin.notification.css')
@endsection
@section('title')
<a href="{!! route('admins.notification.list') !!}">Schedule</a>
@endsection
@section('content')
<!-- tile -->
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>Schedule</strong></h1>
		<ul class="controls">
			<li class="dropdown">

				<a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown"><i class="fa fa-plus mr-5"></i>Add</a>

				<ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
					<li>
						<a href="{!! route('admins.notification.create', ['type' => 1]) !!}" role="button" tabindex="0" id="add-entry"><i class="fa fa-plus mr-5"></i>My Schedule</a>
					</li>
					<li>
						<a href="{!! route('admins.notification.create', ['type' => 2]) !!}" role="button" tabindex="0" id="add-entry"><i class="fa fa-plus mr-5"></i>Send Customer</a>
					</li>
				</ul>

			</li>
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
	<form class="form-horizontal" role="form" method="post" action="{!! route('admins.notification.action') !!}">
		<input type="hidden" name="_token" value="{{csrf_token()}}" />
		<div class="tile-body">
			<div class="table-responsive">
				@if (session('success'))
				<div class="alert alert-success">
					<p><strong>Action success!</strong></p>
				</div>
				@endif
				<table class="table table-custom" id="editable-usage">
					<thead>
						<tr>
							<th>
								<label class="checkbox checkbox-custom-alt checkbox-custom-sm m-0">
									<input type="checkbox" id="select-all"><i></i>
								</label>
							</th>
							<th>Id</th>
							<th>title</th>
							<th>Content</th>
							<th>Type</th>
							<th>Send to</th>
							<th>Send time</th>
							<th>Status</th>
							<th>Created at</th>
							<th style="width: 160px;" class="no-sort">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($list as $obj)
						<tr class="odd gradeX {{ ($obj->status == 1) ? ' danger' : '' }}">
							<td>
								<label class="checkbox checkbox-custom-alt checkbox-custom-sm m-0"><input type="checkbox" class="selectMe" name="selected[]" value="{!! $obj->id !!}" ><i></i></label>
							</td>
							<td>{!! $obj->id !!}</td>
							<td>{!! $obj->title !!}</td>
							<td>{!! $obj->content !!}</td>
							<td>{{ getNotificationScheduleType($obj->type) }}</td>
							<td>
								@if ($obj->type == 1)
								{{ $obj->user->employee->name  }}
								@else
								<a href="{!! route('admins.customer.detail',['id' => $obj->customer->id]) !!}" class="text-primary text-uppercase text-strong text-sm mr-10">{{ $obj->customer->name  }}</a>
								@endif
							</td>
							@php
							$time_data = [
							'date_of_week' => $obj->date_of_week,
							'day_of_month' => $obj->day_of_month,
							'send_time' => $obj->send_time,
							'send_date' => $obj->send_date,
							];
							$status = getNotificationScheduleStatus($obj->status);
							@endphp
							<td>{{ getNotificationScheduleTime($obj->recurring_type,$time_data) }}</td>
							<td>
								<select name="status-{!! $obj->id !!}" onChange = "changeStatus({!! $obj->id !!})">
									@foreach(getListNotificationScheduleStatus() as $key => $value)
									<option {{ ($value == $obj->status) ? 'selected="selected"' : ''}} value="{!! $value!!}">{!! $key !!}</option>
									@endforeach
								</select>
								<td>{!! date( "d/m/Y", strtotime($obj->created_at)) !!}</td>
								<td class="actions"><a href="{!! route('admins.notification.edit',['id' => $obj->id]) !!}" role="button" tabindex="0" class="edit text-primary text-uppercase text-strong text-sm mr-10">Edit</a><a role="button" tabindex="0" class="delete text-danger text-uppercase text-strong text-sm mr-10">Remove</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<!-- /tile body -->
			<!-- tile footer -->
			<div class="tile-footer dvd dvd-top">
				<div class="row">

					<div class="col-sm-5 hidden-xs">
						<select class="input-sm form-control w-sm inline" name="option">
							<option value="1">Delete selected</option>
						</select>
						<input type="submit" id="apply" class="btn btn-sm btn-default" value="Apply">
					</div>
				</div>
			</div>
			<!-- /tile footer -->
		</form>
	</section>
	<!-- /tile -->
	@endsection

	@section('script')
	@include('admin.notification.script')
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
        		var list = $('input[name="selected"]:checked');
        		if (list.length == 0) {
        			alert('No obj is selected!');
        			return false;
        		}
        		return true;
        	});

        	function changeStatus(id) {
        		status = $('select[name = "status-' + id + '"]').val();
        		$.ajax({
        			url: "{!! route('admins.notification.status') !!}",
        			method: "GET",
        			data: {
        				'id' : id,
        				'status' : status
        			},
        			dataType : 'json',
        			success : function(result){
        				alert('Action success!');
        			}
        		});
        	}

        // });
    </script>
    @endsection