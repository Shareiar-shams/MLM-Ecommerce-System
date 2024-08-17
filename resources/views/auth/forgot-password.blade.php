@extends('user.layouts.layout')
@section('user_title_content')
    Ahknoxo | Registation
@endsection
@section('user_css_content')
@endsection
@section('user_main_content')
    <section class="login_section section-padding">
        <div class="container">
            <div class="row bg_login">
                <div class="col-md-12">
                    <div class="card register-area">
                        <div class="card-body ">
                            <div class="mb-4 text-sm text-gray-600">
                                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                            </div>
                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                            <h4 class="margin-bottom-1x text-center">Forgot password</h4>
                            <form class="row" action="{{ route('password.email') }}" method="POST">
                                @csrf  
                                
                                <!-- Email Address -->
                                <div class="col-sm-12">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                
                                <div class="mt-4 col-12 text-center">
                                    <x-primary-button class="btn btn-info margin-bottom-none">
                                        {{ __('Email Password Reset Link') }}
                                    </x-primary-button>
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
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
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

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
