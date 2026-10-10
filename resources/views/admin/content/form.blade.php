@extends('admin.layout')
@section('title', ($item->exists ? 'Edit ' : 'Add ').$label)
@section('content')
<h1>{{ $item->exists ? 'Edit' : 'Add' }} {{ strtolower($label) }}</h1>
<form class="stack" method="POST" enctype="multipart/form-data"
      action="{{ $item->exists ? route("admin.$slug.update", $item->id) : route("admin.$slug.store") }}">
  @csrf @if($item->exists) @method('PUT') @endif
  @foreach($fields as $n => $f)
    <label for="{{ $n }}">{{ $f['label'] }}</label>
    @if($f['type'] === 'textarea')
      <textarea id="{{ $n }}" name="{{ $n }}">{{ old($n, $item->$n) }}</textarea>
    @elseif($f['type'] === 'select')
      <select id="{{ $n }}" name="{{ $n }}">@foreach($f['options'] as $v => $t)<option value="{{ $v }}" @selected(old($n, $item->$n) === $v)>{{ $t }}</option>@endforeach</select>
    @elseif($f['type'] === 'image')
      @if($item->$n)<img class="thumb" style="width:90px;height:90px;margin-bottom:8px" src="{{ \App\Support\Media::url($item->$n) }}" alt="">@endif
      <input id="{{ $n }}" type="file" name="{{ $n }}" accept="image/*">
    @else
      <input id="{{ $n }}" type="{{ $f['type'] }}" name="{{ $n }}" value="{{ old($n, $item->$n ?? ($n === 'sort_order' ? 0 : ($n === 'gradient' ? 'linear-gradient(160deg,#3b4a7a,#16153f)' : ''))) }}">
    @endif
    @error($n)<p class="field-error">{{ $message }}</p>@enderror
  @endforeach
  <button class="btn" type="submit">Save</button>
  <a href="{{ route("admin.$slug.index") }}" style="margin-left:16px">Cancel</a>
</form>
@endsection
