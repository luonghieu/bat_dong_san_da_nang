@extends('admin.inc.index')
@section('css')
@include('admin.apartment.css')
@endsection
@section('title')
<a href="{{ route('admins.product.list', ['projectId' => $obj->product->project->id]) }}">Products</a> > 
<a href="{{ route('admins.apartment.list', ['productId' => $obj->product_id]) }}">>Apartment</a> > 
>Edit Apartment
@endsection
@section('content')
<!-- tile -->
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>Edit Apartment</strong></h1>
		<ul class="controls">
			<li>
				<a id="add-entry" role="button" tabindex="0"><i class="fa fa-plus mr-5"></i> Edit</a>
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
		<form role="form" id="form-add" method="post" action="{!! route('admins.apartment.update') !!}" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			<input type="hidden" name="apartmentId" value="{{$obj->id}}" />
			<div class="form-group">
				<label for="inputPassword3">Floor</label>
				<div>
					<select name="floor" class="form-control">
						@foreach($floors as $floor)
						<option {{ ($obj->floor == $floor) ? 'selected="selected"' : '' }} value="{{$floor}}">{{ $floor }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">Position</label>
				<div>
					<input type="text" class="form-control" placeholder="Position" name="position" value="{{ $obj->position }}">
					@if ($errors->has('position'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('position') !!}</strong>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">Area(m2)</label>
				<div>
					<input type="number" min="0" max="10000" class="form-control" name="area" value="{{ $obj->area }}">
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
					<input type="number" min="0" max="999" class="form-control" name="price" value="{{ $obj->price }}">
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
						<option value="{{$key}}" {{($obj->unit_price_id == $key) ? 'selected="selected"' : ''}}>{{ $item }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">Direction</label>
				<div>
					<select name="direction" class="form-control">
						@foreach($direction as $key => $item)
						<option {{($obj->direction == $key) ? 'selected="selected"' : ''}} value="{{$key}}">{{ $item }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">Description</label>
				<textarea id="editor1" name="description">{{ $obj->description }}</textarea>
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
@include('admin.apartment.script')
<script>
	$( document ).ready(function() {
		$('#add-entry').click(function (e) {
			$('#form-add').submit();
		});
	});
</script>
@endsection