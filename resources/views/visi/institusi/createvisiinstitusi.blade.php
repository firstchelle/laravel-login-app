@extends('layouts.app')

@section('content')
<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
    {{-- Kotak Tambah VISI --}}
    @auth
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4 border-b pb-2">Tambah Visi</h2>

            <form action="{{ route('visiinstitusi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="isi_visi" class="font-semibold">Isi Visi</label>
                    <textarea name="isi_visi" id="isi_visi" rows="4" class="w-full border rounded-md p-2">{{ old('isi_visi') }}</textarea>
                </div>

                <div>
                    <label for="author" class="font-semibold">Author</label>
                    <input type="text" name="author" id="author" class="w-full border rounded-md p-2" value="{{ old('author') }}">
                </div>

                <div>
                    <label for="dokumen" class="font-semibold">Dokumen (PDF)</label>
                    <input type="file" name="dokumen" id="dokumen" accept=".pdf" class="w-full border rounded-md p-2">
                </div>

                <div>
                    <label for="berlaku_sampai" class="font-semibold">Berlaku Sampai</label>
                    <input type="date" name="berlaku_sampai" id="berlaku_sampai" class="w-full border rounded-md p-2">
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md font-bold">Tambah Visi</button>
            </form>
        </div>
    @endauth
</div>
@endsection
