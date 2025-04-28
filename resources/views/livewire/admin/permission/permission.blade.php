<div>
    <x-admin.heading class="pb-5">Permissions</x-admin.heading>
    <div class="grid grid-cols-1 md:grid-cols-12 items-start gap-4">
        <livewire:admin.permission.create-permission />
        <x-card-basic class="md:col-span-8">
            <div class="relative">
                <x-table>
                    <x-slot:action>

                    </x-slot>
                    <x-slot name="heading">
                        <tr>
                            <th scope="col" class="w-10">No</th>
                            <th scope="col" class="">Name</th>
                            <th scope="col" class="">Guard</th>
                            <th scope="col" class="">Action</th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($permissions as $permission)
                            <tr class="hover:bg-slate-200 dark:hover:bg-slate-800">
                                <td class="w-10">{{ $loop->index }}</td>
                                <td class="">{{ $permission->name }}</td>
                                <td class="">{{ $permission->guard_name }}</td>
                                <td class="">
                                    <x-button.button-icon color="info" title="Permission" name="{{ $permission->id }}" wire:click="permission({{ $permission->id }})" wire:loading.attr="disabled">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 stroke-2 stroke-current fill-none group-hover:stroke-cyan-900 dark:group-hover:stroke-cyan-200" wire:target="permission">
                                            <path fill-rule="evenodd" d="M15.75 1.5a6.75 6.75 0 0 0-6.651 7.906c.067.39-.032.717-.221.906l-6.5 6.499a3 3 0 0 0-.878 2.121v2.818c0 .414.336.75.75.75H6a.75.75 0 0 0 .75-.75v-1.5h1.5A.75.75 0 0 0 9 19.5V18h1.5a.75.75 0 0 0 .53-.22l2.658-2.658c.19-.189.517-.288.906-.22A6.75 6.75 0 1 0 15.75 1.5Zm0 3a.75.75 0 0 0 0 1.5A2.25 2.25 0 0 1 18 8.25a.75.75 0 0 0 1.5 0 3.75 3.75 0 0 0-3.75-3.75Z" clip-rule="evenodd" />
                                          </svg>
                                    </x-button.button-icon>
                                </td>
                            </tr>
                        @endforeach

                    </x-slot>
                </x-table>
            </div>
            <div class="py-4">
                {{ $permissions->links(data: ['scrollTo' => false]) }}
            </div>
        </x-card-basic>
    </div>

</div>
