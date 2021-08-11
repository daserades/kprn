<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\price;
use App\models\urun;
use Auth;


class priceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $urun = urun::orderBy('id','desc')->paginate(20);
        return view('definition.price.index',compact('urun'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $urun = $request-> get('urun_id');
        $deger = str_replace(",",".",$request->get('deger'));
        $price=price::where('urun_id',$urun)->value('price');
        if ($price)
        {
        price::where('urun_id',$urun)->update(['price' => $deger,'price2'=>$price]);
        }
        else
        {  
        price::insert(['urun_id'=>$urun,'price'=>$deger,'users_id'=>Auth::id()]);
        }
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
    public function search (Request $request){
         $search = $request-> get('search');
        $posts = urun::where('name','like','%'.$search.'%')->
                     orwhere('no','like','%'.$search.'%')->
                     orderBy('id','desc')->
                        paginate(100);
        return view('definition.price.index',['urun'=> $posts]);
    }
}
