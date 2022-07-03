<!-- Add Permission Modal -->
<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 pb-5">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Add New Permission</h1>
                    <p>Permissions you may use and assign to your users.</p>
                </div>
                <form id="addPermissionForm" class="row" onsubmit="return false">
                    <div class="col-12">
                        <label class="form-label" for="modalPermissionName">Permission Name</label>
                        <input
                            type="text"
                            id="modalPermissionName"
                            name="modalPermissionName"
                            class="form-control"
                            placeholder="Permission Name"
                            autofocus
                            data-msg="Please enter permission name"
                        />
                    </div>
                    <div class="col-12 mt-75">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="corePermission" />
                            <label class="form-check-label" for="corePermission"> Set as core permission </label>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary mt-2 me-1">Create Permission</button>
                        <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Add Permission Modal -->
