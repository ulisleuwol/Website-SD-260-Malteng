<x-guest.app-layout>
    <section class="section-login min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">


                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Reset Password</h5>
                                <p class="text-center small">
                                    {{ __('Masukan alamat email Anda yang di daftarkan di akun Anda
                                    dan kami akan mengirimkan tautan pengaturan ulang kata sandi melalui email yang
                                    memungkinkan Anda memilih kata sandi baru.') }}
                                </p>
                            </div>

                            <form method="POST" action="{{ route('password.email') }}" class="row g-3 needs-validation">
                                @csrf

                                <!-- Email Address -->
                                <div class="col-12">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <x-text-input id="email" class="form-control" type="email" name="email"
                                            :value="old('email')" required autofocus />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger d-block" />
                                    </div>
                                </div>

                                <div class="col-12 d-flex align-items-center justify-content-end">
                                    <x-primary-button class="btn btn-primary">
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
</x-guest.app-layout>