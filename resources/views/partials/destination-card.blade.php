<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
    <div class="w-full max-w-sm overflow-hidden rounded-xl shadow-lg transition-all duration-300 hover:scale-105">
        <div class="relative group">
            <a href="{{ $dest->link }}" target="_blank" class="cursor-pointer overflow-hidden block">
                <img 
                    src="{{ asset('assets/img/destination/' . $dest->image) }}" 
                    alt="Azores Landscape" 
                    class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110"
                />
            </a>
            <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent">
                <h2 class="text-2xl font-bold text-white mb-1">{{ $dest->name }}</h2>
                <div class="flex items-center gap-2">
                    <svg class="h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2C8.686 2 6 4.686 6 8c0 5.25 6 12 6 12s6-6.75 6-12c0-3.314-2.686-6-6-6zM12 10a2 2 0 110-4 2 2 0 010 4z"/>
                    </svg>
                    <span class="text-sm text-gray-200">{{ $dest->location }}</span>
                </div>
            </div>
            <div class="absolute top-4 right-4 bg-yellow-400 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-lg">
                {{ $dest->popularity }}/5
            </div>
        </div>
        <div class="p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-1">
                    @for ($i = 1; $i <= $dest->popularity; $i++)
                        <svg class="h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 17l-5 3 1.9-5.7L4 10h6l2-6 2 6h6l-4.9 3.3L17 20l-5-3z"/>
                        </svg>
                    @endfor
                    @for ($i = $dest->popularity + 1; $i <= 5; $i++)
                        <svg class="h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 17l-5 3 1.9-5.7L4 10h6l2-6 2 6h6l-4.9 3.3L17 20l-5-3z"/>
                        </svg>
                    @endfor
                </div>
            </div>
        </div>
    </div>    
</div>