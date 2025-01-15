<div class="modal fade" tabindex="-1" id="modal-add-travel-route" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-sm rounded-3 border-0">
            <form id="form-add-travel-route" method="POST">
                @csrf
                <input type="hidden" name="id" id="id" value="">
                
                <div class="modal-header bg-light py-3 px-4 border-bottom-0 rounded-top-3">
                    <h5 class="modal-title fs-5 fw-medium" id="title-form-travel-route">Add Travel Route</h5>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" onclick="toggleAddTravelRoute(false)">
                        <i class="ki-outline ki-cross fs-3"></i>
                    </div>
                </div>

                <div class="modal-body p-4">
                    <div class="fv-row mb-4">
                        <label for="travel-route-objective" class="form-label fs-9 fw-medium mb-2">Objective Route</label>
                        <input type="text" 
                               class="form-control bg-light-subtle" 
                               id="travel-route-objective" 
                               name="travel-route-objective" 
                               placeholder="Enter objective" 
                               autocomplete="off"
                               style="--bs-bg-opacity: .6;" />
                    </div>

                    <div class="fv-row mb-4">
                        <label for="travel-route-first-route" class="form-label fs-9 fw-medium mb-2">First Route</label>
                        <input type="text" 
                               class="form-control bg-light-subtle" 
                               id="travel-route-first-route" 
                               name="travel-route-first-route" 
                               placeholder="Enter First Route" 
                               autocomplete="off"
                               style="--bs-bg-opacity: .6;" />
                    </div>

                    <div class="fv-row mb-4">
                        <label for="transport-id" class="form-label fs-9 fw-medium mb-2 required">Transport Name</label>
                        <select class="form-select bg-light-subtle" 
                                id="transport-id" 
                                name="transport-id"
                                style="--bs-bg-opacity: .6;">
                        </select>
                    </div>

                    <div class="fv-row mb-4">
                        <label for="travel-route-price"" class="form-label fs-9 fw-medium mb-2">Price (Rp)</label>
                        <input type="text" 
                               class="form-control bg-light-subtle" 
                               id="travel-route-price" 
                               name="travel-route-price"" 
                               placeholder="Enter Price" 
                               autocomplete="off"
                               style="--bs-bg-opacity: .6;" />
                    </div>
                </div>

                <div class="modal-footer border-top-0 px-3 pb-3 pt-0">
                    <button type="button" 
                            class="btn btn-light px-3 py-2" 
                            onclick="toggleAddTravelRoute(false)">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="btn btn-primary px-4 py-2" 
                            id="btn-save-travel-route">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>