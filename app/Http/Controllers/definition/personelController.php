<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\models\departman;
use App\models\gorevlistesi;
use App\models\durum;
use App\models\personel;

class personelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        //$personel=personel::paginate(10);
        $personel=personel::where('durums_id','1')->paginate(10);
        $durum =durum::get();
        return view('definition.personel.index',compact('personel','durum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user= user::leftjoin('personels', 'users.id', '=', 'personels.users_id')->
        whereNull('personels.users_id')->select('users.id','users.username')->get();
        $departman = departman::get();
        $gorevlistesi = gorevlistesi::get();
        $durum= durum::get();
        return view('definition.personel.create',['user'=>$user, 'departman'=>$departman,'gorevlistesi'=>$gorevlistesi,'durum'=>$durum]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $personel = new personel([
            'name'=> $request ->get('name'),
            'surname'=>$request ->get('surname'),
            'tel' => $request ->get('tel'),
            'departman_id'=>$request ->get('departman_id'),
            'gorevlistesis_id'=>$request ->get('gorevlistesis_id'),
            'gtrh'=>$request ->get('gtrh'),
            'ctrh'=>$request ->get('ctrh'),
            'durums_id'=>$request ->get('durums_id'),
            'users_id'=>$request ->get('users_id'),
            'adres'=>$request ->get('adres')
        ]);
        $personel->save();
        return redirect('/personel/personel')->with('success','Personel Ekleme Başarılı..');

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
        $personel=personel::find($id);
        $user= User::get();
        $departman = departman::get();
        $gorevlistesi = gorevlistesi::get();
        $durum= durum::get();
        return view('definition.personel.edit',compact('personel','user','departman','durum','gorevlistesi'));
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
        
        
        $personel = personel::find($id);
        $personel ->name = $request->get('name');
        $personel ->surname= $request->get('surname');
        $personel ->tel= $request->get('tel');
        $personel ->departman_id= $request->get('departman_id');
        $personel ->gorevlistesis_id= $request->get('gorevlistesis_id');
        $personel ->gtrh= $request->get('gtrh');
        $personel ->ctrh= $request->get('ctrh');
        $personel ->durums_id= $request->get('durums_id');
        $personel ->users_id= $request->get('users_id');
        $personel ->adres= $request->get('adres');
        $personel -> save();
        return redirect('/personel/personel')->with('success','Personel Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $personel = personel::find($id);
        $personel -> delete();
        return redirect('/personel/personel')->with('success','Personel Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = personel::where('name','like','%'.$search.'%')->paginate(10);
        return view('definition.personel.index',['personel'=> $posts]);
    }
    public function list ($list)
    {
        $personel = personel::where('durums_id','=',$list)->paginate(10);
        $durum = durum::get();
        return view('definition.personel.index',compact('personel','durum'));
    }
}
