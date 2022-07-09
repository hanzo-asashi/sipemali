<button {{ $attributes->merge(['type' => 'button', 'aria-label' => 'Close', 'class' => 'btn waves-effect waves-float waves-light'] ) }}>
    {{ $slot }}
</button>
