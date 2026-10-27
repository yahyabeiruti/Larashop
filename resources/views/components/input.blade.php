<!-- input.blade.php -->
@props(['label', 'name', 'type'=>'text'])



<x-label :for="$name">{{ $label }}</x-label>
<input
type="{{ $type }}"
name="{{ $name }}"
{{ $attributes->merge([
    'class' => '
            mt-4
            mb-4
            block
            w-80 
            border border-transparent
            rounded-xl
            shadow-md 
            px-8     
            py-3      
            text-black
            focus:outline-none
            focus:ring-5
            focus:ring-blue-500/30
            transition
        '
    ]) }}
>


