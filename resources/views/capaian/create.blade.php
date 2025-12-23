<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white shadow-sm sm:rounded-lg p-6">
            <p class="text-lg font-bold border border-black px-6 py-2 w-fit rounded-lg mb-6">CAPAIAN PEMBELAJARAN LULUSAN</p>

            <form action="{{ route('capaian.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Nama Dosen Pengisi --}}
                <div>
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
                           class="w-full border border-gray-300 rounded-md p-2"
                           value="{{ auth()->user()->name }}" readonly>
                </div>

                {{-- Tanggal Dibuat --}}
                <div>
                    <label for="tanggal_dibuat" class="font-bold flex items-center gap-2">
                        Tanggal Dibuat
                        <span class="text-gray-400 text-sm cursor-help" title="Tanggal pembuatan CPL">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                    </label>
                    <input type="date" name="tanggal_dibuat" id="tanggal_dibuat"
                           class="w-full border border-gray-300 rounded-md p-2"
                           value="{{ old('tanggal_dibuat') }}">
                </div>

                {{-- Capaian Pembelajaran Lulusan --}}
                <div>
                    <label for="capaian_profil_lulusan" class="font-bold flex items-center gap-2">
                        Capaian Pembelajaran Lulusan
                        <span class="text-gray-400 text-sm cursor-help" title="Isi capaian pembelajaran lulusan">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                    </label>
                    <input type="text" name="capaian_profil_lulusan" id="capaian_profil_lulusan"
                           class="w-full border border-gray-300 rounded-md p-2"
                           value="{{ old('capaian_profil_lulusan') }}">
                </div>

                {{-- Deskripsi CPL --}}
                <div>
                    <label for="deskripsi_capaian_profil_lulusan" class="font-bold flex items-center gap-2">
                        Deskripsi Capaian Pembelajaran Lulusan
                        <span class="text-gray-400 text-sm cursor-help" title="Deskripsi lengkap capaian pembelajaran lulusan">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                    </label>
                    <textarea name="deskripsi_capaian_profil_lulusan" id="deskripsi_capaian_profil_lulusan" rows="4"
                              class="w-full border border-gray-300 rounded-md p-2 resize-none">{{ old('deskripsi_capaian_profil_lulusan') }}</textarea>
                </div>

                {{-- Profil Lulusan --}}
                <div>
                    <label for="profil_lulusan_id" class="block font-semibold flex items-center gap-2">
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
                            class="w-full border rounded-md p-2" required>
                        <option value="">-- Pilih Profil Lulusan --</option>
                        @foreach($profilLulusans as $profil)
                            <option value="{{ $profil->id }}"
                                {{ old('profil_lulusan_id') == $profil->id ? 'selected' : '' }}>
                                {{ $profil->profil_lulusan }}
                            </option>
                        @endforeach
                    </select>
                    @error('profil_lulusan_id')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>



                {{-- Dokumen Pendukung --}}
                <div>
                    <label for="dokumen_pendukung" class="font-bold flex items-center gap-2">
                        Dokumen Pendukung (PDF)
                        <span class="text-gray-400 text-sm cursor-help"
                                    title="Upload file dokumen pendukung (opsional)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                    </label>
                    <input type="file" name="dokumen_pendukung" id="dokumen_pendukung" accept=".pdf"
                                class="border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-sm text-gray-500">Format: PDF, Maksimal 5MB</p>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex justify-between mt-6">
                    <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white font-bold rounded-md hover:bg-blue-700 transition">
                        Tambah
                    </button>
                    <a href="{{ route('capaian.index') }}"
                       class="px-6 py-2 bg-gray-500 text-white font-bold rounded-md hover:bg-gray-600 transition">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
