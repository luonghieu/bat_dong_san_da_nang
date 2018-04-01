
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
                                                <a role="button" tabindex="0"><i class="fa fa-envelope-o"></i> <span>Mail</span> <span class="badge bg-lightred">6</span></a>
                                                <ul>
                                                    <li><a href="mail-inbox.html"><i class="fa fa-caret-right"></i> Inbox</a></li>
                                                    <li><a href="mail-compose.html"><i class="fa fa-caret-right"></i> Compose Mail</a></li>
                                                    <li><a href="mail-single.html"><i class="fa fa-caret-right"></i> Single Mail</a></li>
                                                </ul>
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
                                                    <li><a href=""><i class="fa fa-caret-right"></i> purchase</a></li>
                                                    <li><a href=""><i class="fa fa-caret-right"></i> post</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a role="button" tabindex="0"><i class="fa fa-shopping-cart"></i> <span>Account</span> <span class="label label-success">new</span></a>
                                                <ul>
                                                    <li><a href=""><i class="fa fa-caret-right"></i> Employee</a></li>
                                                    <li><a href=""><i class="fa fa-caret-right"></i> Customer</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a role="button" tabindex="0"><i class="fa fa-table"></i> <span>Product</span></a>
                                            </li>
                                            <li>
                                                <a href="" role="button" tabindex="0"><i class="fa fa-desktop"></i> <span>Project</span></a>
                                            </li>
                                            <li>
                                                <a href="" role="button" tabindex="0"><i class="fa fa-delicious"></i> <span>Chat</span></a>
                                            </li>
                                            <li>
                                                <a href="" role="button" tabindex="0"><i class="fa fa-file-o"></i> <span>Rating product</span> <span class="label label-success">new</span></a>
                                            </li>
                                            <li>
                                                <a href="" role="button" tabindex="0"><i class="fa fa-map-marker"></i> <span>Rating customer</span></a>
                                            </li>
                                            <li>
                                                <a href="" role="button" tabindex="0"><i class="fa fa-magic"></i> <span>Report</span></a>
                                            </li>
                                            <li><a href=""><i class="fa fa-calendar-o"></i> <span>News</span> <span class="label label-success">new events</span></a></li>
                                            <li><a href=""><i class="fa fa-bar-chart-o"></i> <span>Introduce</span></a></li>

                                            <li>
                                                <a href="" role="button" tabindex="0"><i class="fa fa-magic"></i> <span>Slider</span></a>
                                            </li>
                                        </ul>
                                        <!--/ NAVIGATION Content -->
                                    </div>
                                </div>
                            </div>
                            <div class="panel charts panel-default">
                                <div class="panel-heading" role="tab">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#sidebarCharts">
                                            Orders Summary <i class="fa fa-angle-up"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="sidebarCharts" class="panel-collapse collapse in" role="tabpanel">
                                    <div class="panel-body">
                                        <div class="summary">

                                            <div class="media">
                                                <a class="pull-right" role="button" tabindex="0">
                                                    <span class="sparklineChart"
                                                    values="5, 8, 3, 4, 6, 2, 1, 9, 7"
                                                    sparkType="bar"
                                                    sparkBarColor="#92424e"
                                                    sparkBarWidth="6px"
                                                    sparkHeight="36px">
                                                Loading...</span>
                                            </a>
                                            <div class="media-body">
                                                This week sales
                                                <h4 class="media-heading">26, 149</h4>
                                            </div>
                                        </div>

                                        <div class="media">
                                            <a class="pull-right" role="button" tabindex="0">
                                                <span class="sparklineChart"
                                                values="2, 4, 5, 3, 8, 9, 7, 3, 5"
                                                sparkType="bar"
                                                sparkBarColor="#397193"
                                                sparkBarWidth="6px"
                                                sparkHeight="36px">
                                            Loading...</span>
                                        </a>
                                        <div class="media-body">
                                            This week balance
                                            <h4 class="media-heading">318, 651</h4>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel settings panel-default">
                        <div class="panel-heading" role="tab">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#sidebarControls">
                                    General Settings <i class="fa fa-angle-up"></i>
                                </a>
                            </h4>
                        </div>
                        <div id="sidebarControls" class="panel-collapse collapse in" role="tabpanel">
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="row">
                                      <label class="col-xs-8 control-label">Switch ON</label>
                                      <div class="col-xs-4 control-label">
                                        <div class="onoffswitch greensea">
                                          <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch-on" checked="">
                                          <label class="onoffswitch-label" for="switch-on">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                              <label class="col-xs-8 control-label">Switch OFF</label>
                              <div class="col-xs-4 control-label">
                                <div class="onoffswitch greensea">
                                  <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch-off">
                                  <label class="onoffswitch-label" for="switch-off">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>


</aside>
                <!--/ SIDEBAR Content -->