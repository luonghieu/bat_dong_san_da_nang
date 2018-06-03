@extends('admin.inc.index')
@section('css')
@include('admin.customer.css')
@endsection
@section('title')
<a href="{!! route('admins.customer.list') !!}">Customer</a> >Detail Customer
@endsection
@section('content')
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>{!! $obj->name !!}</strong></h1>
		<ul class="controls">
			<li>
				<a href="javascript:void(0)" role="button" tabindex="0" id="add-entry"><i class="fa fa-plus mr-5"></i> Add</a>
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

	<form class="form-horizontal" role="form" method="post" action="{!! route('admins.customer.actionDetail') !!}">
		<input type="hidden" name="_token" value="{{csrf_token()}}" />
		<input type="hidden" name="customerId" value="{{ $obj->id }}" />
		<div class="tile-body">
			<div class="table-responsive">
				@if (session('success'))
				<div class="alert alert-success">
					<p><strong>session('success')</strong></p>
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
							<th>Attribute</th>
							<th>Value</th>
							<th>Created at</th>
							<th style="width: 160px;" class="no-sort">Actions</th>
						</tr>
					</thead>
					<tbody id="contentDetail">
						@foreach($list as $item)
						<tr class="odd gradeX" id="detail-{{ $item->id }}">
							<td>
								<label class="checkbox checkbox-custom-alt checkbox-custom-sm m-0"><input type="checkbox" class="selectMe" name="selected[]" value="{!! $item->id !!}" ><i></i></label>
							</td>
							<td>{!! $item->id !!}</td>
							<td>{!! $item->attribute !!}</td>
							<td>{!! $item->value !!}</td>
							<td>{!! date( "d/m/Y", strtotime($item->created_at)) !!}</td>
							<td class="actions"><a href="javascript:void(0)" onclick="edit({{ $item->id }})" role="button" tabindex="0" class="edit text-primary text-uppercase text-strong text-sm mr-10" id="edit-entry">Edit</a><a role="button" tabindex="0" class="delete text-danger text-uppercase text-strong text-sm mr-10">Remove</a></td>
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
<!-- /tile -->

@endsection
@include('admin.customer.addDetail')
@include('admin.customer.editDetail')
@section('script')
@include('admin.customer.scriptDetail')
<script type="text/javascript">

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
	
	$('#add-entry').click(function(){
		$('#idAdd').val({!! $obj->id !!});
		$('#addDetail').modal();
	});

	function edit(id) {
		$.ajax({
			url: "{{ route('admins.customer.getDetail') }}",
			method: "GET",
			data: {
				'id' : id,
			},
			dataType : 'json',
			success : function(result){
				$('#idEdit').val(result.id);
				$('#attributeEdit').val(result.attribute);
				$('#valueEdit').val(result.value);
				$('#editDetail').modal();
			}
		});
	}
</script>

@endsection