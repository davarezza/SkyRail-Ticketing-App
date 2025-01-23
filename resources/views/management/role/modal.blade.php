<div class="modal fade" id="modalHakAkses" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-sm rounded-3 border-0">
            <form id="form-add-role" method="POST">
                @csrf
                <input type="hidden" id="id" name="id" />

                <div class="modal-header bg-light py-3 px-4 border-bottom-0 rounded-top-3">
                    <h5 class="modal-title fs-5 fw-medium" id="title-form-role">Tambah Role</h5>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" onclick="toggleAddRole(false)">
                        <i class="ki-outline ki-cross fs-3"></i>
                    </div>
                </div>

                <div class="modal-body p-4">
                    <div class="fv-row mb-4">
                        <label for="name-role" class="form-label fs-9 fw-medium mb-2 required">Role</label>
                        <input type="text" 
                               name="name-role" 
                               id="name-role" 
                               class="form-control bg-light-subtle" 
                               placeholder="Input Role" 
                               autocomplete="off"
                               style="--bs-bg-opacity: .6;">
                    </div>
                </div>

                <div class="modal-footer border-top-0 px-3 pb-3 pt-0">
                    <button type="button" 
                            class="btn btn-light px-3 py-2" 
                            onclick="toggleAddRole(false)">
                        Close
                    </button>
                    <button type="submit" 
                            class="btn btn-primary px-4 py-2" 
                            id="btn-save-role">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>