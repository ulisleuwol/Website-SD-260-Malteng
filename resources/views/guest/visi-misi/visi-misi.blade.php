<x-guest.app-layout title="Visi & Misi">

  <main id="main">

    {{-- start heading --}}
    <x-guest.heading title="Visi & Misi" linkText="Visi & Misi" content="Sekolah Dasar Negeri 260 Maluku Tengah" />
    {{-- End heading --}}


    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row g-5">
          <!-- ======= Content Section ======= -->
          <div class="col-lg-8">

            <article class="blog-details">

              <div class="post-img">
                <img src="assets/img/blog/blog-1.jpg" alt="" class="img-fluid">
              </div>

              <h2 class="title text-center">{{ $visi->jenis }}</h2>

              <div class="content">
                <blockquote>
                  <p>
                    {!! $visi->deskripsi !!}
                  </p>
                  <span class="text-end text-muted small fst-italic d-block pt-5">&tilde;
                    {{ $visi->updated_at->format('d - m - Y') }} &tilde;
                  </span>
                </blockquote>

                <h2 class="title text-center">{{ $misi->jenis }}</h2>
                <blockquote class="text-start">
                  <p>
                    {!! $misi->deskripsi !!}
                  </p>
                  <span class="text-end text-muted small fst-italic d-block pt-5">&tilde;
                    {{ $misi->updated_at->format('d - m - Y') }} &tilde;
                  </span>
                </blockquote>
              </div><!-- End post content -->

            </article><!-- End blog post -->

          </div>
          <!-- End Content Section -->

          {{-- sidebar start --}}
          <div class="col-lg-4">
            {{-- include sidebar / modal kegiatan --}}
            <x-guest.sidebar :kegiatan="$kegiatan" :agenda="$agenda" :pengumuman="$pengumuman" />
            {{-- include modal agenda --}}
            @foreach ($agenda as $item)
            <x-guest.modal :title="$item->title" :dateTime="$item->date_time" :description="$item->description"
              :location="$item->location" type="agenda" :id="$item->id" :author="$item->user->name"
              :created_at="$item->created_at" />
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