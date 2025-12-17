<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    {{-- Header --}}
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Edit Visi Fakultas</h2>
                        <p class="text-gray-600 mt-1">Perbarui informasi visi fakultas</p>
                    </div>

                    {{-- Form --}}
                    <form action="{{ route('visifakultas.update_visi', $item->id) }}" method="POST"
                        enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Visi --}}
                        <div class="flex flex-col gap-2">
                            <label for="visi" class="font-semibold text-gray-700">
                                Visi <span class="text-red-500">*</span>
                            </label>
                            <textarea name="visi" id="visi" rows="6"
                                class="border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
                                placeholder="Masukkan visi fakultas... ">{{ old('visi', $item->visi) }}</textarea>
                            @error('visi')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Dokumen Saat Ini --}}
                        @if ($item->dokumen)
                            <div class="flex flex-col gap-2">
                                <label class="font-semibold text-gray-700">Dokumen Saat Ini</label>
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" />
                                    </svg>
                                    <a href="{{ asset('storage/' . $item->dokumen) }}" target="_blank"
                                        class="text-blue-600 hover:text-blue-800 hover:underline">
                                        Lihat Dokumen
                                    </a>
                                </div>
                            </div>
                        @endif

                        {{-- Upload Dokumen Baru --}}
                        <div class="flex flex-col gap-2">
                            <label for="dokumen" class="font-semibold text-gray-700">
                                {{ $item->dokumen ? 'Ganti Dokumen (PDF)' : 'Upload Dokumen (PDF)' }}
                            </label>
                            <input type="file" name="dokumen" id="dokumen" accept=".pdf"
                                class="border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-sm text-gray-500">
                                {{ $item->dokumen ? 'Kosongkan jika tidak ingin mengubah dokumen' : 'Format:  PDF, Maksimal 5MB' }}
                            </p>
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
                                value="{{ old('berlaku_sampai', $item->berlaku_sampai) }}">
                            @error('berlaku_sampai')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t">
                            <button type="submit"
                                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200 shadow-sm">
                                Update Visi
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
</x-app-layout>
