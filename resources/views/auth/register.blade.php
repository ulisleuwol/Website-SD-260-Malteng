<x-guest.app-layout>
    <section class="section-login min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-8 col-md-6 d-flex title flex-column align-items-center justify-content-center">
                    <h1 class="text-center fw-bold">{{ config('app.name') }}</h1>
            </div><!-- End Logo -->

                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                    <div class="card mb-3">
                        <div class="card-body shadow">
                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Registrasi Akun Anda</h5>
                                <p class="text-center small">Masukan Data Anda</p>
                            </div>

                            <form method="POST" action="{{ route('register') }}" class="row g-3 needs-validation">
                                @csrf

                                <!-- Name -->
                                <div class="col-12">
                                    <x-input-label for="name" :value="__('Name')" />
                                    <div class="input-group has-validation">
                                        <x-text-input id="name" class="form-control" type="text" name="name"
                                            :value="old('name')" required autofocus autocomplete="name" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                                    </div>
                                </div>

                                <!-- Email Address -->
                                <div class="col-12">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <x-text-input id="email" class="form-control" type="email" name="email"
                                            :value="old('email')" required autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="col-12">
                                    <x-input-label for="password" :value="__('Password')" />
                                    <div class="input-group has-validation">
                                        <x-text-input id="password" class="form-control" type="password" name="password"
                                            required autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-12">
                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                    <div class="input-group has-validation">
                                        <x-text-input id="password_confirmation" class="form-control" type="password"
                                            name="password_confirmation" required autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                                    </div>
                                </div>

                                <div class="col-12 d-flex align-items-center justify-content-between">
                                    <a class="text-primary" href="{{ route('login') }}">
                                        {{ __('Already registered?') }}
                                    </a>
                                    <x-primary-button class="btn btn-primary">
                                        {{ __('Register') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest.app-layout>