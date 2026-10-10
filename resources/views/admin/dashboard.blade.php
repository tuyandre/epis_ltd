@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')
<h1>Dashboard</h1>
<div class="stats">@foreach($counts as $k => $v)<div class="stat"><b>{{ $v }}</b>{{ $k }}</div>@endforeach</div>
<div class="card"><h3>Latest quote requests</h3>
@include('admin.quotes.table', ['quotes' => $latest])
</div>
@endsection
