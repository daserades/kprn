<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\bot;
use App\models\botdetail;
use App\models\uretim;
use Yajra\Datatables\Datatables;
use Auth;
use DB;

class botController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bot.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bot.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['barcode']=date('YmdHis');
        $request['users_id']=Auth::id();
        $bot=bot::create($request->all());
        return redirect('bot/create2/'.$bot->id);
    }

    public function create2($id)
    {
        $bot=bot::with(['botdetail'
        =>function($q){$q->groupby('urun_id')->select('*',DB::raw('COUNT(urun_id) as count'));}
            ,'botdetail.urun'
        ])
        ->where('id',$id)->first();
        return view('bot.create2',compact('bot'));
    }

    public function store2(Request $request)
    {
        $botdetail=botdetail::where('barcode',$request->barcode)->first();
        if(isset($botdetail))
        {
        return back()->with('error','Hatalı Barkod yada Okutulmuş..');
        }
        else
        {    
        $urun=uretim::where('no',$request->barcode)->first();
        $request['urun_id']=$urun->urun_id; $request['users_id']=Auth::id();
        botdetail::create($request->all());
        return back()->with('success','Başarılı..');
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        botdetail::where('bot_id',$id)->delete();
        bot::where('id',$id)->delete();
        return back()->with('success','Başarılı..');
    }

    public function botdetaildestroy(Request $request)
    {
        botdetail::where('barcode',$request->barcode)->where('bot_id',$request->bot_id)->delete();
        return back()->with('success','Başarılı..');
    }

    public function sticker($id)
    {
        $bot=bot::where('id',$id)->first();
        return view('bot.sticker',compact('bot'));
    }
     public function js()
    {
        $bot=bot::orderbydesc('id')->get();
        return Datatables::of($bot)
      ->addColumn('action', function ($bot) {
        $a= '<table><tr>
        <td><a href="bot/'.$bot->id.'" title="Detay" style="color:black"><i class="fas fa-desktop fa-1x"></i></a></td>
        <td><a href="'.route('create2',$bot->id).'" title="Ürün Ekle" style="color:black"><i class="fas fa-plus-circle fa-1x"></i></a></td>
        <td><a href="'.route('botsticker',$bot->id).'" title="Etiket Bas" style="color:black"><i class="fas fa-print fa-1x"></a></td>
        <td class="sil"><div class="delete-form">
        <form action="bot/'.$bot->id.'" method="POST">
        <input type="hidden" name="_token" value="'.csrf_token().'">
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" style="color:red"  title="Sil"><i class="far fa-trash-alt"></i></button>
        </form>
        </div></td></tr></table>';
        return $a;
      })
      ->removeColumn('password')
      ->make(true);
    }
}
