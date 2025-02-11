<div id="modal-detail-facilities" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg w-full max-w-2xl mx-4 relative max-h-[90vh] flex flex-col">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 flex-shrink-0">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Fasilitas Penerbangan</h2>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 cursor-pointer" onclick="toggleDetailFacilities(false)">
                    <i class="ki-outline ki-cross text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="px-6 py-4 overflow-y-auto flex-grow">
            <!-- Airline Info -->
            <div class="flex items-center gap-3 mb-6">
                <img src="/citilink-logo.png" alt="Citilink logo" class="w-6 h-6">
                <div class="flex flex-col items-start gap-1">
                    <div class="font-medium">Citilink</div>
                    <div class="text-gray-500">
                        <span>QG-720</span>
                        <span>•</span>
                        <span>Ekonomi</span>
                        <span>•</span>
                        <span>1j 40m</span>
                    </div>
                </div>
            </div>

            <!-- Included Features -->
            <div class="space-y-6">
                <h3 class="font-semibold text-gray-800 mb-4">Tiket Sudah Termasuk</h3>
                
                <!-- Baggage -->
                <div class="space-y-2">
                    <div class="flex items-start gap-3">
                        <span class="text-gray-500">🧳</span>
                        <div>
                            <div class="font-medium">Kabin: 7 kg</div>
                            <div class="text-gray-700">Bagasi: 15 kg</div>
                            <p class="text-gray-500 text-sm mt-1">
                                Pembelian bagasi tambahan tersedia di halaman pemesanan. *Ketersediaan tergantung pihak maskapai.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Meals -->
                <div class="flex items-start gap-3">
                    <span class="text-gray-500">🍽️</span>
                    <div>
                        <div class="font-medium">Tidak termasuk makanan</div>
                        <p class="text-gray-500 text-sm mt-1">
                            Tambah di halaman pemesanan. *Ketersediaan tergantung pihak maskapai.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>