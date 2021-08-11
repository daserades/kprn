<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use\App\models\urunkategori;
use Auth;

class urunkategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {

        $urunkategori=urunkategori::paginate(10);
        return view('definition.urunkategori.index',compact('urunkategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('definition.urunkategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // urunkategori::create($request->all());
        //return back()->with('sucses','urunkategori Eklema Başarılı..');
        $urunkategori = new urunkategori([
            'name'=> $request ->get('name'),
            'users_id'=> Auth::id()
        ]);
        $urunkategori->save();
        return redirect('/urunkategori/urunkategori')->with('success','Tür Eklema Başarılı..');
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
        $urunkategori=urunkategori::find($id);
        return view('definition.urunkategori.edit',compact('urunkategori'));
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
        $urunkategori = urunkategori::find($id);
        $urunkategori ->name = $request->get('name');
        $urunkategori ->users_id = Auth::id();
        $urunkategori -> save();
        return redirect('/urunkategori/urunkategori')->with('success','Tür Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $urunkategori = urunkategori::find($id);
        $urunkategori -> delete();
        return redirect('/urunkategori/urunkategori')->with('success','Tür Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = urunkategori::where('name','like','%'.$search.'%')->paginate(10);
        return view('definition.urunkategori.index',['urunkategori'=> $posts]);
    }
}
