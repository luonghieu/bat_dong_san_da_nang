@extends('admin.inc.index')
@section('css')
@include('admin.project.css')
@endsection
@section('title')
<a href="{!! route('admins.project.list') !!}">Project</a> >{{ $obj->name }}
@endsection
@section('content')
<!-- tile -->
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>{!! $obj->name !!}</strong></h1>&nbsp;&nbsp;&nbsp;
		<h2><a href="{!! route('admins.product.list',['projectId' => $obj->id]) !!}" role="button" tabindex="0" class="text-uppercase text-strong text-sm mr-10">List products</a></h2>

		<ul class="controls">
			@if (!isEmployee())
			<li>
				<a id="edit" role="button" tabindex="0"><i class="fa fa-plus mr-5"></i> Edit</a>
			</li>
			@endif
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
		<form role="form" id="form-project" method="post" action="{!! route('admins.project.update', ['id' => $detail->id]) !!}" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			<input type="hidden" name="projectId" value="{!! $obj->id !!}" />
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label"><strong>Name</strong></label>
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
				<label class="col-sm-2 control-label"><strong>Image</strong></label>
				<div class="col-sm-10">
					<div class="img-container mb-10">
						<img src="{!! asset((empty($obj->image)) ? '/images/default.jpg' : $obj->image ) !!}" class="img-responsive" alt="Picture">
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
				<label class="col-sm-2 control-label"><strong>Library images</strong></label>
				<div class="col-sm-10">
					<div class="img-container mb-10">
						@foreach(explode("|", $obj->library_images) as $item)
						<img src="{!! asset((empty($item)) ? '/images/default.jpg' : $item ) !!}" width="100px" height="100px">
						@endforeach
					</div>
					<input type="file" name="images[]" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox" multiple>
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3"><strong>Introduce</strong></label>
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
				<label for="inputPassword3"><strong>Overview</strong></label>
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
				<label for="inputPassword3"><strong>Position</strong></label>
				<div class="row">
					<div class="col-sm-4">
						<label>District</label>
						<select name="district_id" id="district_id">
							<option value="-1">--Choose--</option>
							@foreach($districts as $id => $name)
							<option {{ ($obj->district_id==$id) ? 'selected="selected"' : '' }} value="{!! $id !!}">{!! $name !!}</option>
							@endforeach
						</select>
					</div>
					<div class="col-sm-4">
						<label for="">Village: </label>
						<select name="village_id" id="village_id">
							<option value="-1">--Choose--</option>
							@foreach($villages as $id => $name)
							<option {{ ($obj->village_id==$id) ? 'selected="selected"' : '' }} value="{!! $id !!}">{!! $name !!}</option>
							@endforeach
						</select>
					</div>
					<div class="col-sm-4">
						<label for="">Street: </label>
						<select name="street_id" id="street_id">
							<option value="-1">--Choose--</option>
							@foreach($streets as $id => $name)
							<option {{ ($obj->street_id==$id) ? 'selected="selected"' : '' }} value="{!! $id !!}">{!! $name !!}</option>
							@endforeach
						</select>
					</div>
				</div>
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
				<label for="inputPassword3"><strong>Utilities</strong></label>
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
				<label for="inputPassword3"><strong>Progress</strong></label>
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
				<label for="inputPassword3"><strong>Price and Payment</strong></label>
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
		$("input[type='images[]']").blur(function(){
			var $fileUpload = $("input[type='images[]']");
			if (parseInt($fileUpload.get(0).files.length) > 3){
				alert("You are only allowed to upload a maximum of 3 files");
			}
			return false;
		});

		$('#edit').click(function(){
			$('#form-project').submit();
		});

		$('#district_id').change(function () {
			district_id = $(this).val();
			if (district_id == -1) {
				$("#village_id").html('<option value="-1">--Choose--</option>');
				$("#street_id").html('<option value="-1">--Choose--</option>');
				return false;
			}
			$.ajax({
				url: "{{ route('admins.project.getVillageByDistrict') }}",
				method: "GET",
				data: {
					'district_id' : district_id,
				},
				dataType : 'json',
				success : function(result){
					html = '<option value="-1">--Choose--</option>';
					$.each (result, function (key, item){
						html += '<option value="' + key + '">' + item + '</option>';
					});
					$("#village_id").html(html);
				}
			});
		});

		$('#village_id').change(function () {
			village_id = $(this).val();
			if (village_id == -1) {
				$("#street_id").html('<option value="-1">--Choose--</option>');
				return false;
			}
			$.ajax({
				url: "{{ route('admins.project.getStreetByVillage') }}",
				method: "GET",
				data: {
					'village_id' : village_id,
				},
				dataType : 'json',
				success : function(result){
					html = '<option value="-1">--Choose--</option>';
					$.each (result, function (key, item){
						html += '<option value="' + key + '">' + item + '</option>'
					});
					$('#street_id').html(html);
				}
			});
		});

	});
</script>
@endsection