<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;


class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::all();
        return view('slide.index')->compact('slide');
    }

    public function create()
    {
        return view('slide.create');
    }
    public function store(Request $request)
    {
        
        if($request->hasFile('image_slide')){
            $file = $request->file('image_slide');
            $extension = $file->getClientOriginalExtension();
            $fillename = time().'.'.$extension;
            $file->move('public/slide',$fillename);
            $slides->image_slide=$fillename;
        }
        $slides->save();
        return redirect()->route('slides.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
