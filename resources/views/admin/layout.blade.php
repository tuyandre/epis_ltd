<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'Admin') — EPIS Ltd</title>
<meta name="robots" content="noindex,nofollow">
<link rel="stylesheet" href="{{ asset('css/site.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="adm">
@auth
<div class="adm-bar"><div class="wrap">
  <strong>EPIS ADMIN</strong>
  <a href="{{ route('admin.dashboard') }}" @class(['on' => request()->routeIs('admin.dashboard')])>Dashboard</a>
  <a href="{{ route('admin.quotes.index') }}" @class(['on' => request()->routeIs('admin.quotes.*')])>Quotes</a>
  <a href="{{ route('admin.services.index') }}" @class(['on' => request()->routeIs('admin.services.*')])>Services</a>
{{--  <a href="{{ route('admin.team.index') }}" @class(['on' => request()->routeIs('admin.team.*')])>Team</a>--}}
  <a href="{{ route('admin.projects.index') }}" @class(['on' => request()->routeIs('admin.projects.*')])>Projects</a>
  <a href="{{ route('admin.clients.index') }}" @class(['on' => request()->routeIs('admin.clients.*')])>Clients</a>
  <a href="{{ route('admin.gallery.index') }}" @class(['on' => request()->routeIs('admin.gallery.*')])>Gallery</a>
  <a href="{{ route('home') }}" target="_blank">View site</a>
  <form method="POST" action="{{ route('admin.logout') }}">@csrf<button>Log out</button></form>
</div></div>
@endauth
<main><div class="wrap">
  @if(session('status'))<div class="alert" role="status">{{ session('status') }}</div>@endif
  @yield('content')
</div></main>
</body>
</html>
