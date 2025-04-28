@props([
    'title',
    'subtitle',
    'overflow_x' => false
])


<div {{ $attributes->merge(['class' => 'bg-gray-100 border shadow-sm rounded-xl dark:bg-isDark dark:border-slate-700']) }}>
    @if (isset($title))
        <h3 class="text-base font-bold text-gray-800 dark:text-gray-200 p-3">
        {{ $title }}
        </h3>
    @endif
    @if (isset($subtitle))
        <p class="mt-1 text-xs font-medium uppercase text-gray-500 dark:text-neutral-500  p-3 md:p-4">
        {{ $subtitle }}
        </p>
    @endif
    <div class="card-body mt-0 py-0 @if($overflow_x == true) overflow-x-auto scrollbar-thin @endif">
        {{ $slot }}
    </div>
  </div>