@extends('admin.inc.index')
@section('css')
  @include('admin.report.css')
@endsection
@section('title')
<a href="{!! route('admins.report.list') !!}">Report</a>
@endsection
@section('content')
  <!-- tile -->
  <section class="tile">

    <!-- tile header -->
    <div class="tile-header dvd dvd-btm">
      <h1 class="custom-font"><strong>Report</strong></h1>
      <ul class="controls">
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
      <div class="panel-body handling">
        <div class="search filter-search">
          <form class="navbar-form navbar-left form-search" action="{{ route('admins.report.list') }}" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <label for="">Date from: </label>
            <input name="date_from" class="form-control" type="date" value="{{ (isset($search)) ? $search['date_from'] : date('Y-m-d') }}">
            <label for="">Date to: </label>
            <input name="date_to" class="form-control" type="date" value="{{ (isset($search)) ? $search['date_to'] : date('Y-m-d') }}">
            <button class="form-control" type="submit" class="pull-right">Search</button>
            <a href="{!! route('admins.report.list') !!}" role="button" tabindex="0" style="text-decoration: none" class="form-control" class="pull-right">Show all</a>
          </form>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="table-responsive">
        <table class="table table-custom">
          <thead>
          <tr>
            <th>Id</th>
            <th>Project</th>
            <th>Number of customer</th>
            <th>Processing</th>
            <th>Registered</th>
            <th>Deposit</th>
            <th>Payment</th>
          </tr>
          </thead>
          <tbody>
          @php($i = 1)
          @foreach($projects as $id => $item)
            <tr class="odd gradeX">
              <td>{!! $i++ !!}</td>
              <td>{!! $item !!}</td>
              <td>{!! $report[$id]->total !!}</td>
              <td>{!! $report[$id]->sum_processing !!}</td>
              <td>{!! $report[$id]->sum_registered !!}</td>
              <td>{!! $report[$id]->sum_deposit !!}</td>
              <td>{!! $report[$id]->sum_payment !!}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>
  <!-- /tile -->
@endsection
