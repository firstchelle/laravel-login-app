<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('VISI MISI INSTITUSI') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Tombol Create (Hanya Dekan) --}}
            @if (auth()->user()->role === 'rektor')
                <div class="flex gap-3">
                    <a href="{{ route('visiinstitusi.create_visi') }}"
                        class="bg-gray-700 hover:bg-gray-800 px-6 py-3 rounded-lg text-white font-semibold transition duration-200 shadow-sm">
                        + Tambah Visi
                    </a>

                    <a href="{{ route('visiinstitusi.create_misi') }}"
                        class="bg-blue-700 hover:bg-blue-800 px-6 py-3 rounded-lg text-white font-semibold transition duration-200 shadow-sm">
                        + Tambah Misi
                    </a>
                </div>
            @endif

            {{-- Tabel Visi --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Daftar Visi Institusi</h3>

                    @if ($visi->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                            No
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                            Visi
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                            Berlaku Sampai
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                            Dokumen
                                        </th>
                                        @if (auth()->user()->role === 'rektor')
                                            <th scope="col"
                                                class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                                Aksi
                                            </th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($visi as $item)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                <p class="line-clamp-3">{{ $item->visi }}</p>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($item->berlaku_sampai)->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                @if ($item->file_path)
                                                    <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank"
                                                        class="inline-flex items-center px-3 py-1 bg-purple-500 hover:bg-purple-600 rounded-full text-white text-xs font-semibold transition duration-200">
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" />
                                                        </svg>
                                                        Lihat PDF
                                                    </a>
                                                @else
                                                    <span class="text-red-500 text-xs">Tidak ada dokumen</span>
                                                @endif
                                            </td>
                                            @if (auth()->user()->role === 'rektor')
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                                    <div class="flex justify-center gap-3">
                                                        {{-- Edit --}}
                                                        <a href="{{ route('visiinstitusi.edit_visi', $item->id) }}"
                                                            class="text-blue-600 hover:text-blue-900 transition duration-200"
                                                            title="Edit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                                stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                        </a>

                                                        {{-- Delete --}}
                                                        <form
                                                            action="{{ route('visiinstitusi.hapus_visi', $item->id) }}"
                                                            method="POST" class="inline">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="button"
                                                                class="confirm-delete text-red-600 hover:text-red-900 transition duration-200"
                                                                title="Hapus">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                    fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor" stroke-width="2">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500">Belum ada data visi</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Tabel Misi --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Daftar Misi Institusi</h3>

                    @if ($misi->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                            No
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                            Misi
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                            Visi Terkait
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                            Berlaku Sampai
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                            Dokumen
                                        </th>
                                        @if (auth()->user()->role === 'rektor')
                                            <th scope="col"
                                                class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                                Aksi
                                            </th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($misi as $item)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                <p class="line-clamp-3">{{ $item->misi }}</p>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                @if ($item->visiInstitusi)
                                                    <p class="line-clamp-2 text-xs text-gray-600">
                                                        {{ Str::limit($item->visiInstitusi->visi, 50) }}</p>
                                                @else
                                                    <span class="text-gray-400 text-xs">-</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($item->berlaku_sampai)->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                @if ($item->file_path)
                                                    <a href="{{ asset('storage/' . $item->file_path) }}"
                                                        target="_blank"
                                                        class="inline-flex items-center px-3 py-1 bg-purple-500 hover:bg-purple-600 rounded-full text-white text-xs font-semibold transition duration-200">
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" />
                                                        </svg>
                                                        Lihat PDF
                                                    </a>
                                                @else
                                                    <span class="text-red-500 text-xs">Tidak ada dokumen</span>
                                                @endif
                                            </td>
                                            @if (auth()->user()->role === 'rektor')
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                                    <div class="flex justify-center gap-3">
                                                        {{-- Edit --}}
                                                        <a href="{{ route('visiinstitusi.edit_misi', $item->id) }}"
                                                            class="text-blue-600 hover:text-blue-900 transition duration-200"
                                                            title="Edit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                        </a>

                                                        {{-- Delete --}}
                                                        <form
                                                            action="{{ route('visiinstitusi.hapus_misi', $item->id) }}"
                                                            method="POST" class="inline">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="button"
                                                                class="confirm-delete text-red-600 hover:text-red-900 transition duration-200"
                                                                title="Hapus">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="h-5 w-5" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor"
                                                                    stroke-width="2">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500">Belum ada data misi</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Script Delete Confirmation --}}
    <script>
        (function() {
            function handleDeleteClick(event) {
                const ok = confirm('Apakah Anda yakin ingin menghapus item ini?');
                if (!ok) {
                    event.preventDefault();
                    return;
                }

                const form = event.currentTarget.closest('form');
                if (ok && form) form.submit();
            }

            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('button.confirm-delete')
                    .forEach(btn => btn.addEventListener('click', handleDeleteClick));
            });
        })();
    </script>

    {{-- Custom CSS untuk line-clamp --}}
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-app-layout>
