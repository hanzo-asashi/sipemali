<button {{ $attributes->merge(['type' => 'button', 'aria-label' => 'Close','class' => 'btn'] ) }}>
  {{ $slot }}
</button>
