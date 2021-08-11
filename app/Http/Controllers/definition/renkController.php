<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\renk;

class renkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $renk=renk::paginate(10);
        return view('definition.renk.index',compact('renk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('definition.renk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // renk::create($request->all());
        //return back()->with('sucses','renk Eklema Başarılı..');
        $renk = new renk([
            'name'=> $request ->get('name')]);
        $renk->save();
        return redirect('/renk/renk')->with('success','Renk Eklema Başarılı..');
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
        $renk=renk::find($id);
        return view('definition.renk.edit',compact('renk'));
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
        $renk = renk::find($id);
        $renk ->name = $request->get('name');
        $renk -> save();
        return redirect('/renk/renk')->with('success','Renk Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $renk = renk::find($id);
        $renk -> delete();
        return redirect('/renk/renk')->with('success','Renk Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = renk::where('name','like','%'.$search.'%')->paginate(10);
        return view('definition.renk.index',['renk'=> $posts]);
    }
}
