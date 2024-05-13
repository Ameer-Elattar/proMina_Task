@extends('layouts.app')

@section('title',"show album images")

@section('content')
<div class="d-flex gap-2 my-3">
  @foreach ($images as $img)
  <div class="card" style="width: 18rem;">
    <img src="{{asset("")}}public/{{$img->image}}"  alt="">
  </div>
  @endforeach
</div>

@endsection