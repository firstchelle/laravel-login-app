<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('VISI MISI PRODI') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- Visi --}}
                <div class="w-full h-auto p-4 sm:p-8 rounded-md space-y-4">
                    <div class="flex flex-col gap-4">
                        <p class="text-2xl sm:text-4xl font-bold">VISI</p>
                        @if (Auth::user()->role == 'kaprodi')
                            <a href="{{ route('visiprodi.create') }}"
                                class="px-4 py-2 bg-blue-500 text-white font-bold rounded-md w-fit">
                                Tambah Visi Prodi
                            </a>
                        @endif
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse">
                            <thead>
                                <tr>
                                    <th
                                        class="bg-gray-200 p-2 text-gray-700 font-bold border border-gray-300 text-left">
                                        No
                                    </th>
                                    <th
                                        class="bg-gray-200 p-2 text-gray-700 font-bold border border-gray-300 text-left">
                                        Visi
                                    </th>
                                    <th
                                        class="bg-gray-200 p-2 text-gray-700 font-bold border border-gray-300 text-left">
                                        Dokumen
                                    </th>
                                    <th
                                        class="bg-gray-200 p-2 text-gray-700 font-bold border border-gray-300 text-left">
                                        Berlaku
                                    </th>
                                    <th
                                        class="bg-gray-200 p-2 text-gray-700 font-bold border border-gray-300 text-left">
                                        Dibuat Oleh
                                    </th>
                                    <th
                                        class="bg-gray-200 p-2 text-gray-700 font-bold border border-gray-300 text-left">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white">
                                    <td class="p-2 border border-gray-300 text-left">
                                        1
                                    </td>
                                    <td class="p-2 border border-gray-300 text-left">
                                        Menjadi Perguruan Tinggi Terkemuka Dibidang Ekonomi, Bisnis,sains dan Teknologi
                                        Berbasis ekonomi Digital dan Technopreneur Berdaya Saing Nasional dan
                                        Internasional
                                    </td>
                                    <td class="p-2 border border-gray-300 text-left">
                                        <p class="px-4 py-1 bg-purple-500 rounded-full inline-block">visi.pdf</p>
                                    </td>
                                    <td class="p-2 border border-gray-300 text-left">
                                        28/10/2025
                                    </td>
                                    <td class="p-2 border border-gray-300 text-left">
                                        Kaprodi
                                    </td>
                                    <td class="p-2 border border-gray-300 text-left">
                                        <div class="flex space-x-2">

                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('visiprodi.edit', 1) }}"
                                                class=" 
        @if (auth()->user()->role !== 'kaprodi') pointer-events-none opacity-50 cursor-not-allowed @endif
    ">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            {{-- Tombol Delete --}}
                                            <button @disabled(auth()->user()->role !== 'kaprodi')
                                                class="confirm-delete disabled:opacity-50 disabled:cursor-not-allowed">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Misi --}}
                <div class="w-full h-auto p-4 sm:p-8 rounded-md space-y-4">
                    <div class="flex flex-col gap-4">
                        <p class="text-2xl sm:text-4xl font-bold">MISI</p>
                        @if (Auth::user()->role == 'kaprodi')
                            <a href="{{ route('misiprodi.create') }}"
                                class="px-4 py-2 bg-blue-500 text-white font-bold rounded-md w-fit">
                                Tambah Misi Prodi
                            </a>
                        @endif
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse">
                            <thead>
                                <tr>
                                    <th
                                        class="bg-gray-200 p-2 text-gray-700 font-bold border border-gray-300 text-left">
                                        No
                                    </th>
                                    <th
                                        class="bg-gray-200 p-2 text-gray-700 font-bold border border-gray-300 text-left">
                                        Misi
                                    </th>
                                    <th
                                        class="bg-gray-200 p-2 text-gray-700 font-bold border border-gray-300 text-left">
                                        Dokumen
                                    </th>
                                    <th
                                        class="bg-gray-200 p-2 text-gray-700 font-bold border border-gray-300 text-left">
                                        Berlaku
                                    </th>
                                    <th
                                        class="bg-gray-200 p-2 text-gray-700 font-bold border border-gray-300 text-left">
                                        Dibuat Oleh
                                    </th>
                                    <th
                                        class="bg-gray-200 p-2 text-gray-700 font-bold border border-gray-300 text-left">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white">
                                    <td class="p-2 border border-gray-300 text-left">
                                        1
                                    </td>
                                    <td class="p-2 border border-gray-300 text-left">
                                        Menyelenggarakan tridharma perguruan tinggi secara konsisten dan berkelanjutan
                                        sesuai Standar Nasional Pendidikan Tinggi.
                                    </td>
                                    <td class="p-2 border border-gray-300 text-left">
                                        <p class="px-4 py-1 bg-purple-500 rounded-full inline-block">misi.pdf</p>
                                    </td>
                                    <td class="p-2 border border-gray-300 text-left">
                                        28/10/2025
                                    </td>
                                    <td class="p-2 border border-gray-300 text-left">
                                        Kaprodi
                                    </td>
                                    <td class="p-2 border border-gray-300 text-left">
                                        <div class="flex space-x-2">

                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('misiprodi.edit', 1) }}"
                                                class=" 
        @if (auth()->user()->role !== 'kaprodi') pointer-events-none opacity-50 cursor-not-allowed @endif
    ">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            {{-- Tombol Delete --}}
                                            <button @disabled(auth()->user()->role !== 'kaprodi')
                                                class="confirm-delete disabled:opacity-50 disabled:cursor-not-allowed">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="bg-white">
                                    <td class="p-2 border border-gray-300 text-left">
                                        2
                                    </td>
                                    <td class="p-2 border border-gray-300 text-left">
                                        Mentransformasikan perkembangan teknologi digital dalam kegiatan tridharma
                                        perguruan tinggi serta mendorong jiwa technopreneur.
                                    </td>
                                    <td class="p-2 border border-gray-300 text-left">
                                        <p class="px-4 py-1 bg-purple-500 rounded-full inline-block">misi.pdf</p>
                                    </td>
                                    <td class="p-2 border border-gray-300 text-left">
                                        28/10/2025
                                    </td>
                                    <td class="p-2 border border-gray-300 text-left">
                                        Kaprodi
                                    </td>
                                    <td class="p-2 border border-gray-300 text-left">
                                        <div class="flex space-x-2">

                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('misiprodi.edit', 1) }}"
                                                class=" 
        @if (auth()->user()->role !== 'kaprodi') pointer-events-none opacity-50 cursor-not-allowed @endif
    ">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            {{-- Tombol Delete --}}
                                            <button @disabled(auth()->user()->role !== 'kaprodi')
                                                class="confirm-delete disabled:opacity-50 disabled:cursor-not-allowed">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="bg-white">
                                    <td class="p-2 border border-gray-300 text-left">
                                        3
                                    </td>
                                    <td class="p-2 border border-gray-300 text-left">
                                        Mengembangkan kegiatan akademik dan non akademik yang mampu menghasilkan
                                        sumberdaya manusia yang memiliki kecerdasan holistik
                                    </td>
                                    <td class="p-2 border border-gray-300 text-left">
                                        <p class="px-4 py-1 bg-purple-500 rounded-full inline-block">misi.pdf</p>
                                    </td>
                                    <td class="p-2 border border-gray-300 text-left">
                                        28/10/2025
                                    </td>
                                    <td class="p-2 border border-gray-300 text-left">
                                        Kaprodi
                                    </td>
                                    <td class="p-2 border border-gray-300 text-left">
                                        <div class="flex space-x-2">

                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('misiprodi.edit', 1) }}"
                                                class=" 
        @if (auth()->user()->role !== 'kaprodi') pointer-events-none opacity-50 cursor-not-allowed @endif
    ">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            {{-- Tombol Delete --}}
                                            <button @disabled(auth()->user()->role !== 'kaprodi')
                                                class="confirm-delete disabled:opacity-50 disabled:cursor-not-allowed">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Confirmation Delete --}}
                <script>
                    (function() {
                        function handleClick(event) {
                            // If button is disabled, do nothing
                            if (event.currentTarget.disabled) return;

                            var ok = confirm('Apakah anda yakin ingin menghapus item ini?');
                            if (!ok) {
                                event.preventDefault();
                                event.stopPropagation();
                                return false;
                            }

                            // If the button is inside a form, submit the form
                            var btn = event.currentTarget;
                            var form = btn.closest('form');
                            if (form) {
                                form.submit();
                                return true;
                            }

                            // If button has data-url, navigate to it (GET)
                            var url = btn.getAttribute('data-url') || btn.getAttribute('data-href');
                            if (url) {
                                window.location.href = url;
                                return true;
                            }

                            // Otherwise allow default behavior (in case other handlers exist)
                            return true;
                        }

                        document.addEventListener('DOMContentLoaded', function() {
                            var delBtns = document.querySelectorAll('button.confirm-delete');
                            delBtns.forEach(function(b) {
                                b.addEventListener('click', handleClick, {
                                    capture: false
                                });
                            });
                        });
                    })();
                </script>

            </div>
        </div>
    </div>
</x-app-layout>
