@props(['name' => '', 'id' => '', 'placeholder' => '', 'label' => '', 'required' => false, 'remote' => '', 'disabled' => false])
<div class="w-full relative">
    <x-form.label for="{{ $id }}" class="{{ $label ? '' : 'sr-only' }}">{{ $label }} @if($required)<span class="text-rose-500 ms-1">*</span>@endif</x-form.label>
    <select
    name="{{ $name }}" id="{{ $id }}" {{ $attributes }}
        data-hs-select='{
        "hasSearch": true,
        {{ $remote }}
        {{ $remote ? ',' : ''}}
        "searchPlaceholder": "Search...",
        "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-primary-500 focus:ring-primary-500 before:absolute before:inset-0 before:z-[100] dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 py-2 px-3",
        "searchWrapperClasses": "bg-white w-full p-2 -mx-1 sticky top-0 dark:bg-neutral-900",
        "placeholder": "{{ $placeholder }}",
        {{-- "dropdownScope": "window", --}}
        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"font-medium @if($errors->has($name)) text-red-500 @else text-slate-700 dark:text-slate-200 @endif \" data-title></span></button>",
        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2.5 ps-2.5 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-gray-200 border @if($errors->has($name)) border-rose-400 focus:border-rose-500 @else border-transparent @endif focus:border-primary-500 rounded-xl text-start text-sm focus:outline-none focus:ring-2 @if($errors->has($name)) focus:ring-rose-500 @else focus:ring-primary-500 @endif dark:dark:bg-slate-800 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 @if($errors->has($name)) dark:focus:ring-rose-500 @else dark:focus:ring-primary-500 @endif",
        "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-[9999] w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
        "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-neutral-200 \" data-title></div></div></div>",
        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
      }'
        class="hidden absolute" {{ $disabled ? 'disabled' : '' }}>
        {{ $slot }}
    </select>
 
     @error($name)
        <p class="isInvalidMessage mt-1" id="error-msg-{{ $name }}">{{ $message }}</p>
    @enderror
</div>
{{-- <option value="AF"
    data-hs-select-option='{
  "icon": "<img class=\"inline-block size-4 rounded-full\" src=\"../assets/vendor/svg-country-flags/png100px/af.png\" alt=\"Afghanistan\" />"}'>
    Afghanistan
</option> --}}
