<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">@lang('translation.Menu')</li>

                <li>
                    <a href="{{route('admin.dashboard')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        {{-- <span class="badge rounded-pill bg-info float-end">04</span> --}}
                        <span key="t-dashboards">@lang('translation.Dashboards')</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">@lang('translation.email_marketing')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.marketing.create')}}" key="t-user-list">@lang('translation.marketing_send')</a></li>
                        <li><a href="{{route('admin.marketing.index')}}" key="t-profile">@lang('translation.marketing_list')</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('admin.warmup')}}" class="">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">@lang('translation.warmup_setting')</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.inbox')}}" class="">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">@lang('translation.inbox')</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.unsubscriber.list')}}" class="">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">@lang('translation.unsubscriber')</span>
                    </a>
                </li> -->
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
