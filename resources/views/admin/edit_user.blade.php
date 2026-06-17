<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-6">
                <nav class="flex text-sm text-gray-500 mb-4">
                    <a href="{{ route('admin.users') }}" class="hover:text-blue-600 transition-colors">Manajemen User</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-900 font-medium">Edit: {{ $user->name }}</span>
                </nav>
                <h1 class="text-2xl font-bold text-gray-900">Perbarui Data Anggota</h1>
                <p class="text-gray-500">Ubah informasi akun pengguna ini.</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    {{-- Nama Lengkap --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full border-gray-200 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition-shadow bg-gray-50 focus:bg-white">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full border-gray-200 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition-shadow bg-gray-50 focus:bg-white">
                    </div>

                    {{-- Role --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Peran (Role)</label>
                        <div class="relative">
                            <select name="role" required class="w-full border-gray-200 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition-shadow bg-gray-50 focus:bg-white appearance-none py-3 px-4">
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User (Peminjam)</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrator</option>
                            </select>
                             <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-r-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    Catatan: Password tidak dapat diubah di sini. Gunakan fitur "Reset Password" di halaman daftar user jika diperlukan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex items-center gap-4">
                         <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition-colors shadow-md hover:shadow-lg">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.users') }}" class="w-full sm:w-auto px-6 py-3 bg-white text-gray-600 font-bold rounded-xl border border-gray-200 hover:bg-gray-50 transition-colors text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>