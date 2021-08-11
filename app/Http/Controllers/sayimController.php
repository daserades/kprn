<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\sayim;
use App\models\urun;
use App\models\bot;
use App\models\botdetail;
use App\models\store;
use App\models\storedetail;
use Auth;

class sayimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sayim=sayim::with('urun')->orderbydesc('updated_at')->get();
        return view('sayim.create',compact('sayim'));
        // return view('sayim.index',compact('sayim'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        storedetail::where('sayim',1)->update(['sayim'=>0]);
        sayim::query()->truncate();
        return redirect('sayim/sayim');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          if ( strlen($request->barcode) == 19 || strlen($request->barcode) ==20)
        {
            $urun_id=storedetail::Where('no',$request->barcode)->where('sayim',0)->first();
                if(isset($urun_id))
                {
                    $sayim=sayim::where('urun_id',$urun_id->urun_id)->first();
                    if(isset($sayim))
                    {
                        $sayim->increment('miktar');
                    }
                    else 
                    {
                        $sayim=sayim::create(['urun_id'=>$urun_id->urun_id,
                                              'miktar'=> 1]);
                    }
                        $urun_id->sayim =1; $urun_id->save();
                        return redirect('sayim/sayim')->with('success','Ürün Eklendi.');
                }
                else return back()->with('error','Hatalı Ürün (Stokda Olmayan Ürün Yada Okutulmuş Ürün Olabilir!)');
        }
        elseif(strlen($request->barcode) == 14 )
        {
            $bot=bot::where('barcode',$request->barcode)->with('botdetail')->first();
            foreach ($bot->botdetail as $list) 
            {
                $urun_id=storedetail::Where('no',$list->barcode)->where('sayim',0)->first();
                if(isset($urun_id))
                {
                    $sayim=sayim::where('urun_id',$urun_id->urun_id)->first();
                    if(isset($sayim))
                    {
                        $sayim->increment('miktar');
                    }
                    else 
                    {
                        $sayim=sayim::create(['urun_id'=>$urun_id->urun_id,
                                              'miktar'=> 1]);
                    }
                        $urun_id->sayim =1; $urun_id->save();
                }
            }
                        return redirect('sayim/sayim')->with('success','Ürünler Eklendi.');
        }
        else return back()->with('error','Hatalı Barkod (Stokda Olmayan Bir Barkod!)'); 
    }
    public function bitir()
    {
        // $sayim= sayim::get();
        // foreach ($sayim as $list) {
        //  storedetail::where('sayim',0)->where('urun_id',$list->urun_id)->delete();
        // store::query()->truncate();
        // }

        // storedetail::where('sayim',0)->delete();
        // store::query()->truncate();
        
        // $storedetail = storedetail::get();
        // foreach ($storedetail as $list) {
        //     $store=store::where('urun_id',$list->urun_id)->first();
        //     if(isset($store))
        //     {
        //         $store->increment('miktar',1);
        //     }
        //     else
        //     {
        //         store::create([
        //             'urun_id'=> $list->urun_id,
        //             'miktar' => 1,
        //             'users_id'=> Auth::id()
        //         ]);
        //     }
        // }
        // return redirect('sayim/sayim');
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
