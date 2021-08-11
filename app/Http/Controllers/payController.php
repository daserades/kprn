<?php

namespace App\Http\Controllers;

use App\models\order;
use Illuminate\Http\Request;
use App\models\cari;
use App\models\current;
use App\models\pay;
use App\models\paydetail;
use App\models\payloadtype;
use App\models\type;
use App\models\kur;
use App\models\firma;
use App\models\ship;
use Auth;
use Yajra\DataTables\DataTables;

class payController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pay.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $firma=firma::get();
        return view('pay.create',compact('firma'));
    }
    public function createdetail($id)
    {
        $pay=pay::where('id',$id)->with('paydetail')->first();
        $payloadtype=payloadtype::get();
        $type=type::get();
        $kur=kur::get();
        $ship=current::with('ship','order','pay','paydetail','kur')
        ->where('firma_id',$pay->firma_id)
        ->where('durum_id',1)
        ->get();

        return view('pay.createdetail',compact('pay','payloadtype','type','kur','ship'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $no=date('ymdHis');
        $request['no']=$no; $request['users_id']=Auth::id();
        $pay= pay::create($request->all());
        return redirect('pay/createdetail/'.$pay->id);
    }

    public function storedetail(Request $request)
    {        
    $pay=pay::where('id',$request->pay_id)->first();
    $request['users_id']= Auth::id();
    $paydetail=paydetail::create($request->all());

    cari::create([
         'firma_id'=>$pay->firma_id,
         'pay_id'=>$pay->id,
         'paydetail_id'=>$paydetail->id,
         'trh'=>now(),
          'vadetrh'=>$request->vadetrh,
          'alinantutar'=> $request->miktar,
          'kur_id'=>$request->kur_id,
          'aciklama'=>$pay->aciklama,
          'users_id'=> Auth::id()
    ]);
    current::create([
         'firma_id'=>$pay->firma_id,
         'pay_id'=>$pay->id,
         'paydetail_id'=>$paydetail->id,
         'vadetrh'=>$request->vadetrh,
         'paid'=> $request->miktar,
         'kur_id'=>$request->kur_id,
         'aciklama'=>$pay->aciklama,
         'durum_id'=>1,
         'option'=>2,
         'users_id'=> Auth::id()
    ]);
    return redirect('pay/createdetail/'.$request->pay_id);
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
        $pay=pay::where('id',$id)->first();
        $firma=firma::get();
        return view('pay.edit',compact('pay','firma'));
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
        $pay=pay::find($id);
        $cari = cari::where('pay_id',$id)->first();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pay = pay::find($id);
        $cari=cari::where('pay_id',$id)->delete();
        $pay -> delete();
        return redirect('/pay/pay')->with('success','Ödeme Silindi');
    }
    public function js()
    {
    $pay = pay::with('firma')->get();
        return Datatables::of($pay)
            ->addColumn('action', function ($pay) {
                $a= '<table><tr>
        <td><a href="pay/'.$pay->id.'" title="Detay" style="color:black"><i class="fas fa-desktop fa-1x"></i></a></td>
        <td><a href="createdetail/'.$pay->id.'" title="Ödeme Girişi" style="color:black"><i class="fas fa-plus-circle fa-1x"></i></a></td>
        <td><a href="pay/'.$pay->id.'/edit" style="color:black" title="Düzenle"><i class="far fa-edit fa-1x"></i></a></td>
        <td class="sil"><div class="delete-form">
        <form action="pay/'.$pay->id.'" method="POST">
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
    public function hook($id)
    {
        $cari=cari::where('id',$id)->first();
        return $cari;
    }
}
