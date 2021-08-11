<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\urunaltkategori;
use App\models\urunkategori;
use Auth;

class urunaltkategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function index()
    {
        $urunaltkategori=urunaltkategori::paginate(10);
        return view('definition.urunaltkategori.index',compact('urunaltkategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $urunkategori = urunkategori::all();
        return view('definition.urunaltkategori.create',compact('urunkategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $urunaltkategori = new urunaltkategori([
            'name'=> $request ->get('name'),
            'urunkategori_id'=> $request->get('urunkategori_id'),
            'users_id'=> Auth::id()
        ]);
        $urunaltkategori->save();
        return redirect('/urunaltkategori/urunaltkategori')->with('success','Alt Kategori Başarılı..');
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
        $urunaltkategori=urunaltkategori::find($id);
        $urunkategori = urunkategori::all();
        return view('definition.urunaltkategori.edit',compact('urunaltkategori','urunkategori'));
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
            'urunkategori_id'=>'required']);
        $urunaltkategori = urunaltkategori::find($id);
        $urunaltkategori ->name = $request->get('name');
        $urunaltkategori ->urunkategori_id= $request->get('urunkategori_id');
        $urunaltkategori ->users_id= Auth::id();
        $urunaltkategori -> save();
        return redirect('/urunaltkategori/urunaltkategori')->with('success','Alt Kategori Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $urunaltkategori = urunaltkategori::find($id);
        $urunaltkategori -> delete();
        return redirect('/urunaltkategori/urunaltkategori')->with('success','Alt Kategori Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = urunaltkategori::where('name','like','%'.$search.'%')->paginate(10);
        return view('definition.urunaltkategori.index',['urunaltkategori'=> $posts]);
    }
}
