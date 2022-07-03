<x-livewire-tables::table.cell class="hidden md:table-cell">
  <div>
    @if ($row->isAdmin())
      <x-badges.success>{{ ucfirst($row->type) }}</x-badges.success>
    @else
      <x-badges.default>{{ ucfirst($row->type) }}</x-badges.default>
    @endif
  </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
  <div class="flex items-center">
    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
      <div wire:key="profile-picture-{{ $row->id }}" class="flex-shrink-0 h-10 w-10">
        <img class="h-10 w-10 rounded-full" src="{{ $row->profile_photo_url }}" alt="{{ $row->name }}" />
      </div>
    @endif

    <div class="@if (Laravel\Jetstream\Jetstream::managesProfilePhotos()) ml-4 @endif">
      <div class="text-sm font-medium text-gray-900">
        {{ $row->name }}
      </div>

      @if($row->timezone)
        <div wire:key="timezone-{{ $row->id }}" class="text-sm text-gray-500">
          {{ str_replace('_', ' ', $row->timezone) }}
        </div>
      @endif
    </div>
  </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
  <p class="text-blue-400 truncate">
    <a href="mailto:{{ $row->email }}" class="hover:underline">{{ $row->email }}</a>
  </p>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell class="hidden md:table-cell">
  <div>
    @if ($row->isActive())
      <x-badges.success>@lang('Yes')</x-badges.success>
    @else
      <x-badges.danger>@lang('No')</x-badges.danger>
    @endif
  </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell class="hidden md:table-cell">
  <div>
    @if ($row->isVerified())
      <x-badges.success>@lang('Yes')</x-badges.success>
    @else
      <x-badges.danger>@lang('No')</x-badges.danger>
    @endif
  </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell class="hidden md:table-cell">
  <div>
    @if ($row->twoFactorEnabled())
      <x-badges.success>@lang('Enabled')</x-badges.success>
    @else
      <x-badges.danger>@lang('Disabled')</x-badges.danger>
    @endif
  </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
  <a href="#" wire:click.prevent="manage({{ $row->id }})" class="text-primary-600 font-medium hover:text-primary-900">Manage</a>
</x-livewire-tables::table.cell>
