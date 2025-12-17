<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm: px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    {{-- Header --}}
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Tambah Misi Fakultas</h2>
                        <p class="text-gray-600 mt-1">Isi formulir di bawah untuk menambahkan misi fakultas</p>
                    </div>

                    {{-- Form --}}
                    <form action="{{ route('visifakultas.store_misi') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        {{-- Pilih Visi dengan Select2 --}}
                        <div class="flex flex-col gap-2">
                            <label for="visi_fakultas_id" class="font-semibold text-gray-700">
                                Pilih Visi <span class="text-red-500">*</span>
                            </label>
                            <select name="visi_fakultas_id" id="visi_fakultas_id"
                                class="border border-gray-300 rounded-lg p-3 w-full" required>
                                <option value="">-- Pilih Visi --</option>
                                @foreach ($visi as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('visi_fakultas_id') == $item->id ? 'selected' : '' }}>
                                        {{ Str::limit($item->visi, 100) }}
                                        @if ($item->berlaku_sampai)
                                            (Berlaku sampai:
                                            {{ \Carbon\Carbon::parse($item->berlaku_sampai)->format('d/m/Y') }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('visi_fakultas_id')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Misi --}}
                        <div class="flex flex-col gap-2">
                            <label for="misi" class="font-semibold text-gray-700">
                                Misi <span class="text-red-500">*</span>
                            </label>
                            <textarea name="misi" id="misi" rows="6"
                                class="border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
                                placeholder="Masukkan misi fakultas..." required>{{ old('misi') }}</textarea>
                            @error('misi')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Dokumen --}}
                        <div class="flex flex-col gap-2">
                            <label for="dokumen" class="font-semibold text-gray-700">
                                Dokumen Pendukung (PDF)
                            </label>
                            <input type="file" name="dokumen" id="dokumen" accept=".pdf"
                                class="border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-sm text-gray-500">Format: PDF, Maksimal 5MB</p>
                            @error('dokumen')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Berlaku Sampai --}}
                        <div class="flex flex-col gap-2">
                            <label for="berlaku_sampai" class="font-semibold text-gray-700">
                                Berlaku Sampai <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="berlaku_sampai" id="berlaku_sampai"
                                class="border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full md:w-1/2"
                                value="{{ old('berlaku_sampai') }}" required>
                            @error('berlaku_sampai')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t">
                            <button type="submit"
                                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200 shadow-sm">
                                Simpan Misi
                            </button>
                            <a href="{{ route('visifakultas.index') }}"
                                class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg transition duration-200 shadow-sm text-center">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Styles --}}
    <style>
        .select2-container--default .select2-selection--single {
            height: 46px !important;
            padding: 8px 12px !important;
            border: 1px solid #d1d5db !important;
            border-radius: 0.5rem !important;
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
            border-radius: 0.5rem !important;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #3b82f6 !important;
        }
    </style>

    {{-- Initialize Select2 --}}
    <script>
        // Tunggu sampai DOM dan library loaded
        window.addEventListener('load', function() {
            // Double check jQuery dan Select2 loaded
            if (typeof jQuery === 'undefined') {
                console.error('jQuery tidak loaded! ');
                return;
            }

            if (typeof jQuery.fn.select2 === 'undefined') {
                console.error('Select2 tidak loaded!');
                return;
            }

            // Initialize Select2
            jQuery('#visi_fakultas_id').select2({
                placeholder: "-- Pilih Visi --",
                allowClear: true,
                width: '100%'
            });

            console.log('✅ Select2 berhasil diinisialisasi! ');
        });
    </script>
</x-app-layout>
