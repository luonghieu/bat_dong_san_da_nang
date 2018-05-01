
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
                            <li class="active"><a href="index-2.html"><i class="fa fa-dashboard"></i> <span>Home</span></a></li>
                            <li>
                                <a href="{!! route('admins.announcement.list') !!}" tabindex="0"><i class="fa fa-list"></i> <span>Announcement</span></a>
                            </li>
                            <li>
                                <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Employee</span></a>
                                <ul>
                                    <li><a href="{!! route('admins.leader.list') !!}"><i class="fa fa-caret-right"></i> Leader sale</a></li>
                                    <li><a href="{!! route('admins.sale.list') !!}"><i class="fa fa-caret-right"></i> Sale</a></li>
                                </ul>
                            </li>
                            <li>
                                <a role="button" tabindex="0"><i class="fa fa-pencil"></i> <span>Customer</span></a>
                                <ul>
                                    <li><a href="{!! route('admins.customer.list') !!}"><i class="fa fa-caret-right"></i> purchase</a></li>
                                    <li><a href="{!! route('admins.poster.list') !!}"><i class="fa fa-caret-right"></i> post</a></li>
                                </ul>
                            </li>
                            <li>
                                <a role="button" tabindex="0" href="{!! route('admins.post.list') !!}"><i class="fa fa-table"></i> <span>Post</span></a>
                            </li>
                            <li>
                                <a role="button" tabindex="0" href="{!! route('admins.post.list') !!}"><i class="fa fa-table"></i> <span>Product</span></a>
                            </li>
                            <li>
                                <a href="{!! route('admins.project.list') !!}" role="button" tabindex="0"><i class="fa fa-desktop"></i> <span>Project</span></a>
                            </li>
                            <li>
                                <a href="{!! route('admins.assign.list') !!}" role="button" tabindex="0"><i class="fa fa-map-marker"></i> <span>Assign Task</span></a>
                            </li>
                            <li>
                                <a href="{!! route('admins.consult.list') !!}" role="button" tabindex="0"><i class="fa fa-magic"></i> <span>Register and consult</span>
                                </a>
                            </li>
                            <li>
                                <a href="{!! route('admins.notification.list') !!}" tabindex="0"><i class="fa fa-list"></i> <span>Schedules</span></a>
                            </li>
                            <li>
                                <a href="" role="button" tabindex="0"><i class="fa fa-magic"></i> <span>Report</span></a>
                            </li>
                            <li><a href="{!! route('admins.news.list') !!}"><i class="fa fa-calendar-o"></i> <span>News</span> <span class="label label-success">new events</span></a></li>
                            <li>
                                <a href="{!! route('admins.introduce.list') !!}"><i class="fa fa-bar-chart-o"></i> <span>Introduce</span>
                                </a>
                            </li>

                            <li>
                                <a href="{!! route('admins.slider.list') !!}" role="button" tabindex="0"><i class="fa fa-magic"></i> <span>Slider</span>
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