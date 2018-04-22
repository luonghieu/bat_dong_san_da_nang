@extends('layouts.admin')
@section('admin.content')
<div class="col-md-10 col-sm-11 main ">
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading" data-original-title>
          <h2><i class="fa fa-user"></i><span class="break"></span>プッシュ通知</h2>
        </div>
        <div class="panel-body handling">
          <div class="search filter-search">
            <form class="navbar-form navbar-left form-search" action="" method="GET">
              <input type="text" class="form-control input-search" placeholder="Search..." name="search" value="{{request()->search}}">
              <label for="">From date: </label>
              <input type="text" class="form-control date-picker input-search" name="from_date" id="date01" data-date-format="yyyy/mm/dd" value="{{request()->from_date}}" placeholder="yyyy/mm/dd" />
              <label for="">To date: </label>
              <input type="text" class="form-control date-picker" name="to_date" id="date01" data-date-format="yyyy/mm/dd" value="{{request()->to_date}}" placeholder="yyyy/mm/dd"/>
              <button type="submit" class="fa fa-search btn-search"></button>
            </form>
            <form class="navbar-form pull-right export-btn" action="{{ route('admin.notification_schedules.create') }}" method="GET">
              <button type="submit" class="pull-right">新規作成</button>
            </form>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="panel-body">
          <form class="navbar-form navbar-left form-search" action="" id="limit-page" method="GET">
            <div class="form-group">
              <label class="col-md-1 limit-page">表示件数：</label>
              <div class="col-md-1">
                <select id="select-limit" name="limit" class="form-control">
                  @foreach ([10, 20, 50, 100] as $limit)
                    <option value="{{ $limit }}" {{ request()->limit == $limit ? 'selected' : '' }}>{{ $limit }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </form>
        </div>
        <div class="panel-body">
          @include('admin.partials.notification')
            <table class="table table-striped table-bordered bootstrap-datatable" id="notificationSchedule_info">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>プッシュ通知ID</th>
                  <th>区分</th>
                  <th>送信日時</th>
                  <th>ステータス</th>
                  <th>タイトル</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($notificationSchedules as $key => $notificationSchedule)
                <tr>
                  <td>{{ $notificationSchedules->firstItem() +$key }}</td>
                  <td>{{ $notificationSchedule->id }}</td>
                  <td>
                    <span class="label label-success label-{{ getNotificationScheduleType($notificationSchedule->type) }}">
                      {{ getNotificationScheduleType($notificationSchedule->type) }}
                    </span>
                  </td>
                  @php
                    $time_data = [
                      'date_of_week' => $notificationSchedule->date_of_week,
                      'day_of_month' => $notificationSchedule->day_of_month,
                      'send_time' => $notificationSchedule->send_time,
                      'send_date' => $notificationSchedule->send_date,
                    ];
                  @endphp
                  <td>{{ getNotificationScheduleTime($notificationSchedule->recurring_type,$time_data) }}</td>
                  <td>{{ getNotificationScheduleStatus($notificationSchedule->status) }}</td>
                  <td class="long-text">{{ $notificationSchedule->title }}</td>
                  <td><a href="{{ route('admin.notification_schedules.show', ['id' => $notificationSchedule->id ]) }}" class="btn btn-info">詳細</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
        <div class="col-lg-12">
            @if ($notificationSchedules->total())
              全 {{ $notificationSchedules->total() }}件中 {{ $notificationSchedules->firstItem() }}~{{ $notificationSchedules->lastItem() }}件を表示しています
            @endif
          </div>
          <div class="pagination-outter">
            <ul class="pagination">
              {{ $notificationSchedules->appends(request()->all())->links() }}
            </ul>
          </div>
      </div>
    </div>
    <!--/col-->
  </div>
  <!--/row-->
</div>
@endsection
