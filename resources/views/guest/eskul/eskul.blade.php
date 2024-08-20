<x-guest.app-layout title="Ekstrakurikuler">
    <main id="main">

        {{-- start heading --}}
        <x-guest.heading title="Ekstrakurikuler" linkText="Ekstrakurikuler"
            content="Sekolah Dasar Negeri 260 Maluku Tengah" />
        {{-- End heading --}}

        <section class="blog eskul">
            <div class="container" data-aos="fade-up">

                    <!-- ======= Content Section ======= -->
                    
                        <div class="row gy-4">
                                {{-- eskul terbaru --}}
                                @if ($eskul->count() == 0)
                                <img src="{{ asset('assets/img/not-data.png') }}" class="img-fluid m-auto"
                                    style="max-width: 40%" alt="no data" loading="lazy">
                                @else
                                @foreach ($eskul as $data)
                                <div class="col-md-3">
                                    <a href="{{ route('eskul-sekolah-show', $data->slug) }}">
                                        <article class="eskul-item">
                                            <div class="eskul-img">
                                                <span class="badge badge-eskul"><i
                                                        class="bi bi-universal-access-circle"></i> Eskul</span>
                                                <img src="{{ asset('storage/' . $data->image) }}"
                                                    alt="{{ $data->eskul }}" class="img" loading="lazy">
                                            </div>

                                            <h2 class="title text-center pt-3">
                                                {{ $data->eskul }}
                                            </h2>
                                        </article>
                                    </a>
                                </div>
                
                            <!-- End post list item -->
                            @endforeach
                            @endif

                            <!-- End post list item -->
                        </div>
                        <div class="d-flex justify-content-center mt-4">

                            {{ $eskul->onEachSide(0) }}

                        </div><!-- End pagination -->
                    </div>
                    {{-- end content section --}}

     
        </section>

    </main><!-- End #main -->
</x-guest.app-layout>