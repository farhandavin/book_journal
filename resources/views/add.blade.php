<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- Box 1: Cari & Tambah Buku --}}
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200">
                <div class="max-w-3xl mx-auto text-center">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Cari & Tambah Buku Baru</h2>
                    <p class="text-gray-500 mb-8">Masukkan judul buku yang ingin Anda cari dari database kami untuk ditambahkan ke jurnal pribadi Anda.</p>

                    <form action="{{ route('book.search') }}" method="POST" class="relative">
                        @csrf
                        <div class="relative">
                            <input type="text" name="query" 
                                class="w-full pl-6 pr-32 py-4 text-lg border-2 border-gray-200 rounded-full focus:border-blue-500 focus:ring-0 transition-colors shadow-sm"
                                placeholder="Contoh: Harry Potter, Laskar Pelangi..." required>
                            
                            <button type="submit" class="absolute right-2 top-2 bottom-2 bg-blue-600 hover:bg-blue-700 text-white px-8 rounded-full font-bold transition-all transform hover:scale-105">
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Box 2: Hasil Pencarian --}}
            @if(isset($results))
                <div class="pt-8 animate-fade-in-up">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">Hasil Pencarian</h3>
                        <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">{{ count($results) }} buku ditemukan</span>
                    </div>

                    @if(count($results) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                            @foreach($results as $book)
                                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 group">
                                    {{-- Cover Image --}}
                                    <div class="relative aspect-[2/3] overflow-hidden bg-gray-100">
                                        <img src="https://covers.openlibrary.org/b/id/{{ $book->cover_i }}-L.jpg" 
                                            alt="{{ $book->title }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                            onerror="this.onerror=null;this.src='https://via.placeholder.com/250x350?text=No+Cover';">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                            <p class="text-white text-sm font-medium line-clamp-2">
                                                {{ is_array($book->author_name) ? implode(', ', $book->author_name) : 'Penulis Tidak Diketahui' }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="p-5">
                                        <h4 class="font-bold text-lg text-gray-900 mb-1 line-clamp-1" title="{{ $book->title }}">{{ $book->title }}</h4>
                                        <p class="text-xs text-gray-500 mb-4">{{ isset($book->first_publish_year) ? $book->first_publish_year : 'Tahun tidak diketahui' }}</p>

                                        <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                            @csrf
                                            <input type="hidden" name="title" value="{{ $book->title }}">
                                            <input type="hidden" name="author" value="{{ is_array($book->author_name) ? implode(', ', $book->author_name) : 'Tidak diketahui' }}">
                                            <input type="hidden" name="isbn" value="{{ isset($book->isbn[0]) ? $book->isbn[0] : '' }}">
                                            <input type="hidden" name="stock" value="1">

                                            {{-- Form Inputs Compact --}}
                                            <div>
                                                <select name="category" class="w-full text-sm border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                                    <option value="">Pilih Kategori</option>
                                                    <option value="Fiksi">Fiksi</option>
                                                    <option value="Non-Fiksi">Non-Fiksi</option>
                                                    <option value="Sains">Sains</option>
                                                    <option value="Sejarah">Sejarah</option>
                                                    <option value="Teknologi">Teknologi</option>
                                                </select>
                                            </div>

                                            <div class="grid grid-cols-2 gap-2">
                                                <input type="number" name="rating" placeholder="Rate (1-10)" min="1" max="10" class="w-full text-sm border-gray-200 rounded-lg" required>
                                                <input type="hidden" name="date_read" value="{{ date('Y-m-d') }}">
                                                {{-- <input type="date" name="date_read" class="w-full text-sm border-gray-200 rounded-lg"> --}}
                                            </div>

                                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-2 rounded-lg transition-colors">
                                                + Tambahkan
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Buku tidak ditemukan</h3>
                            <p class="mt-1 text-sm text-gray-500">Coba kata kunci lain atau periksa ejaan judul buku.</p>
                        </div>
                    @endif
                </div>
            @endif

        </div>
    </div>
</x-app-layout>