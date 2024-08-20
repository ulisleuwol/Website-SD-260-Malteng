<x-guest.app-layout title="PPDB">
    @push('link')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    @endpush
    <main id="main">
        {{-- start heading --}}
        <x-guest.heading title="PPDB" linkText="PPDB" content="Sekolah Dasar Negeri 260 Maluku Tengah" />
        {{-- End heading --}}

        <section class="blog kegiatan">
            <div class="container" data-aos="fade-up">
                <div class="row g-5">

                    <!-- ======= Content Section ======= -->
                    <div class="col-lg-12">
                        <article class="article-bg pb-5 overflow-hidden">
                            <div class="d-flex justify-content-center">
                                @if ($ppdb->count() == 0)
                                <img src="{{ asset('assets/img/not-data.png') }}" class="img-fluid mt-5"
                                    style="max-width: 40%" alt="no data" loading="lazy" />
                            </div>
                            @else
                            @foreach ($ppdb as $data)
                            <div class="kegiatan-show">
                                <div class="image text-center">
                                    <a href="{{ asset('storage/' . $data->image)  }}" data-fancybox="ppdb"
                                        data-caption="{{ $data->name }}">
                                        <img src="{{ asset('storage/' . $data->image) }}" class="ppdb-photo card-img"
                                            alt="{{ $data->name }}" loading="lazy">
                                    </a>
                                </div>

                                <div class="card-body px-4">
                                    <div class="pt-2 mt-2">
                                        <span class="small text-muted me-4"><i
                                                class="icons bi bi-person-circle me-2"></i>Oleh : {{
                                            $data->user->name
                                            }}</span>
                                        <span class=" text-muted small"><i
                                                class="icons me-2 bi bi-calendar-check"></i>Tanggal
                                            Posting
                                            :
                                            {{ (new \Carbon\Carbon($data->updated_at))->format('d F Y')
                                            }}</span>
                                    </div>
                                    <div class="pt-3 border-bottom border-1 border-black">
                                        <h2 class="fw-semibold pt-3">{{ $data->name }}</h2>
                                    </div>
                                    <p class="mt-2 deskripsi-kegiatan">{!! $data->deskripsi !!}</p>

                                </div>
                            </div>
                            @endforeach
                            @endif
                        </article>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
    @push('script')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    @endpush
</x-guest.app-layout>