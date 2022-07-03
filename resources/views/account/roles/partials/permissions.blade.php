@foreach($role->permissions()->get() as $key => $perm)
  <td>
    <div class="form-check">
      <input name="permission" wire:model="selectedPermission" wire:key="{{ $key }}" type="checkbox" class="form-check-input"
             id="admin-{{$perm->name}}"/>
      <label class="form-check-label" for="admin-{{$perm->name}}"></label>
    </div>
  </td>
@endforeach
