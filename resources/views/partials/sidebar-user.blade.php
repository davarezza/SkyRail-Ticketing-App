<div class="md:col-span-1">
    <div class="sticky top-24 bg-white rounded-lg shadow-lg border-2 border-gray-200/50 backdrop-blur-sm p-4 space-y-4">
        <a href="{{ route('dashboard-user.index') }}"
           class="flex items-center gap-3 p-2 rounded-lg {{ Request::routeIs('dashboard-user.index') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
            <i class="fa-solid fa-user text-lg"></i>
            <span class="font-medium">Account</span>
        </a>
        <a href="{{ route('booking-history.index') }}"
           class="flex items-center gap-3 p-2 rounded-lg {{ Request::routeIs('booking-history.index') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
            <i class="fa-solid fa-box-open text-lg"></i>
            <span>Your Orders</span>
        </a>
    </div>
</div>
