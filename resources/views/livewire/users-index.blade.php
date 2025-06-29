<div>
    <x-partials.sidebar currentUrl="{{ $currentUrl }}">
        <div class="mx-auto">

            {{-- Judul --}}
            <h4 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4">Users Management</h4>

            {{-- Flash Message --}}
            @if (session()->has('message'))
                <div class="mb-4 text-sm text-green-600 dark:text-green-400">
                    {{ session('message') }}
                </div>
            @endif

            {{-- Input Pencarian --}}
            <div class="mb-4">
                <input type="text" id="search"
                       wire:model.live.debounce.150ms="search"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                       placeholder="Cari berdasarkan nama atau email...">
            </div>

            {{-- Tabel User --}}
            <a href="{{ url('admin/users/create') }}"
               wire:navigate
               class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                Tambah User
            </a>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-200">
                    <tr>
                        <th scope="col" class="px-4 py-3">#</th>
                        <th scope="col" class="px-4 py-3">Nama</th>
                        <th scope="col" class="px-4 py-3">Email</th>
                        <th scope="col" class="px-4 py-3">Role</th>
                        <th scope="col" class="px-4 py-3">Dibuat</th>
                        <th scope="col" class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($users as $index => $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-4 py-3">{{ $users->firstItem() + $index }}</td>
                            <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $user->name }}</td>
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-white bg-blue-500 rounded">
                                        {{ ucfirst($user->role) }}
                                    </span>
                            </td>
                            <td class="px-4 py-3">{{ $user->created_at->diffForHumans() }}</td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center gap-2">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('users.edit', $user->id) }}"
                                       class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                        Edit
                                    </a>

                                    {{-- Tombol Hapus --}}
                                    <button wire:click="delete({{ $user->id }})"
                                            onclick="return confirm('Yakin ingin hapus user ini?')"
                                            class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-2 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-white dark:bg-gray-800">
                            <td colspan="6" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                                Tidak ada data.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $users->links() }}
            </div>

        </div>
    </x-partials.sidebar>

    {{-- Notifikasi dengan toast --}}
    @if(session()->has('create-user-success'))
        <script> successToast('Berhasil menambahkan User'); </script>
    @endif

    @if(session()->has('changes-success'))
        <script> successToast('Berhasil menyimpan perubahan'); </script>
    @endif

    @if(session()->has('delete-user-success'))
        <script> successToast('Berhasil menghapus user'); </script>
    @endif

    @if(session()->has('bad-request'))
        <script> errorToast('400 Bad Request'); </script>
    @endif
</div>
