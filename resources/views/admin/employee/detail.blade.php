@extends('admin.inc.index')
@section('css')
@include('admin.employee.css')
@endsection
@section('title')
Detail Employee
@endsection
@section('content')
<!-- tile -->
<!-- tile -->
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>{!! $obj->name !!}</strong></h1>
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
			<li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>
		</ul>
	</div>
	<!-- /tile header -->

	<!-- tile body -->
	<div class="tile-body">

		<dl class="dl-horizontal">
			<dt>Name</dt>
			<dd>{!! $obj->name !!}</dd>
			<dt>Gender</dt>
			<dd>
				@if($obj->gender==0)
					Nam
				@else
					Nu
				@endif
			</dd>
			<dt>Address</dt>
			<dd>{!! $obj->address !!}</dd>
			<dt>Phone</dt>
			<dd>{!! $obj->phone !!}</dd>
			<dt>Department</dt>
			<dd>{!! $obj->district->name !!}</dd>
			<dt>Role</dt>
			<dd>
				{{ ($obj->user->role == 2) ? 'Leader' : 'Sale' }}
			</dd>
		</dl>
	</div>
	<!-- /tile body -->

</section>
<!-- /tile -->
<!-- /tile -->
@endsection

@section('script')

@endsection