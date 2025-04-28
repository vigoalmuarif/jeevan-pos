@props(['name' => '', 'disabled' => false])


@error($name)
    @php
        $classes = 'isInvalid';
    @endphp
@else
    @php
        $classes = 'formSelect';
    @endphp
@enderror

<div>
    <select {{ $attributes->merge([
        'class' => $classes,
        'name' => $name
    ]) }} {{ $disabled ? 'disabled="" readonly=""' : '' }}>
    {{ $slot }}
    </select>
    @error($name)
        <p class="isInvalidMessage" id="error-msg-{{ $name }}">{{ $message }}</p>
    @enderror
</div>
