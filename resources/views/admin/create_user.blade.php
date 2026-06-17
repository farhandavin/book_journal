<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah User Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-6">
                <nav class="flex text-sm text-gray-500 mb-4">
                    <a href="{{ route('admin.users') }}" class="hover:text-blue-600 transition-colors">Manajemen User</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-900 font-medium">Tambah User</span>
                </nav>
                <h1 class="text-2xl font-bold text-gray-900">Tambah Anggota Baru</h1>
                <p class="text-gray-500">Buat akun untuk anggota atau admin baru.</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    {{-- Nama Lengkap --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" class="w-full border-gray-200 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition-shadow bg-gray-50 focus:bg-white" placeholder="Masukkan nama lengkap" required>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Email</label>
                        <input type="email" name="email" class="w-full border-gray-200 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition-shadow bg-gray-50 focus:bg-white" placeholder="contoh@email.com" required>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" class="w-full border-gray-200 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition-shadow bg-gray-50 focus:bg-white" placeholder="••••••••" required>
                        <p class="text-xs text-gray-400 mt-1">Minimal 8 karakter.</p>
                    </div>

                    {{-- Role --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Peran (Role)</label>
                        <div class="relative">
                            <select name="role" class="w-full border-gray-200 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition-shadow bg-gray-50 focus:bg-white appearance-none py-3 px-4">
                                <option value="user">User (Peminjam)</option>
                                <option value="admin">Administrator</option>
                            </select>
                             <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex items-center gap-4">
                        <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition-colors shadow-md hover:shadow-lg">
                            Simpan User
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