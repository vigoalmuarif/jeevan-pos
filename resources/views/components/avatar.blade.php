@props(['name' => 'Name'])

<div {{ $attributes->merge(['class' => 'flex items-center justify-center w-10 h-10 rounded-full   text-white font-bold text-sm']) }}>
    {{ $slot }}
</div>