<x-guest-layout>


    {{--    @if (Auth::check())--}}
    {{--        <script>alert('1')</script>--}}
    {{--    @else--}}
    {{--        <script>alert('0')</script>--}}
    {{--    @endif--}}


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-5 col-xl-4 my-5">

                <!-- Heading -->
                <h1 class="display-4 text-center mb-3">
                    Вход
                </h1>

                <!-- Subheading -->
                <p class="text-muted text-center mb-5">
                    Введите свою эл.почту и пароль
                </p>


                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        236482398358346584365876
                        {{ session('status') }}
                    </div>
                @endif




            <!-- Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <x-jet-label for="email" value="{{ __('Email') }}"/>
                        <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')" placeholder="name@address.com"
                                     required autofocus/>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">

                                <!-- Label -->
                                <x-jet-label for="password" value="{{ __('Password') }}"/>

                            </div>

                            <div class="col-auto">
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                       href="{{ route('password.request') }}">
                                        {{ __('Forgot password?') }}
                                    </a>
                                @endif


                            </div>
                        </div>

                        <x-jet-input id="password" class="form-control form-control-appended"  placeholder="Enter your password" type="password"
                                     name="password" required
                                     autocomplete="current-password"/>








                    </div>


                    <x-jet-button class="btn btn-lg btn-block btn-primary mb-3">
                        {{ __('Sign in') }}
                    </x-jet-button>

                    <div class="text-center">
                        <small class="text-muted text-center">
                            Don't have an account yet? <a href="{{ route('register') }}">Sign up</a>.
                        </small>


                    </div>

                </form>


                {{--            <form>--}}

                {{--                <!-- Email address -->--}}
                {{--                <div class="form-group">--}}

                {{--                    <!-- Label -->--}}
                {{--                    <label>Email Address</label>--}}

                {{--                    <!-- Input -->--}}
                {{--                    <input type="email" class="form-control" placeholder="name@address.com">--}}

                {{--                </div>--}}

                {{--                <!-- Password -->--}}
                {{--                <div class="form-group">--}}

                {{--                    <div class="row">--}}
                {{--                        <div class="col">--}}

                {{--                            <!-- Label -->--}}
                {{--                            <label>Password</label>--}}

                {{--                        </div>--}}
                {{--                        <div class="col-auto">--}}

                {{--                            <!-- Help text -->--}}
                {{--                            <a href="password-reset.html" class="form-text small text-muted">--}}
                {{--                                Forgot password?--}}
                {{--                            </a>--}}

                {{--                        </div>--}}
                {{--                    </div> <!-- / .row -->--}}

                {{--                    <!-- Input group -->--}}
                {{--                    <div class="input-group input-group-merge">--}}

                {{--                        <!-- Input -->--}}
                {{--                        <input type="password" class="form-control form-control-appended" placeholder="Enter your password">--}}

                {{--                        <!-- Icon -->--}}
                {{--                        <div class="input-group-append">--}}
                {{--                  <span class="input-group-text">--}}
                {{--                    <i class="fe fe-eye"></i>--}}
                {{--                  </span>--}}
                {{--                        </div>--}}

                {{--                    </div>--}}
                {{--                </div>--}}

                {{--                <!-- Submit -->--}}
                {{--                <button class="btn btn-lg btn-block btn-primary mb-3">--}}
                {{--                    Sign in--}}
                {{--                </button>--}}

                {{--                <!-- Link -->--}}
                {{--                <div class="text-center">--}}
                {{--                    <small class="text-muted text-center">--}}
                {{--                        Don't have an account yet? <a href="sign-up.html">Sign up</a>.--}}
                {{--                    </small>--}}
                {{--                </div>--}}

                {{--            </form>--}}

            </div>
        </div> <!-- / .row -->
    </div>
</x-guest-layout>


{{--    <x-jet-authentication-card>--}}
{{--        <x-slot name="logo">--}}
{{--            <x-jet-authentication-card-logo />--}}
{{--        </x-slot>--}}

{{--        <x-jet-validation-errors class="mb-4" />--}}


{{--    </x-jet-authentication-card>--}}
{{--</x-guest-layout>--}}
