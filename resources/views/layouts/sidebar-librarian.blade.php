 <!-- Nav Item - Dashboard -->
 <li class="nav-item">
    <a class="nav-link" href="index.html">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#visitor"
        aria-expanded="true" aria-controls="visitor">
        <i class="fas fa-door-open"></i>
        <span>Visitor's Log</span>
    </a>
    <div id="visitor" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ url('/visitors-log-admin') }}">Admin Interface</a>
            <a class="collapse-item" href="{{ url('/visitors-log') }}">Student Interface</a>
        </div>
    </div>
</li>

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
                <a class="collapse-item" href="{{ url('/approve-reservation') }}">Approve</a>
                <a class="collapse-item" href="{{ url('/for-release') }}">For Release</a>
                <a class="collapse-item" href="{{ url('/borrow-book') }}">Borrow</a>
                <a class="collapse-item" href="{{ url('/return-book') }}">Return</a>
                <a class="collapse-item" href="{{ url('/penalty-payment') }}">Penalty payment</a>
            </div>
        </div>
    </li>

     <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#reports"
            aria-expanded="true" aria-controls="reports">
            <i class="fas fa-fw fa-print"></i>
            <span>Reports</span>
        </a>
        <div id="reports" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('/borrowed-report') }}">Borrowed</a>
                <a class="collapse-item" href="{{ url('/returned-report') }}">Returned</a>
                <a class="collapse-item" href="{{ url('/overdue-report') }}">Overdue</a>
                <a class="collapse-item" href="{{ url('/unreturned-report') }}">Unreturned</a>
                <a class="collapse-item" href="{{ url('/loss-report') }}">Loss book</a>
                <a class="collapse-item" href="{{ url('/weed-report') }}">Weed book list</a>
                <a class="collapse-item" href="{{ url('/penalty-report') }}">List of penalty</a>
                <a class="collapse-item" href="{{ url('/visitors-log-report') }}">Visitor's log</a>
            </div>
        </div>
    </li>

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