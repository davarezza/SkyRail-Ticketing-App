<div class="modal fade" tabindex="-1" id="modal-add-travel-route" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-sm rounded-3 border-0">
            <form id="form-add-travel-route" method="POST">
                @csrf
                <input type="hidden" name="id" id="id" value="">

                <div
                    class="modal-header d-flex justify-content-between bg-light py-3 px-4 border-bottom-0 rounded-top-3">
                    <h5 class="modal-title fs-5 fw-medium" id="title-form-travel-route">Add Travel Route</h5>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                        onclick="toggleAddTravelRoute(false)">
                        <i class="ki-outline ki-cross fs-3"></i>
                    </div>
                </div>

                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="fv-row mb-4">
                                <label for="travel-route-objective" class="form-label fs-9 fw-medium mb-2">Objective City</label>
                                <input type="text" class="form-control bg-light-subtle" id="travel-route-objective"
                                    name="travel-route-objective" placeholder="Enter objective" autocomplete="off"
                                    style="--bs-bg-opacity: .6;" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fv-row mb-4">
                                <label for="travel-route-first-route" class="form-label fs-9 fw-medium mb-2">Departure City</label>
                                <input type="text" class="form-control bg-light-subtle" id="travel-route-first-route"
                                    name="travel-route-first-route" placeholder="Enter Departure City" autocomplete="off"
                                    style="--bs-bg-opacity: .6;" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="fv-row mb-4">
                                <label for="travel-route-objective-airport" class="form-label fs-9 fw-medium mb-2">Objective Airport</label>
                                <input type="text" class="form-control bg-light-subtle" id="travel-route-objective-airport"
                                    name="travel-route-objective-airport" placeholder="Enter Objective Airport" autocomplete="off"
                                    style="--bs-bg-opacity: .6;" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fv-row mb-4">
                                <label for="travel-route-first-route-airport" class="form-label fs-9 fw-medium mb-2">Departure Airport</label>
                                <input type="text" class="form-control bg-light-subtle" id="travel-route-first-route-airport"
                                    name="travel-route-first-route-airport" placeholder="Enter Departure Airport" autocomplete="off"
                                    style="--bs-bg-opacity: .6;" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="fv-row mb-4">
                                <label class="form-label fs-9 fw-medium mb-2 required">Departure Date & Time</label>
                                <div class="d-flex gap-2">
                                    <input type="date" class="form-control bg-light-subtle" id="travel-route-departure-date"
                                        name="travel-route-departure-date" autocomplete="off" style="--bs-bg-opacity: .6;" />
                                    <input type="time" class="form-control bg-light-subtle" id="travel-route-departure-time"
                                        name="travel-route-departure-time" autocomplete="off" style="--bs-bg-opacity: .6;" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fv-row mb-4">
                                <label for="travel-route-arrival-time" class="form-label fs-9 fw-medium mb-2">Arrival Time</label>
                                <input type="time" class="form-control bg-light-subtle" id="travel-route-arrival-time"
                                    name="travel-route-arrival-time" autocomplete="off" style="--bs-bg-opacity: .6;" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="fv-row mb-4">
                                <label for="transport-id" class="form-label fs-9 fw-medium mb-2 required">Transport Name</label>
                                <select class="form-select bg-light-subtle" id="transport-id" name="transport-id" style="--bs-bg-opacity: .6;">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fv-row mb-4">
                                <label for="travel-route-price" class="form-label fs-9 fw-medium mb-2">Price (IDR)</label>
                                <input type="text" class="form-control bg-light-subtle" id="travel-route-price"
                                    name="travel-route-price" placeholder="Enter Price" autocomplete="off" style="--bs-bg-opacity: .6;" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-top-0 px-3 pb-3 pt-0">
                    <button type="button" class="btn btn-light px-3 py-2" onclick="toggleAddTravelRoute(false)">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary px-4 py-2" id="btn-save-travel-route">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modal-detail-travel-route" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-sm rounded-3 border-0">
            <div class="modal-header d-flex justify-content-between bg-light py-3 px-4 border-bottom-0 rounded-top-3">
                <h5 class="modal-title fs-5 fw-medium" id="modal-title-detail-travel-route">Detail Travel Route</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" onclick="toggleDetailTravelRoute(false)">
                    <i class="ki-outline ki-cross fs-3"></i>
                </div>
            </div>
            <div class="modal-body p-4">
                <div class="row mb-4">
                    <div class="col-4">
                        <p class="fw-bold mb-1">Objective City</p>
                        <p class="text-gray-700" id="detail-objective"></p>
                    </div>
                    <div class="col-4">
                        <p class="fw-bold mb-1">Departure City</p>
                        <p class="text-gray-700" id="detail-first-route"></p>
                    </div>
                    <div class="col-4">
                        <p class="fw-bold mb-1">Price</p>
                        <p class="text-gray-700" id="detail-price"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <p class="fw-bold mb-1">Departure Date</p>
                        <p class="text-gray-700" id="detail-departure-date"></p>
                    </div>
                    <div class="col-4">
                        <p class="fw-bold mb-1">Departure Time</p>
                        <p class="text-gray-700" id="detail-departure-time"></p>
                    </div>
                    <div class="col-4">
                        <p class="fw-bold mb-1">Arrival Time</p>
                        <p class="text-gray-700" id="detail-arrival-time"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0 px-3 pb-3 pt-0">
                <button type="button" class="btn btn-light px-3 py-2" onclick="toggleDetailTravelRoute(false)">Close</button>
            </div>
        </div>
    </div>
</div>
