<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('¡Gracias! por registrarte con nosotros, antes de comenzar cosas maravillosas necesitas un ultimo paso que 
        es verificar tu correo por temas de seguridas dale al boton aqui abajo y sigue las instrucciones que se envian a tu 
        correo.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Hemos enviado un correo de confirmacion al correo que registraste anteriormente, revisa tu bandeja o spam') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Enviar correo de confirmacion') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Cerrar sesion') }}
            </button>
        </form>
    </div>
</x-guest-layout>