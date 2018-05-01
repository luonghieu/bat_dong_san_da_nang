@extends('admin.inc.index')
@section('css')
@include('admin.post.posts.css')
@endsection
@section('title')
Posts
@endsection
@section('content')
<!-- tile -->
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>Posts</strong></h1>
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
	<form class="form-horizontal" role="form" method="post" action="{!! route('admins.post.action') !!}">
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
							<th>Description</th>
							<th>Direction</th>
							<th>Category</th>
							<th>Type</th>
							<th>Image</th>
							<th>Status</th>
							<th>Village</th>
							<th>Street</th>
							<th>District</th>
							<th>Project</th>
							<th>Area</th>
							<th>View</th>
							<th>Price</th>
							<th>Unit price</th>
							<th>Type post</th>
							<th>Start time</th>
							<th>End time</th>
							<th>Fee(VND/month)</th>
							<th>Frontispiece</th>
							<th>Road ahead(m)</th>
							<th>Number of floor</th>
							<th>Number of room</th>
							<th>Number of toilet</th>
							<th>Furniture</th>
							<th>Infomation contact</th>
							<th>Posted by</th>
							<th>Deleted at</th>
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
							<td>{!! $obj->description !!}</td>
							<td>
								@foreach($direction as $key => $value)
								@if($obj->direction == $key) {!! $value !!}
								@endif
								@endforeach
							</td>
							<td>{!! $obj->cat->name !!}</td>
							<td>
								@if ($obj->cat->type_transaction == 1)
								<p>Bán</p>
								@else
								<p>Cho thuê</p>
								@endif
							</td>
							<td><img src="{!! asset((empty($obj->image)) ? '/images/default.jpg' : $obj->image ) !!}" class="img-responsive text-center" /></td>
							<td>
								<select name="status-{!! $obj->id !!}" onChange = "changeStatus({!! $obj->id !!})">
									<option {{ ($obj->status ==0) ? "selected='selected'" : '' }} value="1">Processing</option>
									<option {{ ($obj->status ==1) ? "selected='selected'" : '' }} value="2">Processed</option>
									<option {{ ($obj->status ==2) ? "selected='selected'" : '' }} value="3">Cancel</option>
								</select>
							</td>
							<td>
								@if ($obj->village_id)
								{!! $obj->village->name !!}
								@endif
								<p>Khong xac dinh</p>
							</td>
							<td>
								@if ($obj->street_id)
								{!! $obj->street->name !!}
								@endif
								<p>Khong xac dinh</p>
							</td>
							<td>{!! $obj->district->name !!}</td>
							<td>
								@if ($obj->project_id)
								{!! $obj->project->name !!}
								@endif
								<p>Khong xac dinh</p>
							</td>
							<td>{!! $obj->area !!}</td>
							<td>{!! $obj->view !!}</td>
							<td>{!! $obj->price !!}</td>
							<td>{!! $obj->unitPrice->name !!}</td>
							<td>{!! $obj->typePost->name !!}</td>
							<td>{!! date( "d/m/Y", strtotime($obj->start_time)) !!}</td>
							<td>{!! date( "d/m/Y", strtotime($obj->end_time)) !!}</td>
							<td>{!! $obj->typePost->price !!}</td>
							<td>{!! $obj->frontispiece !!}</td>
							<td>{!! $obj->road_ahead !!}</td>
							<td>{!! $obj->number_of_floor !!}</td>
							<td>{!! $obj->number_of_room !!}</td>
							<td>{!! $obj->number_of_toilet !!}</td>
							<td>{!! $obj->furniture !!}</td>
							<td>{!! $obj->info_contact !!}</td>
							<td>{!! $obj->poster->name !!}</td>
							<td>{!! date( "d/m/Y", strtotime($obj->deleted_at)) !!}</td>
							<td class="actions"><a role="button" tabindex="0" class="delete text-danger text-uppercase text-strong text-sm mr-10">Remove</a></td>
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
						<option value="2">Change to processed status</option>
						<option value="3">Change to cancel status</option>
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
@include('admin.post.posts.script')
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
				url: "{!! route('admins.post.status') !!}",
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