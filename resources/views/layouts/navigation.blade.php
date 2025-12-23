<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="fixed inset-y-0 left-0 w-64 bg-gray-800 text-white flex flex-col">
        <!-- Logo / Header -->
        <div class="flex items-center justify-center p-6 border-b border-gray-700">
            <img src="{{ asset('images/logo-itsm.png') }}" alt="Logo" class="w-11 h-11 rounded-full mr-3">
            <div class="flex flex-col">
                <span class="text-lg font-semibold">Acadex</span>
                <span class="text-sm text-gray-300">ITS Mandala Jember</span>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 p-4 space-y-2">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                        class="sidebar-link text-white hover:bg-gray-700 hover:text-white hover:underline focus:text-white active:text-white">
                Dashboard
            </x-nav-link>

            <div x-data="{ open: false }" class="space-y-1">
                <button @click="open = !open" 
                        class="w-full flex items-center justify-between px-4 py-2 rounded-md 
                               text-white hover:bg-gray-700 hover:text-white hover:underline 
                               focus:text-white active:text-white">
                    <span>Visi Misi</span>
                    <svg class="w-4 h-4 transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" class="ml-6 space-y-1">
                    <a href="{{ route('visiinstitusi.index') }}" 
                       class="block px-4 py-2 text-sm 
                              text-white hover:bg-gray-700 hover:text-white hover:underline 
                              focus:text-white active:text-white">
                       Institusi
                    </a>
                    <a href="{{ route('visifakultas.index') }}" 
                       class="block px-4 py-2 text-sm 
                              text-white hover:bg-gray-700 hover:text-white hover:underline 
                              focus:text-white active:text-white">
                       Fakultas
                    </a>
                    <a href="{{ route('visiprodi.index') }}" 
                       class="block px-4 py-2 text-sm 
                              text-white hover:bg-gray-700 hover:text-white hover:underline 
                              focus:text-white active:text-white">
                       Prodi
                    </a>
                </div>
            </div>

            <x-nav-link :href="route('profil-lulusan.index')" :active="request()->routeIs('profil-lulusan.index')" 
                        class="sidebar-link text-white hover:bg-gray-700 hover:text-white hover:underline focus:text-white active:text-white">
                Profil Lulusan
            </x-nav-link>

            <x-nav-link :href="route('capaian.index')" :active="request()->routeIs('capaian.index')" 
                        class="sidebar-link text-white hover:bg-gray-700 hover:text-white hover:underline focus:text-white active:text-white">
                Capaian Pembelajaran Lulusan
            </x-nav-link>
        </nav>

        <!-- User / Logout -->
        <div class="p-4 border-t border-gray-700">
            <div class="text-sm">{{ Auth::user()->name }}</div>
            <div class="text-xs text-gray-400">{{ Auth::user()->email }}</div>
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" 
                    class="w-full flex items-center px-4 py-2 rounded-md 
                           text-white hover:bg-gray-700 hover:text-white hover:underline 
                           focus:text-white active:text-white">
                    <!-- Exit Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        class="w-5 h-5 mr-2" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5m0 14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2h4a2 2 0 012 2v1" />
                    </svg> 
                    Log Out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <!-- <main class="flex-1 ml-64 p-6 bg-white min-h-screen">
        @yield('content')
    </main> -->
</div>
