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
				<a role="button" tabindex="0" id="add"><i class="fa fa-plus mr-5"></i> Add</a>
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
			@if (isset($list))
			<input type="hidden" name="type" value="2" >
			<div class="form-group">
				<label class="col-sm-2 control-label">Customer</label>
				<div class="col-sm-10">
					<table class="table" id="table_add">
						<thead>
							<tr>
								<th>
									<label class="checkbox checkbox-custom-alt checkbox-custom-sm m-0">
										<input type="checkbox" id="select-all"><i></i>
									</label>
								</th>
								<th>Customer</th>
								<th>Email</th>
							</tr>
						</thead>
						<tbody>
							@foreach($list as $obj)
							<tr>
								<td>
									<label class="checkbox checkbox-custom-alt checkbox-custom-sm m-0"><input type="checkbox" class="selectMe" name="selected[]" value="{!! $obj->id !!}" ><i></i></label>
								</td>
								<td>{!! $obj->name !!}</td>
								<td>{!! $obj->email !!}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<div>{{ $list->links() }}</div>
				</div>
			</div>
			@else
			<input type="hidden" name="type" value="1" >
			@endif
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
					<input type="radio" name="recurring" value='3'> Hàng tháng
				</div>
				<div class="col-sm-8">
					<select name="day_of_month" style="padding: 8px 12px; background-color: white">
						@foreach (range(01,31) as $day_of_month)
						<option value="{{ $day_of_month }}" >Ngày {{ $day_of_month }}</option>
						@endforeach
					</select>
					<input style="padding: 6px 12px; background-color: white" type="number" name="month_hour" min="00" max="24" value ="">
					<input style="padding: 6px 12px; background-color: white" type="number" name="month_minute" min="00" max="59" value="">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-2 col-sm-offset-2 recurring">
					<input type="radio" name="recurring" value="2"> Hàng tuần
				</div>
				<div class="col-sm-8">
					<select style="padding: 8px 12px; background-color: white" name="date_of_week">
						@foreach (['Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm','Thứ sáu','Thứ bảy'] as $key => $date)
						<option value="{{ $key }}"  >{{ $date }}</option>
						@endforeach
					</select>
					<input style="padding: 6px 12px; background-color: white" type="number" name="week_hour" min="00" max="24" value ="">
					<input style="padding: 6px 12px; background-color: white" type="number" name="week_minute" min="00" max="59" value="">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-2 col-sm-offset-2 recurring">
					<input type="radio" name="recurring" value="1"> Mỗi ngày
				</div>
				<div class="col-sm-8">
					<input style="padding: 6px 12px; background-color: white" type="number" name="daily_hour" min="00" max="24"  value="" >
					<input style="padding: 6px 12px; background-color: white" type="number" name="daily_minute" min="00" max="59"  value="" >
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-2 col-sm-offset-2 recurring">
					<input type="radio" name="recurring" value="0"> Chỉ định ngày
				</div>
				<div class="col-sm-8">
					<select style="padding: 8px 12px; background-color: white" name="date">
						@foreach (range(01,31) as $date)
						<option value="{{ $date }}" >Ngày {{ $date }}</option>
						@endforeach
					</select>
					<select style="padding: 8px 12px; background-color: white" name="send_month">
						@foreach (range(01,12) as $month)
						<option value="{{ $month }}" >Tháng {{ $month }}</option>
						@endforeach
					</select>
					<select style="padding: 8px 12px; background-color: white" name="send_year">
						@foreach (range(2018,2025) as $year)
						<option value="{{ $year }}" >Năm {{ $year }}</option>
						@endforeach
					</select>
					<input style="padding: 6px 12px; background-color: white" type="number" name="send_hour" min="00" max="24"  value="">
					<input style="padding: 6px 12px; background-color: white" type="number" name="send_minute" min="00" max="59" value="">
				</div>
			</div>
			@if ($errors->has('recurring'))
			<div class="alert alert-lightred alert-dismissable fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<strong>{!! $errors->first('recurring') !!}</strong>
			</div>
			@endif

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
@include('admin.news.script')
<script>

	$('#select-all').change(function() {
		if ($(this).is(":checked")) {
			$('#table_add .selectMe').prop('checked', true);
		} else {
			$('#table_add .selectMe').prop('checked', false);
		}
	});

	$('#add').click(function() {
		type = $('input[name="type"]').val();

		if (type != 1) {
			var list = $('input[name="selected"]:checked');
			alert(list);
			if (list.length == 0) {
				alert('No obj is selected!');
				return false;
			}
			$('#form-add').submit();
		} else {
			$('#form-add').submit();
		}

	});

</script>
@endsection