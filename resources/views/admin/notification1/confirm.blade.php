@extends('layouts.admin')
@section('admin.content')
<div class="col-md-10 col-sm-11 main ">
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading" data-original-title>
          <h2><i class="fa fa-user"></i><span class="break"></span>プッシュ通知</h2>
        </div>
        <div class="panel-body message">
        @include('admin.partials.notification')
          @if (isset($notificationSchedule))
          <form class="form-horizontal form-date" role="form"  id= "editNotification_schedule" action="{{ route('admin.notification_schedules.edit', ['id' => $notificationSchedule->id ]) }}" method="GET">
          @else
          <form class="form-horizontal form-date" role="form"  id= "editNotification_schedule" action="{{ route('admin.notification_schedules.create') }}" method="GET">
          @endif
            <div class="form-group">
              <label for="radio" class="col-sm-2 col-sm-offset-2 control-label">配信予定数：</label>
              <div class="col-sm-9"></div>
            </div>
            <div class="form-group">
              <div class="col-sm-6 col-sm-offset-2 notification-type">
                {{ $data['countUser'] }}件
              </div>
              <div class="col-sm-4"></div>
            </div>
            <div class="form-group">
              <label for="radio" class="col-sm-1 col-sm-offset-2 control-label">区分:</label>
              <div class="col-sm-9"></div>
            </div>
             <div class="form-group">
              <div class="col-sm-6 col-sm-offset-2 notification-type">
                {{ $data['type'] == 1 ? 'User' :'Staff' }}
              </div>
              <div class="col-sm-4"></div>
            </div>
            <div class="form-group">
              <label for="title" class="col-sm-1 col-sm-offset-2 control-label">タイトル:</label>
              <div class="col-sm-2"></div>
            </div>
            <div class="form-group">
              <div class="col-sm-6 col-sm-offset-2">
                {{ $data['title'] }}
              </div>
              <div class="col-sm-2"></div>
            </div>
            <div class="form-group">
              <label  class="col-sm-1 col-sm-offset-2 control-label">本文:</label>
            </div>
            <div class="form-group">
              <div class="col-sm-6 col-sm-offset-2">
                {{ $data['content'] }}
              </div>
              <div class="col-sm-2"></div>
            </div>
            <div class="form-group">
              <label for="radio" class="col-sm-2 col-sm-offset-2 control-label">通知タイミング:</label>
            </div>
            <div class="form-group">
              <div class="col-sm-3 col-sm-offset-2">
                <span class="recurring_type">
                  {{ getNotificationScheduleRecurringType($data['recurring']) }}
                </span>
                <span>
                  {{ getNotificationScheduleTime($data['recurring'], $data['time']) }}
                </span>
              </div>
            </div><br>
            <div class="form-group">
              <div class="col-sm-1 col-sm-offset-3">
                <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="">戻る</button>
              </div>
              <div class="col-sm-1 col-sm-offset-1">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editNotificationSchedule">更新する</button>
              </div>
              <div class="col-sm-4" ></div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="editNotificationSchedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <span>プッシュ通知の更新が完了しました。</span><br/>
        </div>
        <div class="modal-footer">
          @if (isset($notificationSchedule))
          <form action="{{ route('admin.notification_schedules.update', ['id' => $notificationSchedule->id ]) }}" method="POST">
          @else
          <form action="{{ route('admin.notification_schedules.create_notification_schedule') }}" method="POST">
          @endif
            {{csrf_field()}}
            <input type="hidden" name="title" value="{{ $data['title'] }}">
            <input type="hidden" name="content" value="{{ $data['content'] }}">
            <input type="hidden" name="type" value="{{ $data['type'] }}">
            <input type="hidden" name="recurring" value="{{ $data['recurring'] }}">
            @if (App\NotificationSchedule::RECURRING_TYPES['daily']==($data['recurring']))
              <input type="hidden" name="daily_hour" value="{{ $data['time']['daily_hour'] }}">
              <input type="hidden" name="daily_minute" value="{{ $data['time']['daily_minute'] }}">
            @elseif(App\NotificationSchedule::RECURRING_TYPES['weekly']==($data['recurring']))
              <input type="hidden" name="week_hour" value="{{ $data['time']['week_hour'] }}">
              <input type="hidden" name="week_minute" value="{{ $data['time']['week_minute'] }}">
              <input type="hidden" name="date_of_week" value="{{ $data['time']['date_of_week'] }}">
            @elseif(App\NotificationSchedule::RECURRING_TYPES['monthly']==($data['recurring']))
              <input type="hidden" name="month_hour" value="{{ $data['time']['month_hour'] }}">
              <input type="hidden" name="month_minute" value="{{ $data['time']['month_minute'] }}">
              <input type="hidden" name="day_of_month" value="{{ $data['time']['day_of_month'] }}">
            @else
              <input type="hidden" name="send_year" value="{{ $data['time']['send_year'] }}">
              <input type="hidden" name="send_month" value="{{ $data['time']['send_month'] }}">
              <input type="hidden" name="send_minute" value="{{ $data['time']['send_minute'] }}">
              <input type="hidden" name="date" value="{{ $data['time']['date'] }}">
              <input type="hidden" name="send_hour" value="{{ $data['time']['send_hour'] }}">
            @endif
            <button type="submit" class="btn btn-accept">Ok</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--/col-->
</div>
<!--/row-->
@endsection
