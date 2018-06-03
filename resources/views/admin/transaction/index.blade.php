@extends('admin.inc.index')
@section('css')
@include('admin.transaction.css')
@endsection
@section('title')
<a href="{!! route('admins.transaction.listAll') !!}">Transaction</a>
@endsection
@section('content')
<!-- tile -->
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>Transaction</strong></h1>
		<ul class="controls">
			<li>
				<a href="{!! route('admins.transaction.createAllTransaction') !!}" role="button" tabindex="0" id="add-entry"><i class="fa fa-plus mr-5"></i> Add</a>
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
						<a href="{!! route('admins.transaction.listAll') !!}" role="button" tabindex="0" class="tile-refresh">
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
	<div class="tile-body">
		<div class="panel-body handling">
			<div class="search filter-search">
				<form class="navbar-form navbar-left form-search" action="{{ route('admins.transaction.searchAllTransaction') }}" method="GET">
					<input type="hidden" name="_token" value="{{csrf_token()}}" />
					<div>
						<label>Project</label>
						<select class="form-control" witdth="50px;" name="project" id="project">
							<option value="-1">--Choose--</option>
							@foreach($projects as $key => $item)
							<option {{ (isset($search)&&$search['project']==$key) ? 'selected="selected"' : '' }} value="{!! $key !!}">{!! $item !!}</option>
							@endforeach
						</select>
						<label>Category</label>
						<select class="form-control" name="cat_id" id="cat_id">
							<option value="-1">--Choose--</option>
							@foreach($cats as $id => $name)
							<option {{ (isset($search)&&$search['cat_id']==$id) ? 'selected="selected"' : '' }} value="{!! $id !!}">{!! $name !!}</option>
							@endforeach
						</select>
					</div>
					<br>
					<div>
						<label>Block</label>
						<select class="form-control" name="block" id="block">
							<option value="-1">--Choose--</option>
							@if (isset($lands))
							@foreach($blocks as $item)
							<option {{ (isset($search)&&$search['block']==$item) ? 'selected="selected"' : '' }} value="{!! $item !!}">{!! $item !!}</option>
							@endforeach
							@endif
						</select>
						<label for="">Land: </label>
						<select class="form-control" name="land" id="land">
							<option value="-1">--Choose--</option>
							@if (isset($lands))
							@foreach($lands as $item)
							<option {{ (isset($search)&&$search['land']==$item) ? 'selected="selected"' : '' }} value="{{ $item }}">{{ $item }}</option>
							@endforeach
							@endif
						</select>
						<label for="">Floor: </label>
						<select class="form-control" name="floor" id="floor">
							<option value="-1">--Choose--</option>
							@if (isset($floors))
							@foreach($floors as $item)
							<option {{ (isset($search)&&$search['floor']==$item) ? 'selected="selected"' : '' }} value="{{ $item }}">{{ $item }}</option>
							@endforeach
							@endif
						</select>
						<label for="">Status: </label>
						<select class="form-control" name="status">
							<option value="-1">--Choose--</option>
							@foreach($status as $key => $value)
							<option  {{ (isset($search)&&$search['status']==$value) ? 'selected="selected"' : '' }}  value="{{ $value }}">{{ $key }}</option>
							@endforeach
						</select>
						<button style="margin-left: 15px" class="form-control" type="submit" class="pull-right">Search</button>
						<a href="{!! route('admins.transaction.listAll') !!}" role="button" tabindex="0" style="margin-left: 15px; text-decoration: none" class="form-control" class="pull-right">Show all</a>
					</div>
				</form>
			</div>
		</div>
		<div class="clearfix"></div>
		<form class="form-horizontal" role="form" method="post" action="{!! route('admins.transaction.actionAllTransaction') !!}">
			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			<div class="table-responsive">
				@if (session('success'))
				<div class="alert alert-success">
					<p><strong>{{session('success')}}</strong></p>
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
							<th>Category</th>
							<th>Block</th>
							<th>Land</th>
							<th>Number of floors</th>
							<th>Floor</th>
							<th>Position</th>
							<th width="150px">Status</th>
							<th>Created at</th>
							<th>Description</th>
							<th>Rating</th>
							<th>Customer</th>
							<th>Email</th>
							<th>Phone</th>
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
							<td>{!! $obj->product->project->name !!}</td>
							<td>{!! $obj->product->cat->name !!}</td>
							<td>{!! $obj->product->block !!}</td>
							<td>{!! $obj->product->land !!}</td>
							<td>
								@if($obj->product->floor)
								{!! $obj->product->floor !!}
								@else
								<span>0</span>
								@endif
							</td>
							<td>
								@if(isset($obj->apartment))
								{!! $obj->apartment->floor !!}
								@else
								<span>0</span>
								@endif
							</td>
							<td>
								@if(isset($obj->apartment))
								{!! $obj->apartment->position !!}
								@else
								<span>0</span>
								@endif
							</td>
							<td>
								<select name="status-{!! $obj->id !!}" @if ($obj->isPermit) onchange="statusTransaction({!! $obj->id !!}) @endif">
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
								@if ($obj->isPermit)
								@if($obj->status == 0)
								<div id="rateYo{{$obj->id}}"></div>
								<span style="color: red"></span>
								<div id ="rating{{$obj->id}}">
									<a id="saveRating{{$obj->id}}" href="javascript:void(0)">Save Rating</a>
								</div>
								<script type="text/javascript">
									$(function () {
										var rate = 0;
										$rateYo = $("#rateYo" + {{$obj->id}}).rateYo({
											maxValue: 10,
											numStars: 10,
											starWidth: "20px",
											rating: {{$obj->rating}},
											onChange: function (rating, rateYoInstance) {
												$(this).next().text(rating);
												rate = rating;
											}
										});
										$("#rateYo"+ {{$obj->id}}).click(function () {
											alert("Rating " + rate);
										});
										$("#saveRating"+ {{$obj->id}}).click(function () {
											$.ajax({
												url: "{!! route('admins.customer.ratingTransaction') !!}",
												method: "GET",
												data: {
													'id' : {{$obj->id}},
													'rating' : rate
												},
												dataType : 'json',
												success : function(result){
													alert('Rating success!');
													return false;
												}
											});
										});
									});
								</script>
								@else
								<div id="rateYo{{$obj->id}}"></div>
								<script type="text/javascript">
									$(function () {
										$("#rateYo" + {{$obj->id}}).rateYo({
											maxValue: 10,
											numStars: 10,
											starWidth: "20px",
											rating: {{$obj->rating}},
											readOnly: true
										});
									});
								</script>
								@endif
								@else
								<div id="rateYo{{$obj->id}}"></div>
								<script type="text/javascript">
									$(function () {
										$("#rateYo" + {{$obj->id}}).rateYo({
											maxValue: 10,
											numStars: 10,
											starWidth: "20px",
											rating: {{$obj->rating}},
											readOnly: true
										});
									});
								</script>
								@endif
							</td>
							<td>{!! $obj->register->customer->name !!}</td>
							<td>{!! $obj->register->customer->email !!}</td>
							<td>{!! $obj->register->customer->phone !!}</td>
							<td class="actions">
								@if ($obj->isPermit)
								@if ($obj->status == 0) 
								<a href="{!! route('admins.transaction.editAllTransaction',['id' => $obj->id]) !!}" role="button" tabindex="0" class="edit text-primary text-uppercase text-strong text-sm mr-10">Edit</a>
								@endif
								<a role="button" tabindex="0" class="delete text-danger text-uppercase text-strong text-sm mr-10">Remove</a>
								@else
								No permit
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
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
		</form>
	</div>
	<!-- /tile footer -->

