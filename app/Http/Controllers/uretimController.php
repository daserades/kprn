<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\models\uretim;
use App\models\urun;
use App\models\store;
use App\models\storedetail;
use App\models\botdetail;
use App\models\bot;
use Auth;

class uretimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$urun = urun::where('urunturu_id',1)->where('durum_id',1)->orderBy('id','desc')->paginate(10);
        return view('uretim.index');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {       
        $urun=urun::where('id',$id)->first();
        return view('uretim.create',compact('id','urun'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sql=urun::where('id',$request->get('id'))->select('barkod')->first();
        //return $sql;
        $barkod=mb_substr($sql['barkod'], -6, -1, 'utf8');
        $uretimno = uretim::where('no','like',date('Ymd').$barkod.'%')->select('no')->orderBy('no', 'desc')->first();
         if($uretimno) 
         {
         $getno = mb_substr($uretimno->no, -6, null, 'utf8'); $getno = $getno+1;
         $no=str_pad($getno, 6 , "0",STR_PAD_LEFT);
         $no =  date('Ymd').$barkod.$no; 
         }
         else {$no =  date('Ymd').$barkod.'000001';}
         $uretim = new uretim ([
                'no'=> $no,
                'urun_id'=>$request->get('id'),
                'users_id'=>Auth::id()
         ]);
         $storedetail= new storedetail ([
                'no'=> $no,
                'urun_id'=>$request->get('id'),
                'sayim'=>1,
                'users_id'=>Auth::id()
         ]);
         $uretim->save();
         $storedetail->save();
        if  (store::where('urun_id',$request->get('id'))->first())
        {
            store::where('urun_id',$request->get('id'))->increment('miktar',1);
        }else {
            store::insert(['urun_id'=>$request->get('id'),'miktar'=>1,'users_id'=>Auth::id()]);
        }
         return view('uretim.barcode',compact('uretim'))->with('success','Üretildi..');
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
       
    }

    public function js()
    {
        $uretim=urun::with('urunturu')->where('durum_id',1)->whereNotNull('barkod')->orderBy('id','desc')->get();
        return Datatables::of($uretim)
      ->addColumn('action', function ($uretim) {
        $a= '<table><tr>
        <td><a href="create/'.$uretim->id.'" title="ÜRET" style="color:black"><i class="far fa-plus-square fa-2x"></i></a></td>
        <td><a href="topluetiket/'.$uretim->id.'" title="TOPLU ÜRETİM" style="color:black"><i class="far fa-clone fa-2x"></i></a></td>
        </tr></table>';
        return $a;
      })
      ->removeColumn('password')
      ->make(true);
    }
       public function topluetiket($id)
    {
        $urun=urun::where('id',$id)->first();
        return view('uretim.topluetiket',compact('id','urun'));
    }

    public function etiket (Request $request)
    {
            $array=[];
             $sql=urun::where('id',$request->get('urun_id'))->first();
         for ($i=0; $i < $request->sayi; $i++)
         {
            $barkod=mb_substr($sql['barkod'], -6, -1, 'utf8');
            $uretimno = uretim::where('no','like',date('Ymd').$barkod.'%')->select('no')->orderBy('no', 'desc')->first();
             if($uretimno) 
             {
             $getno = mb_substr($uretimno->no, -6, null, 'utf8'); $getno = $getno+1;
             $no=str_pad($getno, 6 , "0",STR_PAD_LEFT);
             $no =  date('Ymd').$barkod.$no; 
             }
             else {$no =  date('Ymd').$barkod.'000001';}

             $uretim = new uretim ([
                    'no'=> $no,
                    'urun_id'=>$request->get('urun_id'),
                    'users_id'=>Auth::id()
             ]);
             $storedetail= new storedetail ([
                    'no'=> $no,
                    'urun_id'=>$request->get('urun_id'),
                    'sayim'=> 1,
                    'users_id'=>Auth::id()
             ]);
             $uretim->save();
             $storedetail->save();
             array_push($array,$uretim);
            if  (store::where('urun_id',$request->get('urun_id'))->first())
            {
                store::where('urun_id',$request->get('urun_id'))->increment('miktar',1);
            }else {
                store::insert(['urun_id'=>$request->get('urun_id'),'miktar'=>1,'users_id'=>Auth::id()]);
            }
         
        }
        return view('uretim.alletiket',compact('array','sql'));
    
}
    public function delete()
    {
        return view('uretim.delete');
    }

    public function etiketsilme(Request $request)
    {
        if (strlen($request->barcode) >= 19 )
        {
            $storedetail= storedetail::where('no',$request->barcode)->first();
            if(isset($storedetail))
            {
            uretim::where('no',$request->barcode)->delete();   
             store::where('urun_id',$storedetail->urun_id)->decrement('miktar',1);
              $storedetail->delete();
             return back()->with('success','Silme İşlemi Başarılı');
            }
            else return back()->with('error','Böyle Bir Barcode Bulunmamaktadır');
        }
        else return back()->with('error','Hatalı Barcode');
    }

    public function uretimbot()
    {
        $urun=urun::orderby('no')->orderby('name')->get();
        return view('uretim.uretimbot',compact('urun'));
    }

    public function uretimbotstore(Request $request)
    {
              $botarray=[];
         $sql=urun::where('id',$request->urun_id)->select('barkod')->first();
         if($sql)
        {    
            for($i=0; $i < $request->botadet; $i++)
             {   
                unset($array);$array=[]; 
                 for ($j=0; $j < $request->boticiadet; $j++)
                 {
                 $barkod=mb_substr($sql['barkod'], -6, -1, 'utf8');
                 $uretimno = uretim::where('no','like',date('Ymd').$barkod.'%')->select('no')->orderBy('no', 'desc')->first();
                  if($uretimno) 
                  {
                  $getno = mb_substr($uretimno->no, -6, null, 'utf8'); $getno = $getno+1;
                  $no=str_pad($getno, 6 , "0",STR_PAD_LEFT);
                  $no =  date('Ymd').$barkod.$no; 
                  }
                  else {$no =  date('Ymd').$barkod.'000001';}
                  $uretim = new uretim ([
                         'no'=> $no,
                         'urun_id'=>$request->urun_id,
                         'users_id'=>Auth::id()
                  ]);
                  $storedetail= new storedetail ([
                         'no'=> $no,
                         'urun_id'=>$request->urun_id,
                         'sayim'=>1,
                         'users_id'=>Auth::id()
                  ]);
                  array_push($array,$uretim);
                  $uretim->save();
                  $storedetail->save();
                 if  (store::where('urun_id',$request->urun_id)->first())
                 {
                     store::where('urun_id',$request->urun_id)->increment('miktar',1);
                 }else {
                     store::insert(['urun_id'=>$request->urun_id,'miktar'=>1,'users_id'=>Auth::id()]);
                 }

                 if( $j == ($request->boticiadet-1)) 
                        {
                            $barcode= bot::orderbydesc('id')->select('barcode')->first();
                            if($barcode) $barcode =$barcode->barcode +1; else $barcode=date('YmdHis');
                            $bot=bot::create(['barcode'=>$barcode,
                                        'users_id'=>Auth::id(),
                                        'type'=> count($array)
                                    ]);
                            foreach ($array as $list) 
                            {
                                botdetail::create([
                                    'bot_id'=> $bot->id,
                                    'urun_id'=> $list->urun_id,
                                    'barcode'=> $list->no,
                                    'users_id'=> Auth::id(),
                                    'created_at'=> now(),
                                    'updated_at'=> now()
                                ]);
                            }
                            $botdetail=bot::where('id',$bot->id)->with('botdetail.urun')->first();
                              array_push($botarray,$botdetail);

                        }   
                 }
            }
            return view('uretim.botetiket',compact('botarray'));
            // return $botarray;
        }
    }
}
