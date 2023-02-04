<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index')->with('products', $products);
        return view('/welcome');
        
    }

    public function create()
    {
        return view('products.create');
    }

    public function products(Request $request){
        
    }
    public function store(Request $request)
    {
        //input data only dont have image

        // $prepareProduct=[
        //     'name'=>$request->name,
        //     'price'=>$request->price,
        //     'user_id'=>Auth::id()
        // ];
        // $products = Product::create($prepareProduct);


        // $request->validate([
        //     'name'=>'required',
        //     'price' => 'required',
        // ]);
        // if($request->hasFile('file')){
        //     $request->validate([
        //         'image'=>'mimes:jpg,jpeg,png,gif'
        //     ]);
        //     $request->file->store('image','public');
        //     $product = new Product([
        //         "name" => $request->get('name'),
        //         "price" => $request->get('price'),
        //         "user_id"=>Auth::id(),
        //         "file_path"=>$request->file->hashName()
        //     ]);
        //  $product->save();
        // }
        // return redirect()->route('products.index');
            
            if($request->hasfile('file'))
            {
                $product = new Product([
                "name" => $request->input('name'),
                "price"=> $request->input('price'),
                "user_id"=>Auth::id(),
                ]);
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $fillename = time().'.'.$extension;
                $file->move('public/image',$fillename);
                $product->file_path = $fillename;
            }
            $product->save();
            return redirect()->route('products.index');
            //input data and image
    }
 
    public function show(Product $product)
    {
        //
    }
    public function edit(Product $product)
    {
        return view('products.edit')->with('product',$product);
    }
    public function update(Request $request, Product $product)
    {
//update only data dont have image

        // $prepareProduct=[
        //     'name'=>$request->name,
        //     'price'=>$request->price,
        //     'user_id'=>Auth::id()
        // ];
        // $productupdate = Product::find($product->id);
        // $productupdate->update($prepareProduct);
        // return redirect()->route('products.index');

        
        $product = Product::find($product->id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        if($request->hasfile('file'))
            {
                $destination = 'public/image/'.$product->file_path;
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $fillename = time().'.'.$extension;
                $file->move('public/image/',$fillename);
                $product->file_path = $fillename;
            }
            $product->update();
            return redirect()->route('products.index');
            //update data and image 
    }
    public function search()
    {
        $search = $_GET['query'];
        $products = Product::where('name','LIKE','%'.$search.'%')->get();

        return view('products.search')->with('products',$products);
    }

    public function destroy(Product $product)
    {
        $productdelete = Product::find($product->id);
        $image_path = 'public/image/'.$product->file_path;
        if(File::exists($image_path)){
            File::delete($image_path);
        }else{
            $productdelete->delete();
        }
        $productdelete->delete();
        return redirect()->route('products.index');
    }
}
