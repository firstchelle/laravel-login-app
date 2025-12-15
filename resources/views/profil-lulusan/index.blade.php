<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- Header --}}
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Daftar Profil Lulusan</h2>
                        <a href="{{ route('profil-lulusan.create') }}"
                            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200 shadow-sm">
                            + Tambah Profil Lulusan
                        </a>
                    </div>

                    {{-- Alert Success --}}
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg relative">
                            {{ session('success') }}
                            <button type="button" class="absolute top-0 right-0 p-4"
                                onclick="this.parentElement.style.display='none'">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    @endif

                    {{-- Table --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        No
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        Profil Lulusan
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        Nama Dosen
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        Tanggal Dibuat
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        Visi Terkait
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        Misi Terkait
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        Dokumen
                                    </th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($profilLulusans as $index => $profil)
                                    <tr class="hover:bg-gray-50 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $profilLulusans->firstItem() + $index }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            <div class="font-semibold text-gray-800">{{ $profil->profil_lulusan }}</div>
                                            <div class="text-gray-500 text-xs mt-1">
                                                {{ Str::limit($profil->deskripsi_profil_lulusan, 60) }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $profil->nama_dosen_pengisi }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ \Carbon\Carbon::parse($profil->tanggal_dibuat)->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            @if ($profil->visiProdi)
                                                <span
                                                    class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 font-semibold">
                                                    VISI
                                                </span>
                                                <div class="text-xs text-gray-600 mt-1">
                                                    {{ Str::limit($profil->visiProdi->visi, 40) }}
                                                </div>
                                            @else
                                                <span class="text-gray-400 text-xs">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            @if ($profil->misiProdi)
                                                <span
                                                    class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 font-semibold">
                                                    MISI
                                                </span>
                                                <div class="text-xs text-gray-600 mt-1">
                                                    {{ Str::limit($profil->misiProdi->misi, 40) }}
                                                </div>
                                            @else
                                                <span class="text-gray-400 text-xs">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if ($profil->dokumen_pendukung)
                                                <a href="{{ asset('storage/' . $profil->dokumen_pendukung) }}"
                                                    target="_blank"
                                                    class="inline-flex items-center px-3 py-1 bg-purple-500 hover:bg-purple-600 rounded-full text-white text-xs font-semibold transition duration-200">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" />
                                                    </svg>
                                                    PDF
                                                </a>
                                            @else
                                                <span class="text-gray-400 text-xs">Tidak ada</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex justify-center gap-3">
                                                {{-- Detail --}}
                                                <a href="{{ route('profil-lulusan.show', $profil->id) }}"
                                                    class="text-blue-600 hover:text-blue-900 transition duration-200"
                                                    title="Detail">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>

                                                {{-- Edit --}}
                                                <a href="{{ route('profil-lulusan.edit', $profil->id) }}"
                                                    class="text-yellow-600 hover:text-yellow-900 transition duration-200"
                                                    title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>

                                                {{-- Delete --}}
                                                <form action="{{ route('profil-lulusan.destroy', $profil->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="text-red-600 hover:text-red-900 transition duration-200 confirm-delete"
                                                        title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-16 h-16 text-gray-300 mb-3" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <p class="text-lg font-medium">Belum ada data profil lulusan</p>
                                                <a href="{{ route('profil-lulusan.create') }}"
                                                    class="mt-3 text-blue-600 hover:text-blue-800 font-semibold">
                                                    + Tambah data pertama
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if ($profilLulusans->hasPages())
                        <div class="mt-6">
                            {{ $profilLulusans->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Script Delete Confirmation --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.confirm-delete').forEach(button => {
                button.addEventListener('click', function(e) {
                    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                        this.closest('form').submit();
                    }
                });
            });
        });
    </script>
</x-app-layout>
