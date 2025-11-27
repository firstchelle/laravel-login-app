<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-full h-auto flex flex-col p-4">
                    <p class="px-16 py-3 border border-black w-fit rounded-lg">MISI</p>

                    {{-- Form --}}
                    <form action="{{ route('visiprodi.store') }}" method="POST" enctype="multipart/form-data"
                        class="flex flex-col gap-4 mt-4">
                        @csrf
                        <div class="flex flex-col gap-2">
                            <label for="visi" class="font-bold">Visi</label>
                            <textarea name="visi" id="visi" rows="4" class="border border-gray-300 rounded-md p-2 resize-none">{{ old('visi') }}</textarea>
                            @error('visi')
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
                            <label for="berlaku" class="font-bold">Berlaku Sampai</label>
                            <input type="date" name="berlaku" id="berlaku"
                                class="border border-gray-300 rounded-md p-2 w-full" value="{{ old('berlaku') }}">
                        </div>

                        <div>
                            {{-- Created By --}}
                            <label for="created_by" class="font-bold">Dibuat Oleh</label>
                            <input type="text" name="created_by" class="border border-gray-300 rounded-md p-2 w-full"
                                value="{{ Auth::user()->name }}">
                        </div>

                        <div class="flex flex-row justify-between w-full h-auto items-center">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white font-bold rounded-md w-fit">Tambah</button>
                            <button type="submit"
                                class="px-4 py-2 bg-slate-500 text-white font-bold rounded-md w-fit">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
