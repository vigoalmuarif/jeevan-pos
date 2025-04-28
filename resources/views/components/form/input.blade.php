@props(['name' => '', 'utility', 'disabled' => false])


@if($errors->has($name))
    @php
        $classes = 'isInvalid';
    @endphp
@else
    @php
        $classes = 'formInput';
    @endphp
@endif

<div>
    <input {{ $attributes->merge([
        'type' => 'text',
        'class' => $classes,
        'name' => $name
    ]) }} {{ $disabled ? 'disabled="" readonly=""' : '' }} />
    @if (isset($utility))
        {{ $utility }}
    @endif
    @error($name)
        <p class="isInvalidMessage" id="error-msg-{{ $name }}">{{ $message }}</p>
    @enderror
</div>
