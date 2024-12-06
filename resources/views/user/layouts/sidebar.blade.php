<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">@lang('translation.Menu')</li>

                <li>
               
                </li>
                @if(Auth::user()->role_id == App\Models\Role::BUSINESS_ROLE)
                <li>
                    <a href="{{route('business.dashboard')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        {{-- <span class="badge rounded-pill bg-info float-end">04</span> --}}
                        <span key="t-dashboards">@lang('translation.Dashboards')</span>
                    </a>
                    <a href="{{ route('business.user.create') }}" class="">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">New User</span>
                    </a>
                    <a href="{{ route ('business.all.business.staff')}}" class="">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">Business Staff</span>
                    </a>
                    <a href="{{ route ('business.products.list')}}" class="">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">Buy Products</span>
                    </a>
                    <a href="{{ route ('business.myorder.list')}}" class="">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">My Orders</span>
                    </a>
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
                @if(Auth::user()->role_id == App\Models\Role::RESIDENT_ROLE)
                <li>
                    <a href="{{ route('promotional.index') }}" class="">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">Local Promotion</span>
                    </a>
                </li>
                @endif
                @if(Auth::user()->role_id == App\Models\Role::OWNER_ROLE)
                <li>

                    <a href="{{route('owner.dashboard')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        {{-- <span class="badge rounded-pill bg-info float-end">04</span> --}}
                        <span key="t-dashboards">@lang('translation.Dashboards')</span>
                    </a>
                    <a href="{{ route('owner.all.role') }}" class="">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">Role Management</span>
                    </a>
                    <a href="{{ route('owner.user.create') }}" class="">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">New User</span>
                    </a>
                    <a href="{{ route ('owner.all.admin')}}" class="">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">Admins</span>
                    </a>
                    <a href="{{ route ('owner.all.cummiunitystaff')}}" class="">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">Cummiunitystaff</span>
                    </a>
                    <a href="{{ route ('owner.all.business')}}" class="">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">Business</span>
                    </a>
                    <a href="{{ route ('owner.all.business.staff')}}" class="">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">Business Staff</span>
                    </a>
                    <a href="{{ route ('owner.all.property.manager')}}" class="">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">Property Manager</span>
                    </a>
                    <a href="{{ route ('owner.all.property.staff')}}" class="">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">Property Staff</span>
                    </a>
                    <a href="{{ route ('owner.all.resident')}}" class="">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">Resident</span>
                    </a>
                    <a href="{{ route ('owner.products.index')}}" class="">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">Products</span>
                    </a>
                  
                </li>
                @endif
                @if(Auth::user()->role_id == App\Models\Role::ADMIN_ROLE)
                <li>
                    <a href="{{route('admin.dashboard')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        {{-- <span class="badge rounded-pill bg-info float-end">04</span> --}}
                        <span key="t-dashboards">@lang('translation.Dashboards')</span>
                    </a>
                    <a href="{{ route('admin.user.create') }}" class="">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">New User</span>
                    </a>
                    <a href="{{ route ('admin.all.cummiunitystaff')}}" class="">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">Cummiunitystaff</span>
                    </a>
                  
                </li>
                @endif
                @if(Auth::user()->role_id == App\Models\Role::PROPERTY_MANAGER_ROLE)
                <li>
                    <a href="{{route('prop_manager.dashboard')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        {{-- <span class="badge rounded-pill bg-info float-end">04</span> --}}
                        <span key="t-dashboards">@lang('translation.Dashboards')</span>
                    </a>
                    <a href="{{ route('prop_manager.user.create') }}" class="">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">New User</span>
                    </a>
                    <a href="{{ route ('prop_manager.all.property.staff')}}" class="">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">Business Staff</span>
                    </a>
                    <a href="{{ route ('prop_manager.all.resident')}}" class="">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">Resident </span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
