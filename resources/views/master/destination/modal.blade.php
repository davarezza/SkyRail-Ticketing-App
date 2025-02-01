<div class="modal fade" tabindex="-1" id="modal-add-destination" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-sm rounded-3 border-0">
            <form id="form-add-destination" method="POST">
                @csrf
                <input type="hidden" name="id" id="id" value="">
                
                <div class="modal-header bg-light py-3 px-4 border-bottom-0 rounded-top-3">
                    <h5 class="modal-title fs-5 fw-medium" id="title-form-destination">Add Destination</h5>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" onclick="toggleAddDestination(false)">
                        <i class="ki-outline ki-cross fs-3"></i>
                    </div>
                </div>

                <div class="modal-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-6 fv-row">
                            <label for="destination-name" class="form-label fs-9 fw-medium mb-2">Name</label>
                            <input type="text" 
                                   class="form-control bg-light-subtle" 
                                   id="destination-name" 
                                   name="destination-name" 
                                   placeholder="Enter name" 
                                   autocomplete="off"
                                   style="--bs-bg-opacity: .6;" />
                        </div>
                        <div class="col-md-6 fv-row">
                            <label for="destination-location" class="form-label fs-9 fw-medium mb-2">Location (City)</label>
                            <input type="text" 
                                   class="form-control bg-light-subtle" 
                                   id="destination-location" 
                                   name="destination-location" 
                                   placeholder="Enter location" 
                                   autocomplete="off"
                                   style="--bs-bg-opacity: .6;" />
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 fv-row">
                            <label for="destination-link" class="form-label fs-9 fw-medium mb-2">Link</label>
                            <input type="text" 
                                   class="form-control bg-light-subtle" 
                                   id="destination-link" 
                                   name="destination-link" 
                                   placeholder="Enter link" 
                                   autocomplete="off"
                                   style="--bs-bg-opacity: .6;" />
                        </div>
                        <div class="col-md-6 fv-row">
                            <label for="destination-popularity" class="form-label fs-9 fw-medium mb-2">Popularity (1-5)</label>
                            <input type="number" 
                                   class="form-control bg-light-subtle" 
                                   id="destination-popularity" 
                                   name="destination-popularity" 
                                   placeholder="Enter popularity" 
                                   autocomplete="off"
                                   style="--bs-bg-opacity: .6;" />
                        </div>
                    </div>

                    <div class="fv-row mb-4">
                        <label for="destination-image" class="form-label fs-9 fw-medium mb-2">Image</label>
                        <input type="file" 
                               class="form-control bg-light-subtle" 
                               id="destination-image" 
                               name="destination-image" 
                               accept="image/*"
                               onchange="previewImage(event)"
                               style="--bs-bg-opacity: .6;" />
                        <div class="mt-3 text-center">
                            <img id="image-preview" src="#" alt="Image Preview" class="img-fluid d-none" style="max-height: 200px; border-radius: 8px;" />
                        </div>
                        <input type="hidden" id="existing-image" name="existing_image">
                    </div>
                </div>

                <div class="modal-footer border-top-0 px-3 pb-3 pt-0">
                    <button type="button" 
                            class="btn btn-light px-3 py-2" 
                            onclick="toggleAddDestination(false)">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="btn btn-primary px-4 py-2" 
                            id="btn-save-destination">
                        Save
                    </button>
                </div>
            </form>
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