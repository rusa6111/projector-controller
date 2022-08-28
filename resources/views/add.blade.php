@extends('layouts')
@section('style')
<style media="screen">
  input {
    margin-bottom: 5px;
  }
  
  h1 {
    margin-top: 30px;
  }
  
  h1:first-child {
    margin-top: 0;
  }
  
  h2 {
    margin-bottom: 0;
  }
  
  button {
    margin-bottom: 10px;
  }
  
  .btn-danger {
    margin-left: 30px;
  }
</style>
@endsection
@section('content')
<body>
  <h1>Add Movie</h1>
  @foreach ($errors->all() as $error)
  <li>{{$error}}</li>
  @endforeach
	<form method="POST" action="{{ route('add_post')}}" enctype="multipart/form-data">
  	@csrf
    <input type="text" id="title" name="title" placeholder="Title" class="form-control">
  	<input type="file" id="upload_file" name="upload_file" class="form-control">
  	<button type="submit" class="btn btn-primary">Upload</button>
	</form>
  <h1>Delete Movie</h1>
  @foreach ($movies as $movie)
  <h2>・{{ $movie->title }}</h2>
	<form method="POST" action="{{ route('delete')}}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="id" name="id" value="{{ $movie->id }}" class="form-control">
    <button type="submit" class="btn btn-danger">Delete</button>
	</form>
  @endforeach
</body>
@endsection