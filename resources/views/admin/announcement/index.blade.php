@extends('admin.inc.index')
@section('css')
@include('admin.announcement.css')
@endsection
@section('title')
<a href="{!! route('admins.announcement.list') !!}">Announcement</a>
@endsection
@section('content')
@php
$objUser = getUserLogin();
@endphp
<!-- tile -->
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>Announcement</strong></h1>
		<ul class="controls">
			<li>
				@if (isAdmin() || isManager())
				<a href="{!! route('admins.announcement.create') !!}" role="button" tabindex="0" id="add-entry"><i class="fa fa-plus mr-5"></i> Add</a>
				@endif
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
	<form class="form-horizontal" role="form" method="post" action="{!! route('admins.announcement.action') !!}">
		<input type="hidden" name="_token" value="{{csrf_token()}}" />
		<div class="tile-body">
			<div class="table-responsive">
				@if (session('success'))
				<div class="alert alert-success">
					<p><strong>{!! session('success') !!}</strong></p>
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
							<th>Title</th>
							<th>Content</th>
							<th>Active</th>
							<th>Created by</th>
							<th>Created at</th>
							<th style="width: 160px;" class="no-sort">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($list as $obj)
						<tr class="odd gradeX {{ isset($obj->is_read) ? (($obj->is_read) ? ' ' :'danger') : '' }}">
							<td>
								<label class="checkbox checkbox-custom-alt checkbox-custom-sm m-0"><input type="checkbox" class="selectMe" name="selected[]" value="{!! $obj->id !!}" ><i></i></label>
							</td>
							<td>{!! $obj->id !!}</td>
							<td>{!! $obj->title !!}</td>
							<td>{!! $obj->content !!}</td>
							<td>
								@if ($obj->active_edit)
								@if ($obj->active == 0)
								<span onclick="active({!! $obj->id !!})" class="check-toggler toggle-class" data-toggle="checked"></span>
								@else
								<span onclick="active({!! $obj->id !!})" class="check-toggler toggle-class checked" data-toggle="checked"></span>
								@endif
								@else
								No permission
								@endif 
							</td>
							<td>
								@if($obj->causer_id != null)
								{!! $obj->user->username !!}
								@endif
							</td>
							<td>{!! date( "d/m/Y H:i:s", strtotime($obj->created_at)) !!}</td>
							<td class="actions">
								@if ($obj->active_edit)
								<a href="{!! route('admins.announcement.edit',['id' => $obj->id]) !!}" role="button" tabindex="0" class="edit text-primary text-uppercase text-strong text-sm mr-10">Edit</a>
								@endif
								<a role="button" tabindex="0" class="delete text-danger text-uppercase text-strong text-sm mr-10">Remove</a>
							</td>
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
						<option value="2">Active selected</option>
						<option value="3">Non-active selected</option>
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
@include('admin.announcement.script')
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


        	function active(id) {
        		$.ajax({
        			url: "{!! route('admins.announcement.active') !!}",
        			method: "GET",
        			data: {
        				'id' : id
        			},
        			dataType : 'html',
        			success : function(result){
        				alert('Action success!');
        			}
        		});
        	}
        // });
    </script>
    @endsection