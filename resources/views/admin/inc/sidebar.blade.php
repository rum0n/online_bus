<aside>
    <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            
            @if(Auth::user()->role_id == 1)

            <p class="centered"><a href="{{-- {{ route('admin.admin_profile') }} --}}"><img src="{{asset('admin/admin_picture')}}/default.jpg" class="img-circle" width="80"></a></p>
            <h5 class="centered">{{ Auth::user()->name }}</h5>

            <li class="mt">
                <a class="{{Request::is('admin/dashboard')? 'active':''}}" href="{{route('admin.dashboard')}} ">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sub-menu">
                <a class="{{Request::is('admin/bus')? 'active':''}}" href="{{ route('admin.bus.index') }}">
                    <span>All Bus</span>
                </a>
            </li>

            <li class="sub-menu">
                <a class="{{Request::is('admin/operator')? 'active':''}}" href="{{route('admin.operator.index') }}">
                    <span>All Operator</span>
                </a>
            </li>

            <li class="sub-menu">
                <a class="{{Request::is('admin/schedule')? 'active':''}}" href="{{route('admin.schedule.index') }}">
                    <span>Time Schedule</span>
                </a>
            </li>

            {{-- 
            <li class="sub-menu">
                <a class="{{Request::is('admin/category')? 'active':''}}" href="{{ route('admin.category') }}">
                    <span>Category</span>
                </a>
            </li>

            <li class="sub-menu">
                <a class="{{Request::is('admin/admin_profile')? 'active':''}}" href="{{ route('admin.admin_profile') }}">
                    <span>Edit Profile</span>
                </a>
            </li>
            <li class="sub-menu">
                <a class="{{Request::is('admin/deleted')? 'active':''}}" href="{{ route('admin.deleted') }}">
                    <span>Deleted Posts</span>
                </a>
            </li>
            <li class="sub-menu">
                <a class="{{Request::is('admin/rejected')? 'active':''}}" href="{{ route('admin.rejected_post') }}">
                    <span>Rejected Posts</span>
                </a>
            </li> --}}

            @else
            
                
            @endif

        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>

