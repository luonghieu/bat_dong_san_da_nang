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
		@php
			$hour = Carbon\Carbon::parse($notificationSchedule->send_time)->format('H');
			$minute = Carbon\Carbon::parse($notificationSchedule->send_time)->format('i');
			$send_date = Carbon\Carbon::parse($notificationSchedule->send_date)->format('d');
			$send_month = Carbon\Carbon::parse($notificationSchedule->send_date)->format('m');
			$send_year = Carbon\Carbon::parse($notificationSchedule->send_date)->format('Y');
		@endphp
		<form class="form-horizontal" role="form" id="form-edit" method="post" action="{!! route('admins.notification.update', ['id' => $obj->id]) !!}" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			<div class="form-group">
				<div class="col-sm-1 col-sm-offset-2">
					<input type="radio" name="type" value="1" {{ getNotificationScheduleType($notificationSchedule->type) == 'User' ? 'checked' :'' }} > User
				</div>
				<div class="col-sm-1">
					<input type="radio" name="type" value="2" {{ getNotificationScheduleType($notificationSchedule->type) == 'Staff' ? 'checked' :'' }}> Staff
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Title</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="inputEmail3" name="title" placeholder="Title" value="{!! $notificationSchedule->title !!}">
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
					<textarea id="summernote" name="content">{!! $notificationSchedule->content !!}
					</textarea>
					@if ($errors->has('content'))
					<div class="alert alert-lightred alert-dismissable fade in">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<strong>{!! $errors->first('content') !!}</strong>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-2 col-sm-offset-2 recurring">
					<input type="radio" name="recurring" {{ ($notificationSchedule->recurring_type) == 3 ? 'checked' :''}} value='3'> Hàng tháng
				</div>
				<div class="col-sm-1">
					<select id="" name="day_of_month" class="form-control select-time">
						@foreach (range(01,31) as $day_of_month)
							<option value="{{ $day_of_month }}" {{ ($notificationSchedule->day_of_month) == $day_of_month ? 'selected' :''}} >Ngày {{ $day_of_month }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-1">
					<input type="number" name="month_hour" min="00" max="24"
						   value ="{{ $hour }}">
				</div>
				<div class="col-sm-1 ">
					<input type="number" name="month_minute" min="00" max="59" value="{{ $minute }}">
				</div>
				<div class="col-sm-4"></div>
			</div>
			<div class="form-group">
				<div class="col-sm-2 col-sm-offset-2 recurring">
					<input type="radio" name="recurring" value="2" {{ ($notificationSchedule->recurring_type) == 2 ? 'checked' :''}} > Hàng tuần
				</div>
				<div class="col-sm-1">
					<select id="" name="date_of_week" class="form-control select-time">
						@foreach (['Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm','Thứ sáu','Thứ bảy'] as $key => $date)
							<option value="{{ $key }}" {{ ($notificationSchedule->date_of_week) == $key ? 'selected' :''}} >{{ $date }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-1">
					<input type="number" name="week_hour" min="00" max="24" value ="{{ $hour }}">
				</div>
				<div class="col-sm-1 ">
					<input type="number" name="week_minute" min="00" max="59" value="{{ $minute }}">
				</div>
				<div class="col-sm-4"></div>
			</div>
			<div class="form-group">
				<div class="col-sm-2 col-sm-offset-2 recurring">
					<input type="radio" name="recurring" value="1" {{ ($notificationSchedule->recurring_type) == 1 ? 'checked' :''}}> Mỗi ngày
				</div>
				<div class="col-sm-1">
					<input type="number" name="daily_hour" min="00" max="24"  value="{{ $hour }}" >
				</div>
				<div class="col-sm-1 ">
					<input type="number" name="daily_minute" min="00" max="59"  value="{{ $minute }}" >
				</div>
				<div class="col-sm-5"></div>
			</div>
			<div class="form-group">
				<div class="col-sm-2 col-sm-offset-2 recurring">
					<input type="radio" name="recurring" value="0" {{ (!$notificationSchedule->is_recurring) ? 'checked' :''}}> Chỉ định ngày
				</div>
				<div class="col-sm-1">
					<select id="" name="date" class="form-control select-time">
						@foreach (range(01,31) as $date)
							<option value="{{ $date }}" {{ ($send_date) == $date ? 'selected' :''}} >Ngày {{ $date }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-1 ">
					<select id="" name="send_month" class="form-control select-time">
						@foreach (range(01,12) as $month)
							<option value="{{ $month }}" {{ ($send_month) == $month ? 'selected' :''}}>Tháng {{ $month }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-1">
					<select id="" name="send_year" class="form-control select-time">
						@foreach (range(2018,2025) as $year)
							<option value="{{ $year }}" {{ ($send_year) == $year ? 'selected' :''}}>Năm {{ $year }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-1">
					<input type="number" name="send_hour" min="00" max="24"  value="{{ $hour }}">
				</div>
				<div class="col-sm-1 ">
					<input type="number" name="send_minute" min="00" max="59" value="{{ $minute }}">
				</div>
				<div class="col-sm-2"></div>
			</div>
			@if(Session::has('msgdate'))
				<div class="alert alert-lightred alert-dismissable fade in">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<strong>{{ Session::get('msgdate') }}</strong>
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
		$('#edit-entry').click(function (e) {
			$('#form-edit').submit();
		});
	});
</script>
@endsection