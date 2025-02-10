<div class="modal fade" tabindex="-1" id="modal-add-transport" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-sm rounded-3 border-0">
            <form id="form-add-transport" method="POST">
                @csrf
                <input type="hidden" name="id" id="id" value="">
                
                <div class="modal-header d-flex justify-content-between bg-light py-3 px-4 border-bottom-0 rounded-top-3">
                    <h5 class="modal-title fs-5 fw-medium" id="title-form-transport">Add Transportation</h5>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" onclick="toggleAddTransport(false)">
                        <i class="ki-outline ki-cross fs-3"></i>
                    </div>
                </div>

                <div class="modal-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-6 fv-row">
                            <label for="transport-name" class="form-label fs-9 fw-medium mb-2">Transportation Name</label>
                            <input type="text" 
                                   class="form-control bg-light-subtle" 
                                   id="transport-name" 
                                   name="transport-name" 
                                   placeholder="Enter transportation name" 
                                   autocomplete="off"
                                   style="--bs-bg-opacity: .6;" />
                        </div>
                        <div class="col-md-6 fv-row">
                            <label for="transport-code" class="form-label fs-9 fw-medium mb-2">Transportation Code</label>
                            <input type="text" 
                                   class="form-control bg-light-subtle" 
                                   id="transport-code" 
                                   name="transport-code" 
                                   placeholder="Enter code" 
                                   autocomplete="off"
                                   style="--bs-bg-opacity: .6;" />
                        </div>
                    </div>
                
                    <div class="row mb-4">
                        <div class="col-md-6 fv-row">
                            <label for="transport-type" class="form-label fs-9 fw-medium mb-2 required">Transportation Type</label>
                            <div class="d-flex align-items-center">
                                <select class="form-select bg-light-subtle me-2" 
                                        id="transport-type" 
                                        name="transport-type"
                                        style="--bs-bg-opacity: .6;">
                                </select>
                                <button class="btn btn-icon btn-light" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Transport Type" onclick="toggleModalAddTransportType(true)">
                                    <i class='bx bx-pencil'></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label for="transport-class" class="form-label fs-9 fw-medium mb-2 required">Transportation Class</label>
                            <select class="form-select bg-light-subtle" 
                                    id="transport-class" 
                                    name="transport-class"
                                    style="--bs-bg-opacity: .6;">
                            </select>
                        </div>
                    </div>
                
                    <div class="row mb-4">
                        <div class="col-md-6 fv-row">
                            <label for="total-seat" class="form-label fs-9 fw-medium mb-2">Total Seats</label>
                            <input type="number" 
                                   class="form-control bg-light-subtle" 
                                   id="total-seat" 
                                   name="total-seat" 
                                   placeholder="Enter total seats" 
                                   autocomplete="off"
                                   style="--bs-bg-opacity: .6;" />
                        </div>
                        <div class="col-md-6 fv-row">
                            <label for="transport-logo" class="form-label fs-9 fw-medium mb-2">Transportation Logo</label>
                            <input type="file" 
                                    class="form-control bg-light-subtle" 
                                    id="transport-logo" 
                                    name="transport-logo" 
                                    accept="image/*"
                                    onchange="previewImage(event)"
                                   style="--bs-bg-opacity: .6;" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 fv-row">
                            <label for="transport-description" class="form-label fs-9 fw-medium mb-2">Description</label>
                            <textarea class="form-control bg-light-subtle" 
                                    id="transport-description" 
                                    name="transport-description" 
                                    rows="4" 
                                    placeholder="Enter description"
                                    style="--bs-bg-opacity: .6;"></textarea>
                        </div>
                        <div class="col-md-6 fv-row">
                            <img id="image-preview" src="#" alt="Image Preview" class="img-fluid d-none" style="max-height: 200px; border-radius: 8px;" />
                            <input type="hidden" id="existing-image" name="existing_image">
                        </div>
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
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modal-add-transport-type" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-sm rounded-3 border-0">
            <form id="form-add-transport-type" method="POST">
                @csrf
                <div class="modal-header d-flex justify-content-between bg-light py-3 px-4 border-bottom-0 rounded-top-3">
                    <h5 class="modal-title fs-5 fw-medium" id="modal-title">Add Transport Type</h5>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" onclick="toggleModalAddTransportType(false)">
                        <i class="ki-outline ki-cross fs-3"></i>
                    </div>
                </div>
                <div class="modal-body p-4">
                    <div class="row mb-4">
                        <div class="col-6 pe-2">
                            <div class="position-relative">
                                <i class='bx bx-search position-absolute search-icon'></i>
                                <input type="text" id="searchTransportType" class="form-control search-input" placeholder="Type to Search" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7 pe-3">
                            <div class="table-responsive">
                                <table id="transport-type-table" class="table custom-table table-hover gy-3">
                                    <thead>
                                        <tr class="fw-semibold fs-6 text-gray-800">
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="mb-4 fv-row">
                                <input type="hidden" name="id_transport_type" id="id_transport_type" value="">
                                <label for="transport-type-name" class="form-label fs-9 fw-medium mb-2 required">Name</label>
                                <input type="text" 
                                       class="form-control bg-light-subtle" 
                                       id="transport-type-name" 
                                       name="transport-type-name" 
                                       placeholder="Input Type Name" 
                                       autocomplete="off" 
                                       style="--bs-bg-opacity: .6;" />
                            </div>
                            <div class="fv-row mb-4">
                                <label for="transport-type-description" class="form-label fs-9 fw-medium mb-2">Description</label>
                                <textarea class="form-control bg-light-subtle" 
                                          id="transport-type-description" 
                                          name="transport-type-description" 
                                          rows="4" 
                                          placeholder="Enter description"
                                          style="--bs-bg-opacity: .6;"></textarea>
                            </div>
                            <div class="d-flex justify-content-end gap-3">
                                <button type="button" class="btn btn-light px-3 py-2" onclick="toggleModalAddTransportType(false)">
                                    Discard
                                </button>
                                <button type="button" class="btn btn-primary px-4 py-2" id="btn-save-transport-type">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modal-detail-transport" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-sm rounded-3 border-0">
            <div class="modal-header d-flex justify-content-between bg-light py-3 px-4 border-bottom-0 rounded-top-3">
                <h5 class="modal-title fs-5 fw-medium" id="modal-title-detail-transport">Detail Transport</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" onclick="toggleDetailTransport(false)">
                    <i class="ki-outline ki-cross fs-3"></i>
                </div>
            </div>
            <div class="modal-body p-4">
                <!-- Row 1: Name, Code, Type -->
                <div class="row mb-4">
                    <div class="col-4">
                        <p class="fw-bold mb-1">Name</p>
                        <p class="text-gray-700" id="detail-name"></p>
                    </div>
                    <div class="col-4">
                        <p class="fw-bold mb-1">Code</p>
                        <p class="text-gray-700" id="detail-code"></p>
                    </div>
                    <div class="col-4">
                        <p class="fw-bold mb-1">Type</p>
                        <p class="text-gray-700" id="detail-type"></p>
                    </div>
                </div>
                <!-- Row 2: Total Seat, Description -->
                <div class="row">
                    <div class="col-3">
                        <p class="fw-bold mb-1">Class</p>
                        <p class="text-gray-700" id="detail-class"></p>
                    </div>
                    <div class="col-3">
                        <p class="fw-bold mb-1">Total Seat</p>
                        <p class="text-gray-700" id="detail-total-seat"></p>
                    </div>
                    <div class="col-6">
                        <p class="fw-bold mb-1">Description</p>
                        <p class="text-gray-700" id="detail-description">
                            
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0 px-3 pb-3 pt-0">
                <button type="button" class="btn btn-light px-3 py-2" onclick="toggleDetailTransport(false)">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modal-detail-type-transport" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-sm rounded-3 border-0">
            <div class="modal-header d-flex justify-content-between bg-light py-3 px-4 border-bottom-0 rounded-top-3">
                <h5 class="modal-title fs-5 fw-medium" id="modal-title-detail-type-transport">Detail Transport Type</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" onclick="toggleDetailTransportType(false)">
                    <i class="ki-outline ki-cross fs-3"></i>
                </div>
            </div>
            <div class="modal-body p-4">
                <!-- Row 1: Name, Code, Type -->
                <div class="row mb-4">
                    <div class="col-4">
                        <p class="fw-bold mb-1">Name</p>
                        <p class="text-gray-700" id="detail-type-name"></p>
                    </div>
                    <div class="col-8">
                        <p class="fw-bold mb-1">Description</p>
                        <p class="text-gray-700" id="detail-type-description">
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0 px-3 pb-3 pt-0">
                <button type="button" class="btn btn-light px-3 py-2" onclick="toggleDetailTransportType(false)">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('image-preview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "#";
            preview.classList.add('d-none');
        }
    }
</script>