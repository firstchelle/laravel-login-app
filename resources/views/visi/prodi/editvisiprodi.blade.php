<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-full h-auto flex flex-col p-4">
                    <p class="px-16 py-3 border border-black w-fit rounded-lg">VISI & MISI</p>

                    {{-- Form --}}
                    <form action="{{ route('visiprodi.update', $item->id) }}" method="POST"
                        enctype="multipart/form-data" class="flex flex-col gap-4 mt-4">
                        @method('PATCH')
                        @csrf

                        <input type="hidden" name="jenis" value="visi">

                        <div class="flex flex-col gap-2">
                            <label for="visimisi" class="font-bold">Visi</label>
                            <textarea name="visimisi" id="visimisi" rows="4" class="border border-gray-300 rounded-md p-2 resize-none">{{ old('visimisi', $item->visimisi) }}</textarea>
                            @error('visimisi')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="dokumen" class="font-bold">Dokumen (PDF)</label>

                            @if ($item->file_path)
                                <p class="text-sm text-green-600">Dokumen saat ini:</p>
                                <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank"
                                    class="text-blue-500 underline">
                                    Lihat Dokumen
                                </a>
                            @endif

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
                                value="{{ old('berlaku_sampai', $item->berlaku_sampai) }}">
                        </div>

                        <div class="w-full h-auto space-y-2">
                            <p class="font-bold">MISI YANG DICANGKUP VISI INI</p>

                            <div class="flex flex-row justify-between w-full h-auto p-2 gap-8">
                                {{-- Daftar Misi --}}
                                <div class="w-1/2 h-auto bg-slate-600 p-4">
                                    <p class="text-white font-bold">Pilih Misi Yang Sudah Ada</p>
                                    <div id="list_misi" class="max-h-40 overflow-y-auto mt-2 scroll-custom">

                                        @foreach ($data_misi as $misi)
                                            <div class="flex items-center mb-2 gap-x-4 p-1">
                                                <input type="checkbox" name="misi_ids[]" value="{{ $misi->id }}"
                                                    class="mr-2 leading-tight"
                                                    {{ $item->children->contains('id', $misi->id) ? 'checked' : '' }}>
                                                <span class="text-white">{{ $misi->visimisi }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Tambah Misi --}}
                                <div class="w-1/2 h-auto bg-slate-600 p-4 flex flex-col justify-start items-start">
                                    <p class="text-white font-bold mb-2">Tambah Misi Baru</p>

                                    <input type="text" id="new_misi" placeholder="Judul Misi Baru"
                                        class="mt-2 p-2 w-full rounded-md">

                                    <button type="button" onclick="tambahMisi()"
                                        class="bg-white px-4 py-2 font-bold rounded-md mt-3">
                                        Tambah Misi Baru
                                    </button>

                                    <p id="misi_error" class="text-red-300 text-sm mt-2 hidden"></p>
                                </div>
                            </div>

                            <div class="flex flex-row justify-between w-full h-auto items-center">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-500 text-white font-bold rounded-md w-fit">Edit</button>
                                <a href="{{ route('visiprodi.index') }}" type="submit"
                                    class="px-4 py-2 bg-slate-500 text-white font-bold rounded-md w-fit">Kembali</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function tambahMisi() {
            let nama = document.getElementById("new_misi").value;
            let error = document.getElementById("misi_error");

            if (!nama.trim()) {
                error.textContent = "Misi tidak boleh kosong";
                error.classList.remove("hidden");
                return;
            }

            error.classList.add("hidden");

            fetch("{{ route('visiprodi.misi.ajax.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        visimisi: nama
                    })
                })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        refreshMisiList();
                        document.getElementById("new_misi").value = "";
                    } else {
                        error.textContent = res.message;
                        error.classList.remove("hidden");
                    }
                });
        }

        function refreshMisiList() {
            fetch("{{ route('visiprodi.api.misi') }}")
                .then(res => res.json())
                .then(data => {
                    let wrapper = document.getElementById("list_misi");
                    wrapper.innerHTML = "";

                    data.forEach(misi => {
                        wrapper.innerHTML += `
                        <div class="flex items-center mb-2 gap-x-4 p-1">
                            <input type="checkbox" name="misi_ids[]" value="${misi.id}" class="mr-2 leading-tight">
                            <span class="text-white">${misi.visimisi}</span>
                        </div>
                    `;
                    });
                });
        }
    </script>
</x-app-layout>
