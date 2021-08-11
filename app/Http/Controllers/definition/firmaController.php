<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\firma;
use App\models\firmatipi;
use App\models\durum;
use App\models\country;
use App\models\alicisatici;
use App\models\personel;
use App\models\city;
use App\models\kur;
use Yajra\Datatables\Datatables;
use App\models\faturatipi;
use App\User;
use Auth;

class firmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        // $firma=firma::paginate(10);
        //$firma=firma::where('durums_tb_id','1')->paginate(10);
        return view('definition.firma.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $durum= durum::get();
        $firmatipi= firmatipi::get();
        $nakliye= firma::where('firmatipi_id',2)->get();
        $country= country::get();
        $kur= kur::get();
        $faturatipi= faturatipi::get();
        $personel= personel::get();
        $alicisatici= alicisatici::get();
        return view('definition.firma.create',['kur'=>$kur,'personel'=>$personel,'faturatipi'=>$faturatipi,'firmatipi'=>$firmatipi,'nakliye'=>$nakliye,'durum'=>$durum,'country'=>$country,'alicisatici'=>$alicisatici]);
    }
    public function city($id)
    {
        $city= city::where('countries_id',$id)->get();
        return $city;
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
        $firma =firma::create($request->all());
        return redirect('/firma/firma')->with('success','Firma Ekleme Başarılı..');

    }   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
    {
        $firma=firma::find($id);
        return view('definition.firma.show',compact('firma'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $firma=firma::find($id);
        $firmatipi= firmatipi::get();
        $durum= durum::get();
        $nakliye= firma::where('firmatipi_id',2)->get();
        $nakliye1= firma::where('id',$firma['nakliye1_id'])->first();
        $nakliye2= firma::where('id',$firma['nakliye2_id'])->first();
        $country= country::get();
        $faturatipi= faturatipi::get();
        $city= city::get();
        $kur= kur::get();
        $personel= personel::get();
        $alicisatici= alicisatici::get();
        return view('definition.firma.edit',compact('personel','kur','firma','faturatipi','firmatipi','durum','alicisatici','nakliye','nakliye1','nakliye2','country','city'));
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
        $firma = firma::find($id);
        $firma ->name = $request->get('name');
        $firma ->firmatipi_id= $request->get('firmatipi_id');
        $firma ->unvan= $request->get('unvan');
        $firma ->vergidairesi= $request->get('vergidairesi');
        $firma ->verginumarasi= $request->get('verginumarasi');
        $firma ->tel1= $request->get('tel1');
        $firma ->tel2= $request->get('tel2');
        $firma ->fax1= $request->get('fax1');
        $firma ->fax2= $request->get('fax2');
        $firma ->email1 = $request->get('email1');
        $firma ->email2= $request->get('email2');
        $firma ->adres1= $request->get('adres1');
        $firma ->adres2= $request->get('adres2');
        $firma ->countries_id= $request->get('countries_id');
        $firma ->cities_id= $request->get('cities_id');
        $firma ->banka= $request->get('banka');
        $firma ->sube= $request->get('sube');
        $firma ->hesapno= $request->get('hesapno');
        $firma ->iban= $request->get('iban');
        $firma ->website= $request->get('website');
        $firma ->durums_id= $request->get('durums_id');
        $firma ->alicisatici_id= $request->get('alicisatici_id');
        $firma ->nakliye1_id= $request->get('nakliye1_id');
        $firma ->nakliye2_id= $request->get('nakliye2_id');
        $firma ->aciklama= $request->get('aciklama');
        $firma ->kur_id= $request->get('kur_id');
        $firma ->faturatipi_id= $request->get('faturatipi_id');
        $firma ->personel_id= $request->get('personel_id');
        $firma ->firma_limit= $request->get('firma_limit');
        $firma ->ticarikod= $request->get('ticarikod');
        $firma ->users_id= Auth::id();
        $firma -> save();
        return redirect('/firma/firma')->with('success','Firma Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $firma = firma::find($id);
        $firma -> delete();
        return redirect('/firma/firma')->with('success','Firma Silindi');
    }
    // public function search (Request $request){
    //     $search = $request-> get('search');
    //     $posts = firma::where('name','like','%'.$search.'%')->paginate(10);
    //     return view('definition.firma.index',['firma'=> $posts]);
    // }
        public function js()
    {
        $firma=firma::with('firmatipi','durum')->orderbydesc('id')->get();
        return Datatables::of($firma)
      ->addColumn('action', function ($firma) {
        $a= '<table><tr>
        <td><a href="firma/'.$firma->id.'" title="Detay" style="color:black"><i class="fas fa-desktop fa-1x"></i></a></td>
        <td><a href="cari/'.$firma->id.'" title="CARİ" style="color:black"><i class="fas fa-hand-holding-usd fa-1x"></i></a></td>
        <td><a href="firma/'.$firma->id.'/edit" style="color:black" title="Düzenle"><i class="far fa-edit fa-1x"></i></a></td>
        <td class="sil"><div class="delete-form">
        <form action="firma/'.$firma->id.'" method="POST">
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
    public function cari($id)
    {
        $firma=firma::with(['cari'
            =>function($q) {$q->orderby('trh');}
            ,'cari.pay','cari.ship'])->where('id',$id)->first();
        return view('definition.firma.cari',compact('firma'));
    }
}
