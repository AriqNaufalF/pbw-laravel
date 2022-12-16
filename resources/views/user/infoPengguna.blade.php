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
                    <form method="POST" action="{{ route('userUpdate', $user->id) }}">
                        @csrf

                        <!-- userName -->
                        <div>
                            <x-input-label for="username" :value="__('Username')" />

                            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username"
                                value="{{ $user->username }}" readonly />

                        </div>

                        <!-- Full Name -->
                        <div>
                            <x-input-label for="name" :value="__('Fullname')" />

                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="fullname"
                                value="{{ $user->fullname }}" required />

                            <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />

                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                value="{{ $user->email }}" readonly />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        {{-- Alamat --}}
                        <div>
                            <x-input-label for="address" :value="__('Alamat')" />

                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                                value="{{ $user->address }}" required autofocus />

                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        {{-- birthdate --}}
                        <div>
                            <x-input-label for="birthdate" :value="__('Tanggal Lahir')" />

                            <x-text-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate"
                                :value="$user->birthdate" required autofocus />
                        </div>

                        {{-- phone number --}}
                        <div>
                            <x-input-label for="phonenumber" :value="__('No Telepon')" />

                            <x-text-input id="phonenumber" class="block mt-1 w-full" type="text" name="phonenumber"
                                :value="$user->phonenumber" required autofocus />

                            <x-input-error :messages="$errors->get('phonenumber')" class="mt-2" />
                        </div>

                        {{-- agama --}}
                        <div>
                            <x-input-label for="agama" :value="__('Agama')" />

                            <x-text-input id="agama" class="block mt-1 w-full" type="text" name="agama"
                                :value="$user->agama" required autofocus />

                            <x-input-error :messages="$errors->get('agama')" class="mt-2" />
                        </div>

                        {{-- gender --}}
                        <div>
                            <x-input-label for="gender" :value="__('Jenis Kelamin')" />
                            <span>
                                <input type="radio" name="gender" id="male" value="1"
                                    {{ $user->gender == 1 ? 'checked' : 'disabled' }}>
                                <label for="male">Laki-laki</label>
                            </span>
                            <span>
                                <input type="radio" name="gender" id="female" value="0"
                                    {{ $user->gender == 2 ? 'checked' : 'disabled' }}>
                                <label for="female">Perempuan</label>
                            </span>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Update user') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
