<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            {{-- Welcome Banner --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Selamat Datang, Admin! 👋</h1>
                    <p class="mt-2 text-gray-500 text-lg">Ringkasan aktivitas dan manajemen perpustakaan Anda.</p>
                </div>
                <div class="mt-6 md:mt-0">
                    <span class="px-5 py-2.5 bg-blue-50 text-blue-700 rounded-xl text-sm font-bold border border-blue-100 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ now()->isoFormat('dddd, D MMMM Y') }}
                    </span>
                </div>
            </div>

            {{-- Kartu Statistik (Stats Cards) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                {{-- Card 1: Total Users --}}
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition duration-300 relative group overflow-hidden">
                    <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:scale-125 transition-transform duration-500">
                         <svg class="w-32 h-32 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    </div>
                    <div class="flex justify-between items-start relative z-10">
                        <div>
                            <p class="text-sm font-bold text-gray-500 uppercase tracking-wider">Total Pengguna</p>
                            <h3 class="text-4xl font-black text-gray-900 mt-2">{{ $totalUsers }}</h3>
                        </div>
                        <div class="p-4 bg-blue-100 rounded-xl text-blue-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                    </div>
                    <a href="{{ route('admin.users') }}" class="mt-6 inline-flex items-center text-sm font-bold text-blue-600 hover:text-blue-800 relative z-10 group-hover:translate-x-1 transition-transform">
                        Kelola User <span class="ml-1">→</span>
                    </a>
                </div>

                {{-- Card 2: Total Books --}}
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition duration-300 relative group overflow-hidden">
                     <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:scale-125 transition-transform duration-500">
                        <svg class="w-32 h-32 text-green-600" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/></svg>
                    </div>
                    <div class="flex justify-between items-start relative z-10">
                        <div>
                            <p class="text-sm font-bold text-gray-500 uppercase tracking-wider">Total Buku</p>
                            <h3 class="text-4xl font-black text-gray-900 mt-2">{{ $totalBooks }}</h3>
                        </div>
                        <div class="p-4 bg-green-100 rounded-xl text-green-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                    </div>
                     <a href="{{ route('home') }}" class="mt-6 inline-flex items-center text-sm font-bold text-green-600 hover:text-green-800 relative z-10 group-hover:translate-x-1 transition-transform">
                        Lihat Katalog <span class="ml-1">→</span>
                    </a>
                </div>

                {{-- Card 3: Active Loans --}}
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition duration-300 relative group overflow-hidden">
                     <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:scale-125 transition-transform duration-500">
                        <svg class="w-32 h-32 text-orange-600" fill="currentColor" viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                    </div>
                    <div class="flex justify-between items-start relative z-10">
                        <div>
                            <p class="text-sm font-bold text-gray-500 uppercase tracking-wider">Sedang Dipinjam</p>
                            <h3 class="text-4xl font-black text-gray-900 mt-2">{{ $activeLoans }}</h3>
                        </div>
                        <div class="p-4 bg-orange-100 rounded-xl text-orange-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <a href="{{ route('admin.borrowings.index') }}" class="mt-6 inline-flex items-center text-sm font-bold text-orange-600 hover:text-orange-800 relative z-10 group-hover:translate-x-1 transition-transform">
                        Lihat Peminjaman <span class="ml-1">→</span>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- Quick Menu --}}
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="p-3 bg-purple-100 rounded-xl text-purple-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">Menu Cepat</h2>
                            <p class="text-gray-500 text-sm">Akses cepat manajemen data.</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <a href="{{ route('admin.users.create') }}" class="flex flex-col items-center justify-center p-6 bg-blue-50 border border-blue-100 rounded-xl hover:bg-blue-100 transition group cursor-pointer text-center">
                            <div class="p-4 bg-white rounded-full text-blue-600 shadow-sm mb-4 group-hover:scale-110 transition duration-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                            </div>
                            <span class="font-bold text-blue-900 text-lg">Tambah User</span>
                            <span class="text-xs text-blue-600 mt-1 font-medium bg-blue-200 px-2 py-0.5 rounded-full">Admin Only</span>
                        </a>

                        <a href="{{ route('book.add') }}" class="flex flex-col items-center justify-center p-6 bg-purple-50 border border-purple-100 rounded-xl hover:bg-purple-100 transition group cursor-pointer text-center">
                            <div class="p-4 bg-white rounded-full text-purple-600 shadow-sm mb-4 group-hover:scale-110 transition duration-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                            <span class="font-bold text-purple-900 text-lg">Tambah Buku</span>
                            <span class="text-xs text-purple-600 mt-1 font-medium bg-purple-200 px-2 py-0.5 rounded-full">Katalog Baru</span>
                        </a>
                    </div>
                </div>

                {{-- Report Center --}}
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                     <div class="flex items-center space-x-4 mb-8">
                        <div class="p-3 bg-gray-100 rounded-xl text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">Pusat Laporan</h2>
                            <p class="text-gray-500 text-sm">Unduh rekapitulasi data.</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <a href="{{ route('admin.export.users') }}" class="flex items-center justify-between p-5 bg-gray-50 rounded-xl hover:bg-gray-100 transition group border border-gray-100 hover:border-gray-200">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-gray-500 group-hover:text-blue-600 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                                <span class="text-gray-700 group-hover:text-gray-900 font-bold">Laporan Data User</span>
                            </div>
                            <span class="text-xs font-bold text-gray-400 group-hover:text-gray-600 bg-white px-3 py-1 rounded-full shadow-sm">CSV</span>
                        </a>

                        <a href="{{ route('admin.export.books') }}" class="flex items-center justify-between p-5 bg-gray-50 rounded-xl hover:bg-gray-100 transition group border border-gray-100 hover:border-gray-200">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-gray-500 group-hover:text-green-600 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                </div>
                                <span class="text-gray-700 group-hover:text-gray-900 font-bold">Laporan Data Buku</span>
                            </div>
                            <span class="text-xs font-bold text-gray-400 group-hover:text-gray-600 bg-white px-3 py-1 rounded-full shadow-sm">CSV</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>