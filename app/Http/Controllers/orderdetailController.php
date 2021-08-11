<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\orderdetails;
use App\models\order;
use App\models\store;
use App\models\urunturu;
use App\models\urun;
use App\models\urunkategori;
use Auth;
use DB;
class orderdetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
    
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
        if($request->deger > 0)
        {
               $tutar= ($request->get('fiyat')) * ($request->get('deger'));
               if($request->get('kur_id')==1)
                $bakiye=$tutar;
                else
                $bakiye= $tutar*$request->get('bazkur');
                $orderdetails=orderdetails::where('order_id' ,$request->get('order_id'))->where('urun_id',$request->get('urun_id'))->first();
                if ($orderdetails)
                {
                 orderdetails::where('order_id' ,$request->get('order_id'))
                                ->where('urun_id',$request->get('urun_id'))
                                ->update(['miktar'=>$request->get('deger'),
                                            'kalan'=>$request->deger - $orderdetails->miktar+ $orderdetails->kalan,
                                            'tutar'=>$tutar,
                                            'bakiye'=>$bakiye,
                                            'listefiyat'=>$request->get('listefiyat'),
                                            'fiyat'=>$request->get('fiyat'),
                                            'kur_id'=>$request->get('kur_id'),
                                            'bazkur'=>$request->get('bazkur')
                                            ]);   
                    if($orderdetails['miktar'])store::where('urun_id',$request->urun_id)->increment('miktar',$orderdetails['miktar']);
                    if($request->deger)
                        {
                         if(store::where('urun_id',$request->urun_id)->first())   
                            {
                                store::where('urun_id',$request->urun_id)->decrement('miktar',$request->deger);
                            }
                            else 
                            {
                                store::insert([
                                    'urun_id'=>$request->urun_id,
                                    'miktar'=>'-'.$request->deger,
                                    'users_id'=>Auth::id()
                                ]);
                            }
                        }
                }
                else {
                    orderdetails::insert([
                        'order_id'=>$request->get('order_id'),
                        'urun_id'=>$request->get('urun_id'),
                        'kur_id'=>$request->get('kur_id'),
                        'listefiyat'=>$request->get('listefiyat'),
                        'fiyat'=>$request->get('fiyat'),
                        'bazkur'=>$request->get('bazkur'),
                        'miktar'=>$request->get('deger'),
                        'kalan'=>$request->get('deger'),
                        'tutar'=>$tutar,
                        'bakiye'=>$bakiye,
                        'users_id'=>Auth::id(),
                        'created_at'=> now()
                    ]);
                    if($request->deger)
                         {
                         if(store::where('urun_id',$request->urun_id)->first())   
                            {
                                store::where('urun_id',$request->urun_id)->decrement('miktar',$request->deger);
                            }
                            else 
                            {
                                store::insert([
                                    'urun_id'=>$request->urun_id,
                                    'miktar'=>'-'.$request->deger,
                                    'users_id'=>Auth::id()
                                ]);
                            }
                        }
                }
        }
        else {
            $orderdetails=orderdetails::where([['order_id',$request->order_id],['urun_id',$request->urun_id]])->delete();
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
        $order=order::with('orderdetails','firma')->where('id',$id)->first();
        $kategori = urunkategori::with(['urunaltkategori.urun'
          =>function($q) {$q->where('urunturu_id',1);}
          ,'urunaltkategori.urun.price','urunaltkategori.urun.models','urunaltkategori.urun.store','urunaltkategori.urun.storedetail'])->get();
        $urunturu= urunturu::get();
        $list=0;
        return view('orderdetail.create',compact('order','kategori','urunturu','list'));
    }

     public function list ($list,$id)
    {
        $order=order::with('orderdetails')->where('id',$id)->first();
        $kategori = urunkategori::with(['urunaltkategori.urun'
          =>function($q) use ($list){$q->where('urunturu_id',$list);}
          ,'urunaltkategori.urun.price','urunaltkategori.urun.models','urunaltkategori.urun.store','urunaltkategori.urun.storedetail'
          ])
        ->get();
        $urunturu= urunturu::get();
        // return $kategori;
        return view('orderdetail.create',compact('order','kategori','urunturu','list'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
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
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orderdetails = orderdetails::find($id);
        $orderdetails -> delete();
        return redirect('/orderdetails/orderdetails')->with('success','Sipariş Silindi');
    }
     public function search (Request $request)
    {
        $order=order::with('orderdetails','firma')->where('id',$request->order_id)->first();
        $no=$request->search;
        if($no>0)
        $kategori = urunkategori::with(['urunaltkategori.urun'
          =>function($q) use ($no) {$q->where('urunturu_id',1)->where('no',$no);}
          ,'urunaltkategori.urun.price','urunaltkategori.urun.models','urunaltkategori.urun.store','urunaltkategori.urun.storedetail'])->get();
      else $kategori = urunkategori::with(['urunaltkategori.urun'
          =>function($q) {$q->where('urunturu_id',1);}
          ,'urunaltkategori.urun.price','urunaltkategori.urun.models','urunaltkategori.urun.store','urunaltkategori.urun.storedetail'])->get();
        $urunturu= urunturu::get();
        $list=0;
        if(isset($no)) $link='true'; else $link='false';
        // return redirect('orderdetail/orderdetail/'.$request->order_id)->with('kategori',$kategori);
        return view('orderdetail.create',compact('order','kategori','urunturu','list','link'));
    }
}
