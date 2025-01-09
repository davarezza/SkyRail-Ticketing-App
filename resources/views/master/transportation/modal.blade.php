<div class="modal fade" tabindex="-1" id="modal-add-transport" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-sm rounded-3 border-0">
            <form id="form-add-transport" method="POST">
                @csrf
                <input type="hidden" name="id" id="id" value="">
                
                <div class="modal-header bg-light py-3 px-4 border-bottom-0 rounded-top-3">
                    <h5 class="modal-title fs-5 fw-medium" id="title-form-transport">Add Transportation</h5>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" onclick="toggleAddTransport(false)">
                        <i class="ki-outline ki-cross fs-3"></i>
                    </div>
                </div>

                <div class="modal-body p-4">
                    <div class="fv-row mb-4">
                        <label for="transport-name" class="form-label fs-9 fw-medium mb-2">Transportation Name</label>
                        <input type="text" 
                               class="form-control bg-light-subtle" 
                               id="transport-name" 
                               name="transport-name" 
                               placeholder="Enter transportation name" 
                               autocomplete="off"
                               style="--bs-bg-opacity: .6;" />
                    </div>

                    <div class="fv-row mb-4">
                        <label for="transport-code" class="form-label fs-9 fw-medium mb-2">Transportation Code</label>
                        <input type="text" 
                               class="form-control bg-light-subtle" 
                               id="transport-code" 
                               name="transport-code" 
                               placeholder="Enter code" 
                               autocomplete="off"
                               style="--bs-bg-opacity: .6;" />
                    </div>

                    <div class="fv-row mb-4">
                        <label for="transport-type" class="form-label fs-9 fw-medium mb-2 required">Transportation Type</label>
                        <button class="btn btn-icon btn-active-color-muted ms-2" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Transport Type" onclick="toggleModalAddTransportType(true)">
                            <i class='bx bx-pencil'></i>
                        </button>
                        <select class="form-select bg-light-subtle" 
                                id="transport-type" 
                                name="transport-type"
                                style="--bs-bg-opacity: .6;">
                        </select>
                    </div>

                    <div class="fv-row mb-4">
                        <label for="total-seat" class="form-label fs-9 fw-medium mb-2">Total Seats</label>
                        <input type="number" 
                               class="form-control bg-light-subtle" 
                               id="total-seat" 
                               name="total-seat" 
                               placeholder="Enter total seats" 
                               autocomplete="off"
                               style="--bs-bg-opacity: .6;" />
                    </div>

                    <div class="fv-row">
                        <label for="transport-description" class="form-label fs-9 fw-medium mb-2">Description</label>
                        <textarea class="form-control bg-light-subtle" 
                                  id="transport-description" 
                                  name="transport-description" 
                                  rows="3" 
                                  placeholder="Enter description"
                                  style="--bs-bg-opacity: .6;"></textarea>
                    </div>
                </div>

                <div class="modal-footer border-top-0 px-3 pb-3 pt-0">
                    <button type="button" 
                            class="btn btn-light px-3 py-2" 
                            onclick="toggleAddTransport(false)">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="btn btn-primary px-4 py-2" 
                            id="btn-save-transport">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>