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
                                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                            </div>
                            
                            <h4 class="margin-bottom-1x text-center">Confirm password</h4>
                            <form class="row" action="{{ route('password.confirm') }}" method="POST">
                                @csrf  
                                
                                <!-- Email Address -->
                                <div class="col-sm-12">
                                    <x-input-label for="password" :value="__('Password')" />

                                    <x-text-input id="password" class="form-control"
                                                    type="password"
                                                    name="password"
                                                    required autocomplete="current-password" />

                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                
                                <div class="mt-4 col-12 text-center">
                                    <x-primary-button class="btn btn-info margin-bottom-none">
                                        {{ __('Confirm') }}
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
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
