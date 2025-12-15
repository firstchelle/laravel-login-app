<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-full h-auto flex flex-col p-4">
                    <p class="px-16 py-3 border border-black w-fit rounded-lg">EDIT PROFIL LULUSAN</p>

                    {{-- Form --}}
                    <form action="{{ route('profil-lulusan.update', $profilLulusan->id) }}" method="POST"
                        enctype="multipart/form-data" class="flex flex-col gap-4 mt-4">
                        @csrf
                        @method('PUT')

                        {{-- Nama Dosen Yang Mengisi --}}
                        <div class="flex flex-col gap-2">
                            <label for="nama_dosen_pengisi" class="font-bold flex items-center gap-2">
                                Nama Dosen Yang Mengisi
                                <span class="text-gray-400 text-sm cursor-help"
                                    title="Nama lengkap dosen yang mengisi form">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                            </label>
                            <input type="text" name="nama_dosen_pengisi" id="nama_dosen_pengisi" placeholder="Nama"
                                class="border border-gray-300 rounded-md p-2"
                                value="{{ old('nama_dosen_pengisi', $profilLulusan->nama_dosen_pengisi) }}" readonly>
                            @error('nama_dosen_pengisi')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tanggal Dibuat --}}
                        <div class="flex flex-col gap-2">
                            <label for="tanggal_dibuat" class="font-bold flex items-center gap-2">
                                Tanggal Dibuat
                                <span class="text-gray-400 text-sm cursor-help"
                                    title="Tanggal pembuatan profil lulusan">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                            </label>
                            <input type="date" name="tanggal_dibuat" id="tanggal_dibuat"
                                class="border border-gray-300 rounded-md p-2"
                                value="{{ old('tanggal_dibuat', $profilLulusan->tanggal_dibuat ? \Carbon\Carbon::parse($profilLulusan->tanggal_dibuat)->format('Y-m-d') : '') }}">
                            @error('tanggal_dibuat')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Dokumen Saat Ini --}}
                        @if ($profilLulusan->dokumen_pendukung)
                            <div class="flex flex-col gap-2">
                                <label class="font-bold">Dokumen Saat Ini</label>
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" />
                                    </svg>
                                    <a href="{{ asset('storage/' . $profilLulusan->dokumen_pendukung) }}"
                                        target="_blank" class="text-blue-600 hover:text-blue-800 hover:underline">
                                        Lihat Dokumen
                                    </a>
                                </div>
                            </div>
                        @endif

                        {{-- Dokumen Pendukung (FILE) --}}
                        <div class="flex flex-col gap-2">
                            <label for="dokumen_pendukung" class="font-bold flex items-center gap-2">
                                {{ $profilLulusan->dokumen_pendukung ? 'Ganti Dokumen Pendukung (PDF)' : 'Upload Dokumen Pendukung (PDF)' }}
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
                            <p class="text-sm text-gray-500">
                                {{ $profilLulusan->dokumen_pendukung ? 'Kosongkan jika tidak ingin mengubah dokumen' : 'Format:  PDF, Maksimal 5MB' }}
                            </p>
                            @error('dokumen_pendukung')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Profil Lulusan --}}
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex flex-col gap-2">
                                <label for="profil_lulusan" class="font-bold flex items-center gap-2">
                                    Profil Lulusan
                                    <span class="text-gray-400 text-sm cursor-help"
                                        title="Deskripsi singkat profil lulusan">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                </label>
                                <input type="text" name="profil_lulusan" id="profil_lulusan"
                                    placeholder="Profil Lulusan" class="border border-gray-300 rounded-md p-2 bg-white"
                                    value="{{ old('profil_lulusan', $profilLulusan->profil_lulusan) }}">
                                @error('profil_lulusan')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Deskripsi Profil Lulusan --}}
                            <div class="flex flex-col gap-2 mt-4">
                                <label for="deskripsi_profil_lulusan" class="font-bold flex items-center gap-2">
                                    Deskripsi Profil Lulusan
                                    <span class="text-gray-400 text-sm cursor-help"
                                        title="Deskripsi lengkap profil lulusan">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                </label>
                                <textarea name="deskripsi_profil_lulusan" id="deskripsi_profil_lulusan" rows="4"
                                    placeholder="Deskripsi Profil Lulusan" class="border border-gray-300 rounded-md p-2 resize-none bg-white">{{ old('deskripsi_profil_lulusan', $profilLulusan->deskripsi_profil_lulusan) }}</textarea>
                                @error('deskripsi_profil_lulusan')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Pilih Visi dengan Select2 --}}
                        <div class="flex flex-col gap-2">
                            <label for="visi_prodi_id" class="font-bold flex items-center gap-2">
                                Pilih Visi <span class="text-red-500">*</span>
                            </label>
                            <select name="visi_prodi_id" id="visi_prodi_id" class="w-full" required>
                                <option value="">-- Pilih Visi --</option>
                                @foreach ($visiList as $visi)
                                    <option value="{{ $visi->id }}"
                                        {{ old('visi_prodi_id', $profilLulusan->visi_prodi_id) == $visi->id ? 'selected' : '' }}>
                                        {{ Str::limit($visi->visi, 100) }}
                                        @if ($visi->berlaku_sampai)
                                            (Berlaku sampai:
                                            {{ \Carbon\Carbon::parse($visi->berlaku_sampai)->format('d/m/Y') }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('visi_prodi_id')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Pilih Misi dengan Select2 (Dependent) --}}
                        <div class="flex flex-col gap-2">
                            <label for="misi_prodi_id" class="font-bold flex items-center gap-2">
                                Pilih Misi <span class="text-red-500">*</span>
                            </label>
                            <select name="misi_prodi_id" id="misi_prodi_id" class="w-full" required>
                                <option value="">-- Pilih Visi Terlebih Dahulu --</option>
                            </select>
                            @error('misi_prodi_id')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex flex-row justify-between w-full h-auto items-center mt-4">
                            <button type="submit"
                                class="px-6 py-2 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600 transition">
                                Update
                            </button>
                            <a href="{{ route('profil-lulusan.index') }}"
                                class="px-6 py-2 bg-slate-500 text-white font-bold rounded-md hover:bg-slate-600 transition">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Styles untuk Select2 --}}
    <style>
        .select2-container--default .select2-selection--single {
            height: 46px ! important;
            padding: 8px 12px !important;
            border: 1px solid #d1d5db !important;
            border-radius: 0.375rem !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 30px !important;
            color: #374151 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 44px !important;
        }

        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
        }

        .select2-dropdown {
            border: 1px solid #d1d5db !important;
            border-radius: 0.375rem !important;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #3b82f6 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #9ca3af !important;
        }
    </style>

    {{-- JavaScript for Select2 + Dependent Select --}}
    <script>
        window.addEventListener('load', function() {
            // Check jQuery dan Select2
            if (typeof jQuery === 'undefined') {
                console.error('jQuery tidak loaded! ');
                return;
            }

            if (typeof jQuery.fn.select2 === 'undefined') {
                console.error('Select2 tidak loaded!');
                return;
            }

            // Initialize Select2 untuk Visi
            $('#visi_prodi_id').select2({
                placeholder: "-- Pilih Visi --",
                allowClear: true,
                width: '100%'
            });

            // Initialize Select2 untuk Misi
            $('#misi_prodi_id').select2({
                placeholder: "-- Pilih Visi Terlebih Dahulu --",
                allowClear: true,
                width: '100%'
            });

            console.log('✅ Select2 berhasil diinisialisasi! ');

            // Dependent Select Logic
            $('#visi_prodi_id').on('change', function() {
                const visiId = $(this).val();
                const misiSelect = $('#misi_prodi_id');

                // Reset misi select
                misiSelect.empty();
                misiSelect.append('<option value="">-- Loading...  --</option>');
                misiSelect.prop('disabled', true);
                misiSelect.trigger('change'); // Update Select2

                if (visiId) {
                    // Fetch misi berdasarkan visi
                    fetch(`/profil-lulusan/get-misi/${visiId}`)
                        .then(response => response.json())
                        .then(data => {
                            misiSelect.empty();
                            misiSelect.append('<option value="">-- Pilih Misi --</option>');

                            if (data.length > 0) {
                                data.forEach(misi => {
                                    const option = new Option(misi.misi, misi.id, false, false);

                                    // Keep old selection or current data
                                    const selectedMisi =
                                        {{ old('misi_prodi_id', $profilLulusan->misi_prodi_id) }};
                                    if (misi.id == selectedMisi) {
                                        option.selected = true;
                                    }

                                    misiSelect.append(option);
                                });
                                misiSelect.prop('disabled', false);
                            } else {
                                misiSelect.append(
                                    '<option value="">-- Tidak Ada Misi Terkait --</option>');
                            }

                            misiSelect.trigger('change'); // Update Select2
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            misiSelect.empty();
                            misiSelect.append('<option value="">-- Error Loading Misi --</option>');
                            misiSelect.trigger('change');
                        });
                } else {
                    misiSelect.empty();
                    misiSelect.append('<option value="">-- Pilih Visi Terlebih Dahulu --</option>');
                    misiSelect.trigger('change');
                }
            });

            // Trigger change on load to populate misi
            $('#visi_prodi_id').trigger('change');
        });
    </script>
</x-app-layout>
