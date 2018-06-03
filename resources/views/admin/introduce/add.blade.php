@extends('admin.inc.index')
@section('css')
@include('admin.news.css')
@endsection
@section('title')
<a href="{!! route('admins.introduce.list') !!}">Introduce</a>
@endsection
@section('content')
<!-- tile -->
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>Introduce</strong></h1>
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
		@if (session('error'))
		<div class="alert alert-danger">
			<p>{{ session('error') }}</p>
		</div>
		@endif
		<form class="form-horizontal" role="form" id="form-add" method="post" action="{!! route('admins.news.store') !!}" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="inputEmail3" name="name" placeholder="Title">
					@if ($errors->has('name'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('name') !!}</strong>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Description</label>
				<div class="col-sm-10">
					<textarea id="description" name="description"></textarea>
					@ckeditor('description')
					@if ($errors->has('description'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('description') !!}</strong>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="reset" class="btn btn-rounded btn-primary btn-sm">Cancel</button>
				</div>
			</div>
		</form>
	</div>
	<!-- /tile body -->

</section>
<!-- /tile -->
@endsection

@section('script')
@include('admin.introduce.script')
<script>
	$( document ).ready(function() {
		$('#add-entry').click(function (e) {
			$('#form-add').submit();
		});
	});
</script>
@endsection