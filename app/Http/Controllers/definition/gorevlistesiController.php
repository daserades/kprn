<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\gorevlistesi;
use App\models\departman;
class gorevlistesiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gorevlistesi=gorevlistesi::paginate(10);
        return view('definition.gorevlistesi.index',compact('gorevlistesi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $departman = departman::all();
        return view('definition.gorevlistesi.create',compact('departman'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'name'=>'required',
            'departman_id'=>'required']);
        $gorevlistesi = new gorevlistesi([
            'name'=> $request ->get('name'),
            'departman_id'=> $request->get('departman_id')]);
        $gorevlistesi->save();
        return redirect('/gorevlistesi/gorevlistesi')->with('success','Görev Ekleme Başarılı..');
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
        $gorevlistesi=gorevlistesi::find($id);
        $departman = departman::all();
        return view('definition.gorevlistesi.edit',compact('gorevlistesi','departman'));
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
         $request->validate([
            'name' => 'required',
            'departman_id'=>'required']);
        $gorevlistesi = gorevlistesi::find($id);
        $gorevlistesi ->name = $request->get('name');
        $gorevlistesi ->departman_id= $request->get('departman_id');
        $gorevlistesi -> save();
        return redirect('/gorevlistesi/gorevlistesi')->with('success','Görev Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gorevlistesi = gorevlistesi::find($id);
        $gorevlistesi -> delete();
        return redirect('/gorevlistesi/gorevlistesi')->with('success','Görev Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = gorevlistesi::where('name','like','%'.$search.'%')->paginate(10);
        return view('definition.gorevlistesi.index',['gorevlistesi'=> $posts]);
    }
}
