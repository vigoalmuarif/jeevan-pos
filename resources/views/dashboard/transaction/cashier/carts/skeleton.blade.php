<div class="flex flex-col space-y-3 animate-pulse px-2.5">
    @for ($i = 0; $i < 5; $i++)
    <div class="bg-white border border-transparent py-2 hover:border-primary-400 rounded-xl shadow-2xs flex  dark:bg-neutral-900  dark:shadow-neutral-700/70">
        <div class="shrink-0 self-center h-20 w-20 mx-1.5">
            <div class="w-20 h-20 bg-gray-200 rounded-full dark:bg-neutral-700 my-2"></div>
        </div>
        <div class="p-2 w-full flex flex-col space-y-3">
            <div class="bg-gray-200 rounded-full dark:bg-neutral-700 w-full h-4"></div>
            <div class="bg-gray-200 rounded-full dark:bg-neutral-700 w-24 h-4"></div>
            <div class="pt-2 bg-slate-200/60 rounded-lg dark:bg-neutral-900 dark:border-neutral-700">
                <div class="flex justify-between items-center">
                    <div class="bg-gray-200 rounded-full dark:bg-neutral-700 w-24 h-4"></div>
                    <div class="bg-gray-200 rounded-full dark:bg-neutral-700 w-24 h-4"></div>
                </div>
            </div>
            <!-- End Input Number -->
        </div>
    </div>
    @endfor   
    <div class="absolute inset-x-0 bottom-0 p-2.5">
        <div class="flex flex-col p-2.5 space-y-3 bg-slate-200/70 dark:bg-neutral-900 rounded-xl">
    
            <div class="flex justify-between items-center">
                <div class="bg-gray-200 rounded-full dark:bg-neutral-700 w-24 h-5"></div>
                <div class="bg-gray-200 rounded-full dark:bg-neutral-700 w-24 h-5"></div>
            </div>
            <div class="flex justify-between items-center">
                <div class="bg-gray-200 rounded-full dark:bg-neutral-700 w-24 h-5"></div>
                <div class="bg-gray-200 rounded-full dark:bg-neutral-700 w-24 h-5"></div>
            </div>
            <div class="flex justify-between items-center">
                <div class="bg-gray-200 rounded-full dark:bg-neutral-700 w-24 h-5"></div>
                <div class="bg-gray-200 rounded-full dark:bg-neutral-700 w-24 h-5"></div>
            </div>
            <div class="flex justify-between items-center">
                <div class="bg-gray-200 rounded-full dark:bg-neutral-700 w-24 h-6"></div>
                <div class="bg-gray-200 rounded-full dark:bg-neutral-700 w-24 h-6"></div>
            </div>
        </div>
        <div class="bg-gray-200 rounded-full dark:bg-neutral-700 w-full h-10 mt-3"></div>

    </div>


</div>