</section>
<!-- /tile -->
@endsection

@section('script')
<script src="{!! asset('admin_asset/js/jquery.rateyo.min.js') !!}"></script>
<!-- ===Modernizr=== -->
<script src="{!! asset('admin_asset/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js') !!}"></script>
@include('admin.transaction.script')
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

	$('#project').change(function () {
		projectId = $(this).val();
		if (block == -1) {
			$("#block").html('<option value="-1">--Choose--</option>');
			$("#land").html('<option value="-1">--Choose--</option>');
			$("#floor").html('<option value="-1">--Choose--</option>');
			return false;
		}
		$.ajax({
			url: "{{ route('admins.project.getBlockByProject') }}",
			method: "GET",
			data: {
				'projectId' : projectId,
			},
			dataType : 'json',
			success : function(result){
				html = '<option value="-1">--Choose--</option>';
				$.each (result, function (key, item){
					html += '<option value="' + item + '">' + item + '</option>';
				});
				$("#block").html(html);
			}
		});
	});

	$('#block').change(function () {
		block = $(this).val();
		if (block == -1) {
			$("#land").html('<option value="-1">--Choose--</option>');
			$("#floor").html('<option value="-1">--Choose--</option>');
			return false;
		}
		$.ajax({
			url: "{{ route('admins.project.getLandByBlock') }}",
			method: "GET",
			data: {
				'block' : block,
				'projectId' : $('#project').val(),
			},
			dataType : 'json',
			success : function(result){
				html = '<option value="-1">--Choose--</option>';
				$.each (result, function (key, item){
					html += '<option value="' + item + '">' + item + '</option>';
				});
				$("#land").html(html);
			}
		});
	});

	$('#land').change(function () {
		land = $(this).val();
		if (land == -1) {
			$("#floor").html('<option value="-1">--Choose--</option>');
			return false;
		}
		$.ajax({
			url: "{{ route('admins.project.getFloorByLand') }}",
			method: "GET",
			data: {
				'block' : $('#block').val(),
				'land' : land,
				'projectId' : $('#project').val(),
			},
			dataType : 'json',
			success : function(result){
				html = '<option value="-1">--Choose--</option>';
				$.each (result, function (key, item){
					html += '<option value="' + item + '">' + item + '</option>'
				});
				$('#floor').html(html);
			}
		});
	});

// });
</script>
@endsection