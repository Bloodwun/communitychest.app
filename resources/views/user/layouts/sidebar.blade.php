<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">@lang('translation.Menu')</li>

                <li>
                    <a href="{{route('user.dashboard')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        {{-- <span class="badge rounded-pill bg-info float-end">04</span> --}}
                        <span key="t-dashboards">@lang('translation.Dashboards')</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">@lang('translation.Contacts')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#" key="t-profile">@lang('translation.Profile')</a></li>
                    </ul>
                </li> -->
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
