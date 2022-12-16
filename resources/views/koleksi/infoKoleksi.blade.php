<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('koleksiUpdate', $collection->id) }}" method="POST">
                        @csrf
                        <!-- Id -->
                        <div>
                            <x-input-label for="id" :value="__('ID koleksi')" />

                            <x-text-input id="id" class="block mt-1 w-full" type="text" name="id"
                                value="{{ $collection->id }}" readonly />
                        </div>

                        <!-- Nama koleksi -->
                        <div>
                            <x-input-label for="namaKoleksi" :value="__('Nama Koleksi')" />

                            <x-text-input id="namaKoleksi" class="block mt-1 w-full" type="text" name="namaKoleksi"
                                value="{{ $collection->namaKoleksi }}" required readonly />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="jenisKoleksi" :value="__('Jenis Koleksi')" />
                            <select name="jenisKoleksi" id="jenisKoleksi"
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                                readonly>
                                <option value="1" {{ $collection->jenisKoleksi == 1 ? 'selected' : '' }}>Buku
                                </option>
                                <option value="2" {{ $collection->jenisKoleksi == 2 ? 'selected' : '' }}>Majalah
                                </option>
                                <option value="3" {{ $collection->jenisKoleksi == 3 ? 'selected' : '' }}>Cakram
                                    digital</option>
                            </select>
                        </div>
                        {{-- Jumlah Awal --}}
                        <div class="mt-4">
                            <x-input-label for="jumlahAwal" :value="__('Jumlah Awal')" />

                            <x-text-input id="jumlahAwal" class="block mt-1 w-full" type="text" name="jumlahAwal"
                                value="{{ $collection->jumlahAwal }}" readonly />

                            <x-input-error :messages="$errors->get('jumlahAwal')" class="mt-2" />
                        </div>
                        {{-- Jumlah Sisa --}}
                        <div class="mt-4">
                            <x-input-label for="jumlahSisa" :value="__('Jumlah Sisa')" />

                            <x-text-input id="jumlahSisa" class="block mt-1 w-full" type="text" name="jumlahSisa"
                                value="{{ $collection->jumlahSisa }}" required />

                            <x-input-error :messages="$errors->get('jumlahSisa')" class="mt-2" />
                        </div>
                        {{-- Jumlah Keluar --}}
                        <div class="mt-4">
                            <x-input-label for="jumlahKeluar" :value="__('Jumlah Keluar')" />

                            <x-text-input id="jumlahKeluar" class="block mt-1 w-full" type="text" name="jumlahKeluar"
                                value="{{ $collection->jumlahKeluar }}" required />

                            <x-input-error :messages="$errors->get('jumlahKeluar')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Edit') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
