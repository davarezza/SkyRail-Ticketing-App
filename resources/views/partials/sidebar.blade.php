<aside id="sidebar">
    {{-- Sidebar Content --}}
    <div class="h-100">
        <div class="sidebar-logo">
            <a href="#">{{ config('app.name') }}</a>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Management Data
            </li>
            <li class="sidebar-item">
                <a href="{{ route('dashboard.index') }}" class="sidebar-link"><i class='bx bx-list-ul'></i> Dashboard</a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed" data-bs-target="#user" data-bs-toggle="collapse" aria-expanded="false"><i class='bx bxs-file pe-2'></i> Master Data</a>
                <ul id="user" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Transportation</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Travel Route</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Discount Coupon</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Ticket</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Officer</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link"><i class='bx bxs-megaphone'></i> Promo Campaigns</a>
            </li>

            <li class="sidebar-header">
                Booking Management
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link"><i class='bx bxs-plane-alt'></i> Airplane Tickets</a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link"><i class='bx bxs-train'></i> Train Tickets</a>
            </li>
            <li class="sidebar-header">
                Analytics & Reports
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link"><i class='bx bxs-bar-chart-alt-2'></i> Sales Overview</a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link"><i class='bx bx-line-chart'></i> Popular Routes</a>
            </li>
                     
            <li class="sidebar-header">
                Operation
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link"><i class='bx bxs-report'></i> Activity Log</a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link"><i class='bx bxs-cog'></i> Settings</a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link"><i class='bx bx-lock'></i> Role Access</a>
            </li>
        </ul>
    </div>
</aside>