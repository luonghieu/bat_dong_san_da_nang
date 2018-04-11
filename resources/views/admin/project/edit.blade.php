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
				<a role="button" tabindex="0"><i class="fa fa-plus mr-5"></i> Edit</a>
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
		<form role="form" id="form-add" method="post" action="{!! route('admins.news.store') !!}" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{csrf_token()}}" />
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
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                	 <div class="row">
						    <div class="col-sm-2">
						    	<label for="">Block</label>
	                        	<input type="text" class="form-control" placeholder="Block" value="{!! $product->block !!}">
						    </div>
						    <div class="col-sm-2">
						    	<label for="">Floor</label>
	                        	<input type="text" class="form-control" placeholder="Floor" value="{!! $product->floor !!}">
						    </div>
						    <div class="col-sm-2">
						    	<label for="">Price</label>
	                        	<input type="text" class="form-control" placeholder="Price" value="{!! $product->price !!}">
						    </div>
						    <div class="col-sm-2">
						    	<label for="">Area</label>
	                        	<input type="text" class="form-control" placeholder="Area" value="{!! $product->area !!}">
						    </div>
						  </div>
					</div>
                    @endforeach
                </div>
			</div>
			<div class="form-group">
				<label for="inputPassword3">introduce</label>
				<div>
					<!-- <textarea id="introduce" name="introduce"></textarea>
 					@ckeditor('introduce', ['height' => 500])
 -->					
<textarea name="txtContent" class="form-control " id="editor1"></textarea>
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
					<textarea id="overview" name="overview"></textarea>
 					@ckeditor('overview', ['height' => 500])
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
					<textarea id="position" name="position"></textarea>
 					@ckeditor('position', ['height' => 500])
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
					<textarea id="utilities" name="utilities"></textarea>
 					@ckeditor('utilities', ['height' => 500])
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
					<textarea id="progress" name="progress"></textarea>
 					@ckeditor('progress', ['height' => 500])
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
					<textarea id="price_payment" name="price_payment"></textarea>
 					@ckeditor('price_payment', ['height' => 500])
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
@include('admin.news.script')
<script>
	$( document ).ready(function() {
		$('#add-entry').click(function (e) {
			html = '<div class="alert alert-big alert-lightred alert-dismissable fade in">' + 
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' + 
	                	 '<div class="row">' +
						    '<div class="col-sm-2">' +
						    	'<label for="">Block</label>' + 
	                        	'<input type="text" class="form-control" placeholder="Block" value="">' + 
						    '</div>' + 
						    '<div class="col-sm-2">' + 
						    	'<label for="">Floor</label>' + 
	                        	'<input type="text" class="form-control" placeholder="Floor" value="">' + 
						    '</div>' +
						    '<div class="col-sm-2">' +
						    	'<label for="">Price</label>' + 
	                        	'<input type="text" class="form-control" placeholder="Price" value="">' + 
						    '</div>' + 
						    '<div class="col-sm-2">' +
						    	'<label for="">Area</label>' + 
	                        	'<input type="text" class="form-control" placeholder="Area" value="">' +
						    '</div>' + 
						  '</div>' +
					'</div>';
			$('#products').append(html);
		});
	});
</script>
@endsection