<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rating dan Ulasan Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Breadcrumb --}}
            <nav class="flex mb-8 text-sm font-medium text-gray-500">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors">Perpustakaan</a>
                <span class="mx-3 text-gray-300">/</span>
                <span class="text-gray-900 truncate">{{ $book->title }}</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                {{-- Left Column: Book Card (4 cols) --}}
                <div class="lg:col-span-4">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 sticky top-24">
                        {{-- Cover Image --}}
                        <div class="relative aspect-[2/3] bg-gray-100 group">
                            @if($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="object-cover w-full h-full transform group-hover:scale-105 transition-transform duration-700">
                            @else
                                <img src="https://covers.openlibrary.org/b/isbn/{{ $book->isbn }}-L.jpg" alt="{{ $book->title }}" class="object-cover w-full h-full transform group-hover:scale-105 transition-transform duration-700" onerror="this.onerror=null;this.src='https://via.placeholder.com/250x350?text=No+Cover';">
                            @endif
                            
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1.5 text-xs font-bold bg-white/90 backdrop-blur-md text-gray-900 rounded-lg shadow-lg">
                                    {{ $book->category ?? 'Umum' }}
                                </span>
                            </div>
                        </div>

                        {{-- Quick Info & Actions --}}
                        <div class="p-6 space-y-6">
                            <div class="space-y-4">
                                @if(auth()->check() && (auth()->user()->role === 'admin' || auth()->id() === $book->user_id))
                                    <div class="grid grid-cols-2 gap-3">
                                        <a href="{{ route('book.edit', $book->id) }}" class="flex items-center justify-center py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition-colors text-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('book.delete', $book->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?');" class="w-full">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full py-3 bg-red-50 hover:bg-red-100 text-red-600 font-bold rounded-xl transition-colors text-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                @elseif($book->isBorrowed())
                                    <div class="text-center py-3 bg-gray-100 text-gray-400 font-bold rounded-xl border border-dashed border-gray-300 text-sm">
                                        Sedang Dipinjam
                                    </div>
                                @elseif($book->stock > 0)
                                    <form action="{{ route('book.borrow', $book->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full py-3.5 bg-black hover:bg-gray-800 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1 text-sm flex items-center justify-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                            Pinjam Buku Ini
                                        </button>
                                    </form>
                                @else
                                    <div class="text-center py-3 bg-gray-100 text-gray-400 font-bold rounded-xl border border-dashed border-gray-300 text-sm">
                                        Stok Habis
                                    </div>
                                @endif
                            </div>

                            <div class="pt-6 border-t border-gray-100">
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Statistik Buku</h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                                        <div class="text-xl font-bold text-gray-900">{{ $book->rating }}</div>
                                        <div class="text-xs text-gray-500">Rating</div>
                                    </div>
                                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                                        <div class="text-xl font-bold {{ $book->stock > 0 ? 'text-green-600' : 'text-red-500' }}">{{ $book->stock }}</div>
                                        <div class="text-xs text-gray-500">Stok</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Content (8 cols) --}}
                <div class="lg:col-span-8">
                    
                    {{-- Title Section --}}
                    <div class="mb-10">
                        <h1 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tight leading-tight mb-4">{{ $book->title }}</h1>
                        <div class="flex flex-wrap items-center gap-4 text-gray-600 text-lg">
                            <span class="font-medium">oleh <span class="text-black">{{ $book->author }}</span></span>
                            <span class="text-gray-300">•</span>
                            <span class="font-mono text-sm bg-gray-100 px-2 py-1 rounded">{{ $book->isbn }}</span>
                        </div>
                    </div>

                    {{-- AI Analysis Badge --}}
                    @if($book->sentiment)
                        <div class="mb-8 inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-gray-50 border border-gray-100">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full text-white font-bold text-xl shadow-sm"
                                style="background-color: {{ $book->sentiment == 'POSITIF' ? '#10B981' : ($book->sentiment == 'NEGATIF' ? '#EF4444' : '#6B7280') }};">
                                @if($book->sentiment == 'POSITIF') ⚡ @elseif($book->sentiment == 'NEGATIF') 🌧️ @else 😐 @endif
                            </div>
                            <div>
                                <h3 class="text-xs font-bold uppercase text-gray-400">Analisis AI</h3>
                                <p class="font-bold text-gray-900 text-sm">
                                    Sentiment: {{ ucfirst(strtolower($book->sentiment)) }}
                                </p>
                            </div>
                        </div>
                    @endif

                    {{-- Notes / Synopsis --}}
                    @if($book->notes)
                        <div class="mb-12">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Tentang Buku Ini</h3>
                            <div class="prose prose-lg text-gray-600 leading-relaxed bg-white border-l-4 border-blue-500 pl-6 py-2">
                                "{{ $book->notes }}"
                            </div>
                        </div>
                    @endif

                    {{-- Reviews Section --}}
                    <div class="border-t border-gray-200 pt-12">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">Ulasan & Rating</h2>
                                <p class="text-gray-500 text-sm mt-1">Apa kata pembaca tentang buku ini?</p>
                            </div>
                            <div class="text-right">
                                <span class="text-4xl font-black text-yellow-500">{{ $book->rating }}</span>
                                <span class="text-gray-400 text-sm">/ 10</span>
                            </div>
                        </div>

                        {{-- Review Form --}}
                        @auth
                            <div class="bg-gray-50 rounded-2xl p-6 mb-10 border border-gray-100">
                                <form action="{{ route('reviews.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    
                                    <div class="mb-4">
                                        <label class="block text-xs font-bold text-gray-500 uppercase mb-3">Berikan Rating</label>
                                        <div class="flex gap-4 flex-wrap">
                                            @foreach(range(10, 1) as $score)
                                                <label class="cursor-pointer group flex flex-col items-center">
                                                    <input type="radio" name="rating" value="{{ $score }}" class="peer sr-only" required> 
                                                    <span class="text-2xl grayscale group-hover:grayscale-0 peer-checked:grayscale-0 transition-all transform peer-checked:scale-125">⭐</span>
                                                    <span class="text-[10px] font-bold text-gray-400 peer-checked:text-black mt-1">{{ $score }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Komentar Anda</label>
                                        <textarea name="comment" rows="3" class="w-full border-gray-200 rounded-xl focus:border-blue-500 focus:ring-blue-500 transition-shadow p-4 text-sm" placeholder="Ceritakan pengalaman membaca Anda..."></textarea>
                                    </div>

                                    <button type="submit" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition-colors shadow-md hover:shadow-lg">
                                        Kirim Ulasan
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="bg-blue-50 rounded-2xl p-8 text-center mb-10 border border-blue-100">
                                <p class="text-blue-800 font-medium mb-4">Ingin memberikan ulasan?</p>
                                <a href="{{ route('login') }}" class="inline-block px-6 py-2 bg-white text-blue-600 font-bold rounded-lg hover:shadow-md transition-shadow">
                                    Login Sekarang
                                </a>
                            </div>
                        @endauth

                        {{-- Review List --}}
                        <div class="space-y-8">
                            @forelse($book->reviews as $review)
                                <div class="flex gap-5">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-lg shadow-md">
                                            {{ substr($review->user->name ?? 'A', 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="flex-grow bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                                        <div class="flex items-start justify-between mb-2">
                                            <div>
                                                <h4 class="font-bold text-gray-900">{{ $review->user->name ?? 'Pengguna' }}</h4>
                                                <span class="text-xs text-gray-400">{{ $review->created_at->format('d M Y, H:i') }}</span>
                                            </div>
                                            <div class="flex items-center gap-1 bg-yellow-50 px-2 py-1 rounded-lg">
                                                <span class="text-yellow-500 text-sm">★</span>
                                                <span class="font-bold text-gray-900 text-sm">{{ $review->rating }}</span>
                                            </div>
                                        </div>
                                        <p class="text-gray-600 leading-relaxed text-sm">
                                            {{ $review->comment }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12 text-gray-400 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                                    <p>Belum ada ulasan untuk buku ini.</p>
                                </div>
                            @endforelse
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
