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
			<h1 class="custom-font"><strong>Project</strong></h1>
			<ul class="controls">
				<li>
					<a href="{!! route('admins.project.create') !!}" role="button" tabindex="0" id="add-entry"><i class="fa fa-plus mr-5"></i> Add</a>
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
		<form class="form-horizontal" role="form" method="post" action="{!! route('admins.project.action') !!}">
			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			<div class="tile-body">
				<div class="table-responsive">
					@if (session('success'))
						<div class="alert alert-success">
							<p><strong>Add success!</strong></p>
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
							<th>Name</th>
							<th>Detail</th>
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
								<td>
									<a href="{!! route('admins.project.detail', ['id' => $obj->id ]) !!}" role="button" tabindex="0" class="text-uppercase text-strong text-sm mr-10">Detail</a>
								</td>
								<td>{!! $obj->view !!}</td>
								<td>
									<select  name="status-{{ $obj->status }}" onchange="statusProject({!! $obj->id !!})">
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
									<a href="{!! route('admins.project.detail', ['id' => $obj->id ]) !!}" role="button" tabindex="0" class="edit text-primary text-uppercase text-strong text-sm mr-10">Edit</a>
									<a role="button" tabindex="0" class="delete text-danger text-uppercase text-strong text-sm mr-10">Remove</a></td>
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
							<option value="2">Change to ready status</option>
							<option value="3">Change to salling status</option>
							<option value="4">Change to coming soon status</option>
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
				alert('Action success!');
			}
		});
	}
        // });
	</script>
@endsection