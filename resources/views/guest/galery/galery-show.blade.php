<x-guest.app-layout title="Galery Foto Show">
    @push('link')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    @endpush
    <main id="main">

        {{-- start heading --}}
        <x-guest.heading title="Galery Foto" link="{{ url('/galery-foto-sekolah') }}" linkText="Galery Foto"
            content="{{ $foto->judul }}" show="{{ $foto->judul }}" />
        {{-- End heading --}}

        <section class="blog galery-show">
            <div class="container" data-aos="fade-up">

                <div class="row g-5">
                    <!-- ======= Content Section ======= -->
                    <div class="col-lg-8">
                        <article class="article-bg pb-5">
                            <div class="row pt-4">
                                {{-- Tampilkan semua foto dari database yang berbentuk JSON --}}
                                @php
                                $images = json_decode($foto->image, true);
                                @endphp

                                @foreach ($images as $image)
                                <div class="col m-auto text-center">
                                    <a href="{{ asset('storage/' . $image)  }}" data-fancybox="gallery"
                                        data-caption="{{ $foto->judul }}">
                                        <img src="{{ asset('storage/' . $image) }}" class="gallery-photo"
                                            alt="{{ $foto->judul }}" loading="lazy">
                                    </a>
                                </div>
                                @endforeach
                            </div>
                            <div class="card-body px-4">
                                <p class="py-4 deskripsi-galery">{!! $foto->deskripsi !!}</p>
                                <div class="pt-3 border-top">
                                    <span class="small text-muted me-4"><i
                                            class="bi bi-person-circle icons me-2"></i>Oleh : {{
                                        $foto->user->name
                                        }}</span>
                                    <span class=" text-muted small"><i
                                            class="icons me-2 bi bi-calendar-check"></i>Tanggal Posting
                                        :
                                        {{ (new \Carbon\Carbon($foto->created_at))->format('d F, Y')
                                        }}</span>
                                </div>
                            </div>
                        </article>
                    </div>
                    {{-- sidebar start --}}
                    <div class="col-lg-4">
                        {{-- include sidebar / modal kegiatan --}}
                        <x-guest.sidebar :kegiatan="$kegiatan" :agenda="$agenda" :pengumuman="$pengumuman" />
                        {{-- include modal agenda --}}
                        @foreach ($agenda as $item)
                        <x-guest.modal :title="$item->title" :dateTime="$item->date_time"
                            :description="$item->description" :location="$item->location" type="agenda" :id="$item->id"
                            :author="$item->user->name" :created_at="$item->created_at" />
                        @endforeach

                        {{-- include modal pengumuman --}}
                        @foreach ($pengumuman as $item)
                        <x-guest.modal :title="$item->title" :description="$item->body" :created_at="$item->created_at"
                            type="announcement" :id="$item->id" :author="$item->user->name" />
                        @endforeach
                    </div>
                    {{-- sidebar end --}}
                </div>

            </div>
        </section>

    </main><!-- End #main -->
    @push('script')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    @endpush
</x-guest.app-layout>