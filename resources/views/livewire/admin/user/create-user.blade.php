<form wire:submit.prevent="save">
    <x-modal title="Create User">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <x-form.input-float label="Username" id="username" name="form.username"
                wire:model.live.debounce.500ms="form.username" />
            <x-form.input-float label="Email" type="email" id="email" name="form.email"
                wire:model.live.debounce.500ms="form.email" />
            <x-form.input-float label="Nama Panggilan" id="name" name="form.name" wire:model="form.name" />
            <x-form.input-float type="date" label="Birthday" id="birthday" name="form.birthday"
                wire:model="form.birthday" />
            <div class=" py-3">
                <div class="flex gap-x-4">
                    {{-- <x-form.label>Jenis Kelamin</x-form.label> --}}
                    <x-form.radio name="form.gender" id="laki-laki" label="Laki-laki" value="L"
                        wire:model="form.gender" />
                    <x-form.radio name="form.gender" id="perempuan" label="perempuan" value="P"
                        wire:model="form.gender" />
                </div>
                @error('form.gender')
                    <p class="isInvalidMessage" id="error-msg-gender">{{ $message }}</p>
                @enderror
            </div>
            <x-form.input-float label="WhatsApp" type="text" id="phone" name="form.phone"
                wire:model.live.debounce.500ms="form.phone" />
            <x-form.textarea class="border-transparent md:col-span-2" placeholder="Alamat"
                wire:form.address></x-form.textarea>
            <div class="md:col-span-2 w-full" wire:ignore>
                <select class="js-example-basic-multiple w-full" name="states[]" multiple="multiple"
                    style="width: 100%;">
                    <option value="AL">Alabama</option>
                    <option value="AL">hahaha</option>
                    <option value="AL">tatag</option>
                    <option value="AL">jdjdjd</option>
                    <option value="AL">apdodid</option>
                    <option value="AL">ndmsmsn</option>
                    <option value="AL">Alabama</option>
                    <option value="WY">Wyoming</option>
                </select>
            </div>
            <x-form.input-float type="password" label="Password" id="password" name="form.password"
                wire:model="form.password" />
            <x-form.input-float type="password" label="Ulangi Password" id="password_confirmation"
                name="form.password_confirmation" wire:model.live.debounce.500ms="form.password_confirmation" />

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
</form>
@script
    <script>
        $('.js-example-basic-multiple').select2({
            placeholder: "Pilih Role",
        });
        document.addEventListener('livewire:update', function() {
            // Re-inisialisasi Select2 setelah Livewire update konten
            $('.js-example-basic-multiple').select2({
                placeholder: "Pilih Role",
            });
        });
    </script>
@endscript
