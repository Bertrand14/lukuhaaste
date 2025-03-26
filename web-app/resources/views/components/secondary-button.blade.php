<button {{ $attributes->merge(['type' => 'button', 'class' => 'secondary inline-flex items-center px-4 py-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>