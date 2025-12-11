<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('VISI MISI INSTITUSI') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <a href="{{ route('visiinstitusi.create') }}"
                class="bg-blue-700 hover:bg-blue-800 p-4 rounded-lg text-white font-bold">Tambah Visi & Misi</a>
            <div class="max-h-screen overflow-y-auto shadow-sm sm:rounded-lg p-2 scroll-custom">
                @foreach ($data_visi as $visi)
                    <div class="w-full h-auto border border-black flex flex-row p-4 bg-white rounded-lg mb-4">
                        {{-- Left --}}
                        <div class="w-5/6 h-100 p-4 border-r">
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
                        <div class="w-1/4 h-auto py-2 px-4 font-bold gap-4 flex flex-col">
                            <p>Berlaku Sampai <br> {{ $visi->berlaku_sampai }}</p>
                            <p>Aksi</p>
                            <div class="flex flex-row gap-4">
                                {{-- Edit Icon --}}
                                <a href="{{ route('visiinstitusi.edit', $visi->id) }}"
                                    class=" 
        @if (auth()->user()->role !== 'rektor') pointer-events-none opacity-50 cursor-not-allowed @endif
    ">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>

                                {{-- Delete Button --}}
                                <form action="{{ route('visiinstitusi.destroy', $visi->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="button" @disabled(auth()->user()->role !== 'rektor')
                                        class="confirm-delete disabled:opacity-50 disabled:cursor-not-allowed">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            <a href=""
                                class="px-4 py-3 bg-slate-400 font-bold text-white text-center rounded-lg hover:bg-slate-500">Lihat
                                Detail</a>
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
                const btn = event.currentTarget;

                // Jika tombol disabled (dari Blade)
                if (btn.hasAttribute('disabled')) {
                    event.preventDefault();
                    return false;
                }

                // Konfirmasi
                const ok = confirm('Apakah anda yakin ingin menghapus item ini?');
                if (!ok) {
                    event.preventDefault();
                    return false;
                }

                // Jika ada form induk submit form
                const form = btn.closest('form');
                if (form) {
                    event.preventDefault();
                    form.submit();
                    return true;
                }

                return true;
            }

            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('button.confirm-delete')
                    .forEach(btn => btn.addEventListener('click', handleDeleteClick));
            });
        })();
    </script>
    </div>
    </div>
    </div>
</x-app-layout>
