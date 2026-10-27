<button 
    {{ $attributes->merge([
        'class' => '
            block
            mt-4
            bg-blue-600
            hover:bg-blue-700 
            text-white 
            font-semibold 
            py-3 
            px-6 
            rounded-xl 
            shadow-md 
            hover:shadow-lg 
            transition 
            duration-200 
            ease-out
        '
    ]) }}
>
    {{ $slot }}
</button>
