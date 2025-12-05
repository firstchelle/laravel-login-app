<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-full h-auto flex flex-col p-4">
                    <p class="px-16 py-3 border border-black w-fit rounded-lg">VISI & MISI</p>

                    {{-- Form --}}
                    <form action="{{ route('visifakultas.store') }}" method="POST" enctype="multipart/form-data"
                        class="flex flex-col gap-4 mt-4">
                        @csrf
                        <div class="flex flex-col gap-2">
                            <label for="visimisi" class="font-bold">Visi / Misi</label>
                            <textarea name="visimisi" id="visimisi" rows="4" class="border border-gray-300 rounded-md p-2 resize-none">{{ old('visimisi') }}</textarea>
                            @error('visimisi')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="dokumen" class="font-bold">Dokumen (PDF)</label>
                            <input type="file" name="dokumen" id="dokumen" accept=".pdf"
                                class="border border-gray-300 rounded-md p-2">
                            @error('dokumen')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            {{-- Date Picker --}}
                            <label for="berlaku_sampai" class="font-bold">Berlaku Sampai</label>
                            <input type="date" name="berlaku_sampai" id="berlaku_sampai"
                                class="border border-gray-300 rounded-md p-2 w-full"
                                value="{{ old('berlaku_sampai') }}">
                        </div>

                        <div>
                            {{-- Jenis --}}
                            <label for="jenis" class="font-bold">Jenis Dokumen</label>
                            <select name="jenis" id="jenis" class="border border-gray-300 rounded-md p-2 w-full">
                                <option value="visi" {{ old('jenis') == 'visi' ? 'selected' : '' }}>Visi</option>
                                <option value="misi" {{ old('jenis') == 'misi' ? 'selected' : '' }}>Misi</option>
                            </select>
                        </div>

                        <div class="flex flex-row justify-between w-full h-auto items-center">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white font-bold rounded-md w-fit">Tambah</button>
                            <a href="{{ route('visifakultas.index') }}" type="submit"
                                class="px-4 py-2 bg-slate-500 text-white font-bold rounded-md w-fit">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
