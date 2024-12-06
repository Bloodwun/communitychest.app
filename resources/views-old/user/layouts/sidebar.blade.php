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
                @if(Auth::user()->role_id == App\Models\Role::BUSINESS_ROLE)
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">@lang('translation.Register')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('business.register')}}" key="t-profile">@lang('translation.Add_New')</a></li>
                    <li><a href="{{route('business.user.list')}}" key="t-profile">@lang('translation.list')</a></li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->role_id == App\Models\Role::STAFF_ROLE)
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">@lang('translation.Register')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('staff.register')}}" key="t-profile">@lang('translation.Add_New')</a></li>
                    <li><a href="{{route('staff.user.list')}}" key="t-profile">@lang('translation.list')</a></li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
