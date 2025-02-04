<aside id="sidebar">
    <div class="h-100">
        <div class="sidebar-logo">
            <a href="#">{{ config('app.name') }}</a>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-header">Management Data</li>

            <li class="sidebar-item">
                <a href="{{ route('dashboard.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                    <i class='bx bx-list-ul'></i> Dashboard
                </a>
            </li>

            <li class="sidebar-item">
                @php
                    $masterActive = request()->routeIs('master.transportation.index') ||
                                    request()->routeIs('master.transport-class.index') ||
                                    request()->routeIs('master.travel-route.index') ||
                                    request()->routeIs('master.destination.index');
                @endphp
                <a href="#file" class="sidebar-link {{ $masterActive ? '' : 'collapsed' }}" data-bs-toggle="collapse" 
                   role="button" aria-expanded="{{ $masterActive ? 'true' : 'false' }}" aria-controls="file">
                    <i class='bx {{ $masterActive ? "bxs-folder-open" : "bxs-file" }} pe-2'></i> Master Data
                </a>
                <ul id="file" class="sidebar-dropdown list-unstyled collapse {{ $masterActive ? 'show' : '' }}" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="{{ route('master.transportation.index') }}" class="sidebar-link {{ request()->routeIs('master.transportation.index') ? 'active' : '' }}">Transportation</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('master.transport-class.index') }}" class="sidebar-link {{ request()->routeIs('master.transport-class.index') ? 'active' : '' }}">Trans Class</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('master.travel-route.index') }}" class="sidebar-link {{ request()->routeIs('master.travel-route.index') ? 'active' : '' }}">Travel Route</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('master.destination.index') }}" class="sidebar-link {{ request()->routeIs('master.destination.index') ? 'active' : '' }}">Destination</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-header">Management</li>

            @php
                $userManagementActive = request()->routeIs('master.passenger.index') || request()->routeIs('master.officer.index');
            @endphp
            <li class="sidebar-item">
                <a href="#user" class="sidebar-link {{ $userManagementActive ? '' : 'collapsed' }}" data-bs-toggle="collapse" 
                   role="button" aria-expanded="{{ $userManagementActive ? 'true' : 'false' }}" aria-controls="user">
                    <i class='bx {{ $userManagementActive ? "bxs-user-check" : "bxs-user" }}'></i> User Management
                </a>
                <ul id="user" class="sidebar-dropdown list-unstyled collapse {{ $userManagementActive ? 'show' : '' }}" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="{{ route('master.passenger.index') }}" class="sidebar-link {{ request()->routeIs('master.passenger.index') ? 'active' : '' }}">Passenger</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('master.officer.index') }}" class="sidebar-link {{ request()->routeIs('master.officer.index') ? 'active' : '' }}">Officer</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-header">Operation</li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link"><i class='bx bxs-report'></i> Activity Log</a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link"><i class='bx bxs-cog'></i> Settings</a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('management.role.index') }}" class="sidebar-link {{ request()->routeIs('management.role.index') ? 'active' : '' }}">
                    <i class='bx bx-lock'></i> Role Access
                </a>
            </li>
        </ul>
    </div>
</aside>