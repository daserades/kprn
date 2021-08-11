<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\departman;

class departmanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $departman=departman::paginate(10);
        return view('definition.departman.index',compact('departman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('definition.departman.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // departman::create($request->all());
        //return back()->with('sucses','Departman Eklema Başarılı..');
        $departman = new departman([
            'name'=> $request ->get('name')]);
        $departman->save();
        return redirect('/departman/departman')->with('success','Departman Eklema Başarılı..');
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
        $departman=departman::find($id);
        return view('definition.departman.edit',compact('departman'));
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
        $departman = departman::find($id);
        $departman ->name = $request->get('name');
        $departman -> save();
        return redirect('/departman/departman')->with('success','Departman Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departman = departman::find($id);
        $departman -> delete();
        return redirect('/departman/departman')->with('success','Departman Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = departman::where('name','like','%'.$search.'%')->paginate(10);
        return view('definition.departman.index',['departman'=> $posts]);
    }
}
