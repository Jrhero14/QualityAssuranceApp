<div>
    <x-partials.sidebar currentUrl="{{ request()->url() }}">
        <div class="max-w-2xl mx-auto p-6">
            <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 p-6">

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Edit User</h2>

                @if (session()->has('update-user-success'))
                    <div class="mb-4 text-sm text-green-700 bg-green-100 rounded-lg p-3 dark:bg-green-800 dark:text-green-200" role="alert">
                        ✅ Perubahan berhasil disimpan!
                    </div>
                @endif

                <form wire:submit.prevent="submit" x-data="{ showPasswordForm: false }" class="space-y-6">
                    {{-- Nama --}}
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
                        <input type="text" id="name" wire:model.defer="name"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                               placeholder="Masukkan nama lengkap">
                        @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat Email</label>
                        <input type="email" id="email" wire:model.defer="email"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                               placeholder="email@example.com">
                        @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    {{-- Tombol tampilkan password --}}
                    <div>
                        <button type="button"
                                @click="showPasswordForm = !showPasswordForm"
                                class="text-sm text-blue-600 hover:underline dark:text-blue-400">
                            <span x-show="!showPasswordForm">🔒 Ubah Password</span>
                            <span x-show="showPasswordForm">✖️ Batal Ubah Password</span>
                        </button>
                    </div>

                    {{-- Password --}}
                    <div x-show="showPasswordForm" x-transition>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password Baru</label>
                        <input type="password" id="password" wire:model.defer="password"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                               placeholder="Minimal 6 karakter">
                        @error('password') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div x-show="showPasswordForm" x-transition>
                        <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi Password</label>
                        <input type="password" id="confirm_password" wire:model.defer="confirm_password"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                               placeholder="Ulangi password baru">
                        @if($password || $confirm_password)
                            @if($password !== $confirm_password)
                                <span class="text-sm text-red-600">Password tidak cocok.</span>
                            @endif
                        @endif
                    </div>

                    {{-- Role --}}
                    <div>
                        <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                        <select id="role" wire:model.defer="role"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="">-- Pilih Role --</option>
                            <option value="supervisor">Supervisor</option>
                            <option value="operator">Operator</option>
                        </select>
                        @error('role') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('users.index') }}"
                           wire:navigate
                           class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 dark:text-white dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-500">
                            Kembali
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800"
                                @if($password && $confirm_password && $password !== $confirm_password) disabled @endif>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-partials.sidebar>
</div>
