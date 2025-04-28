<x-card-basic class="md:col-span-4">
    <x-slot:title>
        Create Role
    </x-slot>
    <div class="px-2.5 py-3">
        <form action="">
            <x-form.input-float label="Role" id="role" name="form.name"
                wire:model.live.debounce.500ms="form.name" />
            <x-form.label class="sr-only" for="type"></x-form.label>
            <x-form.select class="w-full mt-2.5" id="type" name="form.type" wire:model="form.type">
                <option value="" selected hidden>Choose category</option>
                <option value="employe">Employe</option>
                <option value="user">User</option>
                <option value="receptionist">Receptionist</option>
            </x-form.select>
            <div class="flex justify-end mt-3">
                <x-button class="btnSecondary me-2" wire:click.prevent="resetForm">
                    <x-slot:loading wire:target="resetForm" class="dark:text-gray-200">
                        Mereset
                    </x-slot:loading>
                    <x-slot:default wire:target="resetForm" class="dark:text-gray-200">
                        Reset
                    </x-slot:default>
                </x-button>
                <x-button class="btnPrimary" wire:click.prevent="createRole">
                    <x-slot:loading wire:target="createRole">
                        Menyimpan
                    </x-slot:loading>
                    <x-slot:default wire:target="createRole">
                        Simpan
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