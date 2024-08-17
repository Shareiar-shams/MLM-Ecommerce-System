@extends('user.layouts.layout')
@section('user_title_content')
    Ahknoxo | Registation
@endsection
@section('user_css_content')
@endsection
@section('user_main_content')
    <section class="login_section section-padding">
        <div class="container">
            <div class="row" style="display: flex; justify-content: center; align-items: center;">
               
                <div class="col-md-6">
                    <div class="card register-area">
                        <div class="card-body ">
                            <h4 class="margin-bottom-1x text-center">Register</h4>
                            <form class="row" action="{{ route('register') }}" method="POST">
                                @csrf  
                                <!-- Name -->
                                <div class="col-sm-12">
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div> 
                                <!-- User Name -->
                                <div class="col-sm-12 mt-2">
                                    <x-input-label for="username" :value="__('User Name')" />
                                    <x-text-input id="username" class="form-control" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <!-- Email Address -->
                                <div class="col-sm-12 mt-2">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Phone Number -->
                                <div class="col-sm-12 mt-2">
                                    <x-input-label for="phone" :value="__('Phone')" />
                                    <x-text-input id="phone" class="form-control" type="text" name="phone" :value="old('phone')" required autocomplete="phone" />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>
                                <!-- Password -->
                                <div class="col-sm-12 mt-2">
                                    <x-input-label for="password" :value="__('Password')" />

                                    <x-text-input id="password" class="form-control"
                                                    type="password"
                                                    name="password"
                                                    required autocomplete="new-password" />

                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-sm-12 mt-2">
                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                    <x-text-input id="password_confirmation" class="form-control"
                                                    type="password"
                                                    name="password_confirmation" required autocomplete="new-password" />

                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                                {{-- <div class="col-lg-12 mb-4 mt-4">
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
                                </div> --}}
                                <div class="col-12 text-center mt-2">
                                    {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                        {{ __('Already registered?') }}
                                    </a> --}}

                                    <x-primary-button class="btn btn-info margin-bottom-none">
                                        {{ __('Register') }}
                                    </x-primary-button>
                                </div>
                                <div class="col-lg-12 text-center mt-3">
                                    <small>Already a user?</small>
                                    <u><a href="{{route('login')}}" title="sign up" style="color: #5E524F;">Login</a></u>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('user_js_content')
@endsection

{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="username" :value="__('User Name')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
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

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
 --}}