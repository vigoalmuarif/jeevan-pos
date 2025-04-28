<form wire:submit.prevent="save">
    <x-modal title="Role Permission">
        <div class="">
            <x-table :perPage="false" count="{{ $permissions->count() }}">
                <x-slot:action>
                    <div
                        class="py-2 px-4 text-semibold text-sm text-center bg-gray-200 text-slate-700 dark:bg-slate-800 dark:text-slate-200 align-middle rounded-xl">
                        Role: {{ $role->name }}
                    </div>
                </x-slot>
                <x-slot name="heading">
                    <tr>
                        <th scope="col" class="w-10">No</th>
                        <th scope="col" class="">Permission</th>
                        <th scope="col" class="w-20">Action</th>
                    </tr>
                </x-slot>
                <x-slot name="body">
                    @foreach ($permissions as $item)
                        <tr class="hover:bg-slate-200 dark:hover:bg-slate-800">
                            <td class="">{{ $loop->index + 1 }}</td>
                            <td class="">{{ $item->name }}</td>
                            <td class="">
                                <x-form.toggle name="permission[]" id="{{ $item->id }}" value="{{ $item->name }}"
                                    wire:click="togglePermission('{{ $item->name }}')"
                                    wire:model.live="selectedPermissions" wire:key="{{ $item->id }}" />
                            </td>
                        </tr>
                    @endforeach

                </x-slot>
            </x-table>
        </div>
        <x-slot name="footer">
            <x-button class="btnSecondary" wire:click="$dispatch('closeModal')">
                Tutup
            </x-button>
        </x-slot>
    </x-modal>
</form>
@script
    <script>
        $('.js-example-basic-multiple').select2({
            placeholder: "Pilih Role",
        });
        document.addEventListener('livewire:render', function() {
            $('.js-example-basic-multiple').select2({
                placeholder: "Pilih Role",
            }); // Inisialisasi Select2 setelah render ulang
        });
    </script>
@endscript
