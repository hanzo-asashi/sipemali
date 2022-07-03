<x-modal id="modals-slide-in" class="modal-slide-in new-user-modal fade">
  <x-table.modal-form>
    <x-button class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</x-button>
    <x-slot name="modalTitle">
      <h5 class="modal-title" id="exampleModalLabel">New User</h5>
    </x-slot>
    <div class="mb-1">
      <x-label class="form-label" for="basic-icon-default-fullname">Full Name</x-label>
      <x-input type="text" class="dt-full-name" id="basic-icon-default-fullname" placeholder="John Doe" name="user-fullname" aria-label="John Doe"
               aria-describedby="basic-icon-default-fullname2" />
    </div>
    <div class="mb-1">
      <x-label for="basic-icon-default-uname">Username</x-label>
      <x-input class="dt-uname" placeholder="Web Developer" aria-label="jdoe1" aria-describedby="basic-icon-default-uname2" name="user-name">
      </x-input>
    </div>
    <div class="mb-1">
      <x-label for="basic-icon-default-email">Email</x-label>
      <x-input type="text" id="basic-icon-default-email" class="dt-email" placeholder="john.doe@example.com" aria-label="john.doe@example.com"
               aria-describedby="basic-icon-default-email2" name="user-email" />
      <x-help-text> You can use letters, numbers & periods</x-help-text>
    </div>
    <div class="mb-1">
      <x-label for="user-role">User Role</x-label>
      <x-select id="user-role">
        <option value="subscriber">Subscriber</option>
        <option value="editor">Editor</option>
        <option value="maintainer">Maintainer</option>
        <option value="author">Author</option>
        <option value="admin">Admin</option>
      </x-select>
    </div>
    <div class="mb-2">
      <x-label for="user-plan">Select Plan</x-label>
      <x-select id="user-plan" class="form-select">
        <option value="basic">Basic</option>
        <option value="enterprise">Enterprise</option>
        <option value="company">Company</option>
        <option value="team">Team</option>
      </x-select>
    </div>
    <x-button type="submit" class="btn btn-primary me-1 data-submit">Submit</x-button>
    <x-button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</x-button>
  </x-table.modal-form>
</x-modal>
