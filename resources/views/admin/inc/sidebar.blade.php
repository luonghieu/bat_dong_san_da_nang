@if (session('objUser'))
    @php
        $objUser = Session::get("objUser");
    @endphp
@endif
<!-- ================================================
================= SIDEBAR Content ===================
================================================= -->
<aside id="sidebar">


    <div id="sidebar-wrap">

        <div class="panel-group slim-scroll" role="tablist">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#sidebarNav">
                            Navigation <i class="fa fa-angle-up"></i>
                        </a>
                    </h4>
                </div>
                <div id="sidebarNav" class="panel-collapse collapse in" role="tabpanel">
                    <div class="panel-body">


                        <!-- ===================================================
                        ================= NAVIGATION Content ===================
                        ==================================================== -->
                        <ul id="navigation">
                            <li class="{{Request::Segment(1)==='profile' ?'active' : ''}}"><a href="{{ route('auth.profile') }}"><i class="fa fa-list"></i> <span>Home</span></a></li>
                            <li class="{{Request::Segment(2)==='announcement' ?'active' : ''}}">
                                <a href="{!! route('admins.announcement.list') !!}" tabindex="0"><i class="fa fa-list"></i> <span>Announcement</span></a>
                            </li>
                            @if ($objUser->role != 3 && $objUser->role != 4)
                            <li class="{{Request::Segment(2)==='employees' ?'active' : ''}}">
                                <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Employee</span></a>
                                <ul>
                                    @if ($objUser->role == 1)
                                    <li><a href="{!! route('admins.leader.list') !!}"><i class="fa fa-caret-right"></i> Managers</a></li>
                                    @endif
                                    <li><a href="{!! route('admins.sale.list') !!}"><i class="fa fa-caret-right"></i> Sales</a></li>
                                </ul>
                            </li>
                            @endif
                            <li  class="{{(Request::Segment(2)==='customer' || Request::Segment(3)==='posters')?'active' : ''}}">
                                <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Customer</span></a>
                                <ul>
                                    <li><a href="{!! route('admins.customer.list') !!}"><i class="fa fa-caret-right"></i> purchase</a></li>
                                    <li><a href="{!! route('admins.poster.list') !!}"><i class="fa fa-caret-right"></i> post</a></li>
                                </ul>
                            </li>
                            <li class="{{Request::Segment(3)==='posts' ?'active' : ''}}">
                                <a role="button" tabindex="0" href="{!! route('admins.post.list') !!}"><i class="fa fa-list"></i> <span>Post</span></a>
                            </li>
                            <li class="{{(Request::Segment(2)==='project' || Request::Segment(2)==='product') ?'active' : ''}}">
                                <a href="{!! route('admins.project.list') !!}" role="button" tabindex="0"><i class="fa fa-list"></i> <span>Project</span></a>
                            </li>
                            <li class="{{Request::Segment(2)==='transaction' ?'active' : ''}}">
                                <a href="{!! route('admins.transaction.listAll') !!}" role="button" tabindex="0"><i class="fa fa-list"></i> <span>Transaction</span></a>
                            </li>
                            <li class="{{Request::Segment(2)==='assign' ?'active' : ''}}">
                                <a href="{!! route('admins.assign.list') !!}" role="button" tabindex="0"><i class="fa fa-list"></i> <span>Assign Task</span></a>
                            </li>
                            @if ($objUser->role != 3 && $objUser->role != 4)
                            <li class="{{Request::Segment(2)==='consult' ?'active' : ''}}">
                                <a href="{!! route('admins.consult.list') !!}" role="button" tabindex="0"><i class="fa fa-list"></i> <span>Register and consult</span>
                                </a>
                            </li>
                            @endif
                             @if ($objUser->role != 3 && $objUser->role != 4)
                            <li class="{{Request::Segment(2)==='notification' ?'active' : ''}}">
                                <a href="{!! route('admins.notification.list') !!}" role="button" tabindex="0"><i class="fa fa-list"></i> <span>Schedule</span>
                                </a>
                            </li>
                            @endif
                            <li class="{{Request::Segment(2)==='report' ?'active' : ''}}">
                                <a href="{!! route('admins.report.list') !!}" role="button" tabindex="0"><i class="fa fa-list"></i> <span>Report</span></a>
                            </li>
                            <li class="{{Request::Segment(2)==='contact' ?'active' : ''}}">
                                <a href="{!! route('admins.contact.list') !!}" role="button" tabindex="0"><i class="fa fa-list"></i> <span>Contact</span></a>
                            </li>
                            <li class="{{Request::Segment(2)==='news' ?'active' : ''}}">
                                <a href="{!! route('admins.news.list') !!}"><i class="fa fa-list"></i> <span>News</span> </a>
                            </li>
                            <li class="{{Request::Segment(2)==='introduce' ?'active' : ''}}">
                                <a href="{!! route('admins.introduce.list') !!}"><i class="fa fa-list"></i> <span>Introduce</span>
                                </a>
                            </li>

                            <li class="{{Request::Segment(2)==='slider' ?'active' : ''}}">
                                <a href="{!! route('admins.slider.list') !!}" role="button" tabindex="0"><i class="fa fa-list"></i> <span>Slider</span>
                                </a>
                            </li>
                        </ul>
                        <!--/ NAVIGATION Content -->
                    </div>
                </div>
            </div>
            
            
        </div>

    </div>


</aside>
<!--/ SIDEBAR Content -->