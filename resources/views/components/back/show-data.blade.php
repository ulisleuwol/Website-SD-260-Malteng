<div class="card">
    <div class="card-body overflow-x-auto">
        <div class="card-title">
            <x-button as="a" href="{{ $backRoute }}" class="btn-sm">
                <i class="bi bi-arrow-left-circle"></i> Kembali
            </x-button>
        </div>

        <!-- Table with stripped rows -->
        <table class="table table-striped table-responsive table-hover">
            @foreach ($data as $key => $value)
            @if ($key !== 'created_at' && $key !== 'updated_at')
            <tr>
                <th>{{ ucfirst(str_replace('_', ' ', $key)) }}</th>
                <td>:</td>
                <td>
                    @if ($key === 'status')
                    @if (\Carbon\Carbon::parse($value)->isPast())
                    Sudah Selesai
                    @elseif (\Carbon\Carbon::parse($value)->isToday())
                    Berlangsung
                    @else
                    Segera
                    @endif
                    @elseif ($key === 'foto' && $value)
                    @php
                    $images = json_decode($value, true);
                    @endphp
                    @if (!empty($images))
                    <div class="gallery-images">
                        @foreach ($images as $image)
                        <img src="{{ asset($imagePathPrefix . $image) }}" alt="Image" class="img-fluid col-sm-2" loading="lazy">
                        @endforeach
                    </div>
                    @else
                    <img src="{{ asset($imagePathPrefix . $value) }}" alt="Image" class="img-fluid col-sm-2" loading="lazy">
                    @endif
                    @elseif ($key === 'date_time')
                    {{ \Carbon\Carbon::parse($value)->translatedFormat('l, d F Y') }} pukul {{
                    \Carbon\Carbon::parse($value)->format('H:i:s') }} WIT
                    @else
                    {!! $value !!}
                    @endif
                </td>
            </tr>
            @endif
            @endforeach
        </table>
        <!-- End Table with stripped rows -->
    </div>
    <div class="col px-3 py-2 bg-secondary-subtle">
        <div class="float-end text-secondary">
            <span>Updated at: {{ \Carbon\Carbon::parse($data['updated_at'])->locale('id')->diffForHumans() }},</span>
            <span>Created at: {{ \Carbon\Carbon::parse($data['created_at'])->locale('id')->isoFormat('dddd, D MMMM
                YYYY') }}</span>
        </div>
    </div>
</div>