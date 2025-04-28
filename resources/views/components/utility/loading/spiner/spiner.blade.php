
@props(['color' => ''])
<?php
$color = match ($color) {
    'primary' => 'text-primary-600',
    'secondary' => 'text-slate-300',
    'success' => 'text-green-600',
    'danger' => 'text-rose-600',
    'warning' => 'text-amber-600',
    'info' => 'text-teal-600',
    'dark' => 'text-slate-700',
    default => 'text-slate-50',
};
?>

<span {{ $attributes->merge(['class' => 'animate-spin inline-block size-4 border-[3px] border-current border-t-transparent ' . $color . ' rounded-full']) }}role="status" aria-label="loading"></span>
