@extends('admin.inc.index')
@section('css')
@include('admin.project.css')
@endsection
@section('title')
Product
@endsection
@section('content')
<!-- tile -->
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>Add Product</strong></h1>
		<ul class="controls">
			<li>
				<a role="button" tabindex="0"><i class="fa fa-plus mr-5"></i> Add</a>
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
		<form role="form" id="form-add" method="post" action="{!! route('admins.product.store', ['id' => $projectId]) !!}" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			<div class="form-group">
				<label for="inputPassword3">Block</label>
				<div>
					<input type="text" class="form-control" placeholder="Block" name="block" value="">
					@if ($errors->has('block'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('block') !!}</strong>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">Floor</label>
				<div>
					<input type="text" class="form-control" placeholder="Floor" name="floor" value="">
					@if ($errors->has('floor'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('floor') !!}</strong>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">Area</label>
				<div>
					<input type="text" class="form-control" placeholder="Area" name="area" value="">
					@if ($errors->has('area'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('area') !!}</strong>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">Price</label>
				<div>
					<input type="text" class="form-control" placeholder="Price" name="price" value="">
					@if ($errors->has('price'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('price') !!}</strong>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">Description</label>
				<div>
					<textarea id="editor1" name="description"></textarea>
				</div>
			</div>
		</form>
	</div>
	<!-- /tile body -->

</section>
<!-- /tile -->
@endsection

@section('script')
@include('admin.product.script')
<script>
	$( document ).ready(function() {
		$('#add-entry').click(function (e) {
			$('#form-add').submit();
		});
	});
</script>
@endsection