@extends('admin.inc.index')
@section('css')
	@include('admin.assign.css')
@endsection
@section('title')
	Assign Task
@endsection
@section('content')
	<!-- tile -->
	<section class="tile">

		<!-- tile header -->
		<div class="tile-header dvd dvd-btm">
			<h1 class="custom-font"><strong>Assign Task</strong></h1>
			<ul class="controls">
				<li>
					<a role="button" tabindex="0" id="add-entry"><i class="fa fa-plus mr-5"></i> Edit</a>
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
		<div class="tile-body">
			@if (session('error'))
				<div class="alert alert-danger">
					<p>{{ session('error') }}</p>
				</div>
			@endif
			<form class="form-horizontal" role="form" id="form-add" method="post" action="{!! route('admins.assign.update') !!}">
				<input type="hidden" name="_token" value="{{csrf_token()}}" />
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Employee</label>
					<div class="col-sm-10">
						<select class="form-control mb-10" name="employee_id">
							@foreach($employees as $item)
								<option {{ ($employee->id == $item->id) ? 'selected="selected"' : '' }} value="{!! $item->id !!}">{!! $item->name !!}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Customer</label>
					<div class="col-sm-10">
						<select class="form-control mb-10" name="customer_id">
							<option value="{!! $customer->id !!}">{!! $customer->name !!}</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Description</label>
					<div class="col-sm-10">
						<textarea id="description" name="description">{!! $obj->description !!}</textarea>
						@ckeditor('detail', ['height' => 500])
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-rounded btn-primary btn-sm">Cancel</button>
					</div>
				</div>
			</form>
		</div>
		<!-- /tile body -->

	</section>
	<!-- /tile -->
@endsection

@section('script')
	@include('admin.assign.script')
@endsection