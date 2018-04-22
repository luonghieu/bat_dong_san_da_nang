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
          <form class="form-horizontal form-date" id="formNotificationSchedule" role="form" action="{{ route('admin.notification_schedules.confirm_create') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="radio" class="col-sm-1 col-sm-offset-2 control-label">区分:</label>
              <div class="col-sm-9"></div>
            </div>
            <div class="form-group">
              <div class="col-sm-1 col-sm-offset-2">
                <input type="radio" name="type" value="1" > User
              </div>
              <div class="col-sm-1">
                <input type="radio" name="type" value="2" > Staff
              </div>
            </div>
            @if ($errors->has('type'))
            <div class="form-group">
              <div class="alert alert-danger fade in col-sm-5 col-sm-offset-2">
                <button data-dismiss="alert" class="close close-sm" type="button">
                  <i class="icon-remove"></i>
                </button>
                <strong>
                  {{ $errors->first('type') }}
                </strong>
              </div>
            </div>
           @endif
            <div class="form-group">
              <label for="title" class="col-sm-1 col-sm-offset-2 control-label">タイトル:</label>
              <div class="col-sm-9"></div>
            </div>
            <div class="form-group">
              <div class="col-sm-7 col-sm-offset-2">
                <input type="text" class="form-control" id="title" name="title" value=''>
              </div>
            </div>
           @if ($errors->has('title'))
            <div class="form-group">
              <div class="alert alert-danger fade in col-sm-5 col-sm-offset-2">
                <button data-dismiss="alert" class="close close-sm" type="button">
                  <i class="icon-remove"></i>
                </button>
                <strong>
                  {{ $errors->first('title') }}
                </strong>
              </div>
            </div>
           @endif
            <div class="form-group">
              <label for="select" class="col-sm-1 col-sm-offset-2 control-label">本文:</label>
              <div class="col-sm-9"></div>
            </div>
            <div class="form-group">
              <div class="col-sm-7 col-sm-offset-2">
                <textarea class="form-control" name="content" id="content" name="body" rows="12"></textarea>
              </div>
            </div>
            @if ($errors->has('content'))
            <div class="form-group">
              <div class="alert alert-danger fade in col-sm-5 col-sm-offset-2">
                <button data-dismiss="alert" class="close close-sm" type="button">
                  <i class="icon-remove"></i>
                </button>
                <strong>
                  {{ $errors->first('content') }}
                </strong>
              </div>
            </div>
           @endif
            <div class="form-group">
              <label class="col-sm-2 col-sm-offset-2 control-label">通知タイミング:</label>
            </div>
            <div class="form-group">
              <div class="col-sm-2 col-sm-offset-2 recurring">
                <input type="radio" name="recurring" value='3'> 毎月
              </div>
              <div class="col-sm-1">
                <select id="" name="day_of_month" class="form-control select-time">
                  @foreach (range(01,31) as $day_of_month)
                    <option value="{{ $day_of_month }}" >{{ $day_of_month }}日</option>
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
                <input type="radio" name="recurring" value="2"> 毎週
              </div>
              <div class="col-sm-1">
                <select id="" name="date_of_week" class="form-control select-time">
                  @foreach (['日曜日', '月曜日', '火曜日', '水曜日', '木曜日','金曜日','土曜日'] as $key => $date)
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
                <input type="radio" name="recurring" value="1"> 毎日
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
                <input type="radio" name="recurring" value="0"> 日時指定
              </div>
              <div class="col-sm-1">
                <select id="" name="send_year" class="form-control select-time">
                  @foreach (range(2018,2025) as $year)
                    <option value="{{ $year }}" >{{ $year }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-sm-1 ">
                 <select id="" name="send_month" class="form-control select-time">
                  @foreach (range(01,12) as $month)
                    <option value="{{ $month }}" >{{ $month }}月</option>
                  @endforeach
                </select>
              </div>
              <div class="col-sm-1">
                <select id="" name="date" class="form-control select-time">
                  @foreach (range(01,31) as $date)
                    <option value="{{ $date }}" >{{ $date }}日</option>
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
            @if(Session::has('msgdate'))
            <div class="form-group">
              <div class="alert alert-danger fade in col-sm-5 col-sm-offset-2">
                <button data-dismiss="alert" class="close close-sm" type="button">
                  <i class="icon-remove"></i>
                </button>
                <strong>
                  <strong>{{ Session::get('msgdate') }}</strong>
                </strong>
              </div>
            </div>
            @endif
            @if ($errors->has('recurring'))
            <div class="form-group">
              <div class="alert alert-danger fade in col-sm-5 col-sm-offset-2">
                <button data-dismiss="alert" class="close close-sm" type="button">
                  <i class="icon-remove"></i>
                </button>
                <strong>
                  {{ $errors->first('recurring') }}
                </strong>
              </div>
            </div>
           @endif
            <div class="form-group">
              <div class="col-sm-1 col-sm-offset-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createDraftNotificationSchedule">下書き保存</button>
              </div>
              <div class="col-sm-1 col-sm-offset-1">
                 <button type="submit" class="btn-primary action">確認画面へ</button>
              </div>
              <div class="col-sm-4" ></div>
            </div>
          </div>
          <input type="hidden"  value="{{ route('admin.notification_schedules.create_draft') }}" id="route">
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="createDraftNotificationSchedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <span>下書き保存しました。</span><br/>
        </div>
        <div class="modal-footer">
            <button type="button" id='btnSaveDraft' class="btn btn-accept">Ok</button>
        </div>
      </div>
    </div>
  </div>
  <!--/col-->
</div>
<!--/row-->
@endsection
