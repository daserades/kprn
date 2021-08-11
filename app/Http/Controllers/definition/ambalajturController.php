<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\ambalajtur;

class ambalajturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {

        $ambalajtur=ambalajtur::paginate(10);
        return view('definition.ambalajtur.index',compact('ambalajtur'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('definition.ambalajtur.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // ambalajtur::create($request->all());
        //return back()->with('sucses','ambalajtur Eklema Başarılı..');
        $ambalajtur = new ambalajtur([
            'name'=> $request ->get('name')]);
        $ambalajtur->save();
        return redirect('/ambalajtur/ambalajtur')->with('success','Tür Eklema Başarılı..');
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
        $ambalajtur=ambalajtur::find($id);
        return view('definition.ambalajtur.edit',compact('ambalajtur'));
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
        $ambalajtur = ambalajtur::find($id);
        $ambalajtur ->name = $request->get('name');
        $ambalajtur -> save();
        return redirect('/ambalajtur/ambalajtur')->with('success','Tür Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ambalajtur = ambalajtur::find($id);
        $ambalajtur -> delete();
        return redirect('/ambalajtur/ambalajtur')->with('success','Tür Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = ambalajtur::where('name','like','%'.$search.'%')->paginate(10);
        return view('definition.ambalajtur.index',['ambalajtur'=> $posts]);
    }
}
