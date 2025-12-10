<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('VISI MISI INSTITUSI') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-h-screen overflow-y-auto shadow-sm sm:rounded-lg p-2">
                @foreach ($data_visi as $visi)
                    <div class="w-full h-auto border border-black flex flex-row p-4 bg-white rounded-lg">
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
                        <div class="w-1/4 h-auto py-2 px-4 font-bold">
                            <p>Berlaku Sampai <br> {{ $visi->berlaku_sampai }}</p>
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

                // Jika ada form induk → submit form
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
