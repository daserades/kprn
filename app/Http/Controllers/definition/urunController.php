<?php

namespace App\Http\Controllers\definition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\models\urun;
use App\models\urunaltkategori;
use App\models\urunkategori;
use App\models\ebat;
use App\models\models;
use App\models\urunozellik;
use App\models\unit;
use App\models\ambalajtur;
use App\models\paketiciozellik;
use App\models\renk;
use App\models\urunturu;
use App\models\durum;
use App\models\urunaltkategori_models;
use Auth;
use DB;
class urunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$urun=urun::orderBy('id','desc')->paginate(10);
        return view('definition.urun.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $durum= durum::get();
        $urunaltkategori= urunaltkategori::orderby('name','asc')->get();
        $ebat= ebat::get();
        $models= models::orderby('name','asc')->get();
        $urunozellik= urunozellik::orderby('name','asc')->get();
        $unit= unit::get();
        $ambalajtur= ambalajtur::get();
        $renk= renk::orderby('name','asc')->get();
        $urunturu= urunturu::get();
        $paketiciozellik= paketiciozellik::get();
        return view('definition.urun.create', compact('urunozellik','urunaltkategori','durum','ebat','models','unit','ambalajtur','paketiciozellik','renk','urunturu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   //ebat model oz ürünaltkategori (paketiciadet li ambalajturu) renkler 595
     $model=models::where('id',$request ->get('models_id'))->select('name')->first();
     $ebat=ebat::where('id',$request ->get('ebat_id'))->select('name')->first();
     $oz1=urunozellik::where('id',$request ->get('urunozellik1_id'))->select('name')->first();
     $oz2=urunozellik::where('id',$request ->get('urunozellik2_id'))->select('name')->first();
     $oz3=urunozellik::where('id',$request ->get('urunozellik3_id'))->select('name')->first();
     $oz4=urunozellik::where('id',$request ->get('urunozellik4_id'))->select('name')->first();
     $oz5=urunozellik::where('id',$request ->get('urunozellik5_id'))->select('name')->first();
     $uak=urunaltkategori::where('id',$request ->get('urunaltkategori_id'))->select('name')->first();
     $ambalaj =ambalajtur::where('id',$request ->get('ambalajtur_id'))->select('name')->first(); 
     $kutu='('.$request ->get('paketiciadet').' PARÇA '.') ('. $ambalaj['name'].')';
     $renk1=renk::where('id',$request ->get('renk1_id'))->select('name')->first();
     $renk2=renk::where('id',$request ->get('renk2_id'))->select('name')->first();
     $renk3=renk::where('id',$request ->get('renk3_id'))->select('name')->first();
     $renk4=renk::where('id',$request ->get('renk4_id'))->select('name')->first();
     $renk5=renk::where('id',$request ->get('renk5_id'))->select('name')->first();
     $renk6=renk::where('id',$request ->get('renk6_id'))->select('name')->first();
     $name =$ebat['name'].' '.$model['name'].' '.$oz1['name'].' '.$oz2['name'].' '.$oz3['name'].' '.$oz4['name'].' '.$oz5['name'].' '.$uak['name'].' '.$kutu.' '.$renk1['name'].' '.$renk2['name'].' '.$renk3['name'].' '.$renk4['name'].' '.$renk5['name'].' '.$renk6['name'];         
     if ($request->get('barkod'))
      $barkod = $request->get('barkod');
      else 
      {
        $kod = $request ->get('no');
        $sql = urun::where('no',$kod)->orderBy('id','desc')->select('barkod')->first();
        if($sql)
        {
            $getno=mb_substr($sql['barkod'], -3, -1, 'utf8');
            $no= $getno + 01;
            $no=str_pad($no, 2 , "0",STR_PAD_LEFT);
            $firmakod=8682448;
            $asd= $firmakod.$kod.$no;
            $s1 = substr($asd, 0,1); $b1 = substr($asd, 1,1); $s1 += substr($asd, 2,1); $b1 += substr($asd, 3,1); $s1 += substr($asd, 4,1); $b1 += substr($asd, 5,1);$s1 += substr($asd, 6,1); $b1 += substr($asd, 7,1);$s1 += substr($asd, 8,1); $b1 += substr($asd, 9,1);$s1 += substr($asd, 10,1); $b1 += substr($asd, 11,1);
            $sonuc = (($b1 *3)+$s1);
            $kalan = 10-($sonuc%10);
            $barkod = $asd.$kalan;
        }
        else 
        {
          $no  = '01';   
          $firmakod=8682448;
          $asd= $firmakod.$kod.$no;
            $s1 = substr($asd, 0,1); $b1 = substr($asd, 1,1); $s1 += substr($asd, 2,1); $b1 += substr($asd, 3,1); $s1 += substr($asd, 4,1); $b1 += substr($asd, 5,1);$s1 += substr($asd, 6,1); $b1 += substr($asd, 7,1);$s1 += substr($asd, 8,1); $b1 += substr($asd, 9,1);$s1 += substr($asd, 10,1); $b1 += substr($asd, 11,1);
          $sonuc = (($b1 *3)+$s1);
         $kalan = 10-($sonuc%10);
            $barkod = $asd.$kalan;
          }
        }
    $urun = new urun([
        'no'=> $request ->get('no'),
        'barkod'=> $barkod,
        'name'=> $name,
        'urunaltkategori_id'=>$request ->get('urunaltkategori_id'),
        'ebat_id'=>$request ->get('ebat_id'),
        'models_id'=>$request ->get('models_id'),
        'urunozellik1_id'=>$request ->get('urunozellik1_id'),
        'urunozellik2_id' => $request ->get('urunozellik2_id'),
        'urunozellik3_id' => $request ->get('urunozellik3_id'),
        'urunozellik4_id' => $request ->get('urunozellik4_id'),
        'urunozellik4_id' => $request ->get('urunozellik4_id'),
        'urunozellik5_id' => $request ->get('urunozellik5_id'),
        'unit_id' => $request ->get('unit_id'),
        'paketiciadet'=>$request ->get('paketiciadet'),
        'koliiciadet'=>$request ->get('koliiciadet'),
        'ambalajtur_id'=>$request ->get('ambalajtur_id'),
        'paketiciozellik_id'=>$request ->get('paketiciozellik_id'),
        'renk1_id'=>$request ->get('renk1_id'),
        'renk2_id'=>$request ->get('renk2_id'),
        'renk3_id'=>$request ->get('renk3_id'),
        'renk4_id'=>$request ->get('renk4_id'),
        'renk5_id'=>$request ->get('renk5_id'),
        'renk6_id'=>$request ->get('renk6_id'),
        'hacim'=>$request ->get('hacim'),
        'gramaj'=>$request ->get('gramaj'),
        'asgaristok'=>$request ->get('asgaristok'),
        'ipliktur'=>$request ->get('ipliktur'),
        'icerik'=>$request ->get('icerik'),
        'aciklama'=>$request ->get('aciklama'),
        'ticarikod'=>$request ->get('ticarikod'),
        'ticariad'=>$request ->get('ticariad'),
        'tmkod'=>$request ->get('tmkod'),
        'tmad'=>$request ->get('no').' '.$ebat['name'].' '.$model['name'].' '.$oz1['name'].' '.$oz2['name'].' '.$oz3['name'].' '.$oz4['name'].' '.$oz5['name'].' '.$kutu,
        'urunturu_id'=>$request ->get('urunturu_id'),
        'durum_id'=>$request ->get('durum_id'),
        'aciklama'=>$request ->get('aciklama'),
        'users_id'=>Auth::id()
    ]);
    $urun->save();
    DB::table('categories_uruns')->insert(['category_id'=>$request->get('urunaltkategori_id'),'urun_id'=>$urun->id]);
    return redirect('/urun/urun')->with('success','Ürün Ekleme Başarılı..');

}   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $urun=urun::find($id);
        return view('definition.urun.show',compact('urun'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $urun=urun::find($id);
        $durum= durum::get();
        $urunaltkategori= urunaltkategori::orderby('name','asc')->get();
        $ebat= ebat::get();
        $models= models::orderby('name','asc')->get();
        $urunozellik= urunozellik::orderby('name','asc')->get();
        $unit= unit::get();
        $ambalajtur= ambalajtur::orderby('name','asc')->get();
        $renk= renk::orderby('name','asc')->get();
        $urunturu= urunturu::orderby('name','asc')->get();
        $paketiciozellik= paketiciozellik::orderby('name','asc')->get();
        return view('definition.urun.edit',compact('urun','urunaltkategori','durum','ebat','models','urunozellik','unit','ambalajtur','renk','urunturu','paketiciozellik'));
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
        if ($_POST['action'] == 'Güncelle') {

        $model=models::where('id',$request ->get('models_id'))->select('name')->first();
        $ebat=ebat::where('id',$request ->get('ebat_id'))->select('name')->first();
        $oz1=urunozellik::where('id',$request ->get('urunozellik1_id'))->select('name')->first();
        $oz2=urunozellik::where('id',$request ->get('urunozellik2_id'))->select('name')->first();
        $oz3=urunozellik::where('id',$request ->get('urunozellik3_id'))->select('name')->first();
        $oz4=urunozellik::where('id',$request ->get('urunozellik4_id'))->select('name')->first();
        $oz5=urunozellik::where('id',$request ->get('urunozellik5_id'))->select('name')->first();
        $uak=urunaltkategori::where('id',$request ->get('urunaltkategori_id'))->select('name')->first();
        $ambalaj =ambalajtur::where('id',$request ->get('ambalajtur_id'))->select('name')->first(); 
         $kutu='('.$request ->get('paketiciadet').' PARÇA '.') ('. $ambalaj['name'].')';
        $renk1=renk::where('id',$request ->get('renk1_id'))->select('name')->first();
        $renk2=renk::where('id',$request ->get('renk2_id'))->select('name')->first();
        $renk3=renk::where('id',$request ->get('renk3_id'))->select('name')->first();
        $renk4=renk::where('id',$request ->get('renk4_id'))->select('name')->first();
        $renk5=renk::where('id',$request ->get('renk5_id'))->select('name')->first();
        $renk6=renk::where('id',$request ->get('renk6_id'))->select('name')->first();
        $name =$ebat['name'].' '.$model['name'].' '.$oz1['name'].' '.$oz2['name'].' '.$oz3['name'].' '.$oz4['name'].' '.$oz5['name'].' '.$uak['name'].' '.$kutu.' '.$renk1['name'].' '.$renk2['name'].' '.$renk3['name'].' '.$renk4['name'].' '.$renk5['name'].' '.$renk6['name'];

        $urun = urun::find($id);
        if($urun->urunaltkategori_id != $request->get('urunaltkategori_id'))DB::table('categories_uruns')->where('urun_id',$urun->id)->update(['category_id'=>$request->get('urunaltkategori_id')]);
        $urun ->no = $request->get('no');
        $urun ->barkod = $request->get('barkod');
        $urun ->name = $name;
        $urun ->urunaltkategori_id= $request->get('urunaltkategori_id');
        $urun ->ebat_id= $request->get('ebat_id');
        $urun ->models_id= $request->get('models_id');
        $urun ->urunozellik1_id= $request->get('urunozellik1_id');
        $urun ->urunozellik2_id= $request->get('urunozellik2_id');
        $urun ->urunozellik3_id= $request->get('urunozellik3_id');
        $urun ->urunozellik4_id= $request->get('urunozellik4_id');
        $urun ->urunozellik5_id= $request->get('urunozellik5_id');
        $urun ->unit_id= $request->get('unit_id');
        $urun ->paketiciadet= $request->get('paketiciadet');
        $urun ->koliiciadet= $request->get('koliiciadet');
        $urun ->ambalajtur_id= $request->get('ambalajtur_id');
        $urun ->paketiciozellik_id= $request->get('paketiciozellik_id');
        $urun ->renk1_id= $request->get('renk1_id');
        $urun ->renk2_id= $request->get('renk2_id');
        $urun ->renk3_id= $request->get('renk3_id');
        $urun ->renk4_id= $request->get('renk4_id');
        $urun ->renk5_id= $request->get('renk5_id');
        $urun ->renk6_id= $request->get('renk6_id');
        $urun ->hacim= $request->get('hacim');
        $urun ->gramaj= $request->get('gramaj');
        $urun ->asgaristok= $request->get('asgaristok');
        $urun ->ipliktur= $request->get('ipliktur');
        $urun ->icerik= $request->get('icerik');
        $urun ->aciklama= $request->get('aciklama');
        $urun ->ticarikod= $request->get('ticarikod');
        $urun ->ticariad= $request->get('ticariad');
        $urun ->tmkod= $request->get('tmkod');
        $urun ->tmad= $request->get('tmad');
        $urun ->urunturu_id= $request->get('urunturu_id');
        $urun ->durum_id= $request->get('durum_id');
        $urun ->users_id= Auth::id();
        $urun -> save();
        return redirect('/urun/urun')->with('success','Ürün Güncellendi');

        } else if ($_POST['action'] == 'Farklı Kaydet') {

                 $model = models::where('id', $request->get('models_id'))->select('name')->first();
            $ebat = ebat::where('id', $request->get('ebat_id'))->select('name')->first();
            $oz1 = urunozellik::where('id', $request->get('urunozellik1_id'))->select('name')->first();
            $oz2 = urunozellik::where('id', $request->get('urunozellik2_id'))->select('name')->first();
            $oz3 = urunozellik::where('id', $request->get('urunozellik3_id'))->select('name')->first();
            $oz4 = urunozellik::where('id', $request->get('urunozellik4_id'))->select('name')->first();
            $oz5 = urunozellik::where('id', $request->get('urunozellik5_id'))->select('name')->first();
            $uak = urunaltkategori::where('id', $request->get('urunaltkategori_id'))->select('name')->first();
            $ambalaj = ambalajtur::where('id', $request->get('ambalajtur_id'))->select('name')->first();
            $kutu = $request->get('paketiciadet') . ' LI ' . $ambalaj['name'];
            $renk1 = renk::where('id', $request->get('renk1_id'))->select('name')->first();
            $renk2 = renk::where('id', $request->get('renk2_id'))->select('name')->first();
            $renk3 = renk::where('id', $request->get('renk3_id'))->select('name')->first();
            $renk4 = renk::where('id', $request->get('renk4_id'))->select('name')->first();
            $renk5 = renk::where('id', $request->get('renk5_id'))->select('name')->first();
            $renk6 = renk::where('id', $request->get('renk6_id'))->select('name')->first();
            $name = $ebat['name'] . ' ' . $model['name'] . ' ' . $oz1['name'] . ' ' . $oz2['name'] . ' ' . $oz3['name'] . ' ' . $oz4['name'] . ' ' . $oz5['name'] . ' ' . $uak['name'] . ' (' . $kutu . ') ' . $renk1['name'] . ' ' . $renk2['name'] . ' ' . $renk3['name'] . ' ' . $renk4['name'] . ' ' . $renk5['name'] . ' ' . $renk6['name'];


            if ($request->get('barkod'))
      $barkod = $request->get('barkod');
      else 
      {
        $kod = $request ->get('no');
        $sql = urun::where('no',$kod)->max('barkod');
        if($sql)
        {
            $getno=mb_substr($sql, -3, -1, 'utf8');
            $no= $getno + 01;
            $no=str_pad($no, 2 , "0",STR_PAD_LEFT);
            $firmakod=8682448;
            $asd= $firmakod.$kod.$no;
            $s1 = substr($asd, 0,1); $b1 = substr($asd, 1,1); $s1 += substr($asd, 2,1); $b1 += substr($asd, 3,1); $s1 += substr($asd, 4,1); $b1 += substr($asd, 5,1);$s1 += substr($asd, 6,1); $b1 += substr($asd, 7,1);$s1 += substr($asd, 8,1); $b1 += substr($asd, 9,1);$s1 += substr($asd, 10,1); $b1 += substr($asd, 11,1);
            $sonuc = (($b1 *3)+$s1);
            $kalan = 10-($sonuc%10);
            $barkod = $asd.$kalan;
        }
        else 
        {
          $no  = '01';   
          $firmakod=8682448;
          $asd= $firmakod.$kod.$no;
            $s1 = substr($asd, 0,1); $b1 = substr($asd, 1,1); $s1 += substr($asd, 2,1); $b1 += substr($asd, 3,1); $s1 += substr($asd, 4,1); $b1 += substr($asd, 5,1);$s1 += substr($asd, 6,1); $b1 += substr($asd, 7,1);$s1 += substr($asd, 8,1); $b1 += substr($asd, 9,1);$s1 += substr($asd, 10,1); $b1 += substr($asd, 11,1);
          $sonuc = (($b1 *3)+$s1);
         $kalan = 10-($sonuc%10);
            $barkod = $asd.$kalan;
          }
        }
            $urun = new urun([
                'no' => $request->get('no'),
                'barkod' => $barkod,
                'name' => $name,
                'urunaltkategori_id' => $request->get('urunaltkategori_id'),
                'ebat_id' => $request->get('ebat_id'),
                'models_id' => $request->get('models_id'),
                'urunozellik1_id' => $request->get('urunozellik1_id'),
                'urunozellik2_id' => $request->get('urunozellik2_id'),
                'urunozellik3_id' => $request->get('urunozellik3_id'),
                'urunozellik4_id' => $request->get('urunozellik4_id'),
                'urunozellik4_id' => $request->get('urunozellik4_id'),
                'urunozellik5_id' => $request->get('urunozellik5_id'),
                'unit_id' => $request->get('unit_id'),
                'paketiciadet' => $request->get('paketiciadet'),
                'koliiciadet' => $request->get('koliiciadet'),
                'ambalajtur_id' => $request->get('ambalajtur_id'),
                'paketiciozellik_id' => $request->get('paketiciozellik_id'),
                'renk1_id' => $request->get('renk1_id'),
                'renk2_id' => $request->get('renk2_id'),
                'renk3_id' => $request->get('renk3_id'),
                'renk4_id' => $request->get('renk4_id'),
                'renk5_id' => $request->get('renk5_id'),
                'renk6_id' => $request->get('renk6_id'),
                'hacim' => $request->get('hacim'),
                'gramaj' => $request->get('gramaj'),
                'asgaristok' => $request->get('asgaristok'),
                'ipliktur' => $request->get('ipliktur'),
                'icerik' => $request->get('icerik'),
                'aciklama' => $request->get('aciklama'),
                'ticarikod' => $request->get('ticarikod'),
                'ticariad' => $request->get('ticariad'),
                'tmkod' => $request->get('tmkod'),
                'tmad' => $request->get('no') . ' ' . $ebat['name'] . ' ' . $model['name'] . ' ' . $oz1['name'] . ' ' . $oz2['name'] . ' ' . $oz3['name'] . ' ' . $oz4['name'] . ' ' . $oz5['name'] . ' ' . $kutu,
                'urunturu_id' => $request->get('urunturu_id'),
                'durum_id' => $request->get('durum_id'),
                'aciklama' => $request->get('aciklama'),
                'users_id' => Auth::id()
            ]);
            $urun->save();
            DB::table('categories_uruns')->insert(['category_id' => $request->get('urunaltkategori_id'), 'urun_id' => $urun->id]);
            return redirect('/urun/urun')->with('success', 'Ürün Farklı Kaydedildi..');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $urun = urun::find($id);
        $urun -> delete();
        return back()->with('success','Ürün Silindi');
    }
    public function search (Request $request){
        $search = $request-> get('search');
        $posts = urun::where('no','like','%'.$search.'%')->paginate(15);
        return view('definition.urun.index',['urun'=> $posts]);
    }
    public function urunagaci()
    {
        // $kategori = urunkategori::with(['urunaltkategori.urun.models','urunaltkategori.urun.price','urunaltkategori.urun.store'])->get();
        $kategori = urunkategori::with(['urunaltkategori.urun'
          =>function($q){$q->where('urunturu_id',1);}
          ,'urunaltkategori.urun.models','urunaltkategori.urun.price','urunaltkategori.urun.store'])->get();
        $urunturu=urunturu::get();
        // return $kategori;
        return view('definition.urun.urunagaci',compact('kategori','urunturu'));
    }
    public function list ($list)
    {
      if($list >=0) $list=1;
        $kategori = urunkategori::with(['urunaltkategori.urun'
          =>function($q) use ($list){$q->where('urunturu_id',$list);}
          ,'urunaltkategori.urun.models'
          ])
        ->get();
        $urunturu= urunturu::get();
        // return $kategori;
        return view('definition.urun.urunagaci',compact('kategori','urunturu'));
    }

      public function js()
    {
        $urun=urun::with('urunturu')->orderBy('id','desc')->get();
        return Datatables::of($urun)
      ->addColumn('action', function ($urun) {
        $a= '<table><tr>
        <td><a href="urun/'.$urun->id.'" title="DETAY" style="color:black"><i class="fas fa-desktop fa-1x"></i></a></td>
        <td><a href="urun/'.$urun->id.'/edit" style="color:black" title="Düzenle"><i class="far fa-edit fa-1x"></i></a></td>
        <td class="sil"><div class="delete-form">
        <form action="urun/'.$urun->id.'" method="POST">
        <input type="hidden" name="_token" value="'.csrf_token().'">
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" style="color:red"  title="Sil"><i class="far fa-trash-alt"></i></button>
        </form>
        </div></td>
        </tr></table>';
        return $a;
      })
      ->removeColumn('password')
      ->make(true);


    }

}
