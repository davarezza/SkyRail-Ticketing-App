<section class="max-w-screen-lg mx-auto p-6 rounded-2xl border border-extra-light shadow-lg booking__container">
    <div class="flex max-w-2xl mx-auto bg-extra-light rounded-lg booking__nav">
        <span class="flex-1 py-4 px-8 text-lg font-medium text-text-light text-center rounded-lg cursor-pointer">Economy
            Class</span>
        <span
            class="flex-1 py-4 px-8 text-lg font-medium text-white bg-primary rounded-lg text-center cursor-pointer">Business
            Class</span>
        <span class="flex-1 py-4 px-8 text-lg font-medium text-text-light text-center rounded-lg cursor-pointer">First
            Class</span>
    </div>
    <form class="mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="flex items-center gap-4 form__group">
            <span class="p-2 text-2xl text-text-dark bg-extra-light rounded-lg"><i class="ri-map-pin-line"></i></span>
            <div class="w-full input__content">
                <div class="relative input__group">
                    <input type="text"
                        class="w-full py-2 text-base border-b border-primary-color text-text-dark focus:outline-none" />
                    <label
                        class="absolute top-1/2 left-0 transform -translate-y-1/2 text-xl font-medium text-text-dark pointer-events-none transition-all">Location</label>
                </div>
                <p class="text-sm text-text-light mt-2">Where are you going?</p>
            </div>
        </div>
        <div class="flex items-center gap-4 form__group">
            <span class="p-2 text-2xl text-text-dark bg-extra-light rounded-lg"><i class="ri-user-3-line"></i></span>
            <div class="w-full input__content">
                <div class="relative input__group">
                    <input type="number"
                        class="w-full py-2 text-base border-b border-primary-color text-text-dark focus:outline-none" />
                    <label
                        class="absolute top-1/2 left-0 transform -translate-y-1/2 text-xl font-medium text-text-dark pointer-events-none transition-all">Travellers</label>
                </div>
                <p class="text-sm text-text-light mt-2">Add guests</p>
            </div>
        </div>
        <div class="flex items-center gap-4 form__group">
            <span class="p-2 text-2xl text-text-dark bg-extra-light rounded-lg"><i class="ri-calendar-line"></i></span>
            <div class="w-full input__content">
                <div class="relative input__group">
                    <input type="text"
                        class="w-full py-2 text-base border-b border-primary-color text-text-dark focus:outline-none" />
                    <label
                        class="absolute top-1/2 left-0 transform -translate-y-1/2 text-xl font-medium text-text-dark pointer-events-none transition-all">Departure</label>
                </div>
                <p class="text-sm text-text-light mt-2">Add date</p>
            </div>
        </div>
        <div class="flex items-center gap-4 form__group">
            <span class="p-2 text-2xl text-text-dark bg-extra-light rounded-lg"><i class="ri-calendar-line"></i></span>
            <div class="w-full input__content">
                <div class="relative input__group">
                    <input type="text"
                        class="w-full py-2 text-base border-b border-primary-color text-text-dark focus:outline-none" />
                    <label
                        class="absolute top-1/2 left-0 transform -translate-y-1/2 text-xl font-medium text-text-dark pointer-events-none transition-all">Return</label>
                </div>
                <p class="text-sm text-text-light mt-2">Add date</p>
            </div>
        </div>
        <div class="w-full flex justify-center">
            <div class="col-span-1 sm:col-span-2 lg:col-span-1 mt-4">
                <button
                    class="flex items-center justify-center px-8 py-3 text-white bg-primary rounded-full font-medium hover:bg-primary-dark transition duration-300 w-full">
                    <i class="ri-search-line"></i>
                </button>
            </div>
        </div>
    </form>
</section>
