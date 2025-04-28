@props(['color' => '', 'title' => '', 'name', 'loading'])

@if ($color == 'primary')
    @php
        $buttonClasses = [
            'p-1.5 inline-flex items-center text-sm font-medium rounded-full border border-transparent focus:outline-none disabled:opacity-50 disabled:pointer-events-none group',
            'bg-primary-700/80',
            'text-slate-50',
            'hover:bg-primary-500',
            'focus:bg-primary-500/90',
        ];

        $loading = '<span class="animate-spin inline-block size-4 border-[3px] border-current border-t-transparent text-primary-500 rounded-full" role="status" aria-label="loading"">
    <span class="sr-only">Loading...</span>
  </span>'
    @endphp
@elseif ($color == 'secondary')
    @php
        $buttonClasses = [
            'p-1.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-full border border-transparent focus:outline-none disabled:opacity-50 disabled:pointer-events-none group',
            'bg-secondary-300',
            'text-slate-50',
            'hover:bg-secondary-400/80',
            'focus:bg-secondary-400/90',
        ];
        $loading = '<span class="animate-spin inline-block size-4 border-[3px] border-current border-t-transparent text-secondary-500 rounded-full" role="status" aria-label="loading"">
    <span class="sr-only">Loading...</span>
  </span>'
    @endphp
@elseif ($color == 'info')
    @php
        $buttonClasses = [
            'p-1.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-full border border-transparent focus:outline-none disabled:opacity-50 disabled:pointer-events-none group',
            'bg-sky-700/80',
            'text-slate-50',
            'hover:bg-sky-500',
            'focus:bg-sky-500/90',
        ];
        $loading = '<span class="animate-spin inline-block size-4 border-[3px] border-current border-t-transparent text-cyan-500 rounded-full" role="status" aria-label="loading"">
    <span class="sr-only">Loading...</span>
  </span>'
    @endphp
@elseif ($color == 'warning')
    @php
        $buttonClasses = [
            'p-1.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-full border border-transparent focus:outline-none disabled:opacity-50 disabled:pointer-events-none group',
            'bg-amber-700/80',
            'text-slate-50',
            'hover:bg-amber-500',
            'focus:bg-amber-500/90',
        ];

        $loading = '<span class="animate-spin inline-block size-4 border-[3px] border-current border-t-transparent text-amber-500 rounded-full" role="status" aria-label="loading"">
    <span class="sr-only">Loading...</span>
  </span>'
    @endphp
@elseif ($color == 'danger')
    @php
        $buttonClasses = [
            'p-1.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-full border border-transparent focus:outline-none disabled:opacity-50 disabled:pointer-events-none group',
            'bg-rose-700/80',
            'text-slate-50',
            'hover:bg-rose-500',
            'focus:bg-rose-500/90',
        ];

        $loading = '<span class="animate-spin inline-block size-4 border-[3px] border-current border-t-transparent text-rose-500 rounded-full" role="status" aria-label="loading"">
    <span class="sr-only">Loading...</span>
  </span>'
    @endphp
@else
    @php
        $buttonClasses = [
            'p-1.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-full border border-transparent focus:outline-none disabled:opacity-50 disabled:pointer-events-none group',
            'bg-primary-700/80',
            'text-slate-50',
            'hover:bg-primary-500',
            'focus:bg-primary-500/90',
        ];

        $loading = '<span class="animate-spin inline-block size-4 border-[3px] border-current border-t-transparent text-neutral-500 rounded-full" role="status" aria-label="loading"">
    <span class="sr-only">Loading...</span>
  </span>'
    @endphp
@endif


<button {{ $attributes->merge(['type' => 'button', 'class' => implode(' ', $buttonClasses), 'title' => $title]) }}>
    {{ $slot }}
    @if ($name == $loading)
        {!! $loading !!}
    @endif
</button>
