 @if (isLogin())
 @php      
 $objUser = getUserLogin();
 @endphp
 @endif       <!-- === HEADER Content === -->
 <section id="header">
    <header class="clearfix">

        <!-- Branding -->
        <div class="branding">
            <a class="brand" href="index-2.html">
                <span><strong>Bất động sản Đà Nẵng</strong></span>
            </a>
            <a role="button" tabindex="0" class="offcanvas-toggle visible-xs-inline"><i class="fa fa-bars"></i></a>
        </div>
        <!-- Right-side navigation -->
        <ul class="nav-right pull-right list-inline">

            <li class="dropdown nav-profile">

                <a href class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{!! asset((empty($objUser->image)) ? '/images/profile.png' : $objUser->image ) !!}" alt="" class="img-circle size-30x30">
                    <span>{!! $objUser->username !!}<i class="fa fa-angle-down"></i></span>
                </a>

                <ul class="dropdown-menu animated littleFadeInRight" role="menu">

                    <li>
                        <a href="{!! route('auth.profile') !!}" role="button" tabindex="0">
                            <span class="badge bg-greensea pull-right">86%</span>
                            <i class="fa fa-user"></i>Profile
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('auth.logout') !!}" role="button" tabindex="0">
                            <i class="fa fa-sign-out"></i>Logout
                        </a>
                    </li>

                </ul>

            </li>

        </ul>

    </header>

</section>
            <!--/ HEADER Content  -->