<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perpustakaan Digital') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Header Section --}}
            <div class="mb-10 text-center sm:text-left">
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Perpustakaan Digital</h1>
                <p class="mt-2 text-gray-500 text-lg">Temukan inspirasi dalam setiap halaman.</p>
            </div>

            {{-- Filters & Controls --}}
            <div class="mb-8 p-6 bg-white rounded-2xl shadow-sm border border-gray-100">
                <form action="{{ route('home') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center justify-between">
                    
                    <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                        <div class="relative w-full sm:w-56">
                            <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Kategori</label>
                            <select name="category" onchange="this.form.submit()" class="w-full pl-3 pr-10 py-2.5 text-sm border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm cursor-pointer transition-colors hover:bg-gray-50">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="relative w-full sm:w-56">
                            <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Urutan</label>
                            <select name="sort" onchange="this.form.submit()" class="w-full pl-3 pr-10 py-2.5 text-sm border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm cursor-pointer transition-colors hover:bg-gray-50">
                                <option value="id" {{ request('sort') == 'id' ? 'selected' : '' }}>Terbaru</option>
                                <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
                                <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Judul (A-Z)</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex gap-3 w-full md:w-auto justify-end items-end h-full mt-auto">
                        <a href="{{ route('home') }}" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                            Reset Filter
                        </a>
                        <a href="{{ route('book.export') }}" class="inline-flex items-center px-5 py-2.5 bg-green-600 text-white text-sm font-bold rounded-lg hover:bg-green-700 transition-colors shadow-sm transform hover:scale-105 duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Export CSV
                        </a>
                    </div>
                </form>
            </div>

            {{-- Book Grid --}}
            @if(isset($books) && $books->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach($books as $book)
                        <div class="group bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col h-full relative">
                            
                            {{-- Cover Card --}}
                            <div class="relative aspect-[2/3] overflow-hidden bg-gray-100 cursor-pointer" onclick="window.location='{{ route('book.show', $book->id) }}'">
                                @if($book->cover_image)
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="object-cover w-full h-full transform group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <img src="https://covers.openlibrary.org/b/isbn/{{ $book->isbn }}-L.jpg" alt="{{ $book->title }}" class="object-cover w-full h-full transform group-hover:scale-110 transition-transform duration-500" onerror="this.onerror=null;this.src='https://via.placeholder.com/250x350?text=No+Cover';">
                                @endif
                                
                                <div class="absolute top-3 left-3">
                                    <span class="px-2.5 py-1 text-xs font-bold bg-white/90 backdrop-blur-md text-gray-800 rounded-lg shadow-sm">
                                        {{ $book->category ?? 'Umum' }}
                                    </span>
                                </div>

                                {{-- Hover Overlay --}}
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-[2px]">
                                    <span class="text-white font-bold border-2 border-white px-4 py-2 rounded-lg">Lihat Detail</span>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="p-5 flex flex-col flex-grow">
                                <div class="mb-3">
                                    <a href="{{ route('book.show', $book->id) }}" class="text-lg font-bold text-gray-900 line-clamp-1 hover:text-blue-600 transition-colors">
                                        {{ $book->title }}
                                    </a>
                                    <div class="flex items-center justify-between mt-1">
                                        <p class="text-xs text-gray-500">oleh <span class="font-medium text-gray-700">{{ $book->author }}</span></p>
                                        <div class="flex items-center gap-1 text-yellow-500 text-xs font-bold bg-yellow-50 px-1.5 py-0.5 rounded">
                                            <span>★</span><span>{{ $book->rating }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-grow mb-4">
                                     @if($book->notes)
                                        <p class="text-xs text-gray-400 italic line-clamp-2">"{{ $book->notes }}"</p>
                                     @endif
                                </div>

                                {{-- Actions --}}
                                <div class="pt-4 border-t border-gray-50 mt-auto flex flex-col gap-3">
                                    
                                    <div class="flex justify-between items-center text-xs font-medium">
                                        @if($book->sentiment)
                                            <span class="px-2 py-0.5 rounded text-white" 
                                                  style="background-color: {{ $book->sentiment == 'POSITIF' ? '#10B981' : ($book->sentiment == 'NEGATIF' ? '#EF4444' : '#6B7280') }};">
                                                {{ $book->sentiment }}
                                            </span>
                                        @else
                                            <span class="text-gray-300">Belum dianalisis</span>
                                        @endif

                                        <span class="{{ $book->stock > 0 ? 'text-green-600' : 'text-red-500' }}">
                                            {{ $book->stock > 0 ? 'Stok: '.$book->stock : 'Habis' }}
                                        </span>
                                    </div>

                                    @if(auth()->check() && (auth()->user()->role == 'admin' || auth()->id() == $book->user_id))
                                        <div class="grid grid-cols-2 gap-2">
                                            <a href="{{ route('book.edit', $book->id) }}" class="text-center py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-lg transition-colors">Edit</a>
                                            <form action="{{ route('book.delete', $book->id) }}" method="POST" class="w-full">
                                                @csrf
                                                @method('DELETE') 
                                                <button type="submit" class="w-full py-2 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-bold rounded-lg transition-colors" onclick="return confirm('Hapus buku ini?')">Hapus</button>
                                            </form>
                                        </div>
                                    @else
                                        @if($book->isBorrowed())
                                            <button disabled class="w-full py-2 bg-gray-100 text-gray-400 text-xs font-bold rounded-lg cursor-not-allowed">Sedang Dipinjam</button>
                                        @elseif($book->stock > 0)
                                            <form action="{{ route('book.borrow', $book->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="w-full py-2 bg-black hover:bg-gray-800 text-white text-xs font-bold rounded-lg transition-colors shadow-sm">Pinjam Buku</button>
                                            </form>
                                        @else
                                            <button disabled class="w-full py-2 bg-gray-100 text-gray-400 text-xs font-bold rounded-lg cursor-not-allowed">Stok Habis</button>
                                        @endif
                                    @endif

                                    {{-- Link Detail (Secondary Action) --}}
                                    <a href="{{ route('book.show', $book->id) }}" class="block w-full text-center py-2 border border-blue-200 text-blue-600 hover:bg-blue-50 text-xs font-bold rounded-lg transition-colors">
                                        Detail & Ulasan
                                    </a>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-24 bg-white rounded-3xl border border-dashed border-gray-300 text-center">
                    <div class="p-6 bg-gray-50 rounded-full mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Belum ada buku</h3>
                    <p class="text-gray-500 mt-2 max-w-sm">Perpustakaan masih kosong atau tidak ada buku yang cocok dengan filter Anda.</p>
                    @auth
                        <a href="{{ route('book.add') }}" class="mt-6 inline-flex items-center px-6 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Tambah Buku Baru
                        </a>
                    @endauth
                </div>
            @endif
        </div>
    </div>
</x-app-layout>