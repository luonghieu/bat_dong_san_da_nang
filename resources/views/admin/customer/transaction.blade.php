@extends('admin.inc.index')
@section('css')
@include('admin.customer.postCustomer.css')
@endsection
@section('title')
Transaction
@endsection
@section('content')
<!-- tile -->
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>Transaction</strong></h1>
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
	<form class="form-horizontal" role="form" method="post" action="{!! route('admins.customer.actionTransaction') !!}">
		<input type="hidden" name="_token" value="{{csrf_token()}}" />
		<input type="hidden" name="customer_id" value="{!! $customer_id !!}" />
		<div class="tile-body">
			<div class="table-responsive">
				@if (session('success'))
				<div class="alert alert-success">
					<p><strong>success!</strong></p>
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
							<th>Project</th>
							<th>Block</th>
							<th>Floor</th>
							<th>Status</th>
							<th>Created at</th>
							<th>Description</th>
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
							<td>
								<a href="{!! route('admins.project.detail',['project_id' => $obj->product->project->id]) !!}" role="button" tabindex="0" class="text-uppercase text-strong text-sm mr-10">{!! $obj->product->name !!}</a>
							</td>
							<td>{!! $obj->block !!}</td>
							<td>{!! $obj->floor !!}</td>
							<td>
								<select class="form-control mb-10" name="status" onchange="status({!! $obj->id !!})">
									@foreach ($status as $key => $value)
										<option {{($obj->status == $value)? 'selected="selected"' : ''}} value="{!! $value !!}">{!! $key !!}</option>
									@endforeach
								</select>
							</td>
							<td>{!! date( "d/m/Y", strtotime($obj->created_at)) !!}</td>
							<td>
								<textarea>{!! $obj->description !!}</textarea>
							</td>
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
						<option value="2">Change to registered status</option>
						<option value="3">Change to deposit status</option>
						<option value="4">Change to payment status</option>
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
@include('admin.customer.postCustomer.scriptDetail')
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

	function status (id) {
        var status = $('input[name="status"]').val();
        $.ajax({
            url: "{!! route('admins.customer.status') !!}",
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