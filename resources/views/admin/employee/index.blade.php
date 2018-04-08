@extends('admin.inc.index')
@section('css')
@include('admin.employee.css')
@endsection
@section('title')
Employee
@endsection
@section('content')
<!-- tile -->
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>Sale</strong></h1>
		<ul class="controls">
			<li>
				<a role="button" tabindex="0" id="add-entry"><i class="fa fa-plus mr-5"></i> Add</a>
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
		<div class="table-responsive">
			<table class="table table-custom" id="editable-usage">
				<thead>
					<tr>
						<th>Id</th>
						<th>Name</th>
						<th>Gender</th>
						<th>Address</th>
						<th>Phone</th>
						<th style="width: 160px;" class="no-sort">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($list as $obj)
					<tr class="odd gradeX">
						<td>{!! $obj->id !!}</td>
						<td>
							<a href="{!! route('admins.employee.detail', ['employee_id' => $obj->id ]) !!}" role="button" tabindex="0" class="text-uppercase text-strong text-sm mr-10">{!! $obj->name !!}</a>
						</td>
						<td>
							@if($obj->gender==0)
							Nam
							@else
							Nu
							@endif
						</td>
						<td>{!! $obj->address !!}</td>
						<td>{!! $obj->phone !!}</td>
						<td class="actions"><a role="button" tabindex="0" class="edit text-primary text-uppercase text-strong text-sm mr-10">Edit</a><a role="button" tabindex="0" class="delete text-danger text-uppercase text-strong text-sm mr-10">Remove</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<!-- /tile body -->

</section>
<!-- /tile -->
@endsection
@section('script')
@include('admin.employee.script')
@endsection