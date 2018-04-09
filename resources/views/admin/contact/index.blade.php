@extends('admin.inc.index')
@section('css')
@include('admin.contact.css')
@endsection
@section('title')
Contact
@endsection
@section('content')
<!-- tile -->
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>Contact</strong></h1>
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
	<form class="form-horizontal" role="form" method="post" action="{!! route('admins.contact.action') !!}">
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
							<th>Email</th>
							<th>Phone</th>
							<th>Content</th>
							<th>Is reply</th>
							<th>Created at</th>
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
							<td>{!! $obj->email !!}</td>
							<td>{!! $obj->phone !!}</td>
							<td>{!! $obj->content !!}</td>
							<td>
								@if ($obj->is_reply == 0) 
								<span onclick="active({!! $obj->id !!})" class="check-toggler toggle-class" data-toggle="checked"></span>
								@else
								<span onclick="active({!! $obj->id !!})" class="check-toggler toggle-class checked" data-toggle="checked"></span>
								@endif
							</td>
							<td>{!! date( "d/m/Y", strtotime($obj->created_at)) !!}</td>
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
						<option value="2">Change to reply</option>
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
@include('admin.contact.script')
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


	function active(id) {
		$.ajax({
			url: "{!! route('admins.contact.active') !!}",
			method: "GET",
			data: {
				'id' : id
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