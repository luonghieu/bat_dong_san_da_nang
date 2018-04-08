@extends('admin.inc.index')
@section('css')
	@include('admin.product.sale.css')
@endsection
@section('title')
	Sale Product
@endsection
@section('content')
	<!-- tile -->
	<section class="tile">

		<!-- tile header -->
		<div class="tile-header dvd dvd-btm">
			<h1 class="custom-font"><strong>Sale Product</strong></h1>
			<ul class="controls">
				<li>
					<a role="button" tabindex="0" id="add-entry"><i class="fa fa-plus mr-5"></i> Edit</a>
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
			<form class="form-horizontal" role="form" id="form-add" method="post" action="{!! route('admins.product.sale.update', ['id' => $obj->id]) !!}" enctype="multipart/form-data">
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
								<option {{($obj->cat_id == $item->id)? 'selected="selected"' : ''}} value="{!! $item->id !!}">{!! $item->name !!}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">District</label>
					<div class="col-sm-10">
						<select class="form-control mb-10" name="district_id" id="district">
							<option value="0">===Selected===</option>
							@foreach($districts as $item)
								<option {{($obj->district_id == $item->id)? 'selected="selected"' : ''}} value="{!! $item->id !!}">{!! $item->name !!}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Village</label>
					<div class="col-sm-10">
						<select class="form-control mb-10" name="village_id" id="village" disabled>
							<option {{($obj->village_id == 0)? 'selected="selected"' : ''}} value="0">Khong xac dinh</option>
							@foreach($villages as $item)
								<option {{($obj->village_id == $item->id)? 'selected="selected"' : ''}} value="{!! $item->id !!}">{!! $item->name !!}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Street</label>
					<div class="col-sm-10">
						<select class="form-control mb-10" name="street_id" id="street" disabled>
							<option {{($obj->street_id == 0)? 'selected="selected"' : ''}} value="0">Khong xac dinh</option>
							@foreach($streets as $obj)
								<option {{($obj->street_id == $item->id)? 'selected="selected"' : ''}} value="{!! $obj->id !!}">{!! $obj->name !!}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Direction</label>
					<div class="col-sm-10">
						<select class="form-control mb-10" name="direction">
							@foreach($direction as $key => $value)
								<option {{($obj->direction == $key)? 'selected="selected"' : ''}} value="{!! $key !!}">{!! $value !!}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Direction note</label>
					<div class="col-sm-10">
						<textarea id="directionNote" name="direction_note">{!! $obj->direction_note !!}</textarea>
						@ckeditor('directionNote')
						@if ($errors->has('direction_note'))
							<div class="alert alert-lightred alert-dismissable fade in">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<strong>{!! $errors->first('direction_note') !!}</strong>
							</div>
						@endif
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Image</label>
					<div class="col-sm-10">
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
					<label class="col-sm-2 control-label">Area</label>
					<div class="col-sm-10">
						<label class="checkbox checkbox-custom-alt">
							<input type="checkbox" value="0" id="checkArea" name="checkArea" {{ ($obj->area == 0) ? 'checked' : '' }}><i></i> Khong xac dinh
						</label>
						<input type="text" name="area" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox" {{ ($obj->area == 0) ? 'disabled' : '' }} value="{!! $obj->area !!}">
						@if ($errors->has('area'))
							<div class="alert alert-lightred alert-dismissable fade in">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<strong>{!! $errors->first('area') !!}</strong>
							</div>
						@endif
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Price</label>
					<div class="col-sm-10">
						<label class="checkbox checkbox-custom-alt">
							<input type="checkbox" value="0" id="checkPrice" name="checkPrice" {{ ($obj->price == 0) ? 'checked' : '' }}><i></i> Gia thoa thuan sau
						</label>
						<input type="text" name="price" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox" {{ ($obj->price == 0) ? 'disabled' : '' }} value="{!! $obj->price !!}">
						@if ($errors->has('price'))
							<div class="alert alert-lightred alert-dismissable fade in">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<strong>{!! $errors->first('price') !!}</strong>
							</div>
						@endif
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Detail</label>
					<div class="col-sm-10">
						<textarea id="detail" name="detail">{!! $obj->detail !!}</textarea>
						@ckeditor('detail', ['height' => 500])
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
						<button type="submit" class="btn btn-rounded btn-primary btn-sm">Cancel</button>
					</div>
				</div>
			</form>
		</div>
		<!-- /tile body -->

	</section>
	<!-- /tile -->
@endsection

@section('script')
	@include('admin.product.sale.script')
	<script>
        $( document ).ready(function() {
            $('#add-entry').click(function (e) {
                $('#form-add').submit();
            });

            $('#district').change(function (e) {
                $("#village").removeAttr("disabled");
                $("#street").removeAttr("disabled");
                id = $('#district').val();

                $.ajax({
                    url: "{!! route('common.getItemByDistrict') !!}",
                    method: "GET",
                    data: {
                        'id' : id
                    },
                    dataType : 'json',
                    success : function(result){
                        villages = result['villages'];
                        streets = result['streets'];

                        htmlVillage = '<option value="0">Khong xac dinh</option>';
                        $.each (villages, function (key, item){
                            htmlVillage += '<option value="' + item.id + '">' + item.name + '</option>';
                        });

                        htmlStreet = '<option value="0">Khong xac dinh</option>';
                        $.each (streets, function (key, item){
                            htmlStreet += '<option value="' + item.id + '">' + item.name + '</option>';
                        });
                        $("#village").html(htmlVillage);
                        $("#street").html(htmlStreet);
                    }
                });
            });
        });

        $('#checkArea').change(function (e) {
            if ($(this).is(":checked")) {
                $('input[name="area"]').attr('disabled', true);
            } else {
                $('input[name="area"]').removeAttr("disabled");
            }
        });

        $('#checkPrice').change(function (e) {
            if ($(this).is(":checked")) {
                $('input[name="price"]').attr('disabled', true);
            } else {
                $('input[name="price"]').removeAttr("disabled");
            }
        });

        //
	</script>
@endsection