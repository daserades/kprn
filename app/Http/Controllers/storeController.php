<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\sayim;
use App\models\store;
use App\models\urun;
use App\models\storedetail;
use App\models\orderdetails;
use App\models\uretim;
use Yajra\Datatables\Datatables;
use Auth;
use DB;

class storeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('store.show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $store=urun::
        leftjoin('stores as s','uruns.id','=','s.urun_id')
        ->leftjoin('urunturus as ut','uruns.urunturu_id','=','ut.id')
        ->leftjoin(DB::raw("(SELECT 
            count(urun_id) as count,urun_id
              FROM storedetails
              GROUP BY urun_id
      ) as a"),function($join){
        $join->on("a.urun_id","=","uruns.id");
  })
        // ->where('uruns.durum_id',1)
        ->select('s.miktar','s.id','uruns.id as urun_id','uruns.name','uruns.no','a.count','ut.name as tur')
        ->get();
        return Datatables::of($store)
         ->addColumn('action', function ($store) {
        $a= '<table><tr>
        <td><a href="store/'.$store->id.'/edit" style="color:black" title="Ürün Sayım"><i class="far fa-edit fa-1x"></i></a></td>
        </tr></table>';
        return $a;
      })
      ->removeColumn('password')
      ->make(true);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         if ( strlen($request->barcode) == 19)
        {
            $urun_id=storedetail::Where('no',$request->barcode)->where('sayim',0)->first();
                if($urun_id->urun_id == $request->urun_id)
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
                        return back()->with('success','Ürün Eklendi.');
                }
                else return back()->with('error','Hatalı Ürün (Stokda Olmayan Ürün!)');
        }
        elseif(strlen($request->barcode) == 14 )
        {
            $bot=bot::where('barcode',$request->barcode)->with('botdetail')->first();
            foreach ($bot->botdetail as $list) 
            {
                $urun_id=storedetail::Where('no',$list->barcode)->where('sayim',0)->first();
                if($urun_id->urun_id == $request->urun_id)
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
                        return back()->with('success','Ürünler Eklendi.');
        }
        else return back()->with('error','Hatalı Barkod');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store=store::with('urun')->where('id',$id)->first();
        storedetail::where('sayim',1)->where('urun_id',$store->urun_id)->update(['sayim'=>0]);
        sayim::query()->truncate();   
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store=store::with('urun')->where('id',$id)->first();
        $sayim=sayim::with('urun')->where('urun_id',$store->urun_id)->first();
        return view('store.sayim',compact('store','sayim'));
    }

    public function bitir($id)
    {
        // storedetail::where('sayim',0)->where('urun_id',$id)->delete();
        // store::where('urun_id',$id)->delete();
        // $storedetail = storedetail::where('urun_id',$id)->get();
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
         storedetail::where('sayim',0)->where('urun_id',$id)->delete();
        store::where('urun_id',$id)->delete();
        $storedetail=0; $storedetail = storedetail::where('urun_id',$id)->count('id');
            $store=store::where('urun_id',$id)->first();
            $orderdetails=orderdetails::where('urun_id',$id)->sum('kalan');
            $miktar = ($storedetail)-($orderdetails);

            if(isset($store))
            {
                $store->increment('miktar',$miktar);
            }
            else
            {
                store::create([
                    'urun_id'=> $id,
                    'miktar' => $miktar,
                    'users_id'=> Auth::id()
                ]);
            }
        return redirect('store/store');
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

    }

}
