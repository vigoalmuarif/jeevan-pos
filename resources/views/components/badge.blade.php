@props(['color' => 'primary', 'label'=> 'label'])


@php
    $colors = match($color) {
        'primary' => 'inline-flex items-center gap-x-1.5 py-0.5 px-3 rounded-full text-xs font-medium bg-primary-800/30 text-primary-600 dark:text-primary-400 dark:bg-primary-700/30',
        'secondary' => 'inline-flex items-center gap-x-1.5 py-0.5 px-3 rounded-full text-xs font-medium bg-slate-400/20 text-slate-600 dark:text-slate-400 dark:bg-gray-700/30',
        'success' => 'inline-flex items-center gap-x-1.5 py-0.5 px-3 rounded-full text-xs font-medium bg-green-800/30 text-green-600 dark:text-green-400 dark:bg-green-700/30',
        'warning' => 'inline-flex items-center gap-x-1.5 py-0.5 px-3 rounded-full text-xs font-medium bg-amber-800/30 text-amber-600 dark:text-amber-400 dark:bg-amber-700/30',
        'danger' => 'inline-flex items-center gap-x-1.5 py-0.5 px-3 rounded-full text-xs font-medium bg-rose-800/30 text-rose-6-- dark:text-rose-400 dark:bg-rose-700/30',
        'info' => 'inline-flex items-center gap-x-1.5 py-0.5 px-3 rounded-full text-xs font-medium bg-teal-800/30 text-teal-600 dark:text-teal-400 dark:bg-teal-700/30',
    };
@endphp



<span {{ $attributes->merge(['class' => $colors]) }}>{{ $label }}</span>