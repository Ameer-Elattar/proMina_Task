@extends("layouts.app")

@section("title","create")


@section("content")

@if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul >
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  <form action="{{route("store")}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="my-3">
      <label for="name">Album Name</label>
      <input type="text" name="name" class="form-control" placeholder="name" id="name">
    </div>
    <div class="mb-3">
      <label for="photos" class="form-label">Albums Photos</label>
      <input class="form-control" type="file" id="photos" name="photos[]" multiple>
    </div>
    <input type="submit" class="btn btn-primary" value="Add Album">
  </form>
@endsection
