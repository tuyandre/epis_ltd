@extends('admin.layout')
@section('title', 'Log in')
@section('content')
<form class="login" method="POST" action="{{ route('admin.login') }}">
  @csrf
  <h3>Admin log in</h3>
  <label for="email">Email</label>
  <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
  @error('email')<p class="field-error">{{ $message }}</p>@enderror
  <label for="password">Password</label>
  <input id="password" type="password" name="password" required>
  <label><input type="checkbox" name="remember" value="1" style="width:auto;margin-right:8px">Remember me</label>
  <button class="btn" type="submit">Log in</button>
</form>
@endsection
