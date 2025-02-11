<x-app-layout>
  @push('link')
  <link href="{{ asset('assets/vendor/summernote/dist/summernote-lite.css') }}" rel="stylesheet">
  <link href="DataTables/datatables.min.css" rel="stylesheet">
  @endpush

  @slot('title', 'PPDB')
  <main id="main" class="main">

    <x-back.breadcrumb :title="$title" :breadcrumbs="$breadcrumbs" /><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body overflow-x-auto">
              <div class="card-title">
                <x-button onclick="showModal()" class="btn-sm" title="Tambah Data">
                  <i class="bi bi-patch-plus"></i> Tambah Data
                </x-button>
              </div>

              <!-- Table -->
              <table class="table table-striped datatable table-responsive table-hover">
                <thead class="text-center">
                  <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $ppdb as $data )
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ Str::limit(strip_tags($data->deskripsi), 50) }}</td>

                    <td style="width: 120px">
                      <x-button as="a" href="{{ route('ppdb.show', $data->slug) }}" class="btn-sm btn-success"
                        title="Detail">
                        <i class="bi bi-eye"></i>
                      </x-button>

                      <x-button as="a" href="#" data-slug="{{ $data->slug }}" onclick="confirmEdit(this)"
                        class="btn-sm btn-warning" title="Sunting">
                        <i class="bi bi-pencil-square"></i>
                      </x-button>

                      <x-button as="button" data-slug="{{ $data->slug }}" onclick="confirmDelete(this)"
                        class="btn-sm btn-danger" title="Hapus">
                        <i class="bi bi-trash3"></i>
                      </x-button>

                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- End Table -->

            </div>
          </div>

        </div>
      </div>

      @include('back.ppdb.ppdb-form')

    </section>
  </main><!-- End #main -->

  @push('scripts')

  <!-- Jquery 3 -->
  <script type="text/javascript" src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

  <!-- Bootstrap 5 -->
  <script type="text/javascript" src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>

  <!-- Main js -->
  <script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>

  <!-- Laravel Javascript Validation -->
  <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
  {!! JsValidator::formRequest('App\Http\Requests\PPDBRequest', '#modalForm') !!}

  <!-- Sweet Alert2 -->
  <script type="text/javascript" src="{{ asset('assets/vendor/sweetalert/sweetalert2.js') }}"></script>

  <!-- Summernote Editor -->
  <script type="text/javascript" src="{{ asset('assets/vendor/summernote/dist/summernote-lite.js') }}"></script>

  <script type="text/javascript" src="{{ asset('assets/vendor/summernote/dist/lang/summernote-id-ID.min.js') }}">
  </script>

  <!-- Datatables -->
  <script type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"> </script>

  <script>
    $(document).ready(function() {
          $('table').DataTable();
      });
      
    @if (session('success'))
            window.sessionStorage.setItem("successMessage", "{{ session('success') }}");
        @endif
        
        @if (session('error'))
            window.sessionStorage.setItem("errorMessage", "{{ session('error') }}");
            @endif

        let save_method;

        function resetForm() {
            $('#modalForm')[0].reset();
            $('#image-preview').hide(); // Menyembunyikan pratinjau gambar
            $('#image-preview').attr('src', ''); // Menghapus sumber gambar dari pratinjau
            $('#summernote').summernote('code', '');           
            $('.is-invalid').removeClass('is-invalid'); 
            $('.is-valid').removeClass('is-valid'); 
            $('span.invalid-feedback').remove(); 
        }

        function showModal() {
            resetForm(); // Reset form and clear validation errors
            $('#dataModal').modal('show');
            save_method = 'create';

            $('.btnSubmit').text('Simpan');
            $('.modal-title').text('Tambah Data');
        }

        $('#modalForm').on('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            let url, method;
            url = 'ppdb';
            method = 'POST';

            if (save_method === 'update') {
                url = 'ppdb/' + $('#slug').val();
                formData.append('_method', 'PUT');
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: method,
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#dataModal').modal('hide');
                    // Reload halaman sepenuhnya
                    location.reload();
                    Swal.fire({
                        icon: "success",
                        title: "Sukses",
                        text: response.message,
                        showConfirmButton: false,
                        timer: 2000,
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        icon: "info",
                        title: "Peringatan!",
                        text: jqXHR.responseJSON.message || jqXHR.responseText,
                        showConfirmButton: false,
                        timer: 3000,
                    });
                }
            });
        });

        function confirmEdit(e) {
            resetForm(); // Reset form and clear validation errors

            let slug = e.getAttribute('data-slug');
            save_method = 'update';

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: '{{ url("ppdb") }}/' + slug + '/edit',
                success: function(response) {
                    let result = response.data;
                    $('#name').val(result.name);
                    $('#summernote').summernote('code', result.deskripsi); // Set Summernote content
                    $('#slug').val(result.slug);

                    // Tampilkan gambar yang ada
                if (result.image) {
                    $('#image-preview').attr('src', '/storage/' + result.image).show();
                    $('input[name="oldImage"]').val(result.image);
                } else {
                    $('#image-preview').hide();
                }

                    $('#dataModal').modal('show'); // Show modal after data is loaded
                    $('.btnSubmit').text('Simpan');
                    $('.modal-title').text('Ubah Data');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        icon: "info",
                        title: "Peringatan!",
                        text: jqXHR.responseJSON.message || jqXHR.responseText,
                        showConfirmButton: false,
                        timer: 3000,
                    });
                }
            });
        }

        function confirmDelete(e) {
            let slug = e.getAttribute('data-slug');

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "DELETE",
                        url: '{{ url("ppdb") }}/' + slug,
                        success: function(response) {
                            // Reload halaman sepenuhnya
                            location.reload();
                            Swal.fire({
                                icon: "success",
                                title: "Sukses",
                                text: response.message,
                                showConfirmButton: false,
                                timer: 2000,
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Swal.fire({
                                icon: "info",
                                title: "Peringatan!",
                                text: jqXHR.responseJSON.message || jqXHR.responseText,
                                showConfirmButton: false,
                                timer: 3000,
                            });
                        }
                    });
                }
            });
        }

 
  </script>
  @endpush
</x-app-layout>