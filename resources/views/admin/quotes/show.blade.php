@extends('admin.layout')
@section('title', 'Quote request')
@section('content')
<h1>{{ $quote->name }}</h1>
<div class="card">
  <p><strong>Contact:</strong> {{ $quote->contact }}<br>
  <strong>Service:</strong> {{ $quote->service }}<br>
  <strong>Received:</strong> {{ $quote->created_at->format('d M Y H:i') }}</p>
  <p>{!! nl2br(e($quote->message)) !!}</p>
  <form method="POST" action="{{ route('admin.quotes.update', $quote) }}" style="padding:0;border:0;background:none;display:flex;gap:10px;align-items:center">
    @csrf @method('PATCH')
    <select name="status" style="width:auto;margin:0">@foreach(['new','read','replied','closed'] as $s)<option @selected($quote->status === $s)>{{ $s }}</option>@endforeach</select>
    <button class="btn sm alt">Update status</button>
  </form>
</div>
<form method="POST" action="{{ route('admin.quotes.destroy', $quote) }}" style="padding:0;border:0;background:none" onsubmit="return confirm('Delete this request?')">@csrf @method('DELETE')<button class="btn sm">Delete</button></form>
<p><a href="{{ route('admin.quotes.index') }}">← Back to all requests</a></p>
@endsection
