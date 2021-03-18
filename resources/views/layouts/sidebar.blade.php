
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
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Transaction Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Transaction"
                aria-expanded="true" aria-controls="Transaction">
                <i class="fas fa-book"></i>
                <span>Transaction</span>
            </a>
            <div id="Transaction" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ url('/book-search') }}">Book Search</a>
                    <a class="collapse-item" href="{{ url('/reserve-book') }}">Reserve</a>
                    <a class="collapse-item" href="{{ url('/weed-maintenance') }}">Approve</a>
                    <a class="collapse-item" href="{{ url('/penalty-maintenance') }}">Borrow</a>
                    <a class="collapse-item" href="{{ url('/penalty-maintenance') }}">Return</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Maintenance</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ url('/book-maintenance') }}">Book</a>
                    <a class="collapse-item" href="{{ url('/category-maintenance') }}">Category</a>
                    <a class="collapse-item" href="{{ url('/weed-maintenance') }}">Weed book</a>
                    <a class="collapse-item" href="{{ url('/penalty-maintenance') }}">Penalty</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Utilities</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ url('/user-maintenance') }}">User Maintenance</a>
                    <a class="collapse-item" href="utilities-border.html">Audit Trail</a>
                    <a class="collapse-item" href="utilities-border.html">Archive</a>
                </div>
            </div>
        </li>
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