<!-- resources/views/components/breadcrumb.blade.php -->
<div class="pagetitle">
    <h1>{{ $title ?? '' }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            @foreach ($breadcrumbs as $breadcrumb)
            @if ($loop->last)
            <li class="breadcrumb-item active">{{ $breadcrumb['name'] ?? 'Unnamed' }}</li>
            @else
            <li class="breadcrumb-item">
                @if(isset($breadcrumb['url']))
                <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] ?? 'Unnamed' }}</a>
                @else
                {{ $breadcrumb['name'] ?? 'Unnamed' }}
                @endif
            </li>
            @endif
            @endforeach
        </ol>
    </nav>
</div>