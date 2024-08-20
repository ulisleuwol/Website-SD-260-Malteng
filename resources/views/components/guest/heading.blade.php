<div class="breadcrumbs">
  <div class="page-header d-flex align-items-center" style="background-image: url('{{ $backgroundImage ?? '' }}');">
    <div class="container position-relative">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-6 text-center">
          <h2>{{ $title }}</h2>
          <p>{{ $content }}</p>
        </div>
      </div>
    </div>
  </div>
  <nav>
    <div class="container">
      <ol>
        <li><a href="{{ url('/') }}">Home</a></li>
        @isset($title)
        <li><a href="{{ $link ?? '' }}">{{ $linkText ?? '' }}</a></li>
        @endisset
        @isset($show)
        <li>{{ $show }}</li>
        @endisset
      </ol>
    </div>
  </nav>
</div>