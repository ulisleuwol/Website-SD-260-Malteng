<!-- resources/views/components/guest/modal.blade.php -->
@props(['title', 'dateTime' => null, 'description', 'file' => null, 'location' => null, 'type', 'id', 'author',
'created_at'])

<div class="modal fade" id="modal{{ $type . $id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalLabel{{ $type . $id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="m-auto">
                <h1 class="modal-title fs-5 fw-bold text-primary" id="modalLabel{{ $type . $id }}">{{ $title }}</h1>
            </div>
            <div class="modal-body">
                <div class="mb-4 row border-bottom pb-2">
                    <span class="small text-muted col-12 col-lg-6"><i class="icons bi bi-person-circle me-2"></i>Oleh :
                        {{ $author }}</span>
                    <span class="small text-muted col-12 col-lg-6"><i class="icons bi bi-calendar3 me-2"></i>Tanggal
                        Posting : {{
                        \Carbon\Carbon::parse($created_at)->isoFormat('D/MM/YYYY') }}</span>
                </div>
                @if ($type === 'agenda')
                <span class="small text-muted"><i class="text-primary bi bi-info-circle-fill"></i> Detail
                    agenda</span>
                <p class="py-2 text-muted small text-secondary">{!! $description !!}</p>
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <strong><i class="icons me-2 bi bi-clock"></i>Waktu</strong>
                        <p class="small ms-4">{{ \Carbon\Carbon::parse($dateTime)->format('H:i') }} WIT - Selesai</p>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <strong><i class="icons me-2 bi bi-calendar2-check"></i>Tanggal</strong>
                        <p class="small ms-4">{{ \Carbon\Carbon::parse($dateTime)->isoFormat('dddd, D MMMM YYYY') }}</p>
                    </div>
                    <div class="pb-3 col-lg-4 col-md-12">
                        <strong><i class="icons me-2 bi bi-geo-alt-fill"></i>Tempat Pelaksanaan</strong>
                        <p class="small ms-4">{{ $location }}</p>
                    </div>
                </div>
                @elseif ($type === 'announcement')
                <span class="small text-muted d-block"><i class="text-primary bi bi-info-circle-fill"></i> Detail
                    Pengumuman</span>
                <p class="text-muted small text-secondary pt-3">{!! $description !!}</p>
                @if ($file)
                @php
                $fileUrl = asset('storage/'.$file);
                $fileName = basename($file);
                @endphp
                <a href="{{ $fileUrl }}" target="_blank">
                    <button type="button" class="btn btn-sm btn-primary">
                        <i class="bi bi-download me-1"></i> Unduh
                    </button>
                </a>
                @endif
                @endif
            </div>
            <div class="m-auto">
                <button type="button" class="btn border-primary text-primary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>