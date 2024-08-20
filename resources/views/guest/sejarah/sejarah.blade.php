<x-guest.app-layout title="Sejarah">
    <main id="main">

        {{-- start heading --}}
        <x-guest.heading title="Sejarah" linkText="Sejarah" content="Sekolah Dasar Negeri 260 Maluku Tengah" />
        {{-- End heading --}}

        <section class="blog sejarah">
            <div class="container" data-aos="fade-up">

                <div class="row g-5">
                    <!-- ======= Content Section ======= -->
                    <div class="col-lg-12">
                        <article class="article-bg pb-5">
                            <img src="{{ asset('storage/'. $sejarah->image) }}" class="card-img-top"
                                alt="{{ $sejarah->title }}" loading="lazy">
                            <div class="card-body px-4">
                                <div class="pt-2 mt-2">
                                    <span class="small text-muted me-4"><i
                                            class="bi bi-person-circle icons me-2"></i>Oleh : {{
                                        $sejarah->user->name
                                        }}</span>
                                    <span class=" text-muted small"><i
                                            class="icons me-2 bi bi-calendar-check"></i>Tanggal Posting
                                        :
                                        {{ (new \Carbon\Carbon($sejarah->created_at))->format('d F, Y')
                                        }}</span>
                                    <!-- Tambahkan elemen deskripsi dengan kelas deskripsi-sejarah -->
                                    <div class="deskripsi-sejarah pt-4">
                                        {!! $sejarah->deskripsi !!}
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>

            </div>
        </section>

    </main><!-- End #main -->
</x-guest.app-layout>