@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="row">
                @foreach($products as $item)
                    <div class="col-3 mt-2">
                        
                        <form action="{{route('orders.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" placeholder="" value="{{$item->id}}">
                            
                                <div class="card p-1">
                                    
                                    <img src="{{asset('/public/image/'.$item->file_path)}}"  width='200' height='300'>
                                   
                                    <p class="text-center mt-1">{{$item->name}}</p>
                                    <p class="text-center">{{$item->price}} ກີບ</p>
                                    <button class="btn btn-warning" type="submit">ສັ່ງຊື້</button>
                                </div>
                        </form>
                        <div class=" row col-12 ">
                            <div class="btn col-4"> 
                                <a class="btn btn-primary" href="{{route('products.edit',$item->id)}}">ແກ້ໄຂ</a>
                            </div>
                            <div class="btn col-5">
                                <form action="{{route('products.destroy',$item->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">ລືບຂໍ້ມູນ</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection