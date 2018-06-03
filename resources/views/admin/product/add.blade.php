@extends('admin.inc.index')
@section('css')
@include('admin.product.css')
@endsection
@section('title')
<a href="{!! route('admins.project.detail', ['id' => $project->id ]) !!}">{{ $project->name }}</a> >
<a href="{{ route('admins.product.list', ['projectId' => $project->id]) }}">Products</a> > Add Product
@endsection
@section('content')
<!-- tile -->
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>Add Product</strong></h1>
		<ul class="controls">
			<li>
				<a id="add-entry" role="button" tabindex="0"><i class="fa fa-plus mr-5"></i> Add</a>
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
		<form role="form" id="form-add" method="post" action="{!! route('admins.product.store', ['id' => $project->id]) !!}" enctype="multipart/form-data">
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
				<label for="inputPassword3">Land</label>
				<div>
					<input type="text" class="form-control" placeholder="Land" name="land" value="">
					@if ($errors->has('land'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('land') !!}</strong>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">Floor</label>
				<div>
					<input type="number" min="0" max="100" class="form-control" name="floor" value="">
					@if ($errors->has('floor'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('floor') !!}</strong>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">Apartment</label>
				<div>
					<input type="number" min="0" max="100" class="form-control" name="apartment" value="">
					@if ($errors->has('apartment'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('apartment') !!}</strong>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">Category</label>
				<div>
					<select class="form-control" name="cat_id">
						@foreach($categories as $key => $item)
						<option value="{{$key}}">{{ $item }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">Area(m2)</label>
				<div>
					<input type="number" min="0" max="10000" class="form-control" name="area" value="">
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
					<input type="number" min="0" max="999" class="form-control" name="price" value="">
					@if ($errors->has('price'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('price') !!}</strong>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">Unit Price</label>
				<div>
					<select class="form-control" name="unit_price_id">
						@foreach($unitPrice as $key => $item)
						<option value="{{$key}}">{{ $item }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">Direction</label>
				<div>
					<select name="direction" class="form-control">
						@foreach($direction as $key => $item)
						<option value="{{$key}}">{{ $item }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<label>Images</label>
				<div>
					<input type="file" name="images[]" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox" multiple>
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">Description</label>
				<textarea id="editor1" name="description"></textarea>
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
				@if ($errors->has('description'))
				<div class="alert alert-lightred alert-dismissable fade in">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<strong>{!! $errors->first('description') !!}</strong>
				</div>
				@endif
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
@include('admin.product.script')
<script>
	$( document ).ready(function() {
		$('#add-entry').click(function (e) {
			$('#form-add').submit();
		});
	});
</script>
@endsection