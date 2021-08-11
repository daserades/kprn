<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\firma;
use App\models\firmadetay;
use App\models\kur;
use Yajra\Datatables\Datatables;
use Auth;
class firmadetayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $firmadetay=firmadetay::paginate(10);
        return view('definition.firmadetay.index',compact('firmadetay'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $firma= firma::orderby('name')->get();
        $kur= kur::get();
        return view('definition.firmadetay.create',compact('firma','kur'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $firmadetay = new firmadetay([
            'firma_id'=> $request ->get('firma_id'),
            'vade'=> $request ->get('vade'),
            'iskonta'=> $request ->get('iskonta'),
            'kur_id'=> $request ->get('kur_id'),
            'limit'=> $request ->get('limit'),
            'users_id'=>Auth::id()
        ]);
        $firmadetay->save();
        return redirect('/firmadetay/firmadetay')->with('success','Firma Detay Ekleme Başarılı..');

    }   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
    {
        $firmadetay=firmadetay::find($id);
        return view('definition.firmadetay.show',compact('firmadetay'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $firmadetay=firmadetay::find($id);
        $firma= firma::get();
        $kur= kur::get();
        return view('definition.firmadetay.edit',compact('firmadetay','firma','kur'));
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
        $firmadetay = firmadetay::find($id);
        $firmadetay ->firma_id= $request->get('firma_id');
        $firmadetay ->kur_id= $request->get('kur_id');
        $firmadetay ->vade= $request->get('vade');
        $firmadetay ->iskonta= $request->get('iskonta');
        $firmadetay ->limit= $request->get('limit');
        $firmadetay ->users_id= Auth::id();
        $firmadetay -> save();
        return redirect('/firmadetay/firmadetay')->with('success','Firma Detay Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $firmadetay = firmadetay::find($id);
        $firmadetay -> delete();
        return redirect('/firmadetay/firmadetay')->with('success','Firma Detay Silindi');
    }
    // public function search (Request $request){
    //     $search = $request-> get('search');
    //     $posts = firmadetay::where('vade','like','%'.$search.'%')->paginate(10);
    //     return view('definition.firmadetay.index',['firmadetay'=> $posts]);
    // }

     public function js()
    {
        $firmadetay=firmadetay::with('firma')->orderbydesc('id')->get();
        return Datatables::of($firmadetay)
      ->addColumn('action', function ($firmadetay) {
        $a= '<table><tr>
        <td><a href="firmadetay/'.$firmadetay->id.'/edit" style="color:black" title="Düzenle"><i class="far fa-edit fa-1x"></i></a></td>
        <td class="sil"><div class="delete-form">
        <form action="firmadetay/'.$firmadetay->id.'" method="POST">
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
