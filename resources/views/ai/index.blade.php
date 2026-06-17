<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('AI Librarian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center p-4 bg-purple-100 rounded-2xl mb-4 text-purple-600">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">AI Librarian</h1>
                <p class="mt-2 text-gray-500 text-lg">Asisten pintar untuk rekomendasi bacaan Anda.</p>
            </div>

            {{-- Error Alerts --}}
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700 font-medium">Terjadi Kesalahan</p>
                            <p class="text-sm text-red-600 mt-1">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Query Form --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <form action="{{ route('ai.ask') }}" method="POST">
                    @csrf
                    
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tanyakan Sesuatu...</label>
                        <textarea name="prompt" rows="5" class="w-full border-gray-200 rounded-xl focus:border-purple-500 focus:ring-purple-500 p-4 text-gray-700 bg-gray-50 focus:bg-white transition-colors text-base" placeholder="Contoh: Saya suka buku Harry Potter dan The Hobbit, tolong rekomendasikan buku fantasi serupa dengan nuansa petualangan..." required>{{ old('prompt') }}</textarea>
                    </div>

                    <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Minta Rekomendasi
                    </button>
                </form>
            </div>

            {{-- Recommendation Result --}}
            @if(isset($recommendation))
                <div class="mt-10 animate-fade-in-up">
                    <div class="bg-gradient-to-br from-white to-purple-50 rounded-2xl shadow-lg border border-purple-100 p-8 relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-4 opacity-10">
                            <svg class="w-32 h-32 text-purple-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                        </div>
                        
                        <h3 class="flex items-center text-xl font-bold text-gray-900 mb-6 border-b border-purple-200 pb-4 relative z-10 transition-colors">
                            <span class="mr-3 text-2xl">💡</span> Jawaban AI
                        </h3>
                        
                        <div class="prose prose-purple max-w-none text-gray-700 relative z-10 leading-relaxed">
                            {!! nl2br(e($recommendation)) !!}
                        </div>

                        <div class="mt-8 relative z-10 text-right">
                             <span class="text-xs text-purple-400 font-medium uppercase tracking-wider">Powered by Gemini AI</span>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>