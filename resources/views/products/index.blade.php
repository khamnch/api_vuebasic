@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            {{-- slide --}}
            
            {{-- end slide --}}
            
            <a class="btn btn-primary mt-4" href="{{route('products.create')}}">ເພີມສີນຄ້າ</a>
            <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary mt-4" href="{{route('products.create')}}">ເພີມສີນຄ້າ_modal</a>
            <div class="row">
                @foreach($products as $item)
                    <div class="col-3 mt-2">
                        
                        <form action="{{route('orders.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" placeholder="" value="{{$item->id}}">
                            
                                <div class="card p-1">
                                    <div class="gallery">
                                        <a href="">
                                            <img src="{{asset('/public/image/'.$item->file_path)}}"  width="200px" height="300px">
                                        </a>
                                    </div>
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

{{-- create product --}}
<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="text-center" id="exampleModalLabel">ສ້າງສີນຄ້າ</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data" >  
              @csrf
              <label class="name" for="name">ຊື່ສິນຄ້າ</label>
              <input class="form-control" type="text" name="name" required>
              <label  class="name" for="name">ລາຄາ</label>
              <input class="form-control" type="number" name="price" required>
              <label class="name" for="name">ຮູບພາບ</label>
              <input type="file" class="form-control" name="file" required>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">ບັນທືກ</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ປິດ</button>
            </div>
        </form>
      </div>
    </div>
  </div>
 <div class="footer col-12 form-control mt-3">
     <div class="row">
     <div class="col-4">
        <strong><h4 class=" text-md-start mt-2">{{__('ຕິດຕາມສີນຄ້າ')}}</h4></strong>
        <a class="nav-link" href="">
            <img src="public/icon/facebook/facebook-48.png" width="30" height="30" alt="">
               {{__('Facebook')}}
        </a>
        <a class="nav-link" href="">
            <img src="public/icon/instagram/instagram-48.png" width="30" height="30" alt="">
                {{__('Instagram')}}
         </a>
        <a class="nav-link" href="">
            <img src="public/icon/twiter/twitter-50.png" width="30" height="30" alt="">
                {{__('Twiter')}}
        </a>
     </div>
     <div class="col-4">
         <strong><h4 class=" text-md-start mt-2">{{__('ຕິດຕໍພົວພັນ')}}</h4></strong>
            <img src="public/icon/contract/ringer-volume-30.png" width="30" height="30" alt="">
                {{__('020 995-512-16')}}
       
       <a class="nav-link" href="">
        <img src="public/icon/contract/mail-48.png" width="30" height="30" alt="">
                {{__('kham.nch@gmail.com')}} 
       </a>
       <a class="nav-link" href="">
        <img src="public/icon/place-48.png" width="30" height="30" alt="">
                {{__('ບ້ານ: ສາຍລົມ ເມືອງ: ສີໂຄດຕະບອງ ນະຄອນຫຼວງວຽງຈັນ')}}
        </a>    
     </div>
     <div class="col-4">
        <strong><h4 class=" text-md-start mt-2">{{__('ກ່ຽວກັບ')}}</h4></strong>
        <strong><a class="nav-link" href="{{route('products.index')}}">{{__('ສີນຄ້າ')}}</a></strong>
     </div>
 </div>
 <div class=" text-center mt-3">{{__('@2023. All rights reserved')}}</div>
</div>

@endsection

<style>
    .container{
        font-family: noto sans lao;
    }
    .modal{
        font-family:noto sans lao;
    };   
    div.gallery:hover {
         border: 3px solid #777;
        };
</style>


