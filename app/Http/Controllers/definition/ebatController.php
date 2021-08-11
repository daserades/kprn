<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\ebat;
use Auth;
class ebatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {

        $ebat=ebat::paginate(10);
        return view('definition.ebat.index',compact('ebat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('definition.ebat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // ebat::create($request->all());
        //return back()->with('sucses','ebat Eklema Başarılı..');
        $ebat = new ebat([
            'name'=> $request ->get('name'),
            'en'=> $request ->get('en'),
            'boy'=> $request ->get('boy'),
            'yukseklik'=> $request ->get('yukseklik'),
            'hacim'=> $request ->get('hacim'),
            'users_id'=> Auth::id()
        ]);
        $ebat->save();
        return redirect('/ebat/ebat')->with('success','Tür Eklema Başarılı..');
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
        $ebat=ebat::find($id);
        return view('definition.ebat.edit',compact('ebat'));
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
        $ebat = ebat::find($id);
        $ebat ->name = $request->get('name');
        $ebat ->en = $request->get('en');
        $ebat ->boy = $request->get('boy');
        $ebat ->yukseklik = $request->get('yukseklik');
        $ebat ->hacim = $request->get('hacim');
        $ebat ->users_id = Auth::id();
        $ebat -> save();
        return redirect('/ebat/ebat')->with('success','Tür Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ebat = ebat::find($id);
        $ebat -> delete();
        return redirect('/ebat/ebat')->with('success','Tür Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = ebat::where('name','like','%'.$search.'%')->paginate(10);
        return view('definition.ebat.index',['ebat'=> $posts]);
    }
}
