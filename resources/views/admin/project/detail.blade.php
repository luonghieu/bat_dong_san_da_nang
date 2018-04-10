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
                <section class="tile">
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font"><strong>Inline </strong>Form</h1>
                        <ul class="controls">
                            <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>
                          	<li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>
                        </ul>
                    </div>
                    <!-- /tile header -->
                    <!-- tile body -->
                    <div class="tile-body">

                        <form class="form-inline" role="form">
                        	@foreach($products as $product)
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputEmail2">Block</label>
                                <input type="text" class="form-control" id="exampleInputEmail2" placeholder="Block" value="{!! $product->block !!}">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputEmail2">Floor</label>
                                <input type="text" class="form-control" id="exampleInputEmail2" placeholder="Floor" value="{!! $product->floor !!}">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputEmail2">Price</label>
                                <input type="text" class="form-control" id="exampleInputEmail2" placeholder="Price" value="{!! $product->price !!}">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputEmail2">Area</label>
                                <input type="text" class="form-control" id="exampleInputEmail2" placeholder="Area" value="{!! $product->area !!}">
                            </div>
                            @endforeach
                        </form>

                    </div>
                </section>
			</div>
			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">introduce</label>
				<div class="col-sm-10">
					<textarea id="introduce" name="introduce"></textarea>
 					@ckeditor('introduce', ['height' => 500])
					@if ($errors->has('introduce'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('introduce') !!}</strong>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">overview</label>
				<div class="col-sm-10">
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
				<label for="inputPassword3" class="col-sm-2 control-label">position</label>
				<div class="col-sm-10">
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
				<label for="inputPassword3" class="col-sm-2 control-label">utilities</label>
				<div class="col-sm-10">
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
				<label for="inputPassword3" class="col-sm-2 control-label">progress</label>
				<div class="col-sm-10">
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
				<label for="inputPassword3" class="col-sm-2 control-label">Price and Payment</label>
				<div class="col-sm-10">
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
			$('#form-add').submit();
		});
	});
</script>
@endsection