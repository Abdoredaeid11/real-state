<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="'Account Type'" />
            <select id="role" name="role" class="block mt-1 w-full">
                <option value="user" {{ old('role') === 'broker' ? '' : 'selected' }}>User</option>
                <option value="broker" {{ old('role') === 'broker' ? 'selected' : '' }}>Broker</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Broker KYC -->
        <div id="broker-kyc" class="mt-4" style="{{ old('role') === 'broker' ? '' : 'display:none' }}">
            <h3 class="text-md font-semibold mb-2">Broker Verification</h3>
            <div class="mt-2">
                <x-input-label for="id_image" :value="'ID Image'" />
                <input id="id_image" type="file" name="id_image" class="block mt-1 w-full" accept="image/*">
                <x-input-error :messages="$errors->get('id_image')" class="mt-2" />
            </div>
            <div class="mt-2">
                <x-input-label for="selfie_image" :value="'Selfie with ID'" />
                <input id="selfie_image" type="file" name="selfie_image" class="block mt-1 w-full" accept="image/*">
                <x-input-error :messages="$errors->get('selfie_image')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <script>
        const roleSelect = document.getElementById('role');
        const brokerKyc = document.getElementById('broker-kyc');
        const idImage = document.getElementById('id_image');
        const selfieImage = document.getElementById('selfie_image');
        function toggleKyc(){
            if(roleSelect.value === 'broker'){
                brokerKyc.style.display = '';
                if(idImage) idImage.required = true;
                if(selfieImage) selfieImage.required = true;
            }else{
                brokerKyc.style.display = 'none';
                if(idImage) idImage.required = false;
                if(selfieImage) selfieImage.required = false;
            }
        }
        roleSelect.addEventListener('change', toggleKyc);
        toggleKyc();
    </script>
</x-guest-layout>
