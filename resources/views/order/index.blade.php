@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 ">
            
            <h3 class="text-center text-primary">ລາຍການອໍເດີ້</h3>
            <a class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal" href="{{route('orders.index')}}">ເບີງລາຍລະອຽດ</a>
            {{-- <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">ສັ່ງພີມ</button> --}}
            <span class="material-icon ">
                <a href="" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <img class="rounded float-end" src="public/icon/2x/print.png" alt="">
                </a>
            </span>
            <table class="table table-striped table-bordered">
                <thead class="shadow-sm p-3 mb-5 bg-body rounded">
                    <tr class="shadow-sm p-3 mb-5 bg-body rounded">
                        {{-- <th>ຮູບພາບ</th> --}}
                        <th>ຊື່ສິນຄ້າ</th>
                        <th>ລາຄາ</th>
                        <th>ຈຳນວນ</th>
                        <th class="text-center">ຈັດການອໍເດີ້</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($order->order_details as $item)
                    <tr >
                        <td>{{$item->product_name}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->amount}}</td>
                        <td>
                            <div class="row text-center">
                                <div class="col-2">
                                    <form action="{{route('orders.update',$order->id)}}" method="post">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="value" value="decrease">
                                        <input type="hidden" name="product_id" value="{{$item->product_id}}">
                                        <button class="btn btn-outline-danger" type="submit" style="font-family: noto sans lao">ລົດຄ່າ</button>
                                    </form>
                                </div>
                                <div class="col-3">
                                    <form action="{{route('orders.update',$order->id)}}" method="post">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="value" value="increase">
                                        <input type="hidden" name="product_id" value="{{$item->product_id}}">
                                        <button class="btn btn-outline-danger" type="submit" style="font-family: noto sans lao">ເພີມ</button>
                                    </form>
                                </div>
                                <div class="col-3">
                                    <form action="{{route('orders.update',$order->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <button type="submit" class="btn btn-danger">ຍົກເລີກ</button>
                                    </form>
                                </div>
                              
                                <div class=" col-4">
                                    <select class="btn btn-outline-primary">
                                        <option value="Delivering">ກຳລັງຈັດສົ່ງ</option>
                                        <option value="wait_payment">ລໍຖ້າການຊຳລະເງິນ</option>
                                        <option value="successful">ສຳເລັດ</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                  @endforeach
                  <tr class="shadow-sm p-3 mb-5 bg-body rounded">
                    <td></td>
                    <td class="text-center text-danger">ລວມເງິນທັງໝົດ:</td>
                    <td class="text-danger">{{$order->total}} ກີບ</td>
                    <div class="modal-dialog modal-lg">...</div>
                    {{-- <td>
                        <form action="{{route('orders.update', $order->id)}}" method="POST">
                          @csrf
                          @method('put')
                          <input type="hidden" name="value" value="checkout">
                          <button class="btn btn-outline-primary" type="submit">CheckOut</button>
                      </form>
                    </td> --}}
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- view Modal Order Product --}}
<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg flex-md-column-reverse">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="text-center" id="exampleModalLabel">ລາຍລະອຽດອໍເດີ້</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @foreach($order->order_details as $item)
            <div class="row justify-content-between">
                <div class="col-4">
                    <p>ຊື່ສິນຄ້າ: {{$item->product_name}} | ຈຳນວນ: {{$item->amount}}</p>
                </div>
                <div class="col-4">
                    <p>ລາຄາ: {{$item->price}} ກີບ</p>
                </div>
                <hr>
            </div>
            @endforeach
            <div class="row justify-content-center">
                <div class="col-4">
                    <p>ລວມເງິນທັງໝົດ: {{$order->total}} ກີບ</p>
                </div>
            </div>
            </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="#">ສັ່ງພີມ</a>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">ປິດ</button>
            </div>
      </div>
    </div>
  </div>

  {{--view order product with offcanvas --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h4 id="offcanvasRightLabel" class="text-center">ລາຍລະອຽດອໍເດີ້</h4>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    @foreach($order->order_details as $item)
            <div class="row justify-content-between">
                <div class="col-6">
                    <p>ຊື່ສິນຄ້າ: {{$item->product_name}} | ຈຳນວນ: {{$item->amount}}</p>
                </div>
                <div class="col-5">
                    <p>ລາຄາ: {{$item->price}} ກີບ</p>
                </div>
                <hr>
            </div>
            @endforeach
            <div class="row justify-content-center">
                <div class="col-8">
                    <p>ລວມເງິນທັງໝົດ: {{$order->total}} ກີບ</p>
                </div>
                
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary me-md-2" >ສັ່ງພີມ</a>
              </div>
            </div>
                <div class="modal-footer">
            </div>
    </div>
</div>
@endsection

<style>
    .container{
        font-family: noto sans lao;
    }
    .modal{
        font-family: noto sans lao;
    }
</style>