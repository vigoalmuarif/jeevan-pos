<div class="relative overflow-y-auto h-[calc(100vh-333px)] animate-pulse">
    <div
        class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 4xl:grid-cols-4 gap-3 place-content-start overflow-y-auto  scrollbar-thin">
        @for ($i = 0; $i < 9; $i++)
            <div
                class="bg-white border border-gray-200 rounded-xl flex flex-col shadow-2xs dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex pb-2">
                    <div class="shrink-0 h-20 md:h-28 self-center md:self-start overflow-hidden  p-1.5 w-20 md:w-32">
                        <div class="bg-gray-200 rounded-full h-14 w-14 md:w-20 md:h-20 dark:bg-neutral-700"></div>
                    </div>
                    <div class="p-2 w-full">
                        <div class="w-full h-4 bg-gray-200 rounded-full dark:bg-neutral-700 my-2"></div>
                        <div class="w-20 h-4 bg-gray-200 rounded-full dark:bg-neutral-700 my-2"></div>
                        <div class="w-40 h-4 bg-gray-200 rounded-full dark:bg-neutral-700 my-2"></div>
                    </div>
                </div>
                <div class="px-2">
                    <div class="mb-2.5 pe-2 bg-slate-200/60 rounded-lg dark:bg-neutral-900 dark:border-neutral-700">
                        <div class="w-full flex-wrap justify-between items-center flex md:hidden space-y-3">
                            <div class="flex w-full justify-between items-center">
                                <div class="bg-gray-200 rounded-full dark:bg-neutral-700 w-32 h-6"></div>
                                <div class="bg-gray-200 rounded-full dark:bg-neutral-700 w-24 h-6"></div>
                            </div>
                            <div class="bg-gray-200 rounded-full dark:bg-neutral-700 w-full  h-7"></div>
                        </div>
                        <div class="w-full flex-wrap justify-between items-center hidden md:flex">
                            <div class="bg-gray-200 rounded-full dark:bg-neutral-700 w-20 h-6"></div>
                            <div class="bg-gray-200 rounded-full dark:bg-neutral-700 w-40  h-6"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
