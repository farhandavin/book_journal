<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fitur Event / Kegiatan Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                
                {{-- Left Column: Event List (Flexible) --}}
                <div class="flex-grow">
                    <div class="mb-6 flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Agenda & Event</h1>
                            <p class="text-gray-500">Ikuti kegiatan seru seputar buku dan literasi.</p>
                        </div>
                        
                        {{-- Add Event Button (Admin Only) --}}
                        @if(auth()->check() && auth()->user()->role == 'admin')
                            <button onclick="document.getElementById('addEventModal').classList.remove('hidden')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-sm transition-colors flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Tambah Event
                            </button>
                        @endif
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm text-gray-600">
                                <thead class="bg-gray-50 text-gray-900 uppercase font-bold text-xs tracking-wider">
                                    <tr>
                                        <th class="px-6 py-4">Tanggal</th>
                                        <th class="px-6 py-4">Nama Event</th>
                                        @if(auth()->check() && auth()->user()->role == 'admin')
                                            <th class="px-6 py-4 text-center">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse($events as $event)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="p-2 bg-blue-100 text-blue-600 rounded-lg mr-3">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    </div>
                                                    <span class="font-medium text-gray-900">{{ $event->event_date->format('d M Y') }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 font-medium text-gray-900">
                                                {{ $event->title }}
                                            </td>
                                            
                                            @if(auth()->check() && auth()->user()->role == 'admin')
                                                <td class="px-6 py-4 text-center">
                                                    <div class="flex items-center justify-center gap-2">
                                                        <a href="{{ route('admin.events.edit', $event->id) }}" class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition-colors" title="Edit">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                        </a>
                                                        <form action="{{ route('admin.events.delete', $event->id) }}" method="POST" onsubmit="return confirm('Hapus event ini?')">
                                                            @csrf 
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition-colors" title="Hapus">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-6 py-10 text-center text-gray-400">
                                                Belum ada event terjadwal saat ini.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Mini Calendar (Fixed width) --}}
                <div class="w-full lg:w-80 flex-shrink-0">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h4 class="text-lg font-bold text-gray-900 mb-6 text-center border-b pb-4">{{ date('F Y') }}</h4>
                        
                        <div class="grid grid-cols-7 gap-2 mb-4 text-center">
                            <div class="text-xs font-bold text-gray-400">M</div>
                            <div class="text-xs font-bold text-gray-400">S</div>
                            <div class="text-xs font-bold text-gray-400">S</div>
                            <div class="text-xs font-bold text-gray-400">R</div>
                            <div class="text-xs font-bold text-gray-400">K</div>
                            <div class="text-xs font-bold text-gray-400">J</div>
                            <div class="text-xs font-bold text-gray-400">S</div>
                        </div>

                        <div class="grid grid-cols-7 gap-2 text-sm">
                            @for($i = 1; $i <= 31; $i++)
                                @php
                                    $hasEvent = in_array($i, $events->pluck('event_date')->map(fn($d) => (int)$d->format('j'))->toArray());
                                @endphp
                                <div class="aspect-square flex items-center justify-center rounded-lg font-medium transition-all
                                    {{ $hasEvent ? 'bg-blue-600 text-white shadow-md scale-110' : 'bg-gray-50 text-gray-500 hover:bg-gray-100' }}">
                                    {{ $i }}
                                </div>
                            @endfor
                        </div>
                        
                        <div class="mt-6 flex items-center justify-center gap-2 text-xs text-gray-500">
                            <span class="w-2.5 h-2.5 bg-blue-600 rounded-full"></span>
                            <span>Ada Event</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Add Event Modal (Hidden by default) --}}
    <div id="addEventModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="document.getElementById('addEventModal').classList.add('hidden')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                <form action="{{ route('admin.events.store') }}" method="POST">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-bold text-gray-900 mb-4" id="modal-title">Tambah Event Baru</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Event</label>
                                <input type="text" name="title" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                                <input type="date" name="event_date" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                            Simpan Event
                        </button>
                        <button type="button" onclick="document.getElementById('addEventModal').classList.add('hidden')" class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>