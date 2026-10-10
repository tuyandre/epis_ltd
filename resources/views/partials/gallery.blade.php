@if($gallery->isNotEmpty())
<section class="gallery" id="gallery">
  <div class="wrap">
    <h2>On site<span>Our work, in the field</span></h2>
    <div class="gallery-grid">
      @foreach($gallery as $g)
      <figure><img src="{{ \App\Support\Media::url($g->image) }}" alt="{{ $g->caption }}" loading="lazy"><figcaption>{{ $g->caption }}</figcaption></figure>
      @endforeach
    </div>
  </div>
</section>
@endif

