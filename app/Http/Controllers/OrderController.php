<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 0 = ກະຕ໋າ,  1= ເຊັກເອົ້າ
        $order = Order::where('user_id',Auth::id())->where('status',0)->first();
        return view('order.index')->with('order',$order);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::find($request->product_id);
        $order = Order::where('user_id',Auth::id())->where('status',0)->first();
        if($order){
            $orderDetail = $order->order_details()->where('product_id',$product->id)->first();
            if($orderDetail){
                $amountNew = $orderDetail->amount + 1;
                $orderDetail -> update([
                    'amount' => $amountNew
                ]);
            }else{
                $prepareOrderdetail= [
                    'order_id' =>$order->id,
                    'product_id' => $product->id,
                    'product_name'=> $product->name,
                    'price'=> $product->price,
                    'amount' =>1,
                ];
                $orderDetail = OrderDetail::create($prepareOrderdetail);
            }
        }else{
            $prepareOrder=[
                'status'=>0,
                'user_id'=>Auth::id()
            ];
            
            $order = Order::create($prepareOrder);
    
            
            $prepareOrderdetail=[
                'order_id'=>$order->id,
                'product_id'=>$product->id,
                'product_name'=>$product->name,
                'amount'=>1,
                'price'=>$product->price,
            ];
            $orderDetail=OrderDetail::create($prepareOrderdetail);
        }
        
        $totalRaw = 0;
        $total = $order->order_details->map(function($orderDetail) use ($totalRaw){
                $totalRaw += $orderDetail->amount * $orderDetail->price;
                return $totalRaw;
        })->toarray();
        $order->update([
            'total'=> array_sum($total)
        ]);

        
        return redirect()->route('products.index');
        
    }
    public function show(Order $order)
    {
        return view('order.show');
    }
    public function searchProduct(Request $request){

    }
    public function edit(Order $order)
    {
        //
    }
    public function update(Request $request, Order $order)
    {
        //dont chectout 

        $orderDetail = $order->order_details()->where('product_id',$request->product_id)->first();
        if($orderDetail){
            if($request->value=="increase"){
                $amountNew = $orderDetail->amount + 1;
            }else{
                    $amountNew = $orderDetail->amount - 1;
                }
                
            $orderDetail->update([
                'amount'=> $amountNew
            ]);
        }

         $totalRaw = 0;
        $total = $order->order_details->map(function($orderDetail) use ($totalRaw){
                $totalRaw += $orderDetail->amount * $orderDetail->price;
                return $totalRaw;
        })->toarray();
        $order->update([
            'total'=> array_sum($total)
        ]);

        return redirect()->route('orders.index');    
        //return $request;

    }
    public function destroy(Request $request,Order $order)
    {
        $orderdelete = $order->order_details()->where('id',$request->id)->first();
        $orderdelete->delete();
        return redirect()->route('orders.index');
        
        //  $orderdelete = OrderDetail::find($order->id);
        // dd($orderdelete);
       
    }

    
}
