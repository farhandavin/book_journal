<nav x-data="{ open: false }" class="bg-white sticky top-0 z-40 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="font-bold text-xl tracking-tighter text-blue-600">
                        smartbook
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('my.books')" :active="request()->routeIs('my.books')" class="text-gray-600 hover:text-black">
                        {{ __('Peminjaman buku saya') }}
                    </x-nav-link>

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-600 hover:text-black">
                        {{ __('Beranda') }}
                    </x-nav-link>

                    <x-nav-link :href="route('ai.index')" :active="request()->routeIs('ai.*')" class="text-gray-600 hover:text-black">
                        {{ __('Rekomendasi AI') }}
                    </x-nav-link>

                    <x-nav-link :href="route('books.add')" :active="request()->routeIs('books.add')" class="text-gray-600 hover:text-black">
                        {{ __('Tambahkan buku') }}
                    </x-nav-link>

                    <x-nav-link :href="url('/')" :active="request()->is('/')" class="text-gray-600 hover:text-black">
                        {{ __('Home') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                {{-- Logout Button Red --}}
                <form method="POST" action="{{ route('logout') }}" id="logout-form-desktop">
                    @csrf
                    <button type="submit" onclick="confirmLogout(event, 'logout-form-desktop')" class="btn bg-red-700 text-white hover:bg-red-800 focus:bg-red-800 active:bg-red-900 border-transparent rounded-md text-sm font-medium transition duration-150 ease-in-out px-4 py-2">
                        {{ __('Logout') }} ({{ Auth::user()->name }})
                    </button>
                </form>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-200">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('my.books')" :active="request()->routeIs('my.books')">
                {{ __('Peminjaman buku saya') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Beranda') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('ai.index')" :active="request()->routeIs('ai.*')">
                {{ __('Rekomendasi AI') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('books.add')" :active="request()->routeIs('books.add')">
                {{ __('Tambahkan buku') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="url('/')">
                {{ __('Home') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-4 border-t border-gray-200">
            <div class="px-4 mb-3">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="px-4">
                 <form method="POST" action="{{ route('logout') }}" id="logout-form-mobile">
                    @csrf
                    <button type="submit" onclick="confirmLogout(event, 'logout-form-mobile')" class="w-full text-center bg-red-600 text-white rounded-md py-2 text-sm font-medium hover:bg-red-700 transition">
                        {{ __('Logout') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
    function confirmLogout(event, formId) {
        event.preventDefault();
        
        // Mockup Text: "Anda login sebagai [Name]... Apakah Anda yakin ingin logout?"
        // We can inject the name from Blade since this script is inside the blade file
        const userName = "{{ Auth::user()->name }}"; 
        
        if (typeof Swal === 'undefined') {
            if(confirm(`Konfirmasi Logout\n\nAnda login sebagai ${userName}.\nApakah Anda yakin ingin logout?`)) { 
                document.getElementById(formId).submit(); 
            }
            return;
        }
        
        // Custom HTML for SweetAlert2 to match mockup style if possible, or just standard
        Swal.fire({
            title: 'Konfirmasi Logout',
            html: `Anda login sebagai <b>${userName}</b><br>sejak {{ now()->format('H:i') }}<br><br>Apakah Anda yakin ingin logout?`,
            icon: null,
            showCancelButton: true,
            confirmButtonColor: '#2563EB', // Blue for "Logout" in mockup (or Red?) Mockup says "Logout (Blue/Red)" actually mockup 12 shows Blue "Logout" and White "Batal", but the navbar button is Red. Let's make the confirm button Blue to match the modal mockup.
            cancelButtonColor: '#E5E7EB', // Grey
            confirmButtonText: 'Logout',
            cancelButtonText: 'Batal',
            customClass: {
                cancelButton: 'text-gray-800',
                confirmButton: 'bg-blue-600'
            }
        }).then((result) => {
            if (result.isConfirmed) { document.getElementById(formId).submit(); }
        })
    }
</script>