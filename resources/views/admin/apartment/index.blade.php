@extends('admin.inc.index')
@section('css')
@include('admin.apartment.css')
@endsection
@section('title')
<a href="{{ route('admins.product.list', ['projectId' => $product->project->id]) }}">Products</a>
<a href="{{ route('admins.apartment.list', ['productId' => $product->id]) }}">Apartments</a>
@endsection
@section('content')
<!-- tile -->
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>Apartment</strong></h1>
		<ul class="controls">
			@if(!isEmployee())
			@if (count($list) < $product->apartment)
			<li>
				<a href="{!! route('admins.apartment.create', ['productId' => $product->id]) !!}" role="button" tabindex="0" id="add-entry"><i class="fa fa-plus mr-5"></i> Add</a>
			</li>
			@endif
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
			<form class="navbar-form navbar-left form-search" action="{{ route('admins.apartment.searchApartment') }}" method="GET">
				<input type="hidden" name="_token" value="{{csrf_token()}}" />
				<input type="hidden" name="productId" value="{{$product->id}}" />
				<div>
					<label for="">Floor: </label>
					<select class="form-control" name="floor" id="floor">
						<option value="-1">--Choose--</option>
						@foreach($floors as $value)
						<option {{ (isset($search)&&$search['floor']==$value) ? 'selected="selected"' : '' }} value="{!! $value !!}">{!! $value !!}</option>
						@endforeach
					</select>
					<label for="">Position: </label>
					<select class="form-control" name="position" id="position">
						<option value="-1">--Choose--</option>
						@foreach($positions as $name)
						<option {{ (isset($search)&&$search['position']==$name) ? 'selected="selected"' : '' }} value="{!! $name !!}">{!! $name !!}</option>
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
					<label for="">Direction: </label>
					<select class="form-control" name="direction" id="direction">
						<option value="-1">--Choose--</option>
						@foreach($directions as $id => $name)
						<option {{ (isset($search)&&$search['direction']==$id) ? 'selected="selected"' : '' }} value="{!! $id !!}">{!! $name !!}</option>
						@endforeach
					</select>
				</div>
				<div>
					<center>
						<button style="margin-top: 15px" class="form-control" type="submit" class="pull-right">Search</button>
						<a href="{!! route('admins.apartment.list', ['productId' => $product->id]) !!}" role="button" tabindex="0" style="margin-top: 15px; text-decoration: none" class="form-control" class="pull-right">Show all</a>
					</center>
				</div>
			</form>
		</div>
	</div>
	<form class="form-horizontal" role="form" method="post" action="{!! route('admins.apartment.action') !!}">
		<input type="hidden" name="_token" value="{{csrf_token()}}" />
		<input type="hidden" name="productId" value="{{ $product->id}}" />
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
							<th>Floor</th>
							<th>Position</th>
							<th>Price</th>
							<th>Unit price</th>
							<th>Area (m2)</th>
							<th>Direction</th>
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
							<td>{!! $obj->floor !!}</td>
							<td>{!! $obj->position !!}</td>
							<td>{!! $obj->price !!}</td>
							<td>{!! $obj->unitPrice->name !!}</td>
							<td>{!! $obj->area !!}</td>
							<td>{!! $obj->direction !!}</td>
							<td>{!! $obj->description !!}</td>
							<td>{!! $obj->status !!}</td>
							<td>
								<a href="{!! route('admins.apartment.status', ['id' => $obj->id ]) !!}" role="button" tabindex="0" class="text-uppercase text-strong text-sm mr-10">Detail</a>
							</td>
							<td class="actions">
								@if(isEmployee())
								No permission
								@else
								<a href="{!! route('admins.apartment.edit',['id' => $obj->id]) !!}"  tabindex="0" class="text-primary text-uppercase text-strong text-sm mr-10">Edit</a>
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
@include('admin.apartment.script')
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
        // });
    </script>
    @endsection