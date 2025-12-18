<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-full h-auto flex flex-col p-4">

                    <p class="px-16 py-3 border border-black w-fit rounded-lg">EDIT CAPAIAN PROFIL LULUSAN</p>

                    {{-- Form --}}
                    <form action="{{ route('capaian.update', $cpl->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4 mt-4">
                        @csrf
                        @method('PUT')

                        {{-- Nama Dosen Pengisi --}}
                        <div class="flex flex-col gap-2">
                            <label for="nama_dosen_pengisi" class="font-bold flex items-center gap-2">
                                Nama Dosen Yang Mengisi
                                <span class="text-gray-400 text-sm cursor-help" title="Nama lengkap dosen yang mengisi form">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                            </label>
                            <input type="text" name="nama_dosen_pengisi" id="nama_dosen_pengisi"
                                   class="border border-gray-300 rounded-md p-2"
                                   value="{{ old('nama_dosen_pengisi', $cpl->nama_dosen_pengisi) }}" readonly>
                            @error('nama_dosen_pengisi')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tanggal Dibuat --}}
                        <div class="flex flex-col gap-2">
                            <label for="tanggal_dibuat" class="font-bold flex items-center gap-2">
                                Tanggal Dibuat <span class="text-red-500">*</span>
                                <span class="text-gray-400 text-sm cursor-help" title="Tanggal pembuatan CPL">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                            </label>
                            <input type="date" name="tanggal_dibuat" id="tanggal_dibuat"
                                   class="border border-gray-300 rounded-md p-2"
                                   value="{{ old('tanggal_dibuat', $cpl->tanggal_dibuat ? \Carbon\Carbon::parse($cpl->tanggal_dibuat)->format('Y-m-d') : '') }}" required>
                            @error('tanggal_dibuat')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Dokumen Saat Ini --}}
                        @if ($cpl->dokumen_pendukung)
                            <div class="flex flex-col gap-2">
                                <label class="font-bold">Dokumen Saat Ini</label>
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" />
                                    </svg>
                                    <a href="{{ asset('storage/' . $cpl->dokumen_pendukung) }}" target="_blank"
                                       class="text-blue-600 hover:text-blue-800 hover:underline">
                                        Lihat Dokumen
                                    </a>
                                </div>
                            </div>
                        @endif

                        {{-- Dokumen Pendukung --}}
                        <div class="flex flex-col gap-2">
                            <label for="dokumen_pendukung" class="font-bold flex items-center gap-2">
                                {{ $cpl->dokumen_pendukung ? 'Ganti Dokumen Pendukung (PDF)' : 'Upload Dokumen Pendukung (PDF)' }}
                                <span class="text-gray-400 text-sm cursor-help" title="Upload file dokumen pendukung (opsional)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                            </label>
                            <input type="file" name="dokumen_pendukung" id="dokumen_pendukung" accept=".pdf"
                                   class="border border-gray-300 rounded-lg p-3">
                            <p class="text-sm text-gray-500">
                                {{ $cpl->dokumen_pendukung ? 'Kosongkan jika tidak ingin mengubah dokumen' : 'Format: PDF, Maksimal 5MB' }}
                            </p>
                            @error('dokumen_pendukung')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Capaian Profil Lulusan --}}
                        <div class="flex flex-col gap-2">
                            <label for="capaian_profil_lulusan" class="font-bold flex items-center gap-2">
                                Capaian Profil Lulusan <span class="text-red-500">*</span>
                                <span class="text-gray-400 text-sm cursor-help" title="Isi capaian profil lulusan">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                            </label>
                            <input type="text" name="capaian_profil_lulusan" id="capaian_profil_lulusan"
                                   class="border border-gray-300 rounded-md p-2"
                                   value="{{ old('capaian_profil_lulusan', $cpl->capaian_profil_lulusan) }}" required>
                            @error('capaian_profil_lulusan')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                                                {{-- Deskripsi CPL --}}
                        <div class="flex flex-col gap-2">
                            <label for="deskripsi_capaian_profil_lulusan" class="font-bold flex items-center gap-2">
                                Deskripsi CPL <span class="text-red-500">*</span>
                                <span class="text-gray-400 text-sm cursor-help" title="Deskripsi lengkap capaian profil lulusan">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                            </label>
                            <textarea name="deskripsi_capaian_profil_lulusan" id="deskripsi_capaian_profil_lulusan" rows="4"
                                      class="border border-gray-300 rounded-md p-2 resize-none bg-white" required>{{ old('deskripsi_capaian_profil_lulusan', $cpl->deskripsi_capaian_profil_lulusan) }}</textarea>
                            @error('deskripsi_capaian_profil_lulusan')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Profil Lulusan Dropdown --}}
                        <div class="flex flex-col gap-2">
                            <label for="profil_lulusan_id" class="font-bold flex items-center gap-2">
                                Profil Lulusan <span class="text-red-500">*</span>
                                <span class="text-gray-400 text-sm cursor-help" title="Pilih profil lulusan terkait CPL">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                            </label>
                            <select name="profil_lulusan_id" id="profil_lulusan_id"
                                    class="w-full border border-gray-300 rounded-md p-2" required>
                                <option value="">-- Pilih Profil Lulusan --</option>
                                @foreach ($profilLulusans as $profil)
                                    <option value="{{ $profil->id }}"
                                        {{ old('profil_lulusan_id', $cpl->profil_lulusan_id) == $profil->id ? 'selected' : '' }}>
                                        {{ $profil->profil_lulusan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('profil_lulusan_id')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex flex-row justify-between w-full h-auto items-center mt-4">
                            <button type="submit"
                                    class="px-6 py-2 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600 transition">
                                Update
                            </button>
                            <a href="{{ route('capaian.index') }}"
                               class="px-6 py-2 bg-slate-500 text-white font-bold rounded-md hover:bg-slate-600 transition">
                                Batal
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
