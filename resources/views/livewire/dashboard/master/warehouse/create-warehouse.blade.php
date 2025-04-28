<form wire:submit.prevent="save">
    <x-modal title="Tambah Warehouse/Branch">
        <div class="my-4 w-full">
            <x-form.select id="type" class="w-full" name="form.type" wire:model="form.type">
                <option value="Branch">Branch</option>
                <option value="Warehouse">Warehouse</option>
            </x-form.select>
        </div>
        <div class="my-4">
            <x-form.input-float label="Kode Warehouse/Branch" id="warehouse_code" name="form.warehouse_code"
                wire:model.live.debounce.500ms="form.warehouse_code" />
        </div>
        <div class="my-4">
            <x-form.input-float label="Nama" id="name" name="form.name"
                wire:model.live.debounce.500ms="form.name" />
        </div>
        <div class="my-4">
            <x-form.input-float label="Lokasi" id="location" name="form.location" wire:model.live="form.location" />
        </div>
        <div class="my-4">
            <x-form.input-float label="Alamat" id="address" name="form.address" wire:model.live="form.address" />
        </div>
        <div class="my-4">
            <x-form.input-float label="Phone" id="phone" name="form.phone" wire:model.live="form.phone" />
        </div>
        <div class="my-4" wire:ignore>
            <x-form.select-search placeholder="Pilih PIC" id="ppic_id" name="form.ppic_id" wire:model="form.ppic_id">
                <option value="">Pilih PPIC</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" wire:key="user-{{ $user->id }}">{{ $user->name }}
                    </option>
                @endforeach
            </x-form.select-search>
        </div>
        <x-slot name="footer">
            <x-button class="btnSecondary text-slate-700 dark:text-slate-50" wire:click="$dispatch('closeModal')">
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
</form>
