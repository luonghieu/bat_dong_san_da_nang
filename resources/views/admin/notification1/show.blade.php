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
          <form class="form-horizontal form-date" role="form" action="{{ route('admin.notification_schedules.edit', ['id' => $notificationSchedule->id ]) }}" method="GET">
            <div class="form-group">
              <label for="radio" class="col-sm-1 col-sm-offset-2 control-label">区分:</label>
              <div class="col-sm-9"></div>
            </div>
            <div class="form-group">
              <div class="col-sm-6 col-sm-offset-2 notification-type">
                {{ getNotificationScheduleType($notificationSchedule->type) == 'User' ? 'User' :'Staff' }}
              </div>
              <div class="col-sm-4"></div>
            </div>
            <div class="form-group">
              <label for="title" class="col-sm-1 col-sm-offset-2 control-label">タイトル:</label>
              <div class="col-sm-2"></div>
            </div>
            <div class="form-group">
              <div class="col-sm-6 col-sm-offset-2">
                {{ $notificationSchedule->title }}
              </div>
              <div class="col-sm-2"></div>
            </div>
            <div class="form-group">
              <label  class="col-sm-1 col-sm-offset-2 control-label">本文:</label>
            </div>
            <div class="form-group">
              <div class="col-sm-6 col-sm-offset-2">
                {{ $notificationSchedule->content }}
              </div>
              <div class="col-sm-2"></div>
            </div>
            <div class="form-group">
              @php
                $time_data = [
                  'date_of_week' => $notificationSchedule->date_of_week,
                  'day_of_month' => $notificationSchedule->day_of_month,
                  'send_time' => $notificationSchedule->send_time,
                  'send_date' => $notificationSchedule->send_date,
                ];
              @endphp
              <label for="radio" class="col-sm-2 col-sm-offset-2 control-label">通知タイミング:</label>
            </div>
            <div class="form-group">
               <div class="col-sm-3 col-sm-offset-2">
               <span class="recurring_type">
                 {{ getNotificationScheduleRecurringType($notificationSchedule->recurring_type) }}
               </span>
               <span>
                  {{ getNotificationScheduleTime($notificationSchedule->recurring_type,$time_data) }}
               </span>
              </div>
            </div><br>
            <div class="form-group">
              @if ( ($notificationSchedule->status) == 2)
              <div class="col-sm-1 col-sm-offset-2"></div>
              @else
              <div class="col-sm-1 col-sm-offset-3">
                <button type="submit" class="btn-primary action">更新する</button>
              </div>
              @endif
              <div class="col-sm-1 col-sm-offset-1">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteNotificationSchedule">削除</button>
              </div>
              <div class="col-sm-4" ></div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="deleteNotificationSchedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <span>本当に削除しますか？</span><br/>
        </div>
        <div class="modal-footer">
          <form action="{{ route('admin.notification_schedules.destroy', ['id' => $notificationSchedule->id ]) }}" method="POST">
            <button type="button" class="btn btn-canceled" data-dismiss="modal">キャンセル</button>
            {{ csrf_field() }}
            <input type="hidden" name="type" value="2">
            <button type="submit" class="btn btn-accept">はい</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--/col-->
</div>
<!--/row-->
@endsection
