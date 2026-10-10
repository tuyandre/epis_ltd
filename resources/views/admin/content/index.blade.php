@extends('admin.layout')
@section('title', $label.'s')
@section('content')
<h1>{{ $label }}s <a class="btn sm" href="{{ route("admin.$slug.create") }}" style="margin-left:12px">Add</a></h1>
<div class="card">
<table>
  <thead><tr><th>#</th>@foreach($fields as $n => $f)@if(! in_array($f['type'], ['textarea']) && $n !== 'gradient' && $n !== 'sort_order')<th>{{ $f['label'] }}</th>@endif @endforeach<th></th></tr></thead>
  <tbody>
  @forelse($items as $it)
    <tr>
      <td>{{ $it->sort_order }}</td>
      @foreach($fields as $n => $f)@if(! in_array($f['type'], ['textarea']) && $n !== 'gradient' && $n !== 'sort_order')
        <td>@if($f['type'] === 'image')@if($it->$n)<img class="thumb" src="{{ \App\Support\Media::url($it->$n) }}" alt="">@endif @else{{ $it->$n }}@endif</td>
      @endif @endforeach
      <td style="white-space:nowrap">
        <a class="btn sm alt" href="{{ route("admin.$slug.edit", $it->id) }}">Edit</a>
        <form class="inline" method="POST" action="{{ route("admin.$slug.destroy", $it->id) }}" onsubmit="return confirm('Delete this item?')">@csrf @method('DELETE')<button class="btn sm">Delete</button></form>
      </td>
    </tr>
  @empty
    <tr><td colspan="9">Nothing here yet.</td></tr>
  @endforelse
  </tbody>
</table>
</div>
@endsection
