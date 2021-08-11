<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\urunozellik;

class urunozellikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {

        $urunozellik=urunozellik::paginate(10);
        return view('definition.urunozellik.index',compact('urunozellik'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('definition.urunozellik.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // urunozellik::create($request->all());
        //return back()->with('sucses','urunozellik Eklema Başarılı..');
        $urunozellik = new urunozellik([
            'name'=> $request ->get('name')]);
        $urunozellik->save();
        return redirect('/urunozellik/urunozellik')->with('success','Tür Eklema Başarılı..');
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
        $urunozellik=urunozellik::find($id);
        return view('definition.urunozellik.edit',compact('urunozellik'));
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
        $urunozellik = urunozellik::find($id);
        $urunozellik ->name = $request->get('name');
        $urunozellik -> save();
        return redirect('/urunozellik/urunozellik')->with('success','Tür Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $urunozellik = urunozellik::find($id);
        $urunozellik -> delete();
        return redirect('/urunozellik/urunozellik')->with('success','Tür Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = urunozellik::where('name','like','%'.$search.'%')->paginate(10);
        return view('definition.urunozellik.index',['urunozellik'=> $posts]);
    }
}
