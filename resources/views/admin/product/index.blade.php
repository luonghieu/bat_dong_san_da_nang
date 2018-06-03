@extends('admin.inc.index')
@section('css')
@include('admin.product.css')
@endsection
@section('title')
<a href="{!! route('admins.project.detail', ['id' => $project->id ]) !!}">{{ $project->name }}</a> >
<a href="{{ route('admins.product.list', ['projectId' => $project->id]) }}">Products</a>
@endsection
@section('content')
<!-- tile -->
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>Products</strong></h1>
		<ul class="controls">
			@if(!isEmployee())
			<li>
				<a href="{!! route('admins.product.create', ['projectId' => $project->id]) !!}" role="button" tabindex="0" id="add-entry"><i class="fa fa-plus mr-5"></i> Add</a>
			</li>
			@endif
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
	<div class="panel-body handling">
		<div class="search filter-search">
			<form class="navbar-form navbar-left form-search" action="{{ route('admins.product.searchProduct') }}" method="GET">
				<input type="hidden" name="_token" value="{{csrf_token()}}" />
				<input type="hidden" name="projectId" value="{{$project->id}}" />
				<div class="row">
					<label>Category</label>
					<select class="form-control" name="cat_id" id="cat_id">
						<option value="-1">--Choose--</option>
						@foreach($cats as $id => $name)
						<option {{ (isset($search)&&$search['cat_id']==$id) ? 'selected="selected"' : '' }} value="{!! $id !!}">{!! $name !!}</option>
						@endforeach
					</select>
					<label for="">Price: </label>
					<select class="form-control" name="price" id="price">
						<option value="-1">--Choose--</option>
						@foreach($prices as $id => $name)
						<option {{ (isset($search)&&$search['price']==$id) ? 'selected="selected"' : '' }} value="{!! $id !!}">{!! $name !!}</option>
						@endforeach
					</select>
					<label for="">Area: </label>
					<select class="form-control" name="area" id="area">
						<option value="-1">--Choose--</option>
						@foreach($areas as $id => $name)
						<option {{ (isset($search)&&$search['area']==$id) ? 'selected="selected"' : '' }} value="{!! $id !!}">{!! $name !!}</option>
						@endforeach
					</select>
				</div> <br/>
				<div>
					<label for="">Direction: </label>
					<select class="form-control" name="direction" id="direction">
						<option value="-1">--Choose--</option>
						@foreach($directions as $id => $name)
						<option {{ (isset($search)&&$search['direction']==$id) ? 'selected="selected"' : '' }} value="{!! $id !!}">{!! $name !!}</option>
						@endforeach
					</select>
					<label for="">Status: </label>
					<select class="form-control" name="status">
						<option value="-1">--Choose--</option>
						@foreach($statuses as $key => $value)
						<option  {{ (isset($search)&&$search['status']==$key) ? 'selected="selected"' : '' }}  value="{{ $key }}">{{ $value }}</option>
						@endforeach
					</select>
					<button style="margin-left: 15px" class="form-control" type="submit" class="pull-right">Search</button>
					<a href="{!! route('admins.product.list', ['projectId' => $project->id]) !!}" role="button" tabindex="0" style="margin-left: 15px; text-decoration: none" class="form-control" class="pull-right">Show all</a>
				</div>
			</form>
		</div>
	</div>
	<form class="form-horizontal" role="form" method="post" action="{!! route('admins.product.action') !!}">
		<input type="hidden" name="_token" value="{{csrf_token()}}" />
		<input type="hidden" name="projectId" value="{{ $project->id}}" />
		<div class="tile-body">
			<div class="table-responsive">
				@if (session('success'))
				<div class="alert alert-success">
					<p><strong>{{ session('success') }}</strong></p>
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
							<th>Land</th>
							<th>Floor</th>
							<th>Apartment</th>
							<th>Category</th>
							<th>Price</th>
							<th>Unit price</th>
							<th>Area (m2)</th>
							<th>Direction</th>
							<th>View</th>
							<th>Description</th>
							<th>Status</th>
							<th>Transaction</th>
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
							<td>{!! $obj->block !!}</td>
							<td>{!! $obj->land !!}</td>
							<td>{!! $obj->floor !!}</td>
							<td>
								{!! $obj->apartment !!}
								@if ($obj->apartment > 0)
								<a href="{!! route('admins.apartment.list', ['productId' => $obj->id ]) !!}" role="button" tabindex="0" class="text-uppercase text-strong text-sm mr-10">Detail</a>
								@endif
							</td>
							<td>{!! $obj->cat->name !!}</td>
							<td>{!! $obj->price !!}</td>
							<td>{!! $obj->unitPrice->name !!}</td>
							<td>{!! $obj->area !!}</td>
							<td>{!! $obj->direction !!}</td>
							<td>{!! $obj->view !!}</td>
							<td>{!! $obj->description !!}</td>
							<td>{!! $obj->status !!}</td>
							<td>
								<a href="{!! route('admins.product.status', ['id' => $obj->id ]) !!}" role="button" tabindex="0" class="text-uppercase text-strong text-sm mr-10">Detail</a>
							</td>
							<td class="actions">
								@if(isEmployee())
								No permission
								@else
								<a href="{!! route('admins.product.edit',['id' => $obj->id]) !!}"  tabindex="0" class="text-primary text-uppercase text-strong text-sm mr-10">Edit</a>
								<a role="button" tabindex="0" class="delete text-danger text-uppercase text-strong text-sm mr-10">Remove</a>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<!-- /tile body -->
		<!-- tile footer -->
		@if(!isEmployee())
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
		@endif
		<!-- /tile footer -->
	</form>
</section>
<!-- /tile -->
@endsection

@section('script')
@include('admin.product.script')
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