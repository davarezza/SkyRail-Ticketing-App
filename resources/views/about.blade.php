@extends('layouts.main')

@section('title')
    <title>Home | {{ config('app.name') }}</title>
@endsection

@push('styles')
<style>
    #toast-container {
        top: 1rem;
        opacity: 1;
    }
</style>
@endpush

@section('container')
    <section class="px-6 max-w-screen-lg mx-auto pt-24">
        <div class="grid md:grid-cols-2 gap-8 items-center mb-16">
            <div class="space-y-6">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900">
                    Taking You to New Heights
                </h1>
                <p class="text-gray-600 leading-relaxed">
                    At SkyFlight, we believe in the thrill of exploration and the joy of travel. With a dedicated team and a passion for service, we work closely with our clients to provide seamless and enjoyable flight booking experiences. Join us as we connect you to destinations worldwide.
                </p>
            </div>

            <div class="relative">
                <img src="{{ asset('assets/img/about-1.jpg') }}" alt="Airplane taking off"
                     class="w-full rounded-lg">

                <div class="absolute -bottom-6 -left-8 bg-white rounded-full p-2">
                    <div class="w-28 h-28 flex items-center justify-center border rounded-full">
                        <img src="{{ asset('assets/img/logo.png') }}" class="rounded-full">
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="text-lg md:text-xl text-gray-800 mb-4">
                At SkyFlight, we are dedicated to transforming the travel experience with efficient, reliable, and affordable flight booking services.
            </p>
            <p class="text-gray-600">
                With a strong reputation for delivering outstanding travel solutions, we leverage cutting-edge technology, expert knowledge, and customer-focused approaches to make your journey seamless and enjoyable.
            </p>
        </div>

        {{-- Statistic Section --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center mb-24">
            <div class="space-y-2">
                <h3 class="text-3xl md:text-4xl font-bold text-gray-900">10+</h3>
                <p class="text-sm text-gray-600">Years of Experience</p>
            </div>
            <div class="space-y-2">
                <h3 class="text-3xl md:text-4xl font-bold text-gray-900">500+</h3>
                <p class="text-sm text-gray-600">International Routes</p>
            </div>
            <div class="space-y-2">
                <h3 class="text-3xl md:text-4xl font-bold text-gray-900">24/7</h3>
                <p class="text-sm text-gray-600">Customer Support</p>
            </div>
            <div class="space-y-2">
                <h3 class="text-3xl md:text-4xl font-bold text-gray-900">98%</h3>
                <p class="text-sm text-gray-600">Satisfaction</p>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-8 items-center mb-24">
            <div class="relative">
                <div class="rounded-lg overflow-hidden">
                    <img src="{{ asset('assets/img/about-2.jpg') }}" alt="Blueprint" class="w-[475px] h-[450px] rounded-lg object-cover">
                </div>
                <div class="absolute bottom-8 left-[350px] w-[200px] bg-white rounded-lg p-2">
                    <img src="{{ asset('assets/img/about-3.jpg') }}" alt="Construction Worker"
                        class="rounded-lg shadow-lg">
                </div>
            </div>

            {{-- Mission Section --}}
            <div class="space-y-8">
                <h2 class="text-3xl md:text-4xl font-bold">Our Mission</h2>
                <p class="text-gray-600 leading-relaxed">
                    To provide efficient, reliable, and cost-effective solutions for air travel, creating a seamless experience for our customers. We strive to be the leading online travel agency, offering a wide selection of flights, hotels, and car rentals, while continuously improving our services and technology to meet the evolving needs of our customers.
                </p>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-plane text-blue-500"></i>
                        <span class="text-gray-700">Connecting You to the World</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-rocket text-blue-500"></i>
                        <span class="text-gray-700">Innovating for a Seamless Experience</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-user-friends text-blue-500"></i>
                        <span class="text-gray-700">Customer-Centric Approach</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-building text-blue-500"></i>
                        <span class="text-gray-700">Building Stronger Relationships</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Vision Section --}}
        <div class="grid md:grid-cols-2 gap-8 items-center">
            <div class="space-y-8">
                <h2 class="text-3xl md:text-4xl font-bold">Our Vision</h2>
                <p class="text-gray-600 leading-relaxed">
                    To lead the airline ticket sales industry by providing unmatched convenience and affordability. We aim to redefine travel experiences through innovative booking solutions and exceptional customer service, creating memories that last a lifetime.
                </p>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-plane-departure text-blue-500"></i>
                        <span class="text-gray-700">Setting New Standards in Air Travel</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-ticket-alt text-blue-500"></i>
                        <span class="text-gray-700">Simplifying Ticket Booking</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-globe text-blue-500"></i>
                        <span class="text-gray-700">Connecting Global Destinations</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-smile text-blue-500"></i>
                        <span class="text-gray-700">Enhancing Customer Satisfaction</span>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="rounded-lg overflow-hidden">
                    <img src="{{ asset('assets/img/about-4.jpg') }}" alt="Airplane" class=" w-[550px] h-[450px] rounded-lg object-cover">
                </div>
                <div class="hidden md:block absolute bottom-8 -left-8 w-[250px] bg-white rounded-lg p-2">
                    <img src="{{ asset('assets/img/about-5.jpg') }}" alt="Travel Planning"
                        class="rounded-lg shadow-lg">
                </div>
            </div>
        </div>

        {{-- How We Do Work Section --}}
        <div class="text-center max-w-3xl mx-auto my-12 space-y-4">
            <h2 class="text-3xl md:text-4xl font-bold">How We Book Your Flights</h2>
            <p class="text-gray-600">
                We follow a collaborative and transparent process, ensuring clear communication and expert execution at every stage of the booking process. From initial request to final ticket delivery.
            </p>
        </div>

        {{-- Video Section --}}
        <div class="relative rounded-2xl overflow-hidden w-full h-[600px] mb-12 shadow-lg border-2 border-gray-200/50 backdrop-blur-sm">
            <div class="relative cursor-pointer video-thumbnail h-full">
                <img
                    src="https://img.youtube.com/vi/OkORKVBajLA/maxresdefault.jpg"
                    alt="Ticket Booking Process Video"
                    class="w-full h-full object-cover"
                >
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-16 h-16 md:w-20 md:h-20 bg-blue-400 rounded-full flex items-center justify-center cursor-pointer hover:bg-blue-500 transition-colors duration-300">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="hidden absolute inset-0 w-full h-full youtube-iframe">
                <iframe
                    width="100%"
                    height="100%"
                    src=""
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    $(function() {
        const $videoThumbnail = $('.video-thumbnail');
        const $youtubeIframe = $('.youtube-iframe');
        const $iframe = $youtubeIframe.find('iframe');

        const videoId = 'OkORKVBajLA';

        $videoThumbnail.on('click', function() {
            $iframe.attr('src', `https://www.youtube.com/embed/${videoId}?autoplay=1`);

            $videoThumbnail.addClass('hidden');
            $youtubeIframe.removeClass('hidden');
        });
    });
</script>
@endpush
