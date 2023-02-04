@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h5>create image</h5>
            <form action="{{route('slide.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="name" >name</label>
                <input class="form-control" type="text" name="name">
                <label for="image_slide">image</label>
                <input class="form-control" type="file" name="image_slide" required>
                <button class="btn btn-danger">save</button>
            </form>
        </div>
    </div>
</div>
    
@endsection