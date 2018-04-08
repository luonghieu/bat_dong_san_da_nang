@extends('admin.inc.index')
@section('css')
@include('admin.customer.postCustomer.css')
@endsection
@section('title')
Detail Customer
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
			<dt>Address</dt>
			<dd>{!! $obj->address !!}</dd>
			<dt>email</dt>
			<dd>{!! $obj->user->email !!}</dd>
			<dt>Phone</dt>
			<dd>{!! $obj->phone !!}</dd>
			<dt>Number of post</dt>
			<dd>{!! $obj->productTransaction->count() !!}</dd>
			<dt>Product transaction</dt>
			<dd>
				<a href="{!! route('admins.postCustomer.detail', ['customer_id' => $obj->id ]) !!}" role="button" tabindex="0" class="text-uppercase text-strong text-sm mr-10">Detail</a>
			</dd>
			<dt>Number of purchase</dt>
			<dd>{!! $obj->purchaseTransaction->count() !!}</dd>
			<dt>Purchase transaction</dt>
			<dd>
				<a href="{!! route('admins.purchaseCustomer.detail', ['customer_id' => $obj->id ]) !!}" role="button" tabindex="0" class="text-uppercase text-strong text-sm mr-10">Detail</a>
			</dd>
			<dt>Active</dt>
			<dd>
				@if ($obj->active == 0)
					<span class="check-toggler toggle-class" data-toggle="checked"></span>
				@else
					<span class="check-toggler toggle-class checked" data-toggle="checked"></span>
				@endif
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