<div class="modal fade" tabindex="-1" id="modal-add-transport-class" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-sm rounded-3 border-0">
            <form id="form-add-transport-class" method="POST">
                @csrf
                <input type="hidden" name="id" id="id" value="">
                
                <div class="modal-header d-flex justify-content-between bg-light py-3 px-4 border-bottom-0 rounded-top-3">
                    <h5 class="modal-title fs-5 fw-medium" id="title-form-transport-class">Add Transport Class</h5>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" onclick="toggleAddTransportClass(false)">
                        <i class="ki-outline ki-cross fs-3"></i>
                    </div>
                </div>

                <div class="modal-body p-4">
                    <div class="fv-row mb-4">
                        <label for="transport-class-name" class="form-label fs-9 fw-medium mb-2">Name</label>
                        <input type="text" 
                               class="form-control bg-light-subtle" 
                               id="transport-class-name" 
                               name="transport-class-name" 
                               placeholder="Enter name" 
                               autocomplete="off"
                               style="--bs-bg-opacity: .6;" />
                    </div>

                <div class="fv-row mb-4">
                    <label for="transport-class-facilities" class="form-label fs-9 fw-medium mb-2">Facilities (Font Awesome Icon)</label>
                    <div class="d-flex align-items-center gap-2">
                        <input type="text" 
                                class="form-control bg-light-subtle flex-grow-1" 
                                id="transport-class-facilities" 
                                name="transport-class-facilities" 
                                placeholder="Enter Facilities" 
                                autocomplete="off"
                                style="--bs-bg-opacity: .6;" />
                        <a href="https://fontawesome.com/icons" 
                            target="_blank" 
                            class="btn btn-light btn-icon fs-4" 
                            title="Open Font Awesome">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>

                <div class="fv-row mb-4">
                    <label for="transport-class-facilities-detail" class="form-label fs-9 fw-medium mb-2">Facilities Detail</label>
                        <input type="text" 
                                class="form-control bg-light-subtle flex-grow-1" 
                                id="transport-class-facilities-detail" 
                                name="transport-class-facilities-detail" 
                                placeholder="Free Wifi, Baggage: 20kg, etc" 
                                autocomplete="off"
                                style="--bs-bg-opacity: .6;" />
                </div>
                <div class="modal-footer border-top-0 px-3 pb-3 pt-0">
                    <button type="button" 
                            class="btn btn-light px-3 py-2" 
                            onclick="toggleAddTransportClass(false)">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="btn btn-primary px-4 py-2" 
                            id="btn-save-transport-class">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>