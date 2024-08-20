<x-guest.app-layout title="Fasilitas - {{ $fasilitas->nama }}">
    <main id="main">

        {{-- start heading --}}
        <x-guest.heading title="Fasilitas" linkText="Fasilitas" link="{{ url('/fasilitas-sekolah') }}"
            content="{{ $fasilitas->nama }}" show="{{ $fasilitas->nama }}" />
        {{-- End heading --}}

        <section class="blog fasilitas">
            <div class="container" data-aos="fade-up">

                <div class="row g-5">
                    <!-- ======= Content Section ======= -->
                    <div class="col-lg-8">
                        <article class="article-bg pb-5">
                            <img src="{{ asset('storage/'. $fasilitas->image) }}" class="card-img-top-show"
                                alt="Fasilitas">
                            <div class="card-body px-4">
                                <div class="pt-2 mt-2 pb-3">
                                    <span class="small text-muted me-4"><i
                                            class="bi bi-person-circle icons me-2"></i>Oleh : {{
                                        $fasilitas->user->name
                                        }}</span>
                                    <span class=" text-muted small"><i
                                            class="icons me-2 bi bi-calendar-check"></i>Tanggal Posting
                                        :
                                        {{ (new \Carbon\Carbon($fasilitas->created_at))->format('d F, Y')
                                        }}</span>
                                </div>
                                <p class="pt-3 deskripsi-fasilitas">{!! $fasilitas->deskripsi !!}</p>
                                <span class="float-end badge rounded-pill text-bg-secondary"><i
                                        class="bi bi-bookmark-check"></i> {{ $fasilitas->keterangan }}</span>
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