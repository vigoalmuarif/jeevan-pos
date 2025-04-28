<form wire:submit.prevent="save">
    <x-modal title="Pembayaran">
        <p>{{ $subtotal }}</p>
        <p>{{ $discountTransaction }}</p>
        <p>{{ $tax }}</p>
        <p class="font-semibold valuePayment">{{ $pay }}</p>
        <div class="grid grid-cols-3 gap-2 py-1">
            <button type="button" class="p-2 rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20" onClick="addNumber(1)">
                1
            </button>
            <button type="button" class="p-2 rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"  onClick="addNumber(2)">
                2
            </button>
            <button type="button" class="p-2 rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"  onClick="addNumber(3)">
                3
            </button>
        </div>
        <div class="grid grid-cols-3 gap-2 py-1">
            <button type="button" class="p-2 rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"  onClick="addNumber(4)">
                4
            </button>
            <button type="button" class="p-2 rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"  onClick="addNumber(5)">
                5
            </button>
            <button type="button" class="p-2 rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"  onClick="addNumber(6)">
                6
            </button>
        </div>
        <div class="grid grid-cols-3 gap-2 py-1">
            <button type="button" class="p-2 rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"  onClick="addNumber(7)">
                7
            </button>
            <button type="button" class="p-2 rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"  onClick="addNumber(8)">
                8
            </button>
            <button type="button" class="p-2 rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"  onClick="addNumber(9)">
                9
            </button>
        </div>
        <div class="grid grid-cols-3 gap-2 py-1">
            <button type="button" class="p-2 rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"  onClick="addNumber('000')">
                000
            </button>
            <button type="button" class="p-2 rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"  onClick="addNumber('0')">
                0
            </button>
            <button type="button" class="p-2 rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"  onClick="addNumber('.')">
                .
            </button>
        </div>
       
        <x-slot name="footer">
            <x-button class="btnSecondary" wire:click="$dispatch('closeModal')">
                Batal
            </x-button>
            <x-button type="submit" class="btnPrimary" wire:target="save">
                <x-slot name="loading" wire:target="save">
                    Memproses
                </x-slot>
                <x-slot name="default" wire:target="save">
                    Simpan
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4 inline-flex">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                    </svg>

                </x-slot>
            </x-button>
        </x-slot>
    </x-modal>
    <script>
        function addNumber(value) {
            $('.valuePayment').text($('.valuePayment').text() + value);
        }
    </script>
</form>
{{-- @script --}}
{{-- @endscript --}}
