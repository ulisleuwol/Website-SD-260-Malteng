<x-guest.app-layout title="Prestasi">
    <main id="main">

        {{-- start heading --}}
        <x-guest.heading title="Prestasi" linkText="Prestasi" content="Sekolah Dasar Negeri 260 Maluku Tengah" />
        {{-- End heading --}}

        <section class="blog prestasi">
            <div class="container" data-aos="fade-up">

                <div class="row g-5">

                    {{-- search start --}}
                    <div class="col-lg-6 m-auto mt-5">
                        <x-guest.search />
                    </div>
                    {{-- search end --}}

                    <!-- ======= Content Section ======= -->
                    <div class="col-lg-12">
                        <div class="row gy-4">

                            {{-- prestasi terbaru --}}
                            @if ($prestasi->count() == 0)
                            <img src="{{ asset('assets/img/not-data.png') }}" class="img-fluid m-auto"
                                style="max-width: 40%" alt="no data">
                            @else
                            @foreach ($prestasi as $data)
                            <div class="col-md-4 ">
                                <div class="prestasi-item position-relative">
                                    <div class="image position-relative">
                                        <div class="card-img">
                                            {{-- kalau ada image --}}
                                            @if ($data->image != null)
                                            <img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->title }}"
                                                class="card-img" loading="lazy">
                                            @else
                                            <img src="{{ asset('guest/assets/img/prestasi-bg.svg') }}"
                                                alt="{{ $data->title }}" class="card-img" loading="lazy">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="content">
                                        <h3>{{ $data->title }}</h3>
                                        {{-- Buat description menjadi 50 kata --}}
                                        <p>{!! Str::limit(strip_tags($data->description), 100) !!}</p>
                                        <a href="{{ route('prestasi-ak-show', $data->slug) }}"
                                            class="readmore stretched-link"></a>
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted small mt-2"><i
                                                    class="icons me-2 bi bi-person-fill"></i> {{
                                                $data->user->name
                                                }}</span>
                                            <span class="text-muted small mt-2"><i
                                                    class="icons me-2 bi bi-calendar-check"></i> {{
                                                \Carbon\Carbon::parse($data->created_at)->isoFormat('D MMMM YYYY')
                                                }}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                            @endif

                            <!-- End post list item -->
                        </div>
                        <div class="float-end pt-4">

                            {{ $prestasi->onEachSide(0) }}

                        </div><!-- End pagination -->
                    </div>
                    {{-- end content section --}}
                </div>
            </div>
        </section>

    </main><!-- End #main -->
</x-guest.app-layout>