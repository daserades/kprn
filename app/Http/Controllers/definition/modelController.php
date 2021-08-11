<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\models;
use Auth;
class modelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $model=models::paginate(10);
        return view('definition.model.index',compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('definition.model.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // model::create($request->all());
        //return back()->with('sucses','model Eklema Başarılı..');
        $model = new models([
            'name'=> $request ->get('name'),
            'users_id'=> Auth::id()
        ]);
        $model->save();
        return redirect('/model/model')->with('success','Model Eklema Başarılı..');
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
        $model=models::find($id);
        return view('definition.model.edit',compact('model'));
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
        $model = models::find($id);
        $model ->name = $request->get('name');
        $model ->users_id = Auth::id();
        $model -> save();
        return redirect('/model/model')->with('success','Model Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = models::find($id);
        $model -> delete();
        return redirect('/model/model')->with('success','Model Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = models::where('name','like','%'.$search.'%')->paginate(10);
        return view('definition.model.index',['model'=> $posts]);
    }
}
