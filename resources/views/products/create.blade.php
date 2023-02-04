@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h4 class="text-center">ເຂົ້າສູ່ລະບົບ</h4>
            <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data" >  
                @csrf
                <label class="name" for="name">ຊື່ສິນຄ້າ</label>
                <input class="form-control" type="text" name="name" required>
                <label  class="name" for="name">ລາຄາ</label>
                <input class="form-control" type="number" name="price" required>
                <label class="name" for="name">ຮູບພາບ</label>
                <input type="file" class="form-control" name="file" required>
                <button class="btn btn-success mt-3" type="submit">ບັນທຶກ</button>
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
