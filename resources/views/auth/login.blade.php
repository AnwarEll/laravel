<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif

        <!-- 

        Captcha
        @if($errors -> any())
        <div>
            @foreach($errors -> all() as $error)
            <p>{{$error}}</p>
            @endforeach
        </div>
        @endif 
    
        -->


        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <!-- Captcha -->
            <div>
                <span id="captcha-img">
                    {!!captcha_img()!!}
                </span>
                <button id="reload">Reload</button>
            </div>

            <div>
                <input class="block mt-1 w-full" type="text" name="captcha" placeholder="Captcha">
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
        <script>
            $('#reload').click(function(e) {
                e.preventDefault();
                $.ajax({

                    type: 'GET',
                    url: 'reload',
                    success: function(res) {
                        $('#captcha-img').html(res.captcha);
                    }

                })

            });
        </script>
    </x-jet-authentication-card>
</x-guest-layout>