@extends('admin.inc.index')
@section('css')
@include('admin.customer.postCustomer.css')
@endsection
@section('title')
Post Customer
@endsection
@section('content')
<!-- tile -->
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>Customer</strong></h1>
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
	<form class="form-horizontal" role="form" method="post" action="{!! route('admins.postCustomer.actionProductTransaction') !!}">
		<input type="hidden" name="_token" value="{{csrf_token()}}" />
		<input type="hidden" name="customer_id" value="{!! $customer_id !!}" />
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
							<th>Published</th>
							<th>End date</th>
							<th>Type post</th>
							<th>Free time</th>
							<th>Price(thousand VND/day)</th>
							<th>Payed</th>
							<th>Active</th>
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
								<a href="{!! route('admins.postCustomer.detailProduct',['product_id' => $obj->product->id]) !!}" role="button" tabindex="0" class="text-uppercase text-strong text-sm mr-10">{!! $obj->product->name !!}</a>
							</td>
							<td>{!! date( "d/m/Y", strtotime($obj->published)) !!}</td>
							<td>{!! date( "d/m/Y", strtotime($obj->end_date)) !!}</td>
							<td>{!! $obj->typePost->name !!}</td>
							<td>{!! $obj->typePost->type_free_time !!}</td>
							<td>{!! $obj->typePost->price !!}</td>
							<td>
								@if ($obj->payed == 0) 
								<span onclick="activePayed({!! $obj->id !!})" class="check-toggler toggle-class" data-toggle="checked"></span>
								@else
								<span onclick="activePayed({!! $obj->id !!})" class="check-toggler toggle-class checked" data-toggle="checked"></span>
								@endif
							</td>
							<td>
								@if ($obj->active == 0) 
								<span onclick="active({!! $obj->id !!})" class="check-toggler toggle-class" data-toggle="checked"></span>
								@else
								<span onclick="active({!! $obj->id !!})" class="check-toggler toggle-class checked" data-toggle="checked"></span>
								@endif
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
						<option value="2">Active selected</option>
						<option value="3">Non-active selected</option>
						<option value="4">Active pay selected</option>
						<option value="5">Non-active pay selected</option>
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

	function active(id) {
		$.ajax({
			url: "{!! route('admins.postCustomer.activeProductTransaction') !!}",
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

	function activePayed(id) {
		$.ajax({
			url: "{!! route('admins.postCustomer.activePaidProductTransaction') !!}",
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