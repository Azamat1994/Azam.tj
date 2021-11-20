<x-guest-layout>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-5 col-xl-4 my-5">

                <!-- Heading -->
                <h1 class="display-4 text-center mb-3">
                    Sign up
                </h1>

                <!-- Subheading -->
                <p class="text-muted text-center mb-5">
                    Free access to our dashboard.
                </p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <x-jet-label for="name" value="{{ __('Name') }}"/>
                        <x-jet-input id="name" class="form-control" type="text" name="name" :value="old('name')"
                                     required autofocus autocomplete="name"/>
                    </div>

                    <div class="form-group">
                        <x-jet-label for="email" value="{{ __('Email') }}"/>
                        <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')"
                                     required/>
                    </div>

                    <div class="form-group">
                        <x-jet-label for="password" value="{{ __('Password') }}"/>
                        <x-jet-input id="password" class="form-control form-control-appended" type="password"
                                     name="password" required autocomplete="new-password"/>
                    </div>

                    <div class="form-group">
                        <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}"/>
                        <x-jet-input id="password_confirmation" class="form-control form-control-appended"
                                     type="password" name="password_confirmation" required autocomplete="new-password"/>
                    </div>

                    <x-jet-button class="btn btn-lg btn-block btn-primary mb-3">
                        {{ __('Sign up') }}
                    </x-jet-button>

                    <div class="text-center">
                        <small class="text-muted text-center">
                            Already have an account? <a href="{{ route('login') }}">Log in</a>.
                        </small>


                    </div>
                </form>

            </div>
        </div> <!-- / .row -->
    </div>
</x-guest-layout>


{{--<x-guest-layout>--}}
{{--    <x-jet-authentication-card>--}}
{{--        <x-slot name="logo">--}}
{{--            <x-jet-authentication-card-logo />--}}
{{--        </x-slot>--}}

{{--        <x-jet-validation-errors class="mb-4" />--}}

{{--        <form method="POST" action="{{ route('register') }}">--}}
{{--            @csrf--}}

{{--            <div>--}}
{{--                <x-jet-label for="name" value="{{ __('Name') }}" />--}}
{{--                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />--}}
{{--            </div>--}}

{{--            <div class="mt-4">--}}
{{--                <x-jet-label for="email" value="{{ __('Email') }}" />--}}
{{--                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />--}}
{{--            </div>--}}

{{--            <div class="mt-4">--}}
{{--                <x-jet-label for="password" value="{{ __('Password') }}" />--}}
{{--                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />--}}
{{--            </div>--}}

{{--            <div class="mt-4">--}}
{{--                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />--}}
{{--                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />--}}
{{--            </div>--}}

{{--            <div class="flex items-center justify-end mt-4">--}}
{{--                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">--}}
{{--                    {{ __('Already registered?') }}--}}
{{--                </a>--}}

{{--                <x-jet-button class="ml-4">--}}
{{--                    {{ __('Register') }}--}}
{{--                </x-jet-button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </x-jet-authentication-card>--}}
{{--</x-guest-layout>--}}
