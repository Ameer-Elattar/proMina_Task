@extends('layouts.app')

@section('title',"index")

@section('content')

  @if (count($albums)>0)
    
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <td>name</td>
        <td>images</td>
        <td>edit</td>
        <td>delete</td>
      </tr>
    </thead>
  @foreach ($albums as $album )
      <tbody>
        <tr>
          <td>{{$album->name}}</td>
          <td><a href="{{route("showImages",['id'=> $album->id])}}" class="btn btn-info">view images</a></td>
          <td><a href="{{route("edit",['id' => $album->id])}}" class="btn btn-secondary ">edit</a></td>
          <td><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal.{{$album->id}}">Delete</button></td>
        </tr>
      </tbody>


<div class="modal fade" id="exampleModal.{{$album->id}}" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Warinig</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      Would you like to delete the images or move it to anothe album?
      </div>
      <div class="modal-footer">
      <form action="{{route("move",['id' => $album->id])}}" method="post">
          @csrf
          @method('put')
          <input type="name" placeholder="enter an album name to move images to" class="form-control"  name="name" required>
          <input type="submit" class="btn btn-secondary move" value="Move">
        </form>
        
        <form action="{{route("destroy",['id' => $album->id])}}" method="post">
          @csrf
          @method('delete')
        <input type="submit" value="Delete" class="btn btn-danger delete">
        </form>
      </div>
    </div>
  </div>
</div>


      @endforeach
    </table>
  @else
  <h1 class="mt-4 text-center alert alert-warning">there is no albums</h1>
  @endif

@endsection

