<x-guest.app-layout>
    <section class="section-login min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                    <!-- Session Status -->
                    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('This is a secure area of the application. Please confirm your password before
                        continuing.') }}
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Confirm Password</h5>
                            </div>

                            <form method="POST" action="{{ route('password.confirm') }}">
                                @csrf

                                <!-- Password -->
                                <div class="mb-3">
                                    <x-input-label for="password" :value="__('Password')" />
                                    <x-text-input id="password" class="form-control" type="password" name="password"
                                        required autocomplete="current-password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <x-primary-button class="btn btn-primary">
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
</x-guest.app-layout>