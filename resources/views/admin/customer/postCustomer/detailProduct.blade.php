@extends('admin.inc.index')
@section('css')
@include('admin.customer.postCustomer.css')
@endsection
@section('title')
Detail Product
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
			<dt>Describe</dt>
			<dd>{!! $obj->feature !!}</dd>
			<dt>Detail</dt>
			<dd>{!! $obj->detail !!}</dd>
			<dt>Direction</dt>
			<dd>{!! $obj->direction !!}</dd>
			<dt>Direction note</dt>
			<dd>{!! $obj->direction_note !!}</dd>
			<dt>Category</dt>
			<dd>{!! $obj->cat->name !!}</dd>
			<dt>Image</dt>
			<dd>
				<div class="img-container mb-10">
					<img src="{!! asset((empty($obj->image)) ? '/images/default.jpg' : $obj->image ) !!}" class="img-responsive" alt="Picture">
				</div>
			</dd>
			<dt>Status</dt>
			<dd>
				@if ($obj->status == 1) <p>Ready</p> @endif
				@if ($obj->status == 2) <p>Deposited</p> @endif
				@if ($obj->status == 3) <p>Signed</p> @endif
			</dd>
			<dt>Village</dt>
			<dd>
				@if ($obj->village_id) 
					$obj->village->name
				@else
					<p>Khong xac dinh</p>
				@endif
			</dd>
			<dt>Street</dt>
			<dd>
				@if ($obj->street_id) 
					$obj->street->name
				@else
					<p>Khong xac dinh</p>
				@endif
			</dd>
			<dt>District</dt>
			<dd>{!! $obj->district->name !!}</dd>
			<dt>Area</dt>
			<dd>{!! $obj->area !!}</dd>
			<dt>View</dt>
			<dd>{!! $obj->view !!}</dd>
			<dt>Price</dt>
			<dd>{!! $obj->price !!}</dd>
		</dl>
	</div>
	<!-- /tile body -->

</section>
<!-- /tile -->
<!-- /tile -->
@endsection

@section('script')

@endsection