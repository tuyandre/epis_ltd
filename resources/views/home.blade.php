<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>EPIS Ltd — Electrical Panel Installation System | Kigali, Rwanda</title>
<meta name="description" content="EPIS Ltd provides MEP design, supervision and installation, MV/LV line installation, and testing and commissioning across Rwanda.">
<meta property="og:image" content="{{ asset('images/epis-logo-blue.jpg') }}">
<link rel="icon" href="{{ asset('images/epis-logo-blue.jpg') }}">
<link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body>
<header class="top">
  <div class="wrap">
    <a href="#home" class="logo" aria-label="EPIS Ltd home">
      <img class="logo-img" src="{{ asset('images/epis-logo-blue.jpg') }}" alt="EPIS Ltd — Electrical Panel Installation System" width="192" height="52">
    </a>
    <nav id="nav" aria-label="Main">
      <ul>
        <li><a href="#about">About</a></li>
        <li><a href="#services">Services</a></li>
{{--        @if($team->isNotEmpty())<li><a href="#team">Team</a></li>@endif--}}
        @if($projects->isNotEmpty())<li><a href="#projects">Projects</a></li>@endif
        @if($gallery->isNotEmpty())<li><a href="#gallery">Gallery</a></li>@endif
        @if($clients->isNotEmpty())<li><a href="#clients">Clients</a></li>@endif
        <li><a href="#contact">Contact</a></li>
      </ul>
    </nav>
    <a href="https://epis.rw/webmail" target="_blank" class="btn nav-cta">Webmail</a>
    <button class="menu-btn" aria-label="Open menu" aria-expanded="false" aria-controls="nav"><span></span><span></span><span></span></button>
  </div>
</header>

<main>
@include('partials.hero')
@include('partials.about')
@include('partials.mvv')

<section class="services" id="services">
  <div class="services-head"><h2>Our <span>Services</span></h2></div>
  <div class="services-band">
    <div class="wrap service-list">
      @foreach($services as $s)
      <article class="service">
        <img class="ico" src="{{ asset('images/site/icons/'.(['bolt' => 'icon_gear', 'lines' => 'icon_worker', 'clipboard' => 'icon_audit'][$s->icon] ?? 'icon_gear').'.png') }}" alt="" width="108" height="108" loading="lazy">
        <div>
          <h3>{{ $s->title }}</h3>
          <p>{{ $s->description }}</p>
        </div>
      </article>
      @endforeach
    </div>
  </div>
</section>

{{--@if($team->isNotEmpty())--}}
{{--<section class="team" id="team">--}}
{{--  <div class="wrap">--}}
{{--    <h2>Our team<span>The people on your project</span></h2>--}}
{{--    <div class="team-grid">--}}
{{--      @foreach($team as $m)--}}
{{--      <div class="member"><div class="card"><h3>{{ $m->name }}</h3><div class="role">{{ $m->role }}</div>--}}
{{--        <div class="photo">@if($m->photo)<img src="{{ \App\Support\Media::url($m->photo) }}" alt="{{ $m->name }}" loading="lazy">@else<div class="initials">{{ $m->initials }}</div>@endif</div></div><div class="bar"></div></div>--}}
{{--      @endforeach--}}
{{--    </div>--}}
{{--  </div>--}}
{{--</section>--}}
{{--@endif--}}

@if($projects->isNotEmpty())
<section class="projects" id="projects">
  <div class="wrap">
    <h2>Our projects<span>Work we have delivered</span></h2>
    <div class="project-grid">
      @foreach($projects as $p)
      <article class="project {{ $p->size }}" style="background:{{ $p->gradient }}">
        @if($p->image)<img class="photo-bg" src="{{ \App\Support\Media::url($p->image) }}" alt="" loading="lazy">@endif
        <div class="info">
          @if($p->partner)<span class="partner">{{ $p->partner }}</span>@endif
          <h3>{{ $p->title }}</h3>
          @if($p->description)<p>{{ $p->description }}</p>@endif
        </div>
      </article>
      @endforeach
    </div>
  </div>
</section>
@endif

@include('partials.gallery')
@if($clients->isNotEmpty())
<section class="clients" id="clients">
  <div class="wrap">
    <h2>Our clients<span>Who we work with</span></h2>
    <div class="client-grid">
      @foreach($clients as $c)
      <div class="client">@if($c->logo)<img src="{{ \App\Support\Media::url($c->logo) }}" alt="{{ $c->name }}" loading="lazy">@else{{ $c->name }}@endif @if($c->subtitle && ! $c->logo)<small>{{ $c->subtitle }}</small>@endif</div>
      @endforeach
    </div>
  </div>
