@extends('admin.inc.index')
@section('css')
@include('admin.project.css')
@endsection
@section('title')
<a href="{!! route('admins.project.list') !!}">Project</a> >
<a href="{!! route('admins.project.detail', ['id' => $project->id ]) !!}">{{ $project->name }}</a>
@endsection
@section('content')
<!-- tile -->
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>{!! $obj->name !!}</strong></h1>
		<ul class="controls">
			<li>
				<a href="{!! route('admins.project.edit', ['id' => $project->id]) !!}" role="button" tabindex="0"><i class="fa fa-plus mr-5"></i> Edit</a>
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
			<div class="form-group">
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"><strong>Products </strong></h1>
                    <ul class="controls">
                        <li>
							<a role="button" tabindex="0" id="add-entry"><i class="fa fa-plus mr-5"></i></a>
						</li>
                    </ul>
                </div>
                <!-- /tile header -->
                <!-- tile body -->
                <div class="tile-body" id = "products">
                	@foreach($products as $product)
                	 <div class="alert alert-big alert-lightred alert-dismissable fade in">
                        <button type="button" value="{!! $product->id !!}" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                	 <div class="row">
						    <div class="col-sm-2">
						    	<label for="">Block</label>
						    	<p>{!! $product->block !!}</p>
						    </div>
						    <div class="col-sm-2">
						    	<label for="">Floor</label>
						    	<p>{!! $product->floor !!}</p>
						    </div>
						    <div class="col-sm-2">
						    	<label for="">Price</label>
						    	<p>{!! $product->price !!}</p>
						    </div>
						    <div class="col-sm-2">
						    	<label for="">Area</label>
						    	<p>{!! $product->area !!}</p>
						    </div>
						  </div>
						  <div>
							  <label for="">Description</label>
							  <p>{!! $product->description !!}</p>
						  </div>
					</div>
                    @endforeach
                </div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">introduce</label>
				<div>
					{!! $project->introduce !!}
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">overview</label>
				<div>
					{!! $project->overview !!}
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">position</label>
				<div>
					{!! $project->position !!}
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">utilities</label>
				<div>
					{!! $project->utilities !!}
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">progress</label>
				<div>
					{!! $project->progress !!}
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">Price and Payment</label>
				<div>
					{!! $project->price_payment !!}
				</div>
			</div>
	</div>
	<!-- /tile body -->

</section>
<!-- /tile -->
@endsection

@section('script')
@include('admin.project.script')
@endsection