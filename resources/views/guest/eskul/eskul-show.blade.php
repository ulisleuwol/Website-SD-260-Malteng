<x-guest.app-layout title="Ekstrakurikuler - {{ $eskul->eskul }}">
    <main id="main">

        {{-- start heading --}}
        <x-guest.heading title="Ekstrakurikuler" link="{{ url('/eskul-sekolah') }}" linkText="Ekstrakurikuler"
            content="{{ $eskul->eskul }}" show="{{ $eskul->eskul }}" />
        {{-- End heading --}}

        <section class="blog">
            <div class="container" data-aos="fade-up">

                <div class="row g-5">
                    <!-- ======= Content Section ======= -->
                    <div class="col-lg-8 eskul-show">
                        <article class="article-bg pb-5">
                            <img src="{{ asset('storage/' . $eskul->image) }}" alt="{{ $eskul->eskul }}"
                                class="card-img-top" loading="lazy">

                            <div class="card-body px-4">

                                <div class="pt-2 mt-2 pb-3">
                                    <span class="small text-muted me-4"><i
                                            class="bi bi-person-circle icons me-2"></i>Oleh : {{
                                        $eskul->user->name
                                        }}</span>
                                    <span class=" text-muted small"><i
                                            class="icons me-2 bi bi-calendar-check"></i>Tanggal Posting
                                        :
                                        {{ (new \Carbon\Carbon($eskul->created_at))->format('d F, Y')
                                        }}</span>
                                </div>

                                <p class="pt-4 small text-muted">
                                    <i class="text-primary bi bi-info-circle-fill me-2"></i>Tujuan Ekstrakurikuler
                                </p>
                                <p class="text-secondary text-muted mx-4">{!! $eskul->deskripsi !!}</p>
                                <div class="row mt-4 pt-3 m-2 border-top">
                                    <div class="col-md-4">
                                        <strong><i class="icons me-2 bi bi-calendar"></i>Hari</strong>
                                        <p class="small ms-4">{{ $eskul->hari }}</p>
                                    </div>
                                    <div class="pb-3 col-md-4">
                                        <strong><i class="icons me-2 bi bi-person"></i>Pendamping</strong>
                                        <p class="small ms-4">{{ $eskul->pendamping }}</p>
                                    </div>
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
</x-guest.app-layout>