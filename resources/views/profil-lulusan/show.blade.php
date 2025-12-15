<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    {{-- Header --}}
                    <div class="flex justify-between items-center mb-6 pb-4 border-b">
                        <h2 class="text-2xl font-bold text-gray-800">Detail Profil Lulusan</h2>
                        <a href="{{ route('profil-lulusan.index') }}"
                            class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg transition duration-200">
                            Kembali
                        </a>
                    </div>

                    {{-- Content --}}
                    <div class="space-y-6">
                        {{-- Nama Dosen --}}
                        <div class="flex flex-col gap-2">
                            <label class="font-semibold text-gray-700">Nama Dosen Yang Mengisi</label>
                            <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $profilLulusan->nama_dosen_pengisi }}
                            </p>
                        </div>

                        {{-- Tanggal Dibuat --}}
                        <div class="flex flex-col gap-2">
                            <label class="font-semibold text-gray-700">Tanggal Dibuat</label>
                            <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">
                                {{ \Carbon\Carbon::parse($profilLulusan->tanggal_dibuat)->format('d F Y') }}
                            </p>
                        </div>

                        {{-- Profil Lulusan --}}
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex flex-col gap-2 mb-4">
                                <label class="font-semibold text-gray-700">Profil Lulusan</label>
                                <p class="text-gray-900 bg-white p-3 rounded-lg">{{ $profilLulusan->profil_lulusan }}
                                </p>
                            </div>

                            <div class="flex flex-col gap-2">
                                <label class="font-semibold text-gray-700">Deskripsi Profil Lulusan</label>
                                <p class="text-gray-900 bg-white p-3 rounded-lg whitespace-pre-wrap">
                                    {{ $profilLulusan->deskripsi_profil_lulusan }}</p>
                            </div>
                        </div>

                        {{-- Visi Terkait --}}
                        <div class="flex flex-col gap-2">
                            <label class="font-semibold text-gray-700">Visi Terkait</label>
                            @if ($profilLulusan->visiProdi)
                                <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                    <span
                                        class="inline-block px-3 py-1 text-xs rounded-full bg-blue-500 text-white font-semibold mb-2">
                                        VISI
                                    </span>
                                    <p class="text-gray-900">{{ $profilLulusan->visiProdi->visi }}</p>
                                    @if ($profilLulusan->visiProdi->berlaku_sampai)
                                        <p class="text-xs text-gray-600 mt-2">
                                            Berlaku sampai:
                                            {{ \Carbon\Carbon::parse($profilLulusan->visiProdi->berlaku_sampai)->format('d F Y') }}
                                        </p>
                                    @endif
                                </div>
                            @else
                                <p class="text-gray-400 italic">Tidak ada visi terkait</p>
                            @endif
                        </div>

                        {{-- Misi Terkait --}}
                        <div class="flex flex-col gap-2">
                            <label class="font-semibold text-gray-700">Misi Terkait</label>
                            @if ($profilLulusan->misiProdi)
                                <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                                    <span
                                        class="inline-block px-3 py-1 text-xs rounded-full bg-green-500 text-white font-semibold mb-2">
                                        MISI
                                    </span>
                                    <p class="text-gray-900">{{ $profilLulusan->misiProdi->misi }}</p>
                                    @if ($profilLulusan->misiProdi->berlaku_sampai)
                                        <p class="text-xs text-gray-600 mt-2">
                                            Berlaku sampai:
                                            {{ \Carbon\Carbon::parse($profilLulusan->misiProdi->berlaku_sampai)->format('d F Y') }}
                                        </p>
                                    @endif
                                </div>
                            @else
                                <p class="text-gray-400 italic">Tidak ada misi terkait</p>
                            @endif
                        </div>

                        {{-- Dokumen Pendukung --}}
                        <div class="flex flex-col gap-2">
                            <label class="font-semibold text-gray-700">Dokumen Pendukung</label>
                            @if ($profilLulusan->dokumen_pendukung)
                                <div
                                    class="flex items-center gap-3 p-3 bg-purple-50 rounded-lg border border-purple-200">
                                    <svg class="w-8 h-8 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" />
                                    </svg>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-900">Dokumen PDF</p>
                                        <p class="text-xs text-gray-500">
                                            {{ basename($profilLulusan->dokumen_pendukung) }}</p>
                                    </div>
                                    <a href="{{ asset('storage/' . $profilLulusan->dokumen_pendukung) }}"
                                        target="_blank"
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
                            <a href="{{ route('profil-lulusan.edit', $profilLulusan->id) }}"
                                class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg transition duration-200">
                                Edit Profil
                            </a>
                            <form action="{{ route('profil-lulusan.destroy', $profilLulusan->id) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg transition duration-200 confirm-delete">
                                    Hapus Profil
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
                if (confirm('Apakah Anda yakin ingin menghapus profil lulusan ini?')) {
                    this.closest('form').submit();
                }
            });
        });
    </script>
</x-app-layout>
