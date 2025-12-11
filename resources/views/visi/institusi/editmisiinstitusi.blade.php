@extends('layouts.app')

@section('content')
<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4 border-b pb-2">Edit Misi</h2>

        <form action="{{ route('visiprodi.update', $misi->id_misi) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @method('PATCH')
            @csrf

            <div>
                <label for="isi_misi" class="font-semibold">Isi Misi</label>
                <textarea name="isi_misi" id="isi_misi" rows="4" class="w-full border rounded-md p-2">{{ old('isi_misi', $misi->isi_misi) }}</textarea>
            </div>

            <div>
                <label for="author" class="font-semibold">Author</label>
                <input type="text" name="author" id="author" class="w-full border rounded-md p-2" value="{{ old('author', $misi->author) }}">
            </div>

            <div>
                <label for="id_visi" class="font-semibold">Visi Terkait</label>
                <select name="id_visi" id="id_visi" class="w-full border rounded-md p-2">
                    @foreach($data_visi as $visi)
                        <option value="{{ $visi->id_visi }}" {{ $misi->id_visi == $visi->id_visi ? 'selected' : '' }}>
                            {{ $visi->isi_visi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="dokumen_pendukung" class="font-semibold">Dokumen (PDF)</label>
                @if($misi->dokumen_pendukung)
                    <a href="{{ asset('storage/' . $misi->dokumen_pendukung) }}" target="_blank" class="text-blue-500 underline">Lihat Dokumen</a>
                @endif
                <input type="file" name="dokumen_pendukung" id="dokumen_pendukung" accept=".pdf" class="w-full border rounded-md p-2">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md font-bold">Update Misi</button>
        </form>
    </div>
</div>
@endsection
