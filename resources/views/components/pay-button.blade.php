<button
{{ $attributes->merge([
    'class' => '
        mt-4
        bg-[#e63946]
        hover:bg-[#c92f3a]
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
    {{$slot}}
</button>