<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('transaksiStore') }}">
                        @csrf
                        <!-- Peminjam -->
                        <div>
                            <x-input-label for="userPeminjam" :value="__('Peminjam')" />

                            <select name="idPeminjam" id="userPeminjam"
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                                <option selected>Pilih dahulu</option>
                                @foreach ($users as $user)
                                    @if ($user->id == old('idPeminjam'))
                                        <option value="{{ $user->id }}" selected>{{ $user->fullname }}</option>
                                    @else
                                        <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                                    @endif
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('userPeminjam')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="koleksi1" :value="__('Nama Koleksi 1')" />

                            <select name="koleksi1" id="koleksi2"
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                                <option selected>Pilih dahulu</option>
                                @foreach ($collections as $collection)
                                    @if ($collection->id == old('koleksi1'))
                                        <option value="{{ $collection->id }}" selected>{{ $collection->namaKoleksi }}
                                        </option>
                                    @else
                                        <option value="{{ $collection->id }}">{{ $collection->namaKoleksi }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('koleksi1')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="koleksi2" :value="__('Nama Koleksi 2')" />

                            <select name="koleksi2" id="koleksi2"
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                                <option selected>Pilih dahulu</option>
                                @foreach ($collections as $collection)
                                    @if ($collection->id == old('koleksi2'))
                                        <option value="{{ $collection->id }}" selected>{{ $collection->namaKoleksi }}
                                        </option>
                                    @else
                                        <option value="{{ $collection->id }}">{{ $collection->namaKoleksi }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('koleksi2')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="koleksi3" :value="__('Nama Koleksi 3')" />

                            <select name="koleksi3" id="koleksi3"
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                                <option selected>Pilih dahulu</option>
                                @foreach ($collections as $collection)
                                    @if ($collection->id == old('koleksi3'))
                                        <option value="{{ $collection->id }}" selected>{{ $collection->namaKoleksi }}
                                        </option>
                                    @else
                                        <option value="{{ $collection->id }}">{{ $collection->namaKoleksi }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('koleksi3')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4" type="submit">
                                {{ __('Tambah Transaksi') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