</section>
@endif

<section class="contact" id="contact">
  <div class="wrap">
    <div>
      <h2>Get in touch<span>Tell us about your project</span></h2>
      <p class="contact-intro">Call, email or send the form and our team will get back to you about your installation, line work or commissioning needs.</p>
      <div class="contact-rows">
        <a class="crow" href="tel:{{ config('epis.phone_href') }}">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.6 10.8a15 15 0 006.6 6.6l2.2-2.2a1 1 0 011-.25 11.4 11.4 0 003.6.57 1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.25.2 2.45.57 3.57a1 1 0 01-.25 1z"/></svg>
          <span><small>Telephone</small><b>{{ config('epis.phone') }}</b></span>
        </a>
        <div class="crow">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 5h18a1 1 0 011 1v12a1 1 0 01-1 1H3a1 1 0 01-1-1V6a1 1 0 011-1zm9 7.2L4 7.3V8l8 5 8-5v-.7z"/></svg>
          <span><small>Email</small>@foreach(config('epis.emails') as $mail)<b><a href="mailto:{{ $mail }}" style="text-decoration:none">{{ $mail }}</a></b>@if(! $loop->last)<br>@endif @endforeach</span>
        </div>
        <div class="crow">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a7 7 0 017 7c0 5-7 13-7 13S5 14 5 9a7 7 0 017-7zm0 4.5A2.5 2.5 0 1012 11.5 2.5 2.5 0 0012 6.5z"/></svg>
          <span><small>Address</small><b>{{ config('epis.address') }}</b></span>
        </div>
      </div>
      <img class="contact-photo" src="{{ asset('images/site/contact.jpg') }}" alt="EPIS engineer overlooking high-voltage lines at sunset" loading="lazy">
    </div>

    <form id="quote" method="POST" action="{{ route('quote.store') }}#quote" novalidate>
      @csrf
      <h3>Request a quote</h3>
      @if(session('status'))<div class="alert" role="status">{{ session('status') }}</div>@endif
      @if($errors->any())<div class="alert error" role="alert">Please fix the highlighted fields.</div>@endif
      <div class="hp" aria-hidden="true"><label>Leave empty<input name="website" tabindex="-1" autocomplete="off"></label></div>
      <label for="name">Your name</label>
      <input id="name" name="name" value="{{ old('name') }}" required autocomplete="name">
      @error('name')<p class="field-error">{{ $message }}</p>@enderror
      <label for="contact">Email or phone</label>
      <input id="contact" name="contact" value="{{ old('contact') }}" required>
      @error('contact')<p class="field-error">{{ $message }}</p>@enderror
      <label for="service">Service needed</label>
      <select id="service" name="service">
        @foreach(config('epis.services_options') as $o)<option @selected(old('service') === $o)>{{ $o }}</option>@endforeach
      </select>
      <label for="message">Project details</label>
      <textarea id="message" name="message" placeholder="Location, size of the project, timeline…">{{ old('message') }}</textarea>
      @error('message')<p class="field-error">{{ $message }}</p>@enderror
      <button class="btn" type="submit">Send request</button>
    </form>
  </div>
</section>
</main>

<footer>
  <div class="wrap">
    <div class="logo">
      <img class="logo-img footer-logo" src="{{ asset('images/epis-logo-blue.jpg') }}" alt="EPIS Ltd — {{ config('epis.tagline') }}" width="240" height="65" loading="lazy">
    </div>
    <ul>
      <li><a href="#about">About</a></li>
      <li><a href="#services">Services</a></li>
      <li><a href="#projects">Projects</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
  </div>
  <div class="wrap copy">© {{ date('Y') }} EPIS Ltd. Kigali, Rwanda. All rights reserved.</div>
</footer>
<div class="footer-strip"></div>

<script>
  const btn = document.querySelector('.menu-btn'), nav = document.getElementById('nav');
  btn.addEventListener('click', () => { const open = nav.classList.toggle('open'); btn.setAttribute('aria-expanded', open); });
  nav.querySelectorAll('a').forEach(a => a.addEventListener('click', () => { nav.classList.remove('open'); btn.setAttribute('aria-expanded', false); }));
</script>
</body>
</html>
