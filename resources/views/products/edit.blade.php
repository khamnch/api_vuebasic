@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <form action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label for="name">ຊື່ສິນຄ້າ:</label>
                <input class="form-control" type="text" name="name" value="{{$product->name}}">
                <label for="name">ລາຄາສິນຄ້າ:</label>
                <input class="form-control" type="number" name="price" value="{{$product->price}}">     
                <input type="file" name="file" id="file" value="{{$product->file}}">
                <button class="btn btn-success mt-2">ບັນທືກ</button>
            </form>
        </div>
    </div>
</div>
@endsection
<style>
    .container{
        font-family: noto sans lao;
    }
</style>