@include('layouts.navigation')
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('userStore') }}">
            @csrf

            <!-- userName -->
            <div>
                <x-input-label for="username" :value="__('Username')" />

                <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                    required autofocus />

                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <!-- Full Name -->
            <div>
                <x-input-label for="name" :value="__('Fullname')" />

                <x-text-input id="name" class="block mt-1 w-full" type="text" name="fullname" :value="old('fullname')"
                    required autofocus />

                <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            {{-- Alamat --}}
            <div>
                <x-input-label for="address" :value="__('Alamat')" />

                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"
                    required autofocus />

                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            {{-- birthdate --}}
            <div>
                <x-input-label for="birthdate" :value="__('Tanggal Lahir')" />

                <x-text-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate"
                    :value="old('birthdate')" required autofocus />

                <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
            </div>

            {{-- phone number --}}
            <div>
                <x-input-label for="phonenumber" :value="__('No Telepon')" />

                <x-text-input id="phonenumber" class="block mt-1 w-full" type="text" name="phonenumber"
                    :value="old('phonenumber')" required autofocus />

                <x-input-error :messages="$errors->get('phonenumber')" class="mt-2" />
            </div>

            {{-- agama --}}
            <div>
                <x-input-label for="agama" :value="__('Agama')" />

                <x-text-input id="agama" class="block mt-1 w-full" type="text" name="agama" :value="old('agama')"
                    required autofocus />

                <x-input-error :messages="$errors->get('agama')" class="mt-2" />
            </div>

            {{-- gender --}}
            <div>
                <x-input-label for="gender" :value="__('Jenis Kelamin')" />
                <span>
                    <input type="radio" name="gender" id="male" value="1">
                    <label for="male">Laki-laki</label>
                </span>
                <span>
                    <input type="radio" name="gender" id="female" value="0">
                    <label for="female">Perempuan</label>
                </span>

                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Tambah user') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
