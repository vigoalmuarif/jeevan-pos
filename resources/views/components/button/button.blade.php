@props(['loading', 'default', 'disabled' => false])

<button {{ $attributes->merge(['type' => 'button', 'class' => '', 'wire:loading.attr' => 'disabled']) }} {{ $disabled ? 'disabled' : '' }}>
    @if (isset($loading))
        <div
            {{ $loading->attributes->merge(['class' => 'flex flex-nowrap items-center justify-center text-slate-100']) }} wire:loading wire:loading.flex>
            <span
            class="animate-spin inline-flex @if(empty($loading)) mx-1 @else me-2 @endif size-3  border-[2px] border-current border-t-transparent text-slate-600 dark:text-slate-50 rounded-full"
            role="status" aria-label="loading"></span>
            <span class="inline-flex">{{ $loading ?? 'Memproses' }}</span>
        </div>
    @endif
    @if (isset($default))
        <div
            {{ $default->attributes->merge(['class' => 'inline-flex flex-nowrap justify-center items-center gap-x-1.5 text-slate-100']) }} wire:loading.remove wire:loading.remove.flex>
            <span class="flex items-center gap-x-1.5">{{ $default }}</span>
        </div>
    @endif
    {{ $slot }}
</button>
