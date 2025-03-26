<button {{ $attributes->merge(['type' => 'submit', 'class' => 'primary inline-flex items-center px-4 py-2 uppercase font-semibold text-xs  transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>