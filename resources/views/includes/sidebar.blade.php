

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

    {{--    evaluate page--}}
    <li class="nav-item active">
        <a class="nav-link" href="{{route('kpis')}}">
            <span>KPIs Target & Weight</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

{{--    evaluate page--}}
    <li class="nav-item active">
        <a class="nav-link" href="{{route('evaluate')}}">
            <span>Evaluate</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>





