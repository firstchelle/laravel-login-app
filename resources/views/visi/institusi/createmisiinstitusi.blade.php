@extends('layouts.app')

@section('content')
<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
    {{-- Kotak Tambah MISI --}}
    @auth
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4 border-b pb-2">Tambah Misi</h2>

            <form action="{{ route('visiinstitusi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="isi_misi" class="font-semibold">Isi Misi</label>
                    <textarea name="isi_misi" id="isi_misi" rows="4" class="w-full border rounded-md p-2">{{ old('isi_misi') }}</textarea>
                    @error('isi_misi')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="author" class="font-semibold">Author</label>
                    <input type="text" name="author" id="author" class="w-full border rounded-md p-2" value="{{ old('author') }}">
                    @error('author')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="id_visi" class="font-semibold">Visi Terkait</label>
                    <select name="id_visi" id="id_visi" class="w-full border rounded-md p-2">
                        <option value="">-- Pilih Visi --</option>
                        @foreach($data_visi as $visi)
                            <option value="{{ $visi->id_visi }}" {{ old('id_visi') == $visi->id_visi ? 'selected' : '' }}>
                                {{ $visi->isi_visi }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_visi')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="dokumen_pendukung" class="font-semibold">Dokumen (PDF)</label>
                    <input type="file" name="dokumen_pendukung" id="dokumen_pendukung" accept=".pdf" class="w-full border rounded-md p-2">
                    @error('dokumen_pendukung')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md font-bold">Tambah Misi</button>
            </form>
        </div>
    @endauth
</div>
@endsection
