<div class="modal fade" tabindex="-1" id="modal-add-officer" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-sm rounded-3 border-0">
            <form id="form-add-officer" method="POST">
                @csrf
                <input type="hidden" name="id" id="id" value="">
                
                <div class="modal-header d-flex justify-content-between bg-light py-3 px-4 border-bottom-0 rounded-top-3">
                    <h5 class="modal-title fs-5 fw-medium" id="title-form-officer">Add Officer</h5>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" onclick="toggleAddOfficer(false)">
                        <i class="ki-outline ki-cross fs-3"></i>
                    </div>
                </div>

                <div class="modal-body p-4">
                    <div class="fv-row mb-4">
                        <label for="officer-name" class="form-label fs-9 fw-medium mb-2">Officer Name</label>
                        <input type="text" 
                               class="form-control bg-light-subtle" 
                               id="officer-name" 
                               name="officer-name" 
                               placeholder="Enter name" 
                               autocomplete="off"
                               style="--bs-bg-opacity: .6;" />
                    </div>

                    <div class="fv-row mb-4">
                        <label for="officer-email" class="form-label fs-9 fw-medium mb-2">Officer Email</label>
                        <input type="email" 
                               class="form-control bg-light-subtle" 
                               id="officer-email" 
                               name="officer-email" 
                               placeholder="Enter Email" 
                               autocomplete="off"
                               style="--bs-bg-opacity: .6;" />
                    </div>

                    <div class="fv-row mb-4">
                        <label for="role-id" class="form-label fs-9 fw-medium mb-2 required">Level Name</label>
                        <select class="form-select bg-light-subtle" 
                                id="role-id" 
                                name="role-id"
                                style="--bs-bg-opacity: .6;">
                        </select>
                    </div>
                </div>

                <div class="modal-footer border-top-0 px-3 pb-3 pt-0">
                    <button type="button" 
                            class="btn btn-light px-3 py-2" 
                            onclick="toggleAddOfficer(false)">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="btn btn-primary px-4 py-2" 
                            id="btn-save-officer">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>