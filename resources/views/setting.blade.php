@extends('main')
@section('contant')
    <div class="container">
        <h1 class="text-center">ichat setting</h1>
        <form action="{{route('upload')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Name</label>
                <input type="hidden" class="form-control" name="id" value="{{$profile->id}}">
                <input type="text" class="form-control" name="name" value="{{$profile->name}}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">upload profile image</label>
                <input type="file" class="form-control" name="image" value="{{$profile->image}}">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
