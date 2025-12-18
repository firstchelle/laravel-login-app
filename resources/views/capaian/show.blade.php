<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-full h-auto flex flex-col p-4">

                    {{-- Header --}}
                    <div class="flex justify-between items-center mb-6 pb-4 border-b">
                        <h2 class="text-2xl font-bold text-gray-800">Detail Profil Lulusan</h2>
                        <a href="{{ route('capaian.index') }}"
                            class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg transition duration-200">
                            Kembali
                        </a>
                    </div>


                    {{-- Content --}}
                    <div class="space-y-6">

                        {{-- Nama Dosen Pengisi --}}
                        <div class="flex flex-col gap-2">
                            <label class="font-bold flex items-center gap-2">Nama Dosen Yang Mengisi</label>
                            <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $cpl->nama_dosen_pengisi }}</p>
                        </div>

                        {{-- Tanggal Dibuat --}}
                        <div class="flex flex-col gap-2">
                            <label class="font-bold flex items-center gap-2">Tanggal Dibuat</label>
                            <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">
                                {{ \Carbon\Carbon::parse($cpl->tanggal_dibuat)->format('d F Y') }}
                            </p>
                        </div>

                        {{-- Capaian Profil Lulusan --}}
                        <div class="flex flex-col gap-2">
                            <label class="font-bold flex items-center gap-2">Capaian Profil Lulusan</label>
                            <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $cpl->capaian_profil_lulusan }}</p>
                        </div>

                        {{-- Deskripsi CPL --}}
                        <div class="flex flex-col gap-2">
                            <label class="font-bold flex items-center gap-2">Deskripsi Capaian Profil Lulusan</label>
                            <p class="text-gray-900 bg-gray-50 p-3 rounded-lg whitespace-pre-wrap">
                                {{ $cpl->deskripsi_capaian_profil_lulusan }}
                            </p>
                        </div>

                        {{-- Profil Lulusan --}}
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex flex-col gap-2">
                                <label class="font-bold flex items-center gap-2">Profil Lulusan</label>
                                <p class="text-gray-900 bg-white p-3 rounded-lg">
                                    {{ $cpl->profilLulusan->profil_lulusan ?? '-' }}
                                </p>
                            </div>
                        </div>

                        {{-- Dokumen Pendukung --}}
                        <div class="flex flex-col gap-2">
                            <label class="font-bold flex items-center gap-2">Dokumen Pendukung</label>
                            @if ($cpl->dokumen_pendukung)
                                <div class="flex items-center gap-3 p-3 bg-purple-50 rounded-lg border border-purple-200">
                                    <svg class="w-8 h-8 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" />
                                    </svg>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-900">Dokumen PDF</p>
                                        <p class="text-xs text-gray-500">{{ basename($cpl->dokumen_pendukung) }}</p>
                                    </div>
                                    <a href="{{ asset('storage/' . $cpl->dokumen_pendukung) }}" target="_blank"
                                        class="px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white font-semibold rounded-lg transition duration-200">
                                        Lihat PDF
                                    </a>
                                </div>
                            @else
                                <p class="text-gray-400 italic">Tidak ada dokumen pendukung</p>
                            @endif
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex gap-3 pt-4 border-t">
                            <a href="{{ route('capaian.edit', $cpl->id) }}"
                                class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg transition duration-200">
                                Edit Capaian
                            </a>
                            <form action="{{ route('capaian.destroy', $cpl->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg transition duration-200 confirm-delete">
                                    Hapus Capaian
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.confirm-delete')?.addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin menghapus capaian profil lulusan ini?')) {
                    this.closest('form').submit();
                }
            });
        });
    </script>
</x-app-layout>
