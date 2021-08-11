<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\paketiciozellik;

class paketiciozellikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {

        $paketiciozellik=paketiciozellik::paginate(10);
        return view('definition.paketiciozellik.index',compact('paketiciozellik'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('definition.paketiciozellik.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // paketiciozellik::create($request->all());
        //return back()->with('sucses','paketiciozellik Eklema Başarılı..');
        $paketiciozellik = new paketiciozellik([
            'name'=> $request ->get('name')]);
        $paketiciozellik->save();
        return redirect('/paketiciozellik/paketiciozellik')->with('success','Özellik Eklema Başarılı..');
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
        echo "show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paketiciozellik=paketiciozellik::find($id);
        return view('definition.paketiciozellik.edit',compact('paketiciozellik'));
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
        $paketiciozellik = paketiciozellik::find($id);
        $paketiciozellik ->name = $request->get('name');
        $paketiciozellik -> save();
        return redirect('/paketiciozellik/paketiciozellik')->with('success','Özellik Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paketiciozellik = paketiciozellik::find($id);
        $paketiciozellik -> delete();
        return redirect('/paketiciozellik/paketiciozellik')->with('success','Özellik Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = paketiciozellik::where('name','like','%'.$search.'%')->paginate(10);
        return view('definition.paketiciozellik.index',['paketiciozellik'=> $posts]);
    }
}
