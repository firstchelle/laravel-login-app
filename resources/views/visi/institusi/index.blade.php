@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-16">
    <h1 class="text-2xl font-bold mb-6">Daftar Visi & Misi Institusi</h1>

    {{-- Tabel VISI --}}
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <h2 class="text-xl font-semibold bg-gray-100 px-4 py-2">Tabel Visi</h2>
        <table class="min-w-full border border-gray-300 table-fixed">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border w-20">ID Visi</th>
                    <th class="px-4 py-2 border w-2/5">Isi Visi</th>
                    <th class="px-4 py-2 border w-1/5">Author</th>
                    <th class="px-4 py-2 border w-1/5">Dokumen Pendukung</th>
                    <th class="px-4 py-2 border w-32">Created At</th>
                    <th class="px-4 py-2 border w-32">Updated At</th>
                    <th class="px-4 py-2 border w-32">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_visi as $visi)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $visi->id_visi }}</td>
                        <td class="px-4 py-2 border break-words">{{ $visi->isi_visi }}</td>
                        <td class="px-4 py-2 border">{{ $visi->author }}</td>
                        <td class="px-4 py-2 border">
                            @if($visi->dokumen_pendukung)
                                <a href="{{ asset('storage/' . $visi->dokumen_pendukung) }}" target="_blank" class="text-blue-600 underline">
                                    Lihat Dokumen
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        
                        <td class="px-4 py-2 border">{{ $visi->created_at }}</td>
                        <td class="px-4 py-2 border">{{ $visi->updated_at }}</td>
                        <td class="px-4 py-2 border text-center">
                            {{-- Edit (ikon pensil) --}}
                            @auth
                                @if(auth()->user()->id_role === 1)
                                <a href="{{ route('visiinstitusi.edit', $visi->id_visi) }}" class="mx-1" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536M9 11l6.232-6.232a2 2 0 112.828 2.828L11.828 13.828a2 2 0 01-1.414.586H9v-2.414a2 2 0 01.586-1.414z" />
                                    </svg>
                                </a>
                                {{-- Hapus (ikon trash) --}}
                                <form action="{{ route('visiinstitusi.destroy', $visi->id_visi) }}" method="POST" class="inline-block delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="mx-1 delete-btn" title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3" />
                                        </svg>
                                    </button>
                                </form>
                                @endif
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Tombol Tambah Visi hanya untuk rektor --}}
        @auth
            @if(auth()->user()->id_role === 1)
                <div class="px-4 py-4">
                    <a href="{{ route('visiinstitusi.create') }}" 
                       class="bg-blue-600 text-white px-4 py-2 rounded-md font-bold hover:bg-blue-700">
                        + Tambahkan Visi
                    </a>
                </div>
            @endif
        @endauth
    </div>

    {{-- Tabel MISI --}}
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <h2 class="text-xl font-semibold bg-gray-100 px-4 py-2">Tabel Misi</h2>
        <table class="min-w-full border border-gray-300 table-fixed">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border w-20">ID Misi</th>
                    <th class="px-4 py-2 border w-2/5">Isi Misi</th>
                    <th class="px-4 py-2 border w-1/5">Visi Terkait</th>
                    <th class="px-4 py-2 border w-1/5">Author</th>
                    <th class="px-4 py-2 border w-1/5">Dokumen Pendukung</th>
                    <th class="px-4 py-2 border w-32">Created At</th>
                    <th class="px-4 py-2 border w-32">Updated At</th>
                    <th class="px-4 py-2 border w-32">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_misi as $misi)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $misi->id_misi }}</td>
                        <td class="px-4 py-2 border break-words">{{ $misi->isi_misi }}</td>
                        <td class="px-4 py-2 border">{{ $misi->visi?->isi_visi ?? '-' }}</td>
                        <td class="px-4 py-2 border">{{ $misi->author }}</td>
                        <td class="px-4 py-2 border">
                            @if($misi->dokumen_pendukung)
                                <a href="{{ asset('storage/' . $misi->dokumen_pendukung) }}" target="_blank" class="text-blue-600 underline">
                                    Lihat Dokumen
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-4 py-2 border">{{ $misi->created_at }}</td>
                        <td class="px-4 py-2 border">{{ $misi->updated_at }}</td>
                        <td class="px-4 py-2 border text-center">
                            {{-- Edit (ikon pensil) --}}
                            @auth
                                @if(auth()->user()->id_role === 1)
                                <a href="{{ route('misiinstitusi.edit', $misi->id_misi) }}" class="mx-1" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536M9 11l6.232-6.232a2 2 0 112.828 2.828L11.828 13.828a2 2 0 01-1.414.586H9v-2.414a2 2 0 01.586-1.414z" />
                                    </svg>
                                </a>
                                {{-- Hapus (ikon trash) --}}
                                <form action="{{ route('misiinstitusi.destroy', $misi->id_misi) }}" method="POST" class="inline-block delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="mx-1 delete-btn" title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1                                             d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3" />
                                        </svg>
                                    </button>
                                </form>
                                @endif
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    {{-- Tombol Tambah Visi hanya untuk rektor --}}
        @auth
            @if(auth()->user()->id_role === 1)
                <div class="px-4 py-4">
                    <a href="{{ route('misiinstitusi.create') }}" 
                       class="bg-blue-600 text-white px-4 py-2 rounded-md font-bold hover:bg-blue-700">
                        + Tambahkan Misi
                    </a>
                </div>
            @endif
        @endauth
    </div>
</div>

{{-- Script SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const form = this.closest('form');
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data akan dihapus permanen dari database.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // hapus dari database
                }
            });
        });
    });
});
</script>
@endsection
