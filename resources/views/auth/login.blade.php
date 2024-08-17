@extends('user.layouts.layout')
@section('user_title_content')
    Ahknoxo | Login
@endsection
@section('user_css_content')
@endsection
@section('user_main_content')
    <section class="login_section section-padding">
        <div class="container">
            <div class="row" style="display: flex; justify-content: center; align-items: center;">
                <div class="col-md-6">
                    <form class="card" method="post" action="{{ route('login') }}">
                        @csrf          
                        <div class="card-body ">
                            <h4 class="margin-bottom-1x text-center">Login</h4>
                            
                            <!-- Email Address -->
                            <div class="form-group input-group">
                                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" placeholder="Email" required autofocus autocomplete="username" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />

                            <!-- Password -->
                            <div class="form-group input-group">

                                <x-text-input id="password" class="form-control" type="password" name="password" placeholder="Password" required autocomplete="current-password" />

                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            <!-- Remember Me -->
                            <div class="d-flex flex-wrap justify-content-between padding-bottom-1x">
                                <div class="custom-control custom-checkbox">
                                    <input id="remember_me" type="checkbox" class="custom-control-input" name="remember">
                                    <label for="remember_me" class="custom-control-label"><span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="navi-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="text-center">
                                <x-primary-button class="btn btn-info margin-bottom-none">
                                    {{ __('Log in') }}
                                </x-primary-button>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-center mt-3">
                                    <a class="facebook-btn mr-2" href="{{ route('socialite.auth', 'facebook') }}">Facebook login
                                    </a>
                                    <a class="google-btn" href="{{ route('socialite.auth', 'google') }}"> Google login
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 text-center mt-3">
                                    <small>Didn't have an account yet?</small>
                                    <br>
                                    <u><a href="{{route('register')}}" title="sign up" style="color: #5E524F;">Create an account</a></u>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- <div class="col-md-6">
                    <div class="card register-area">
                        <div class="card-body ">
                            <h4 class="margin-bottom-1x text-center">Register</h4>
                            <form class="row" action="{{ route('register') }}" method="POST">
                                @csrf  
                                <!-- Name -->
                                <div class="col-sm-6 mt-1">
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div> 
                                <!-- User Name -->
                                <div class="col-sm-6 mt-1">
                                    <x-input-label for="username" :value="__('User Name')" />
                                    <x-text-input id="username" class="form-control" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <!-- Email Address -->
                                <div class="col-sm-6 mt-1">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Phone Number -->
                                <div class="col-sm-6 mt-1">
                                    <x-input-label for="phone" :value="__('Phone')" />
                                    <x-text-input id="phone" class="form-control" type="text" name="phone" :value="old('phone')" required autocomplete="phone" />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>
                                <!-- Password -->
                                <div class="col-sm-6 mt-1">
                                    <x-input-label for="password" :value="__('Password')" />

                                    <x-text-input id="password" class="form-control"
                                                    type="password"
                                                    name="password"
                                                    required autocomplete="new-password" />

                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-sm-6 mt-1">
                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                    <x-text-input id="password_confirmation" class="form-control"
                                                    type="password"
                                                    name="password_confirmation" required autocomplete="new-password" />

                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                                <div class="col-lg-12 mb-4 mt-4">
                                    <script src="https://www.google.com/recaptcha/api.js?" async="" defer=""></script>
                                    <div data-sitekey="6LcnPoEaAAAAAF6QhKPZ8V4744yiEnr41li3SYDn" class="g-recaptcha">
                                        <div style="width: 304px; height: 78px;">
                                            <div>
                                                <iframe title="reCAPTCHA" src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6LcnPoEaAAAAAF6QhKPZ8V4744yiEnr41li3SYDn&amp;co=aHR0cHM6Ly9nZW5pdXNkZXZzLmNvbTo0NDM.&amp;hl=en&amp;v=khH7Ei3klcvfRI74FvDcfuOo&amp;size=normal&amp;cb=cb3odnc0d9mg" width="304" height="78" role="presentation" name="a-s1fuany32hmp" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe>
                                            </div>

                                            <textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea>
                                        </div>
                                        <iframe style="display: none;"></iframe>
                                    </div>
                                </div>
                                <div class="col-12 mt-4 text-center">

                                    <x-primary-button class="btn btn-info margin-bottom-none">
                                        {{ __('Register') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
@endsection

@section('user_js_content')
@endsection


{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
 --}}