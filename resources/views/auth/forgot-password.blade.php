<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('¿Olvidaste tu clave?, ingresa el correo con el que te registraste y enviaremos un codigo para reestablecerla') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="flex justify-between my-5">
            <x-link 
                :href="route('login')">Login </x-link>
            <x-link 
                :href="route('register')"
            >Register </x-link>
        </div>
        <x-primary-button class="w-full justify-center">
            {{ __('enviar codigo') }}
        </x-primary-button>
    </form>
</x-guest-layout>
