@extends('layouts.app')

@section('content')

<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="text-center" id="exampleModalLabel">ສ້າງສີນຄ້າ</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('products.show')}}" method="post">  
              @csrf
             <img class="rounded float-md-start" src="{{}}" alt="">
        </form>
      </div>
    </div>
  </div>
    
@endsection