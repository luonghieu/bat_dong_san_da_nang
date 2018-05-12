@extends('admin.inc.index')
@section('css')
@include('admin.customer.css')
@endsection
@section('title')
Customer
@endsection
@section('content')
<!-- tile -->
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>Customer</strong></h1>
		<ul class="controls">
			<li>
				<a href="{!! route('admins.customer.addRegister') !!}" role="button" tabindex="0" id="add-entry"><i class="fa fa-plus mr-5"></i> Add</a>
			</li>
			<li>
				<a href="{!! route('admins.customer.list') !!}" role="button" tabindex="0" id="add-entry"><i class="fa fa-plus mr-5"></i> Refresh</a>
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
	<form class="form-horizontal" role="form" method="post" action="{!! route('admins.customer.action') !!}">
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
							<th>Personal information</th>
							<th>Project</th>
							<th>Created at</th>
							<th>Actions</th>
							<th>Add</th>
						</tr>
					</thead>
					<tbody>
						@foreach($list as $obj)
						<tr class="odd gradeX">
							<td rowspan="{!! $obj->registers->count() !!}">
								<label class="checkbox checkbox-custom-alt checkbox-custom-sm m-0"><input type="checkbox" class="selectMe" name="selected[]" value="{!! $obj->id !!}" ><i></i></label>
							</td>
							<td rowspan="{!! $obj->registers->count() !!}">{!! $obj->id !!}</td>
							<td rowspan="{!! $obj->registers->count() !!}">{!! $obj->name !!}</td>
							<td rowspan="{!! $obj->registers->count() !!}">{!! $obj->email !!}</td>
							<td rowspan="{!! $obj->registers->count() !!}">{!! $obj->phone !!}</td>
							<td rowspan="{!! $obj->registers->count() !!}">
								<a href="{!! route('admins.customer.detail', ['customer_id' => $obj->id ]) !!}" role="button" tabindex="0" class="text-uppercase text-strong text-sm mr-10">Detail</a>
							</td>
							<td>
								@foreach($obj->registers as $item)
								<div style="height: 50px; width: 300px;"><a href="{!! route('admins.customer.detailTransaction', ['registerId' => $item->id ]) !!}" role="button" tabindex="0" class="text-uppercase text-strong text-sm mr-10">{!! $item->project->name !!}</a></div>
								@endforeach
							</td>
							<td>
								@foreach($obj->registers as $item)
								<div style="height: 50px;">{!! date( "d/m/Y", strtotime($item->created_at)) !!}</div>
								@endforeach
							</td>
							<td class="actions">
								@foreach($obj->registers as $item)
								<div style="height: 50px;"><a href="javascript:void(0)" onclick="removeRegister({!! $item->id !!})" role="button" tabindex="0" class="text-danger text-uppercase text-strong text-sm mr-10">Remove</a></div>
								@endforeach
							</td>
							<td rowspan="{!! $obj->registers->count() !!}">
								<a href="javascript:void(0)" onclick="addRegister({!! $obj->id !!})" role="button" tabindex="0" class="edit text-primary text-uppercase text-strong text-sm mr-10">Add</a>
								<a role="button" tabindex="0" class="delete text-danger text-uppercase text-strong text-sm mr-10">Remove</a></td>
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
@include('admin.customer.addRegister')
@section('script')
@include('admin.customer.script')
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

	function addRegister(id) {
		$.ajax({
			url: "{{ route('admins.customer.getRegister') }}",
			method: "GET",
			data: {
				'id' : id,
			},
			dataType : 'json',
			success : function(result){
				html = '';
				$.each (result, function (key, item){
					html += '<option value="' + key + '">' + item + '</option>'
				});
				$('#projects').html(html);
				$('#id').val(id);
				$('#addRegister').modal('show');
			}
		});
	}

	function removeRegister(id) {
		if (confirm('Are you sure!')) {
			$.ajax({
				url: "{{ route('admins.customer.removeRegister') }}",
				method: "GET",
				data: {
					'id' : id,
				},
				dataType : 'json',
				success : function(result){
					alert('Delete success!');
				}
			});
		} else {
			return false;
		}
	}

// });
</script>
@endsection
