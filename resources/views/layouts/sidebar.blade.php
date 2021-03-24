
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background: #0C5F01;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <img style="width: 50px;" src="{{asset('img/logo.png')}}" alt="bootstraper logo">
        </div>
        <div class="sidebar-brand-text mx-3">SRAPS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    
    <?php
        $user_type = app\Helpers\base::getUserType();
     ?>

    @if($user_type == 0)
        @include('layouts.sidebar-admin')
    @elseif($user_type == 3)
        @include('layouts.sidebar-librarian')
    @else
    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/book-search') }}">
            <i class="fas fa-fw fa-search"></i>
            <span>Book Search</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/reserve-book') }}">
            <i class="fas fa-fw fa-bookmark"></i>
            <span>Reserve</span></a>
    </li>
    @endif

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->