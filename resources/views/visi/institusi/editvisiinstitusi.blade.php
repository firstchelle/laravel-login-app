@extends('layouts.app')

@section('content')
<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
    {{-- Kotak Edit VISI --}}
    @auth
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4 border-b pb-2">Edit Visi</h2>

            <form action="{{ route('visiinstitusi.update', $visi->id_visi) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @method('PATCH')
                @csrf

                <div>
                    <label for="isi_visi" class="font-semibold">Isi Visi</label>
                    <textarea name="isi_visi" id="isi_visi" rows="4" class="w-full border rounded-md p-2">{{ old('isi_visi', $visi->isi_visi) }}</textarea>
                    @error('isi_visi')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="author" class="font-semibold">Author</label>
                    <input type="text" name="author" id="author" class="w-full border rounded-md p-2" value="{{ old('author', $visi->author) }}">
                    @error('author')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="dokumen" class="font-semibold">Dokumen (PDF)</label>
                    @if ($visi->dokumen_pendukung)
                        <p class="text-sm text-green-600">Dokumen saat ini:</p>
                        <a href="{{ asset('storage/' . $visi->dokumen_pendukung) }}" target="_blank" class="text-blue-500 underline">
                            Lihat Dokumen
                        </a>
                    @endif
                    <input type="file" name="dokumen" id="dokumen" accept=".pdf" class="w-full border rounded-md p-2">
                    @error('dokumen')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="berlaku_sampai" class="font-semibold">Berlaku Sampai</label>
                    <input type="date" name="berlaku_sampai" id="berlaku_sampai" class="w-full border rounded-md p-2"
                           value="{{ old('berlaku_sampai', $visi->berlaku_sampai) }}">
                    @error('berlaku_sampai')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md font-bold">Update Visi</button>
                    <a href="{{ route('visiinstitusi.index') }}" class="bg-slate-500 text-white px-4 py-2 rounded-md font-bold">Kembali</a>
                </div>
            </form>
        </div>
    @endauth
</div>
@endsection
