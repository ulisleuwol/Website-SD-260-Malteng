<x-guest.app-layout>
    <section class="section-login min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                    <!-- Session Status -->
                    @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to the email address you provided during
                        registration.') }}
                    </div>
                    @endif

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Verify Your Email</h5>
                                <p class="text-center small">
                                    {{ __('Thanks for signing up! Before getting started, could you verify your email
                                    address by clicking on the link we just emailed to you? If you didn\'t receive the
                                    email, we will gladly send you another.') }}
                                </p>
                            </div>

                            <div class="mt-4 d-flex align-items-center justify-content-between">
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf

                                    <div>
                                        <x-primary-button class="btn btn-primary">
                                            {{ __('Resend Verification Email') }}
                                        </x-primary-button>
                                    </div>
                                </form>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <button type="submit" class="btn btn-link text-sm text-primary">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest.app-layout>