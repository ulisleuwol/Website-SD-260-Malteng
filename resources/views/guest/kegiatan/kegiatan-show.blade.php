<x-guest.app-layout title="Kegiatan - {{ $keg->title }}">
    <main id="main">

        {{-- start heading --}}
        <x-guest.heading title="Kegiatan" linkText="Kegiatan" content="{{ $keg->title }}"
            link="{{ url('/kegiatan-sekolah') }}" show="{{ $keg->title }}" />
        {{-- End heading --}}

        <section class="blog kegiatan">
            <div class="container" data-aos="fade-up">

                <div class="row g-5">

                    <!-- ======= Content Section ======= -->
                    <div class="col-lg-8">
                        <article class="article-bg pb-5">
                            <div class="row gy-4">

                                {{-- Kegiatan terbaru --}}
                                <div class="col-md-12">
                                    <div class="kegiatan-show">
                                        <div class="image text-center">
                                            {{-- kalau ada image --}}
                                            @if ($keg->image != null)
                                            <img src="{{ asset('storage/' . $keg->image) }}" alt="Kegiatan"
                                                class="card-img">
                                            @else
                                            <img src="{{ asset('guest/assets/img/keg-sekolah.svg') }}"
                                                alt="Kegiatan Sekolah" class="card-img">
                                            @endif
                                        </div>

                                        <div class="card-body px-4">
                                            <div class="pt-2 mt-2">
                                                <span class="small text-muted me-4"><i
                                                        class="bi bi-person-circle icons me-2"></i>Oleh : {{
                                                    $keg->user->name
                                                    }}</span>
                                                <span class=" text-muted small"><i
                                                        class="icons me-2 bi bi-calendar-check"></i>Tanggal
                                                    Posting
                                                    :
                                                    {{ (new \Carbon\Carbon($keg->created_at))->format('d F, Y')
                                                    }}</span>
                                            </div>
                                            <div class="pt-3 border-bottom">
                                                <p class="fw-bold"><i
                                                        class="icons me-2 bi bi-calendar-event"></i>Pelaksanaan :
                                                    <span>{{ (new
                                                        \Carbon\Carbon($keg->date_time))->format('d F, Y')
                                                        }}</span>
                                                </p>
                                                <p class="fw-bold"><i class="icons me-2 bi bi-clock"></i>Waktu :
                                                    <span>{{ (new
                                                        \Carbon\Carbon($keg->date_time))->format('H:i')
                                                        }} WIT</span>
                                                </p>
                                                <p class="fw-bold"><i
                                                        class="icons me-2 bi bi-geo-alt-fill"></i>Lokasi :
                                                    <span>{{
                                                        $keg->location }}</span>
                                                </p>
                                            </div>
                                            <p class="mt-2 deskripsi-kegiatan">{!! $keg->description !!}</p>

                                        </div>
                                    </div>

                                </div>

                            </div>
                        </article>
                    </div>
                    {{-- end content section --}}

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
                        <x-guest.modal :title="$item->title" :description="$item->body" :file="$item->file" :created_at="$item->created_at"
                            type="announcement" :id="$item->id" :author="$item->user->name" />
                        @endforeach
                    </div>
                    {{-- sidebar end --}}

                </div>

            </div>
        </section>

    </main><!-- End #main -->
</x-guest.app-layout>