<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\firma;
use App\models\kur;
use App\models\quality;
use App\models\qualitydetail;
use App\models\qualitytype;
use App\models\urun;
use App\models\unit;
use App\models\cari;
use App\models\current;
use Yajra\Datatables\Datatables;
use Auth;

class qualityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('quality.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $firma=firma::orderby('name')->get();
        $kur=kur::get();
        return view('quality.create',compact('firma','kur'));
    }

    public function qualitydetail($id)
    {
        $quality=quality::with('qualitydetail.urun','qualitydetail.qualitytype')->find($id);
        $urun=urun::where('urunturu_id',3)->get();
        $unit=unit::get();
        $qualitytype=qualitytype::get();
        return view('quality.qualitydetailcreate',compact('quality','qualitytype','urun','unit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['users_id']=Auth::id();
        $quality=quality::create($request->all());
        return redirect(route('qualitydetail',$quality->id));   
    }

    public function qualitydetailstore(Request $request)
    {
        $request['users_id']=Auth::id();
        $sum=$request->amount * $request->price;
         $request['sum'] = str_replace([',', ','], ['.', '.'], $sum);
        qualitydetail::create($request->all());
        return back();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
    {
        $quality=quality::with('qualitydetail.urun','qualitydetail.qualitytype')->find($id);
        return view('quality.show',compact('quality'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quality=quality::find($id);
        $firma=firma::get();
        $kur=kur::get();
        return view('quality.edit',compact('quality','firma','kur'));
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
        if(empty($request['dispatchno']))
        {
        $request['users_id']=Auth::id();
        $quality=quality::find($id)->update($request->all());
        return redirect(route('quality.index'));
        }
        else 
        {

        $request['users_id']=Auth::id();
        $quality=quality::where('id',$id)->with('qualitydetail')->first();
        quality::find($id)->update($request->all());

         $dtutar = str_replace([',', ','], ['.', '.'], $quality->qualitydetail->sum('sum'));
                              $cari=cari::create([
                              'firma_id'=>$request->firma_id,
                              'trh'=>now(),
                              'quality_id'=>$id,
                              'vadetrh'=>now(),
                              'tutar'=> $dtutar,
                              'kur_id'=>$quality->qualitydetail[0]->kur_id,
                              'users_id'=> Auth::id()
                              ]);
                              $current=current::create([
                              'firma_id'=>$request->firma_id,
                              'quality_id'=>$id,
                              'vadetrh'=>now(),
                              'debt'=> $dtutar,
                              'kur_id'=>$quality->qualitydetail[0]->kur_id,
                              'durum_id'=> 1,
                              'option'=> 1,
                              'users_id'=> Auth::id()
                              ]);
        return back();
        }

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

        public function js()
    {
        $quality=quality::with('firma','kur')->orderbydesc('id')->get();
        return Datatables::of($quality)
      ->addColumn('action', function ($quality) {
        $a= '<table><tr>
        <td><a href="quality/'.$quality->id.'" title="Detay" style="color:black"><i class="fas fa-desktop fa-1x"></i></a></td>
        <td><a href="'.route('qualitydetail',$quality->id).'" title="Ürün Ekle" style="color:black"><i class="fas fa-plus-circle fa-1x"></i></a></td>
        <td><a href="quality/'.$quality->id.'/edit" style="color:black" title="Düzenle"><i class="far fa-edit fa-1x"></i></a></td>
        <td class="sil"><div class="delete-form">
        <form action="quality/'.$quality->id.'" method="POST">
        <input type="hidden" name="_token" value="'.csrf_token().'">
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" style="color:red"  title="Sil"><i class="far fa-trash-alt"></i></button>
        </form>
        </div></td></tr></table>';
        return $a;
      })
      ->removeColumn('password')
      ->make(true);
    }
}
