<div>
    <x-admin.heading class="pb-5">Users</x-admin.heading>
    <x-card-basic>
        <x-table>
            <x-slot:action>
                <x-button class="btnPrimary me-2" wire:click.prevent="createUser">
                    <x-slot:loading wire:target="createUser">
                        Memuat
                    </x-slot:loading>
                    <x-slot:default wire:target="createUser">
                        Tambah
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>
                    </x-slot:default>
                </x-button>
            </x-slot>
            <x-slot name="heading">
                <tr>
                    <x-table.checkbox-header />
                    <th scope="col" class="">Name</th>
                    <th scope="col" class="">username</th>
                    <th scope="col" class="">email</th>
                    <th scope="col" class="">Action</th>
                </tr>
            </x-slot>
            <x-slot name="body">
                @foreach ($users as $user)
                    <tr class="hover:bg-slate-200 dark:hover:bg-slate-800" wire:key="{{ $user->id }}">
                        <x-table.checkbox-body />
                        <td class="">{{ $user->name }}</td>
                        <td class="">{{ $user->username }}</td>
                        <td class="">{{ $user->email }}</td>
                        <td class="">
                            <button type="button"
                                class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-primary-600 hover:text-primary-800 focus:outline-none focus:text-primary-800 disabled:opacity-50 disabled:pointer-events-none dark:text-primary-500 dark:hover:text-primary-400 dark:focus:text-primary-400">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
            <x-slot:pagination>
                {{ $users->links(data: ['scrollTo' => false]) }}
            </x-slot:pagination>
        </x-table>
    </x-card-basic>

</div>
