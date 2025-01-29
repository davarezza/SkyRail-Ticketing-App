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
                <a href="#file" class="sidebar-link collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="file">
                    <i class='bx bxs-file pe-2'></i> Master Data
                </a>
                <ul id="file" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="{{ route('master.transportation.index') }}" class="sidebar-link">Transportation</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('master.travel-route.index') }}" class="sidebar-link">Travel Route</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('master.destination.index') }}" class="sidebar-link">Destination</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Discount Coupon</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Ticket</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('master.officer.index') }}" class="sidebar-link">Officer</a>
                    </li>
                </ul>
            </li>          
            <li class="sidebar-item">
                <a href="#" class="sidebar-link"><i class='bx bxs-megaphone'></i> Promo Campaigns</a>
            </li>

            <li class="sidebar-header">
                Management
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link"><i class='bx bxs-plane-alt'></i> Airplane Tickets</a>
            </li>
            <li class="sidebar-item">
                <a href="#user" class="sidebar-link collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="user">
                    <i class='bx bxs-user'></i> User Management
                </a>
                <ul id="user" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="{{ route('master.passenger.index') }}" class="sidebar-link">Passenger</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('master.officer.index') }}" class="sidebar-link">Officer</a>
                    </li>
                </ul>
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
                <a href="{{ route('management.role.index') }}" class="sidebar-link"><i class='bx bx-lock'></i> Role Access</a>
            </li>
        </ul>
    </div>
</aside>