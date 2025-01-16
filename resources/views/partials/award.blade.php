<section class="grid grid-cols-1 lg:grid-cols-2 gap-8 px-6 max-w-screen-lg mx-auto py-12 mb-8 lounge__container">
    <div class="relative lounge__image">
        <img class="absolute top-1/2 left-1/2 rounded-full shadow-lg w-[200px] sm:w-[250px] lg:w-[300px] transform -translate-x-[calc(50%+2rem)] sm:-translate-x-[calc(50%+3rem)] -translate-y-1/2"
            src="{{ asset('assets/img/lounge-1.jpg') }}" alt="lounge" />
        <img class="absolute top-1/2 left-1/2 rounded-full shadow-lg w-[150px] sm:w-[200px] lg:w-[250px] transform -translate-x-[calc(50%-4rem)] sm:-translate-x-[calc(50%-6rem)] -translate-y-[calc(50%-6rem)]"
            src="{{ asset('assets/img/lounge-2.jpg') }}" alt="lounge" />
    </div>
    <div class="lounge__content">
        <h2 class="text-3xl md:text-4xl font-semibold mb-6 section__header">Unaccompanied Minor Lounge</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8 lounge__grid">
            <div class="lounge__details">
                <h4 class="text-xl font-semibold mb-2 text-text-dark">Experience Tranquility</h4>
                <p class="text-text-light">Serenity Haven offers a tranquil escape, featuring comfortable seating,
                    calming ambiance, and attentive service.</p>
            </div>
            <div class="lounge__details">
                <h4 class="text-xl font-semibold mb-2 text-text-dark">Elevate Your Experience</h4>
                <p class="text-text-light">Designed for discerning travelers, this exclusive lounge offers premium
                    amenities, assistance, and private workspaces.</p>
            </div>
            <div class="lounge__details">
                <h4 class="text-xl font-semibold mb-2 text-text-dark">A Welcoming Space</h4>
                <p class="text-text-light">Creating a family-friendly atmosphere, The Family Zone is the perfect haven
                    for parents and children.</p>
            </div>
            <div class="lounge__details">
                <h4 class="text-xl font-semibold mb-2 text-text-dark">A Culinary Delight</h4>
                <p class="text-text-light">Immerse yourself in a world of flavors, offering international cuisines,
                    gourmet dishes, and carefully curated beverages.</p>
            </div>
        </div>
    </div>
</section>

<section class="px-6 max-w-screen-lg mx-auto py-12 travellers__container">
    <h2 class="text-3xl md:text-4xl font-semibold text-center mb-12 section__header">Best travellers of the month</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 travellers__grid">
        <div class="bg-white rounded-[50px] overflow-hidden shadow-lg travellers__card">
            <img class="w-full" src="{{ asset('assets/img/traveller-1.jpg') }}" alt="traveller" />
            <div class="relative text-center py-8 travellers__card__content">
                <img class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[60px] sm:w-[70px] border-4 border-extra-light rounded-full"
                    src="{{ asset('assets/img/client-1.jpg') }}" alt="client" />
                <h4 class="text-xl font-semibold text-text-dark mt-12">Emily Johnson</h4>
                <p class="font-medium text-text-light">Dubai</p>
            </div>
        </div>
        <div class="bg-white rounded-[50px] overflow-hidden shadow-lg travellers__card">
            <img class="w-full" src="{{ asset('assets/img/traveller-1.jpg') }}" alt="traveller" />
            <div class="relative text-center py-8 travellers__card__content">
                <img class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[60px] sm:w-[70px] border-4 border-extra-light rounded-full"
                    src="{{ asset('assets/img/client-1.jpg') }}" alt="client" />
                <h4 class="text-xl font-semibold text-text-dark mt-12">Emily Johnson</h4>
                <p class="font-medium text-text-light">Dubai</p>
            </div>
        </div>
        <div class="bg-white rounded-[50px] overflow-hidden shadow-lg travellers__card">
            <img class="w-full" src="{{ asset('assets/img/traveller-1.jpg') }}" alt="traveller" />
            <div class="relative text-center py-8 travellers__card__content">
                <img class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[60px] sm:w-[70px] border-4 border-extra-light rounded-full"
                    src="{{ asset('assets/img/client-1.jpg') }}" alt="client" />
                <h4 class="text-xl font-semibold text-text-dark mt-12">Emily Johnson</h4>
                <p class="font-medium text-text-light">Dubai</p>
            </div>
        </div>
        <div class="bg-white rounded-[50px] overflow-hidden shadow-lg travellers__card">
            <img class="w-full" src="{{ asset('assets/img/traveller-1.jpg') }}" alt="traveller" />
            <div class="relative text-center py-8 travellers__card__content">
                <img class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[60px] sm:w-[70px] border-4 border-extra-light rounded-full"
                    src="{{ asset('assets/img/client-1.jpg') }}" alt="client" />
                <h4 class="text-xl font-semibold text-text-dark mt-12">Emily Johnson</h4>
                <p class="font-medium text-text-light">Dubai</p>
            </div>
        </div>
    </div>
</section>
