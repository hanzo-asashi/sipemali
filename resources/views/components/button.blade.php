<button {{ $attributes->merge(['type' => 'button', 'aria-label' => 'Close', 'class' => 'btn waves-effect waves-ripple'] ) }}>
  {{ $slot }}
</button>
