
@props([
    'name' => '',
    ])

@php
    $classes =  $classes = $errors->has($name) ? 'isInvalid' : 'formInput';
@endphp

    <textarea {{ $attributes->merge([
        'class'=> $classes,
         'rows' => 3,
         ]) }}  >{{ $slot }}</textarea>
    @error($name)
        <p class="isInvalidMessage mt-0.5" id="error-msg-{{ $name }}">{{ $message }}</p>
    @enderror