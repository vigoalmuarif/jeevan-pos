@props(['color' => 'default'])

@if ($color == 'default')
    @php
        $color = 'mt-2 bg-gray-100 border border-gray-200 text-sm text-gray-800 rounded-xl p-4 dark:bg-slate-800 dark:border-white/20 dark:text-white'
    @endphp
@elseif ($color == 'success')
    @php
        $color = 'mt-2 bg-teal-100 border border-teal-200 text-sm text-teal-800 rounded-xl p-4 dark:bg-teal-800/10 dark:border-teal-900 dark:text-teal-500'
    @endphp
@elseif ($color == 'warning')
    @php
        $color = 'mt-2 bg-yellow-100 border border-yellow-200 text-sm text-yellow-800 rounded-xl p-4 dark:bg-yellow-800/10 dark:border-yellow-900 dark:text-yellow-500'
    @endphp
@elseif ($color == 'danger')
    @php
        $color = 'mt-2 bg-red-100 border border-red-200 text-sm text-red-800 rounded-xl p-4 dark:bg-red-800/10 dark:border-red-900 dark:text-red-500'
    @endphp
@elseif ($color == 'info')
    @php
        $color = 'mt-2 bg-blue-100 border border-blue-200 text-sm text-blue-800 rounded-xl p-4 dark:bg-blue-800/10 dark:border-blue-900 dark:text-blue-500'
    @endphp
@elseif ($color == 'primary')
    @php
        $color = 'mt-2 bg-primary-100 border border-primary-200 text-sm text-primary-800 rounded-xl p-4 dark:bg-primary-800/10 dark:border-primary-900 dark:text-primary-500'
    @endphp
@endif

<div {{ $attributes->merge(['class' => $color.' text-center']) }} role="alert" tabindex="-1" aria-labelledby="hs-soft-color-dark-label">
    {{ $slot }}
</div>