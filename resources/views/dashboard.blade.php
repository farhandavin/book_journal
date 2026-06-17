<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Welcome Banner --}}
            <div class="bg-gradient-to-r from-blue-600 to-blue-400 p-8 rounded-2xl shadow-xl flex flex-col md:flex-row md:items-center md:justify-between text-white">
                <div>
                    <h1 class="text-3xl font-bold">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                    <p class="mt-2 text-blue-100 text-lg">Senang melihat Anda kembali di SmartBook. Apa rencana bacaan Anda hari ini?</p>
                </div>
                <div class="mt-6 md:mt-0">
                    <a href="{{ route('book.add') }}" class="inline-flex items-center bg-white text-blue-600 px-6 py-3 rounded-lg font-bold hover:bg-blue-50 transition shadow-md transform hover:scale-105 duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Koleksi Baru
                    </a>
                </div>
            </div>

            {{-- Dashboard Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                {{-- Card 1: Koleksi --}}
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition duration-300">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="p-4 bg-blue-100 rounded-xl text-blue-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Koleksi Buku</p>
                            <h3 class="text-2xl font-bold text-gray-900">Jelajahi</h3>
                        </div>
                    </div>
                    <a href="{{ route('home') }}" class="block w-full text-center py-3 bg-gray-50 text-blue-600 rounded-lg hover:bg-blue-50 transition border border-gray-200 font-semibold group">
                        Lihat Semua Buku <span class="inline-block transition-transform group-hover:translate-x-1">→</span>
                    </a>
                </div>

                {{-- Card 2: Status Pinjaman --}}
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition duration-300">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="p-4 bg-green-100 rounded-xl text-green-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Status Pinjaman</p>
                            <h3 class="text-2xl font-bold text-gray-900">Cek Sesi</h3>
                        </div>
                    </div>
                    <a href="{{ route('my.books') }}" class="block w-full text-center py-3 bg-gray-50 text-green-600 rounded-lg hover:bg-green-50 transition border border-gray-200 font-semibold group">
                        Buku Saya <span class="inline-block transition-transform group-hover:translate-x-1">→</span>
                    </a>
                </div>

                {{-- Card 3: AI Librarian --}}
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition duration-300">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="p-4 bg-purple-100 rounded-xl text-purple-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Rekomendasi AI</p>
                            <h3 class="text-2xl font-bold text-gray-900">Tanya AI</h3>
                        </div>
                    </div>
                    <a href="{{ route('ai.index') }}" class="block w-full text-center py-3 bg-gray-50 text-purple-600 rounded-lg hover:bg-purple-50 transition border border-gray-200 font-semibold group">
                        Minta Saran Bacaan <span class="inline-block transition-transform group-hover:translate-x-1">→</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>