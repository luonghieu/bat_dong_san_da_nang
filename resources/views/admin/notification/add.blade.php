@extends('admin.inc.index')
@section('css')
@include('admin.news.css')
@endsection
@section('title')
Notification
@endsection
@section('content')
<!-- tile -->
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>Notification</strong></h1>
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
		<form class="form-horizontal" role="form" id="form-add" method="post" action="{!! route('admins.notification.store') !!}" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			<div class="form-group">
				<label class="col-sm-2 control-label">Type</label>
				<div class="col-sm-1 col-sm-offset-2">
					<input type="radio" name="type" value="1" > User
				</div>
				<div class="col-sm-1">
					<input type="radio" name="type" value="2" > Staff
				</div>
				@if ($errors->has('type'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('type') !!}</strong>
					</div>
				@endif
				<div id="customer"></div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Title</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="inputEmail3" name="title" placeholder="Title">
					@if ($errors->has('title'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('title') !!}</strong>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Content</label>
				<div class="col-sm-10">
					<textarea id="summernote" name="content">
					</textarea>
					@if ($errors->has('detail'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('content') !!}</strong>
					</div>
					@endif
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 col-sm-offset-2 control-label">Send time:</label>
			</div>
			<div class="form-group">
				<div class="col-sm-2 col-sm-offset-2 recurring">
					<input type="radio" name="recurring" value='3'> Hàng tháng
				</div>
				<div class="col-sm-1">
					<select id="" name="day_of_month" class="form-control select-time">
						@foreach (range(01,31) as $day_of_month)
							<option value="{{ $day_of_month }}" >Ngày {{ $day_of_month }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-1">
					<input type="number" name="month_hour" min="00" max="24"
						   value ="">
				</div>
				<div class="col-sm-1 ">
					<input type="number" name="month_minute" min="00" max="59" value="">
				</div>
				<div class="col-sm-4"></div>
			</div>
			<div class="form-group">
				<div class="col-sm-2 col-sm-offset-2 recurring">
					<input type="radio" name="recurring" value="2"> Hàng tuần
				</div>
				<div class="col-sm-1">
					<select id="" name="date_of_week" class="form-control select-time">
						@foreach (['Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm','Thứ sáu','Thứ bảy'] as $key => $date)
							<option value="{{ $key }}"  >{{ $date }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-1">
					<input type="number" name="week_hour" min="00" max="24" value ="">
				</div>
				<div class="col-sm-1 ">
					<input type="number" name="week_minute" min="00" max="59" value="">
				</div>
				<div class="col-sm-4"></div>
			</div>
			<div class="form-group">
				<div class="col-sm-2 col-sm-offset-2 recurring">
					<input type="radio" name="recurring" value="1"> Mỗi ngày
				</div>
				<div class="col-sm-1">
					<input type="number" name="daily_hour" min="00" max="24"  value="" >
				</div>
				<div class="col-sm-1 ">
					<input type="number" name="daily_minute" min="00" max="59"  value="" >
				</div>
				<div class="col-sm-5"></div>
			</div>
			<div class="form-group">
				<div class="col-sm-2 col-sm-offset-2 recurring">
					<input type="radio" name="recurring" value="0"> Chỉ định ngày
				</div>
				<div class="col-sm-1">
					<select id="" name="date" class="form-control select-time">
						@foreach (range(01,31) as $date)
							<option value="{{ $date }}" >Ngày {{ $date }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-1 ">
					<select id="" name="send_month" class="form-control select-time">
						@foreach (range(01,12) as $month)
							<option value="{{ $month }}" >Tháng {{ $month }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-1">
					<select id="" name="send_year" class="form-control select-time">
						@foreach (range(2018,2025) as $year)
							<option value="{{ $year }}" >Năm {{ $year }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-1">
					<input type="number" name="send_hour" min="00" max="24"  value="">
				</div>
				<div class="col-sm-1 ">
					<input type="number" name="send_minute" min="00" max="59" value="">
				</div>
				<div class="col-sm-2"></div>
			</div>
			@if ($errors->has('recurring'))
				<div class="alert alert-lightred alert-dismissable fade in">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<strong>{!! $errors->first('recurring') !!}</strong>
				</div>
			@endif

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
@include('admin.news.script')
<script>
	$( document ).ready(function() {
		$('#add-entry').click(function (e) {
			$('#form-add').submit();
		});
	});

    $('input[name="type"]').change(function() {
        type = $(this).val();
        if (type == 1) {
            $.ajax({
                url: "{!! route('common.getCustomerByUserLogin') !!}",
                method: "GET",
                data: {
                    'type' : type
                },
                dataType : 'json',
                success : function(result){
                    html = '';
                    $.each(result, function(key, value){
                        html += '<input type="radio" name="customerId[]" value="'+ key +'" > '+ value;
                    });
                    $('#customer').html(html);
                }
            });
		}
    });
</script>
@endsection