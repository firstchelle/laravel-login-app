<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('VISI MISI FAKULTAS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Tombol Create (Hanya untuk Dekan) --}}
            @if (auth()->user()->role === 'dekan')
                <a href="{{ route('visifakultas.create') }}"
                    class="bg-blue-700 hover:bg-blue-800 p-4 rounded-lg text-white font-bold">
                    Tambah Visi & Misi
                </a>
            @endif

            <div class="max-h-screen overflow-y-auto shadow-sm sm:rounded-lg p-2 scroll-custom">

                @foreach ($data_visi as $visi)
                    <div class="w-full border border-black flex flex-row p-4 bg-white rounded-lg mb-4">

                        {{-- Left --}}
                        <div class="w-5/6 h-80 overflow-y-auto p-4 border-r scroll-custom">
                            {{-- Visi --}}
                            <div>
                                <p class="font-bold text-lg mb-2">VISI</p>
                                <p class="mb-4">"{{ $visi->visimisi }}"</p>
                            </div>

                            {{-- Misi --}}
                            <div>
                                <p class="font-bold text-lg mb-2">MISI</p>
                                <ul class="list-disc list-inside">
                                    @foreach ($visi->children as $misi)
                                        <li class="mb-1 list-decimal">{{ $misi->visimisi }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        {{-- Right --}}
                        <div class="w-1/4 h-auto py-2 px-4 font-bold flex flex-col gap-4">

                            <p>Berlaku Sampai <br> {{ $visi->berlaku_sampai }}</p>

                            {{-- Aksi (Hanya untuk Dekan) --}}
                            @if (auth()->user()->role === 'dekan')
                                <p>Aksi</p>

                                <div class="flex flex-row gap-4">

                                    {{-- Edit --}}
                                    <a href="{{ route('visifakultas.edit', $visi->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('visifakultas.destroy', $visi->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="confirm-delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endif

                            {{-- Dokumen --}}
                            <div class="space-y-3 font-bold">
                                <p>Dokumen</p>
                                <div>
                                    @if ($visi->file_path)
                                        <a href="{{ asset('storage/' . $visi->file_path) }}" target="_blank"
                                            class="px-4 py-1 bg-purple-500 rounded-full inline-block text-white">
                                            visi_{{ $loop->iteration }}.pdf
                                        </a>
                                    @else
                                        <p class="text-red-500">Tidak ada dokumen</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>

    {{-- Script --}}
    <script>
        (function() {
            function handleDeleteClick(event) {
                const ok = confirm('Apakah anda yakin ingin menghapus item ini?');
                if (!ok) event.preventDefault();

                const form = event.currentTarget.closest('form');
                if (ok && form) form.submit();
            }

            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('button.confirm-delete')
                    .forEach(btn => btn.addEventListener('click', handleDeleteClick));
            });
        })();
    </script>

</x-app-layout>
