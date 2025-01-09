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
                                  rows="5" 
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
                <div class="modal-header bg-light py-3 px-4 border-bottom-0 rounded-top-3">
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