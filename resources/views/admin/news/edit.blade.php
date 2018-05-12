@extends('admin.inc.index')
@section('css')
@include('admin.news.css')
@endsection
@section('title')
News
@endsection
@section('content')
<!-- tile -->
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>News</strong></h1>
		<ul class="controls">
			<li>
				<a role="button" tabindex="0" id="edit-entry"><i class="fa fa-plus mr-5"></i> Edit</a>
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
		<form class="form-horizontal" role="form" id="form-edit" method="post" action="{!! route('admins.news.update', ['id' => $obj->id]) !!}" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="inputEmail3" name="name" placeholder="Title" value="{!! $obj->name !!}">
					@if ($errors->has('name'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('name') !!}</strong>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Describe</label>
				<div class="col-sm-10">
					<input type="text" name="feature" class="form-control" id="inputPassword3" placeholder="Describe" value="{!! $obj->feature !!}">
					@if ($errors->has('feature'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('feature') !!}</strong>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Link</label>
				<div class="col-sm-10">
					<input type="text" name="link" class="form-control" id="inputPassword3" placeholder="Link" value="{!! $obj->link !!}">
					@if ($errors->has('link'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('link') !!}</strong>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Category</label>
				<div class="col-sm-10">
					<select class="form-control mb-10" name="cat_new_id">
						@foreach($listCat as $item)
						@if ($obj->cat_new_id == $item->id)
						<option value="{!! $item->id !!}" selected="selected">{!! $item->name !!}</option>
						@else 
						<option value="{!! $item->id !!}">{!! $item->name !!}</option>
						@endif
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Image</label>
				<div class="col-sm-10">
					<div class="img-container mb-10">
						<img src="{!! asset((empty($obj->image)) ? '/images/default.jpg' : $obj->image ) !!}" class="img-responsive" alt="Picture"">
					</div>
					<input type="file" name="image" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox">
					@if ($errors->has('image'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('image') !!}</strong>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Detail</label>
				<div class="col-sm-10">
					<textarea id="editor1" name="detail">{!! $obj->detail !!}
					</textarea>
					<script>
						CKEDITOR.replace( 'editor1', {
							filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
							filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
							filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
							filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
							filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
							filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
						});
					</script>
					@if ($errors->has('detail'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('detail') !!}</strong>
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
@include('admin.news.script')
<script>
	$( document ).ready(function() {
		$('#edit-entry').click(function (e) {
			$('#form-edit').submit();
		});
	});
</script>
@endsection