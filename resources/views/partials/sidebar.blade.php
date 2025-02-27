<aside id="sidebar">
    <div class="h-100">
        <div class="sidebar-logo">
            <div class="d-flex items-center justify-content-between">
                <a href="#">{{ config('app.name') }}</a>
                <button class="sidebar-mobile-toggle" id="sidebar-close">
                    <i class="fa-solid fa-x"></i>
                </button>
            </div>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-header">Management Data</li>

            <li class="sidebar-item">
                <a href="{{ route('dashboard.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                    <i class='bx bx-list-ul'></i> Dashboard
                </a>
            </li>

            @canany(['Transportation', 'Transport Class', 'Travel Route', 'Destination'])
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
                    @can('Transportation')
                    <li class="sidebar-item">
                        <a href="{{ route('master.transportation.index') }}" class="sidebar-link {{ request()->routeIs('master.transportation.index') ? 'active' : '' }}">Transportation</a>
                    </li>
                    @endcan
                    @can('Transport Class')
                    <li class="sidebar-item">
                        <a href="{{ route('master.transport-class.index') }}" class="sidebar-link {{ request()->routeIs('master.transport-class.index') ? 'active' : '' }}">Trans Class</a>
                    </li>
                    @endcan
                    @can('Travel Route')
                    <li class="sidebar-item">
                        <a href="{{ route('master.travel-route.index') }}" class="sidebar-link {{ request()->routeIs('master.travel-route.index') ? 'active' : '' }}">Travel Route</a>
                    </li>
                    @endcan
                    @can('Destination')
                    <li class="sidebar-item">
                        <a href="{{ route('master.destination.index') }}" class="sidebar-link {{ request()->routeIs('master.destination.index') ? 'active' : '' }}">Destination</a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcanany

            <li class="sidebar-header">Management</li>

            @canany(['Passenger', 'Officer'])
            @php
                $userManagementActive = request()->routeIs('master.passenger.index') || request()->routeIs('master.officer.index');
            @endphp
            <li class="sidebar-item">
                <a href="#user" class="sidebar-link {{ $userManagementActive ? '' : 'collapsed' }}" data-bs-toggle="collapse"
                role="button" aria-expanded="{{ $userManagementActive ? 'true' : 'false' }}" aria-controls="user">
                    <i class='bx {{ $userManagementActive ? "bxs-user-check" : "bxs-user" }}'></i> User Management
                </a>
                <ul id="user" class="sidebar-dropdown list-unstyled collapse {{ $userManagementActive ? 'show' : '' }}" data-bs-parent="#sidebar">
                    @can('Passenger')
                    <li class="sidebar-item">
                        <a href="{{ route('master.passenger.index') }}" class="sidebar-link {{ request()->routeIs('master.passenger.index') ? 'active' : '' }}">Passenger</a>
                    </li>
                    @endcan
                    @can('Officer')
                    <li class="sidebar-item">
                        <a href="{{ route('master.officer.index') }}" class="sidebar-link {{ request()->routeIs('master.officer.index') ? 'active' : '' }}">Officer</a>
                    </li>
                    @endcan
                </ul>
            </li>
        @endcanany
            <li class="sidebar-item">
                <a href="{{ route('management.manage-booking.index') }}" class="sidebar-link {{ request()->routeIs('management.manage-booking.index') ? 'active' : '' }}"><i class='bx bxs-book'></i> Booking Management</a>
            </li>

            @canany(['Role Access'])
            <li class="sidebar-header">Operation</li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link"><i class='bx bxs-report'></i> Activity Log</a>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link"><i class='bx bxs-cog'></i> Settings</a>
            </li>

            @can('Role Access')
            <li class="sidebar-item">
                <a href="{{ route('management.role.index') }}" class="sidebar-link {{ request()->routeIs('management.role.index') ? 'active' : '' }}">
                    <i class='bx bx-lock'></i> Role Access
                </a>
            </li>
            @endcan
        @endcanany
        </ul><br><br>
    </div>
</aside>
