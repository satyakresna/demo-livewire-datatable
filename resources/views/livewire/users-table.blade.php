@push('scripts')
<script src="/js/sweetalert.min.js"></script>
<script>
    window.addEventListener('swal:confirm', (e) => {
        swal({
            title: e.detail.title,
            text: e.detail.message,
            icon: 'warning',
            buttons: true,
            dangerMode: true
        })
        .then((willDelete) => {
            if (willDelete) {
                window.Livewire.emit('delete', e.detail.id, e.detail.name);
            }
        })
    });

    window.addEventListener('swal:ok', (e) => {
        swal({
            title: e.detail.title,
            text: e.detail.message,
            icon: 'success'
        })
        .then(() => window.Livewire.emit('refreshUsersTable'));
    });

    window.addEventListener('swal:error', (e) => {
        swal({
            title: e.detail.title,
            text: e.detail.message,
            icon: 'error'
        });
    });
</script>
@endpush
<div>
    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center mb-4">
        <div class="flex flex-col lg:flex-row space-y-2 lg:space-y-0 lg:space-x-2">
            <label>
                <select wire:model="perPage" class="w-1/2 lg:w-auto mt-1 shadow-sm border-gray-300 rounded-md text-sm focus:border-purple-400 focus:ring focus:ring-purple-400">
                    <option>10</option>
                    <option>15</option>
                    <option>25</option>
                </select>
                <span>Per halaman</span>
            </label>
            <label>
                <select wire:model="searchUserType" class="w-full lg:w-auto mt-1 shadow-sm border-gray-300 rounded-md text-sm focus:border-purple-400 focus:ring focus:ring-purple-400">
                    <option value="">Tipe pengguna</option>
                    @foreach (users_type() as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </label>
            <label>
                <input type="text" wire:model.lazy="search" placeholder="Cari pengguna..." class="w-full lg:w-auto shadow-sm border-gray-300 rounded-md mt-1 text-sm focus:border-purple-400 focus:ring focus:ring-purple-400">
            </label>
            <button wire:click="refreshUsersTable" class="w-full lg:w-auto mt-1 w-48 py-2 px-4 rounded-md font-semibold text-white bg-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">Perbaharui data</button>
        </div>
        <!-- <div class="mt-4 lg:mt-0"> -->
            <!-- <label> -->
                <!-- <a href="{{-- route('users.create') --}}" class="mt-1 inline-block lg:inline w-full lg:w-48 py-2 px-4 rounded-md font-semibold text-white bg-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50 text-center">Tambah Pengguna</a>    -->
            <!-- </label> -->
        <!-- </div> -->
    </div>

    <div wire:loading.flex wire:target="refreshUsersTable" class="justify-center my-2">
        <p class="text-blue-500 semibold tracking-wide">Memuat ulang data pengguna...</p>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3">
                            <a href="#" wire:click.prevent="sortBy('name')" role="button">
                                <div class="flex">
                                    Nama
                                    @include('includes._sort-icon', ['field' => 'name'])
                                </div>
                            </a>
                        </th>
                        <th class="px-4 py-3">
                            Email
                        </th>
                        <th class="px-4 py-3">
                            User Type
                        </th>
                        <th class="px-4 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @foreach ($users as $user)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-sm">{{ $user->name }}</td>
                            <td class="px-4 py-3 text-sm">{{ $user->email }}</td>
                            <td class="px-4 py-3 text-sm">{{ ucfirst($user->type) }}</td>
                            <td class="px-4 py-3 text-sm">
                                <div class="flex items-center space-x-4 text-sm">
                                    <button class="delete__btn flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:ring focus:ring-gray-500 focus:ring-opacity-50"
                                        aria-label="Delete user"
                                        title="Delete {{ $user->name }}"
                                        wire:click="deleteConfirm('{{ $user->id }}', '{{ $user->name }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 sm:grid-cols-9">
            <span class="flex items-center col-span-3">
                Menampilkan {{ $users->firstItem() }} sampai {{ $users->lastItem() }} dari {{ $users->total() }} hasil
            </span>
            <span class="col-span-2"></span>
            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                {{ $users->links('includes._pagination') }}
            </span>
        </div>
    </div>
</div>
