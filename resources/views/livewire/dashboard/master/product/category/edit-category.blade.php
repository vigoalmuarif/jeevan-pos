<div class="md:col-span-4">
    <x-card-basic class="md:col-span-4">
        <x-slot:title>
            Ubah Kategori
        </x-slot>
        <div class="px-2.5 py-3">
            <form action="">
                <div class="mb-4">
                    <x-form.input-float label="Kategori" id="name" name="form.name"
                        wire:model="form.name" />
                </div>
                <div class="my-4">
                    <x-form.input-float label="Kode Kategori" id="category_code" name="form.category_code"
                        wire:model="form.category_code" />
                </div>
                <div class="my-4">
                    <x-form.toggle name="form.status" id="status" label="Aktif" wire:model="form.status" />
                </div>
                <div class="flex justify-end mt-3">
                    <x-button class="btnSecondary me-2" wire:click.prevent="cancelEdit" wire:target="save" wire:loading.remove>
                        <x-slot:loading wire:target="cancelEdit" class="text-slate-600 dark:text-gray-50">
                            Membatalkan
                        </x-slot:loading>
                        <x-slot:default wire:target="cancelEdit" class="text-slate-600 dark:text-gray-50">
                            Batal
                        </x-slot:default>
                    </x-button>
                    <x-button class="btnPrimary" wire:click.prevent="save">
                        <x-slot:loading wire:target="save">
                            Mengubah
                        </x-slot:loading>
                        <x-slot:default wire:target="save">
                            Ubah
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-4 inline-flex">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>
                        </x-slot:default>
                    </x-button>
                </div>
            </form>
        </div>
    </x-card-basic>

</div>
