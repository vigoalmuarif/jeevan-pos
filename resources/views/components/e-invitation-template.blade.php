@props(['form', 'item'])
<div class="w-[32rem] mx-auto bg-white  rounded-xl">
    <div class="relative h-80 w-full">
        <div class="h-full w-full @if ($form->show_title === true) brightness-[0.4]  @endif @if(!$form->image) bg-primary-500 @else bg-white @endif">
            @if ($form->image)
            <img src="{{ $form->image->temporaryUrl() }}" class="w-full  h-full object-cover rounded-lg" />
            @elseif($form->path_image_name)
            <img src="{{ asset('storage/images/einvitation/'.$form->path_image_name) }}" class="w-full  h-full object-cover" />
            @endif
        </div>
        @if ($form->show_title === true)
            <div class="absolute inset-0 flex flex-col items-center justify-center">
                <h6 class="text-slate-200 font-normal">{{ $form->text_top }}</h6>
                <h1 class="text-4xl text-white font-bold py-3">{{ $form->title }}</h1>
                <h6 class="text-slate-200 font-normal">{{ $form->text_bottom }}</h6>
            </div>
        @endif
    </div>
    <div class="event_date p-6">
        <div class="flex flex-nowrap gap-4 items-center">
            @if ($form->show_event_date === true)
                <div class="shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-8 md:size-14 stroke-slate-800">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

                </div>
            @endif
            <div class="flex flex-col">
                @if ($form->show_event_name === true)
                    <p class="text-slate-500 font-semibold text-lg">{{ $form->title }}</p>
                @endif
                @if ($form->show_event_date === true)
                    <p class="text-slate-700 font-semibold text-base md:text-lg">{{ $item->event->date ?? 'Hari belum dibuat' }}</p>
                    <p class="text-slate-500 font-medium">{{ ($item->start_date ?? 'belum dibuat') .' - '.($item->end_date ?? 'belum dibuat') .' '.($item->time_zone ?? 'WIB') }}</p>
                @endif
                @if ($form->show_location_event === true)
                    <p class="text-slate-600 flex items-center mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 -ms-1 me-1 inline-flex">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        @if($item->event?->same_location === 1) {{ str()->title($item->event->building_name ?? '-').' - '. str()->title($item->event->address ?? '').', '.str()->title($item->event->city ?? '') }}@else {{ str()->title($item->building_name ?? '').' - '. str()->title($item->address ?? '').', '.str()->title($item->city ?? '') }}  @endif
                    </p>
                @endif
            </div>
        </div>
    </div>
    <div class="messages grid grid-cols-12 gap-4 p-6">
        <div class="col-span-7">
            <p class="text-base">{{ $form->sapaan }}</p>
            <div class="flex items-center">
                <p class="text-xl md:text-2xl text-slate-700 font-semibold">{{ $guest->name ?? 'John Doe' }}</p>
                @if ($form->show_vip_guest === true)
                    <span
                        class="bg-amber-500/20 rounded-full px-2 ms-1.5 py-0.5 flex items-center text-amber-500 font-semibold text-xs"><svg
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="size-4 fill-amber-400 inline-flex">
                            <path fill-rule="evenodd"
                                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                clip-rule="evenodd" />
                        </svg>
                        VIP
                    </span>
                @endif
            </div>
            <p class="leading-relaxed mt-2 text-slate-500">{{ $form->message }}</p>
        </div>
        <div class="col-span-5 self-end">
            @if ($form->show_qrcode === true)
                <div>
                    <img src="data:image/png;base64,{{ $form->qrcode }}" class="mx-auto" alt="QR Code">
                </div>
            @endif
        </div>
    </div>
    <div
        class="more flex space-y-5 @if ($form->show_invitation_link === true) justify-between @else justify-end @endif items-end pt-3 pb-5 px-6">
        @if ($form->show_invitation_link === true)
            <div>
                <p class="text-base text-slate-400">More Info</p>
                <p class="text-sm text-slate-500">link.info.com</p>
            </div>
        @endif
        <div>
            <p class="text-base text-slate-400">Powered By</p>
            <p class="text-sm text-slate-500">lmenoewabersama.com</p>
        </div>

    </div>
</div>
