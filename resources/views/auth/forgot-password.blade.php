<x-guest-layout >
    <!--<div class="min-h-screen flex flex-col justify-center items-center bg-cover bg-center" style="background-image: url('/images/fondo.png')"> -->
        <div class="w-full max-w-md bg-white/80 backdrop-blur-md p-6 rounded-xl shadow-lg" >

            <h2 class="text-2xl font-bold text-center text-primary mb-4">¿Olvidaste tu contraseña?</h2>

            <p class="text-sm text-gray-700 mb-4 text-center">
                No te preocupes. Ingresa tu correo electrónico registrado y te enviaremos un enlace para restablecer tu contraseña.
            </p>

            <!-- Estado de sesión -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Dirección de correo -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Correo Electrónico')" />
                    <x-text-input
                        id="email"
                        class="block mt-1 w-full"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Botón -->
                <div class="flex justify-end mt-6">
                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition duration-200"
                    >
                        Enviar enlace de restablecimiento
                    </button>
                </div>
            </form>
        </div>
    <!-- </div> -->
</x-guest-layout>
