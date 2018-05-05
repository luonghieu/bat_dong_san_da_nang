
@extends('admin.inc.index')
@section('css')
@include('admin.project.css')
@endsection
@section('title')
Detail Project
@endsection
@section('content')
<!-- tile -->
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>{!! $obj->name !!}</strong></h1>
		<ul class="controls">
			<li>
				<a id="edit" role="button" tabindex="0"><i class="fa fa-plus mr-5"></i> Edit</a>
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
		<div>
			<div class="tile-header dvd dvd-btm">
				<h1 class="custom-font"><strong>Products </strong></h1>
				<ul class="controls">
					<li>
						<a href="javascript:void(0)" role="button" tabindex="0" id="add-product"><i class="fa fa-plus mr-5"></i></a>
						<!-- <a href="{!! route('admins.product.create', ['id' => $obj->id]) !!}" role="button" tabindex="0" id="add-product"><i class="fa fa-plus mr-5"></i></a> -->
					</li>
				</ul>
			</div>
			<!-- /tile header -->
			<!-- tile body -->
			<form role="form" id="form-product" method="post" action="{!! route('admins.product.update') !!}" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{csrf_token()}}" />
				<div class="tile-body" id = "products">
					@foreach($products as $product)
					<div class="alert alert-big alert-lightred alert-dismissable fade in">
						<button type="button" value="{!! $product->id !!}" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<div class="row">
							<input type="hidden" name="productId[]" value="{!! $product->id !!}">
							<div class="col-sm-2">
								<label for="">Block</label>
								<input type="number" class="form-control" name="block-{!! $product->id !!}" min="0" max="100" value="{!! $product->block !!}">
								@if ($errors->has('block'))
								<div class="alert alert-lightred alert-dismissable fade in">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<strong>{!! $errors->first('block') !!}</strong>
								</div>
								@endif
							</div>
							<div class="col-sm-2">
								<label for="">Floor</label>
								<input type="number" class="form-control" name="floor-{!! $product->id !!}" min="0" max="100" value="{!! $product->floor !!}">
								@if ($errors->has('floor'))
								<div class="alert alert-lightred alert-dismissable fade in">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<strong>{!! $errors->first('floor') !!}</strong>
								</div>
								@endif
							</div>
							<div class="col-sm-2">
								<label for="">Price</label>
								<input type="text" class="form-control" placeholder="Price" name="price-{!! $product->id !!}" value="{!! $product->price !!}">
								@if ($errors->has('price'))
								<div class="alert alert-lightred alert-dismissable fade in">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<strong>{!! $errors->first('price') !!}</strong>
								</div>
								@endif
							</div>
							<div class="col-sm-2">
								<label for="">Area</label>
								<input type="text" class="form-control" placeholder="Area" name="area-{!! $product->id !!}" value="{!! $product->area !!}">
								@if ($errors->has('area'))
								<div class="alert alert-lightred alert-dismissable fade in">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<strong>{!! $errors->first('area') !!}</strong>
								</div>
								@endif
							</div>
						</div>
						<div>
							<label for="">Description</label>
							<textarea class="form-control" name="description-{!! $product->id !!}">{!! $product->description !!}</textarea>
						</div>
					</div>
					@endforeach
				</div>
			</form>
		</div>
		<form role="form" id="form-project" method="post" action="{!! route('admins.project.update', ['id' => $detail->id]) !!}" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			<input type="hidden" name="projectId" value="{!! $obj->id !!}" />
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
			</div><br>
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
				<label for="inputPassword3">introduce</label>
				<div>
					<textarea class="form-control" id="introduce" name="introduce">{!! $detail->introduce !!}</textarea>
					<script>
						CKEDITOR.replace( 'introduce', {
							filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
							filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
							filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
							filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
							filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
							filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
						});
					</script>
					@if ($errors->has('introduce'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('introduce') !!}</strong>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">overview</label>
				<div>
					<textarea class="form-control" id="overview" name="overview">{!! $detail->overview !!}</textarea>
					<script>
						CKEDITOR.replace( 'overview', {
							filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
							filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
							filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
							filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
							filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
							filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
						});
					</script>
					@if ($errors->has('overview'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('overview') !!}</strong>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">position</label>
				<div>
					<textarea class="form-control" id="position" name="position">{!! $detail->position !!}</textarea>
					<script>
						CKEDITOR.replace( 'position', {
							filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
							filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
							filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
							filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
							filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
							filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
						});
					</script>
					@if ($errors->has('position'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('position') !!}</strong>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">utilities</label>
				<div>
					<textarea class="form-control" id="utilities" name="utilities">{!! $detail->utilities !!}</textarea>
					<script>
						CKEDITOR.replace( 'utilities', {
							filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
							filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
							filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
							filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
							filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
							filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
						});
					</script>
					@if ($errors->has('utilities'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('utilities') !!}</strong>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">progress</label>
				<div>
					<textarea class="form-control" id="progress" name="progress">{!! $detail->progress !!}</textarea>
					<script>
						CKEDITOR.replace( 'progress', {
							filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
							filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
							filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
							filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
							filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
							filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
						});
					</script>
					@if ($errors->has('progress'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('progress') !!}</strong>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">Price and Payment</label>
				<div>
					<textarea class="form-control" id="price_payment" name="price_payment">{!! $detail->price_payment !!}</textarea>
					<script>
						CKEDITOR.replace( 'price_payment', {
							filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
							filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
							filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
							filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
							filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
							filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
						});
					</script>
					@if ($errors->has('price_payment'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('price_payment') !!}</strong>
					</div>
					@endif
				</div>
			</div>
		</form>
	</div>
	<!-- /tile body -->

</section>
<!-- /tile -->
@endsection

@section('script')
@include('admin.project.script')
<script>
	$( document ).ready(function() {
		$('.close').click(function (){
			if (confirm('Are you sure?')) {
				id = $(this).val();
				$.ajax({
					url: "{!! route('admins.product.delete') !!}",
					method: "GET",
					data: {
						'id' : id,
						// 'status' : status
					},
					dataType : 'json',
					success : function(result){
						alert('Delete success!');
					}
				});
				return true;
			}

			return false;
		});

		$('#edit').click(function(){
			$.ajax({
				url: "{!! route('admins.product.update') !!}",
				method: "POST",
				data: $("#form-product").serialize(),
					dataType : 'json',
					success : function(result){
						$('#form-project').submit();
					}
				});
		});

		$('#add-product').click(function(){
			projectId = {{ $obj->id }};
			$.ajax({
				url: "{!! route('admins.product.store') !!}",
				method: "GET",
				data: {
					'projectId' : projectId,
				},
				dataType : 'html',
				success : function(result){
					$('#products').append(result);
				}
			});
		});
	});
</script>
@endsection