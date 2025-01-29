<div class="modal fade" tabindex="-1" id="modal-detail-passenger" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-sm rounded-3 border-0">
            <div class="modal-header bg-light py-3 px-4 border-bottom-0 rounded-top-3">
                <h5 class="modal-title fs-5 fw-medium" id="modal-title-detail-passenger">Detail Passenger</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" onclick="toggleDetailPassenger(false)">
                    <i class="ki-outline ki-cross fs-3"></i>
                </div>
            </div>
            <div class="modal-body p-4">
                <!-- Row 1: Name, Code, Type -->
                <div class="row mb-4">
                    <div class="col-3">
                        <p class="fw-bold mb-1">Name</p>
                        <p class="text-gray-700" id="detail-name"></p>
                    </div>
                    <div class="col-3">
                        <p class="fw-bold mb-1">Username</p>
                        <p class="text-gray-700" id="detail-username"></p>
                    </div>
                    <div class="col-3">
                        <p class="fw-bold mb-1">Email</p>
                        <p class="text-gray-700" id="detail-email"></p>
                    </div>
                </div>
                <!-- Row 2: Total Seat, Description -->
                <div class="row">
                    <div class="col-3">
                        <p class="fw-bold mb-1">Address</p>
                        <p class="text-gray-700" id="detail-address"></p>
                    </div>
                    <div class="col-3">
                        <p class="fw-bold mb-1">Birth Date</p>
                        <p class="text-gray-700" id="detail-birth-date"></p>
                    </div>
                    <div class="col-3">
                        <p class="fw-bold mb-1">Gender</p>
                        <p class="text-gray-700" id="detail-gender"></p>
                    </div>
                    <div class="col-3">
                        <p class="fw-bold mb-1">Telephone</p>
                        <p class="text-gray-700" id="detail-telephone"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0 px-3 pb-3 pt-0">
                <button type="button" class="btn btn-light px-3 py-2" onclick="toggleDetailPassenger(false)">Close</button>
            </div>
        </div>
    </div>
</div>