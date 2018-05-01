@extends('admin.inc.index')
@section('css')
@include('admin.customer.css')
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
			<li>
				<a href="{!! route('admins.customer.createTransaction', ['registerId' => $register->id]) !!}" role="button" tabindex="0" id="add-entry"><i class="fa fa-plus mr-5"></i> Add</a>
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
	<center><h3>
		<a href="{!! route('admins.project.detail',['project_id' => $register->project->id]) !!}" role="button" tabindex="0" class="text-uppercase text-strong text-sm mr-10">{!! $register->project->name !!}</a>
	</h3></center>
	<form class="form-horizontal" role="form" method="post" action="{!! route('admins.customer.actionTransaction') !!}">
		<input type="hidden" name="_token" value="{{csrf_token()}}" />
		<input type="hidden" name="registerId" value="{!! $register->id !!}" />
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
							<th>Block</th>
							<th>Floor</th>
							<th>Status</th>
							<th>Created at</th>
							<th>Description</th>
							<th>Rating</th>
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
								<a href="{!! route('admins.product.detail',['id' => $obj->product->id]) !!}" role="button" tabindex="0" class="text-uppercase text-strong text-sm mr-10">{!! $obj->product->block !!}</a>
							</td>
							<td>{!! $obj->floor !!}</td>
							<td>
								<select class="form-control mb-10" name="status-{!! $obj->id !!}" onchange="statusTransaction({!! $obj->id !!})">
									@foreach ($status as $key => $value)
									<option {{($obj->status == $value)? 'selected="selected"' : ''}} value="{!! $value !!}">{!! $key !!}</option>
									@endforeach
								</select>
							</td>
							<td>{!! date( "d/m/Y", strtotime($obj->created_at)) !!}</td>
							<td>
								{!! $obj->description !!}
							</td>
							<td>
								@if($obj->status == 0)
								<div id="rateit_star1"  data-transactionid="{{ $obj->id }}"></div>
								<script type="text/javascript">
									$(function () {
										$('#rateit_star1').rateit({min: 1, max: 10, step: 1});
										$('#rateit_star1').bind('rated', function (e) {
											var ri = $(this);
											var value = ri.rateit('value');
											var transactionid = ri.data('transactionid');
											$.ajax({
												url: "{{ route('admins.customer.ratingTransaction') }}",
												method: "GET",
												data: {
													'value' : value,
													'transactionid' : transactionid,
												},
												dataType : 'json',
												success : function(result){
													alert('Bạn đã đánh giá '+value +' sao cho sản phẩm có id là:'+productID );
                                                        //không cho phép đánh giá,sau khi đã đánh giá xong
                                                        ri.rateit('readonly', true);
                                                    }
                                                });
										});
									});
								</script>
								@endif
								<div class="rateit" data-rateit-value="{{ $obj->rating }}"  data-rateit-readonly="true"></div>
							</td>
							<td class="actions">
								@if ($obj->status != 0) 
								<a href="{!! route('admins.customer.editTransaction',['id' => $obj->id]) !!}" role="button" tabindex="0" class="edit text-primary text-uppercase text-strong text-sm mr-10">Edit</a>
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
@include('admin.customer.scriptTransaction')
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

	function statusTransaction(id) {
		status = $('select[name = "status-' + id + '"]').val();
		$.ajax({
			url: "{!! route('admins.customer.statusTransaction') !!}",
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