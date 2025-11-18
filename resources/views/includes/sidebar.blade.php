<style>
    .collapse-item:hover{
        color: black !important;
    }
</style>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">

        <div class="sidebar-brand-text mx-3">Home</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

@if(!Auth::id())
    <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{route('login')}}">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                <span>Login</span></a>
        </li>
    @endif

    <hr class="sidebar-divider">
    <!-- Nav Item - employees -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('employees')}}">
            <span>Employees</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
           aria-expanded="true" aria-controls="collapseTwo">
            {{--            <i class="fas fa-fw fa-cog"></i>--}}
            <span>KPIs Target & Weight</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-primary py-2 collapse-inner rounded" >
                {{--                <h6 class="collapse-header">Custom Components:</h6>--}}
                <a class="collapse-item text-white" href="{{route('fetch_kpis')}}">All Kpis </a>
                <a class="collapse-item text-white" href="{{route('kpis')}}">Set Targets and Weights</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <span>Evaluate</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-primary py-2 collapse-inner rounded" >
                {{--                <h6 class="collapse-header">Custom Components:</h6>--}}
                <a class="collapse-item text-white" href="{{route('fetch_evaluations')}}">All Evaluations</a>
                <a class="collapse-item text-white" href="{{route('evaluate')}}">Create Evaluation</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
           aria-expanded="true" aria-controls="collapseThree">
            <span>Role & Permissions</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class=" bg-primary py-2 collapse-inner rounded "  >
                <a class="collapse-item text-white" href="{{route('get_permissions')}}">Permissions</a>
                <a class="collapse-item text-white" href="{{route('get_Permission_groups')}}">Permission Groups</a>
                <a class="collapse-item text-white" href="{{route('get_roles')}}">Roles</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">
    <li class="nav-item active">
        <a class="nav-link" href="{{route('myEval')}}">
            <span>My Evaluation</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>





