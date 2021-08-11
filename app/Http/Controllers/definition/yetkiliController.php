<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\yetkili;
use App\models\firma;
use App\models\gorevlistesi;
use Auth;

class yetkiliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        $yetkili=yetkili::paginate(10);
        //$yetkili=yetkili::where('durums_tb_id','1')->paginate(10);
        return view('definition.yetkili.index',compact('yetkili'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $firma = firma::get();
        $gorevlistesi = gorevlistesi::get();
        return view('definition.yetkili.create',['firma'=>$firma,'gorevlistesi'=>$gorevlistesi]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $yetkili = new yetkili([
            'name'=> $request ->get('name'),
            'surname'=>$request ->get('surname'),
            'firma_id'=>$request ->get('firma_id'),
            'gorevlistesi_id'=>$request ->get('gorevlistesi_id'),
            'tel' => $request ->get('tel'),
            'ceptel' => $request ->get('ceptel'),
            'email'=>$request ->get('email'),
            'aciklama'=>$request ->get('aciklama'),
            'users_id'=>Auth::id()
        ]);
        $yetkili->save();
        return redirect('/yetkili/yetkili')->with('success','Yetkili Ekleme Başarılı..');

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
        $yetkili=yetkili::find($id);
        $firma = firma::get();
        $gorevlistesi = gorevlistesi::get();
        return view('definition.yetkili.edit',compact('yetkili','firma','gorevlistesi'));
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
        
        $yetkili = yetkili::find($id);
        $yetkili ->name = $request->get('name');
        $yetkili ->surname= $request->get('surname');
        $yetkili ->firma_id= $request->get('firma_id');
        $yetkili ->gorevlistesi_id= $request->get('gorevlistesi_id');
        $yetkili ->tel= $request->get('tel');
        $yetkili ->ceptel= $request->get('ceptel');
        $yetkili ->email= $request->get('email');
        $yetkili ->aciklama= $request->get('aciklama');
        $yetkili ->users_id=Auth::id();
        $yetkili -> save();
        return redirect('/yetkili/yetkili')->with('success','Yetkili Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $yetkili = yetkili::find($id);
        $yetkili -> delete();
        return redirect('/yetkili/yetkili')->with('success','Yetkili Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = yetkili::where('name','like','%'.$search.'%')->paginate(10);
        return view('definition.yetkili.index',['yetkili'=> $posts]);
    }
}
