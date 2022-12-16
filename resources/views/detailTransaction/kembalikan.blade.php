<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kembalikan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('updateDetailTransaksi', $detailTransaction->id) }}">
                        @csrf
                        {{-- Transaksi --}}
                        <div>
                            <x-input-label for="idTransaksi" :value="__('ID Transaksi')" />
                            <x-text-input id="idTransaksi" class="block mt-1 w-full" type="text" name="idTransaksi"
                                :value="$detailTransaction->idTransaksi" readonly />
                        </div>
                        {{-- Detail Transaksi --}}
                        <div class="mt-4">
                            <x-input-label for="idDetailTransaksi" :value="__('ID Detail Transaksi')" />
                            <x-text-input id="idDetailTransaksi" class="block mt-1 w-full" type="text"
                                name="idDetailTransaksi" :value="$detailTransaction->id" readonly />
                        </div>
                        {{-- Peminjam --}}
                        <div class="mt-4">
                            <x-input-label for="peminjam" :value="__('Peminjam')" />
                            <x-text-input id="peminjam" class="block mt-1 w-full" type="text" name="peminjam"
                                :value="$detailTransaction->namaPeminjam" readonly disabled />
                        </div>
                        {{-- Petugas --}}
                        <div class="mt-4">
                            <x-input-label for="petugas" :value="__('Petugas')" />
                            <x-text-input id="petugas" class="block mt-1 w-full" type="text" name="petugas"
                                :value="$detailTransaction->namaPetugas" readonly disabled />
                        </div>
                        {{-- Koleksi --}}
                        <div class="mt-4">
                            <x-input-label for="koleksi" :value="__('Koleksi')" />
                            <x-text-input id="koleksi" class="block mt-1 w-full" type="text" name="koleksi"
                                :value="$detailTransaction->koleksi" readonly disabled />
                        </div>
                        {{-- Status --}}
                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Status')" />

                            <select name="status" id="status"
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                                <option value="1" @if (old('status', $detailTransaction->status) == 1) selected @endif>Pinjam</option>
                                <option value="2" @if (old('status', $detailTransaction->status) == 2) selected @endif>Kembali
                                </option>
                                <option value="3" @if (old('status', $detailTransaction->status) == 3) selected @endif>Hilang</option>
                            </select>

                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4" type="submit">
                                {{ __('Edit') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
