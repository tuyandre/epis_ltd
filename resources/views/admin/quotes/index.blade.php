@extends('admin.layout')
@section('title', 'Quote requests')
@section('content')
<h1>Quote requests</h1>
<div class="card">@include('admin.quotes.table')</div>
{{ $quotes->links() }}
@endsection
