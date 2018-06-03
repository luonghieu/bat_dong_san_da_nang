@extends('admin.inc.index')
@section('css')
@include('admin.project.css')
@endsection
@section('title')
<a href="{!! route('admins.project.list') !!}">Project</a> >
<a href="{!! route('admins.product.list', ['projectId' => $obj->project_id ]) !!}">Product</a> > Status Transaction
@endsection
@section('content')
<!-- tile -->
<section class="tile">

    <!-- tile header -->
    <div class="tile-header dvd dvd-btm">
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
                <form class="navbar-form navbar-left form-search" action="{{ route('admins.product.searchTransaction') }}" method="GET">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <input type="hidden" id="productId" name="productId" value="{{ $obj->id }}" />
                    @if($obj->floor != 0)
                    <label for="">Floor: </label>
                    <select class="form-control" name="floor">
                        <option value="-1">--Choose--</option>
                        @if (isset($obj->floor))
                        @foreach(range(1, $obj->floor) as $value)
                        <option  {{ (isset($search)&&$search['floor']==$value) ? 'selected="selected"' : '' }}  value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                        @endif
                    </select>
                    @endif
                    <label for="">Status: </label>
                    <select class="form-control" name="status">
                        <option value="-1">--Choose--</option>
                        @foreach($statuses as $key => $value)
                        <option  {{ (isset($search)&&$search['status']==$value) ? 'selected="selected"' : '' }}  value="{{ $value }}">{{ $key }}</option>
                        @endforeach
                    </select>
                    <button style="margin-left: 15px" class="form-control" type="submit" class="pull-right">Search</button>
                    <a href="{!! route('admins.product.status',['id' => $obj->id]) !!}" role="button" tabindex="0" style="margin-left: 15px; text-decoration: none" class="form-control" class="pull-right">Show all</a>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Customer name</th>
                        <th>Customer phone</th>
                        <th>Customer email</th>
                        <th>Floor</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Rating</th>
                        <th>Description</th>
                        <th>Created at</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($transactions))
                    @foreach($transactions as $obj)
                    <tr class="odd gradeX">
                        <td>{!! $obj->id !!}</td>
                        <td>{!! $obj->register->customer->name !!}</td>
                        <td>{!! $obj->register->customer->phone !!}</td>
                        <td>{!! $obj->register->customer->email !!}</td>
                        <td>
                            @if (isset($obj->apartment))
                            {!! $obj->apartment->floor !!}
                            @else
                            <span>0</span>
                            @endif
                        </td>
                        <td>
                            @if (isset($obj->apartment))
                            {!! $obj->apartment->position !!}
                            @else
                            <span>0</span>
                            @endif
                        </td>
                        <td>
                            {{ getTransactionStatus($obj->status) }}
                        </td>
                        <td>
                            <div id="rateYo{{$obj->id}}"></div>
                            <script type="text/javascript">
                                $(function () {
                                    $("#rateYo" + {{$obj->id}}).rateYo({
                                        maxValue: 10,
                                        numStars: 10,
                                        starWidth: "20px",
                                        rating: {{$obj->rating}},
                                        readOnly: true
                                    });
                                });
                            </script>
                        </td>
                        <td>{!! $obj->description !!}</td>
                        <td>{!! date( "d/m/Y", strtotime($obj->created_at)) !!}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="8">No data</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- /tile -->
@endsection

@section('script')
<script src="{!! asset('admin_asset/js/jquery.rateyo.min.js') !!}"></script>
@endsection