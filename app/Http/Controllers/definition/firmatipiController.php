<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\firmatipi;

class firmatipiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $firmatipi=firmatipi::paginate(10);
        return view('definition.firmatipi.index',compact('firmatipi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('definition.firmatipi.create');
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
            'name'=>'required']);
        $firmatipi = new firmatipi([
            'name'=> $request ->get('name')]);
        $firmatipi->save();
        return redirect('/firmatipi/firmatipi')->with('success','Firma Tipi Ekleme Başarılı..');
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
        $firmatipi=firmatipi::find($id);
        return view('definition.firmatipi.edit',compact('firmatipi'));
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
            'name' => 'required']);
        $firmatipi = firmatipi::find($id);
        $firmatipi ->name = $request->get('name');
        $firmatipi -> save();
        return redirect('/firmatipi/firmatipi')->with('success','Firma Tipi Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $firmatipi = firmatipi::find($id);
        $firmatipi -> delete();
        return redirect('/firmatipi/firmatipi')->with('success','Firma Tipi Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = firmatipi::where('name','like','%'.$search.'%')->paginate(10);
        return view('definition.firmatipi.index',['firmatipi'=> $posts]);
    }
}
