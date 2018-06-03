@extends('admin.inc.index')
@section('css')
@include('admin.notification.css')
@endsection
@section('title')
<a href="{!! route('admins.notification.list') !!}">Schedule</a>
@endsection
@section('content')
<!-- tile -->
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>Schedule</strong></h1>
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
		<form class="form-horizontal" role="form" id="form-edit" method="post" action="{!! route('admins.notification.update', ['id' => $notificationSchedule->id]) !!}" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			<input type="hidden" name="type" value="0" >
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
				<label class="col-sm-2 col-sm-offset-2 control-label">Send time:</label>
			</div>
			@if(Session::has('msgdate'))
			<div class="alert alert-lightred alert-dismissable fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<strong>{{ Session::get('msgdate') }}</strong>
			</div>
			@endif
			<div class="form-group">
				<div class="col-sm-2 col-sm-offset-2 recurring">
					<input type="radio" name="recurring" {{ ($notificationSchedule->recurring_type) == 3 ? 'checked' :''}} value='3'> Hàng tháng
				</div>
				<div class="col-sm-8">
					<select name="day_of_month" style="padding: 8px 12px; background-color: white">
						@foreach (range(01,31) as $day_of_month)
						<option value="{{ $day_of_month }}" {{ ($notificationSchedule->day_of_month) == $day_of_month ? 'selected' :''}} >Ngày {{ $day_of_month }}</option>
						@endforeach
					</select>
					<input style="padding: 6px 12px; background-color: white" type="number" name="month_hour" min="00" max="24" value ="{{ $hour }}">
					<input style="padding: 6px 12px; background-color: white" type="number" name="month_minute" min="00" max="59" value="{{ $minute }}">
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-2 col-sm-offset-2 recurring">
					<input type="radio" name="recurring" value="2" {{ ($notificationSchedule->recurring_type) == 2 ? 'checked' :''}} > Hàng tuần
				</div>
				<div class="col-sm-8">
					<select name="date_of_week" style="padding: 8px 12px; background-color: white">
						@foreach (['Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm','Thứ sáu','Thứ bảy'] as $key => $date)
						<option value="{{ $key }}" {{ ($notificationSchedule->date_of_week) == $key ? 'selected' :''}} >{{ $date }}</option>
						@endforeach
					</select>
					<input style="padding: 6px 12px; background-color: white" type="number" name="week_hour" min="00" max="24" value ="{{ $hour }}">
					<input style="padding: 6px 12px; background-color: white" type="number" name="week_minute" min="00" max="59" value="{{ $minute }}">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-2 col-sm-offset-2 recurring">
					<input type="radio" name="recurring" value="1" {{ ($notificationSchedule->recurring_type) == 1 ? 'checked' :''}}> Mỗi ngày
				</div>
				<div class="col-sm-8">
					<input style="padding: 6px 12px; background-color: white" type="number" name="daily_hour" min="00" max="24"  value="{{ $hour }}" >
					<input style="padding: 6px 12px; background-color: white" type="number" name="daily_minute" min="00" max="59"  value="{{ $minute }}" >
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-2 col-sm-offset-2 recurring">
					<input type="radio" name="recurring" value="0" {{ (!$notificationSchedule->is_recurring) ? 'checked' :''}}> Chỉ định ngày
				</div>
				<div class="col-sm-8">
					<select name="date" style="padding: 8px 12px; background-color: white">
						@foreach (range(01,31) as $date)
						<option value="{{ $date }}" {{ ($send_date) == $date ? 'selected' :''}} >Ngày {{ $date }}</option>
						@endforeach
					</select>
					<select style="padding: 8px 12px; background-color: white" name="send_month">
						@foreach (range(01,12) as $month)
						<option value="{{ $month }}" {{ ($send_month) == $month ? 'selected' :''}}>Tháng {{ $month }}</option>
						@endforeach
					</select>
					<select name="send_year" style="padding: 8px 12px; background-color: white">
						@foreach (range(2018,2025) as $year)
						<option value="{{ $year }}" {{ ($send_year) == $year ? 'selected' :''}}>Năm {{ $year }}</option>
						@endforeach
					</select>
					
					<input style="padding: 6px 12px; background-color: white" type="number" name="send_hour" min="00" max="24"  value="{{ $hour }}">
					<input style="padding: 6px 12px; background-color: white" type="number" name="send_minute" min="00" max="59" value="{{ $minute }}">
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
@include('admin.notification.script')
<script>
	$( document ).ready(function() {
		$('#edit-entry').click(function (e) {
			$('#form-edit').submit();
		});
	});
</script>
@endsection