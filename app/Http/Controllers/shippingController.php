<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\models\ship;
use App\models\shipping;
use App\models\order;
use App\models\orderdetails;
use App\models\orderstatus;
use App\models\store;
use App\models\storedetail;
use App\models\bot;
use App\models\botdetail;
use App\models\cari;
use App\models\current;
use Auth;
use DB;
class shippingController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('shipping.index');
    }
    public function kindex()
    {
      return view('shipping.kindex');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // irsaliye - fis yazdırma
      $ship =ship::join('orders','orders.id','=','ships.order_id')
                  ->where('ships.orderstatus_id',7)
                  ->select('ships.*','orders.koliadet as okoli')
                  ->with(['firma.parent'])
                  ->orderbydesc('ships.id')
                  ->paginate(25);
      return view('irsaliye.create',compact('ship'));
    }
    public function search (Request $request){
      $ship =ship::join('orders','orders.id','=','ships.order_id')
                  ->leftjoin('firmas as f','f.id','=','orders.firma_id')
                  ->where([['ships.orderstatus_id',7]])
                  ->where('f.name','like','%'.$request->search.'%')
                  ->select('ships.*','orders.koliadet as okoli')
                  ->with(['firma.parent'])
                  ->orderbydesc('ships.id')
                  ->paginate(100);
        return view('irsaliye.create',compact('ship'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       if(strlen($request->barcode) ==19 || strlen($request->barcode) ==20)
      {

        $shipping= shipping::where('barcode',$request->barcode)->first();
        $product= storedetail::where('no',$request->barcode)->pluck('urun_id')->first();
        if($shipping || empty($product))
          {
          $data = [
                  'success' => false,
                  'message'=> 'Hatalı Barcode (Bu ürün daha önce okutulmuş olabilir Yada Depoda yoktur.) !'
                ]; return $data;
        }
          // return back()->with('error','Hatalı Barcode (Bu ürün daha önce okutulmuş olabilir Yada Depoda yoktur.) !');
        else {

          $urun_id=storedetail::where('no',$request->barcode)->pluck('urun_id')->first();
          $firma_id=order::where('id',$request->order_id)->pluck('firma_id')->first();
          // $ship=ship::where('order_id',$request->order_id)->where('orderstatus_id','!=',7)->get();
          $ship=ship::where('firma_id',$firma_id)->where('orderstatus_id','!=',7)->get();
          if(isset($ship))
          {
            $ship=$ship->last(); 
            $request['ship_id']=$ship['id'];
          }
          if(empty($ship))
          {
            $ship=ship::create(['order_id'=>$request->order_id,'firma_id'=>$firma_id,'users_id'=>Auth::id()]);
            $request['ship_id']=$ship->id;
          }
          $oldorder= order::select('orders.id as orderid','orders.created_at as siptrh','orderdetails.miktar as sipmiktar','orderdetails.*','uruns.no','uruns.name')
          ->join('firmas','firmas.id','=','orders.firma_id')
          ->join('orderdetails','orderdetails.order_id','=','orders.id')
          ->join('uruns','orderdetails.urun_id','=','uruns.id')
          ->where([['firmas.id',$firma_id],['orders.orderstatuses_id','!=',3],['orderdetails.kalan','>',0],['orders.id','!=',$request->order_id],['uruns.id',$urun_id]])
          ->groupBy('orderdetails.urun_id')
          ->get()->toArray(); 

                      // return $oldorder[0]['order_id'];
          if(count($oldorder)>0) $request['order_id']=$oldorder[0]['order_id'];
          $orderdetails=orderdetails::where('order_id',$request->order_id)->where('urun_id',$urun_id)->first();

                if(empty($orderdetails))
               { 
                $oldorder= order::select('orders.id as orderid','orders.created_at as siptrh','orderdetails.miktar as sipmiktar','orderdetails.*','uruns.no','uruns.name')
                    ->join('firmas','firmas.id','=','orders.firma_id')
                    ->join('orderdetails','orderdetails.order_id','=','orders.id')
                    ->join('uruns','orderdetails.urun_id','=','uruns.id')
                    ->where([['firmas.id',$firma_id],['orders.orderstatuses_id','!=',3],['orders.id','!=',$request->order_id],['uruns.id',$urun_id]])
                    ->groupBy('orderdetails.urun_id')
                    ->get()->toArray();
                $request['order_id']=$oldorder[0]['order_id'];
                $orderdetails=orderdetails::where('order_id',$request->order_id)->where('urun_id',$urun_id)->first();
               }

          if($orderdetails)
          {
            $request['urun_id'] =$urun_id; $request['users_id']=Auth::id();
            shipping::create($request->all());
            storedetail::where('no',$request->barcode)->delete();
            $orderdetails->decrement('kalan');
             $data = [
                  'success' => true,
                  'message'=> 'Başarılı Ürün Eklendi..'
                ]; return $data;
            // return back()->with('success','Başarılı Ürün Eklendi..');
          }
          else 
            // return back()->with('error','Hatalı Ürün !');
            {
            $data = [
                  'success' => false,
                  'message'=> 'Hatalı Ürün!'
                ]; return $data;
          }

        }

      }
      elseif(strlen($request->barcode) == 14)
      {
        $bot=bot::where('barcode',$request->barcode)->with('botdetail')->first();
        foreach($bot->botdetail as $list)
        { 
          $shipping= shipping::where('barcode',$list->barcode)->first();

          if($shipping)
            // return back()->with('error','Hatalı Barcode (Bu ürün daha önce okutulmuş olabilir) !');
            {
            $data = [
                  'success' => false,
                  'message'=> 'Hatalı Barcode (Bu ürün daha önce okutulmuş olabilir) !'
                ]; return $data;
          }
          else {

            $urun_id=storedetail::where('no',$list->barcode)->pluck('urun_id')->first();
            $firma_id=order::where('id',$request->order_id)->pluck('firma_id')->first();
            // $ship=ship::where('order_id',$request->order_id)->where('orderstatus_id','!=',7)->get();
            $ship=ship::where('firma_id',$firma_id)->where('orderstatus_id','!=',7)->get();
            if(isset($ship))
            {
              $ship=$ship->last(); 
              $request['ship_id']=$ship['id'];
            }
            if(empty($ship))
            {
              $ship=ship::create(['order_id'=>$request->order_id,'firma_id'=>$firma_id,'users_id'=>Auth::id()]);
              $request['ship_id']=$ship->id;
            }
            $oldorder= order::select('orders.id as orderid','orders.created_at as siptrh','orderdetails.miktar as sipmiktar','orderdetails.*','uruns.no','uruns.name')
            ->join('firmas','firmas.id','=','orders.firma_id')
            ->join('orderdetails','orderdetails.order_id','=','orders.id')
            ->join('uruns','orderdetails.urun_id','=','uruns.id')
            ->where([['firmas.id',$firma_id],['orders.orderstatuses_id','!=',3],['orderdetails.kalan','>',0],['orders.id','!=',$request->order_id],['uruns.id',$urun_id]])
            ->groupBy('orderdetails.urun_id')
            ->get()->toArray(); 

                      // return $oldorder[0]['order_id'];
            if(count($oldorder)>0) $request['order_id']=$oldorder[0]['order_id'];
            $orderdetails=orderdetails::where('order_id',$request->order_id)->where('urun_id',$urun_id)->first();

            if($orderdetails)
            {
              $request['urun_id'] =$urun_id; $request['users_id']=Auth::id(); $request['barcode']=$list->barcode;
              shipping::create($request->all());
              storedetail::where('no',$list->barcode)->delete();
              $orderdetails->decrement('kalan');
            }
          }

        }
              // return back()->with('success','Başarılı Ürün Eklendi..');
         $data = [
                  'success' => true,
                  'message'=> 'Başarılı Ürün Eklendi..'
                ]; return $data;

      }
      else 
      {
        $data = [
                  'success' => false,
                  'message'=> 'Hatalı Barcode'
                ]; return $data;
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
      $order=order::with(['orderdetails.urun','ship','shipping','firma.order'])->find($id);
      $oldorder= order::select('orders.id as orderid','orders.created_at as siptrh','orderdetails.miktar','orderdetails.*','uruns.no','uruns.name','uruns.koliiciadet')
      ->join('firmas','firmas.id','=','orders.firma_id')
      ->join('orderdetails','orderdetails.order_id','=','orders.id')
      ->join('uruns','orderdetails.urun_id','=','uruns.id')
      // ->where([['firmas.id',$order->firma_id],['orders.orderstatuses_id','!=',3],['orderdetails.kalan','>',0],['orders.id','!=',$id]])
      ->where([['firmas.id',$order->firma_id],['orders.orderstatuses_id','!=',3],['orders.id','!=',$id]])
      ->groupBy('orders.id','orderdetails.urun_id')
      ->get();
        // return $oldorder;
      $orderstatus=orderstatus::get();
      $ships=ship::where('firma_id',$order->firma_id)->get(); $ship=$ships->last();
      // return $ships;
      return view('shipping.create',compact('order','ship','oldorder','orderstatus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
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
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function destroyqr(Request $request)
    {
        if(strlen($request->barcode) ==19)
      {
        $shipping= shipping::where('barcode',$request->barcode)->first();
        if($shipping)
        {
          $storedetail=storedetail::where('no',$request->barcode)->first();
          if($storedetail)
           return back()->with('error','Hatalı İşlem Yetkili ile görüşün!');
         else
         {
          storedetail::insert([
            'urun_id'=>$shipping->urun_id,
            'no'=>$request->barcode,
            'users_id'=>Auth::id(),
            'created_at'=>now()
          ]);
          store::where('urun_id',$shipping->urun_id)->increment('miktar');
          orderdetails::where('urun_id',$shipping->urun_id)->where('order_id',$shipping->order_id)->increment('kalan');
          $shipping->delete();
          return back()->with('success','Başarılı Ürün Silindi..')->with('destroyqrfocus', true);
        }
      }
      else 
        return back()->with('error','Hatalı Barcode !')->with('destroyqrfocus', true);
    }
      elseif(strlen($request->barcode)==14)
      {
        $bot=bot::where('barcode',$request->barcode)->with('botdetail')->first();
        foreach($bot->botdetail as $list)
       {   
              $shipping= shipping::where('barcode',$list->barcode)->first();
               if($shipping)
               {
                 $storedetail=storedetail::where('no',$list->barcode)->first();
                 if($storedetail)
                  return back()->with('error','Hatalı İşlem Yetkili ile görüşün!');
                else
                {
                 storedetail::insert([
                   'urun_id'=>$shipping->urun_id,
                   'no'=>$list->barcode,
                   'users_id'=>Auth::id(),
                   'created_at'=>now()
                 ]);
                 store::where('urun_id',$shipping->urun_id)->increment('miktar');
                 orderdetails::where('urun_id',$shipping->urun_id)->where('order_id',$shipping->order_id)->increment('kalan');
                 $shipping->delete();
               } 
             }
       }
                 return back()->with('success','Başarılı Ürün Silindi..')->with('destroyqrfocus', true);
      }
  }
  public function js()
  {
    $order=order::
            leftjoin('orderdetails as od','od.order_id','=','orders.id')
            ->leftjoin('uruns as u','u.id','=','od.urun_id')
            ->leftjoin('firmas as f','f.id','=','orders.firma_id')
            ->leftjoin('orderstatuses as os','os.id','=','orders.orderstatuses_id')
            ->orwhere('orders.orderstatuses_id',1)
            ->orwhere('orders.orderstatuses_id',2)
            ->select('orders.id','f.name as firma','os.name as orderstatus','orders.no','orders.created_at','orders.sevktrh','orders.aciklama',(DB::raw('SUM((od.kalan)/(u.koliiciadet)) as koli')))
            ->groupby('orders.id')
            ->orderbydesc('orders.id')
            ->get();
    return Datatables::of($order)
    ->addColumn('action', function ($order) {
      $a= '<table><tr>';
      $a .= '<td><a href="'.route('shipping.show',$order->id).'" title="Sevkiyat Oluştur" style="color:black"><i class="fas fa-plus-circle fa-1x"></i></a></td>';
      $a .= '</div></td></tr></table>';
      return $a;
    })
    ->removeColumn('password')
    ->make(true);
  }
  public function kjs()
  {
    $order=order::
            leftjoin('orderdetails as od','od.order_id','=','orders.id')
            ->leftjoin('uruns as u','u.id','=','od.urun_id')
            ->leftjoin('firmas as f','f.id','=','orders.firma_id')
            ->leftjoin('orderstatuses as os','os.id','=','orders.orderstatuses_id')
            ->where('orders.orderstatuses_id',3)
            ->select('orders.id','f.name as firma','os.name as orderstatus','orders.no','orders.created_at','orders.sevktrh','orders.aciklama',(DB::raw('SUM((od.kalan)/(u.koliiciadet)) as koli')))
            ->groupby('orders.id')
            ->orderbydesc('orders.id')
            ->get();
    return Datatables::of($order)
    ->addColumn('action', function ($order) {
      $a= '<table><tr>';
      $a .= '<td><a href="'.route('shipping.show',$order->id).'" title="Sevkiyat Oluştur" style="color:black"><i class="fas fa-plus-circle fa-1x"></i></a></td>';
      $a .= '</div></td></tr></table>';
      return $a;
    })
    ->removeColumn('password')
    ->make(true);
  }

    public function koli(Request $request)
    {

      order::find($request->id)->update(['koliadet'=>$request->koliadet]);
      ship::find($request->ship_id)->update(['koliadet'=>$request->koliadet]);
    }

  public function irsaliyeno (Request $request)
  {
    ship::where('id',$request->id)->update(['irsaliyeno'=>$request->no]);
  }

  public function orderstatus(request $request)
  {
        if($request->val==3)
        {
        $ship=ship::where('order_id',$request->id)->update(['orderstatus_id'=>7]);
        $order=order::find($request->id)->update(['orderstatuses_id'=>$request->val]);
        $orderdetails=orderdetails::where('order_id',$request->id)->where('kalan','>',0)->get();
          foreach($orderdetails as $list)
          {
            $store=store::where('urun_id',$list->urun_id)->increment('miktar',$list->kalan); 
          }
        }
  }

public function sevkbitir($id)
  {
     $ship=ship::where('id',$id)->first();
    $shipping=shipping::leftjoin('orderdetails','shippings.order_id','=','orderdetails.order_id')
                  ->leftjoin('kur','kur.id' ,'=','orderdetails.kur_id')
                  ->where('shippings.ship_id',$id)
                  ->whereRaw('orderdetails.urun_id = shippings.urun_id')
                  ->groupBy('shippings.order_id','shippings.urun_id')
                  ->get([
                    'shippings.urun_id'
                  , 'orderdetails.fiyat'
                  ,'shippings.ship_id'
                  ,'shippings.order_id as order_id'
                  ,'orderdetails.kur_id'
                  ,'orderdetails.bazkur'
                  ,DB::raw('COUNT(shippings.barcode) AS count')
                  ,DB::raw('COUNT(shippings.barcode)*(orderdetails.fiyat) AS tutar')
                  ,DB::raw('COUNT(shippings.barcode)*(orderdetails.fiyat)*(orderdetails.bazkur) AS dtutar')
                  ,'kur.name'
                ]);
                    $a=$shipping->groupby('order_id');
                    if(empty(cari::where('ship_id',$id)->first()))
                    {
                      foreach ($a as $key => $value) 
                      {  
                              $dtutar = str_replace([',', ','], ['.', '.'], $value->sum('tutar'));
                              $cari=cari::create([
                              'firma_id'=>$ship->firma_id,
                              'trh'=>now(),
                              'vadetrh'=>now(),
                              'order_id'=>$key,
                              'ship_id'=>$id,
                              'tutar'=> $dtutar,
                              'kur_id'=>$value[0]->kur_id,
                              'users_id'=> Auth::id()
                              ]);
                              $current=current::create([
                              'firma_id'=>$ship->firma_id,
                              'order_id'=>$key,
                              'ship_id'=>$id,
                              'vadetrh'=>now(),
                              'debt'=> $dtutar,
                              'kur_id'=>$value[0]->kur_id,
                              'durum_id'=> 1,
                              'option'=> 1,
                              'users_id'=> Auth::id()
                              ]);
                      }
                    }
    $ship->update(['orderstatus_id'=>7]);
    $ship->save();
    return view('shipping.index');
  }


  public function oldorder(request $request)
  {
    $urun_id=storedetail::where('no',$request->barcode)->pluck('urun_id')->first();
    $orderdetails=orderdetails::where('order_id',$request->order_id)->where('urun_id',$urun_id)->first();
    $shipping= shipping::where('barcode',$request->barcode)->first();
    $oldorder= order::select('orders.id as orderid','orders.created_at as siptrh','orderdetails.miktar as sipmiktar','orderdetails.*','uruns.no','uruns.name')
                      ->join('firmas','firmas.id','=','orders.firma_id')
                      ->join('orderdetails','orderdetails.order_id','=','orders.id')
                      ->join('uruns','orderdetails.urun_id','=','uruns.id')
                      ->where([['firmas.id',$orderdetails->order->firma_id],['orders.orderstatuses_id','=',2],['orderdetails.kalan','>',0],['orders.id','!=',$request->order_id]])
                      ->groupBy('orderdetails.urun_id')
                      ->get(); 
    $ship=ship::where('order_id',$request->mevcutsiparis_id)->where('orderstatus_id','!=',7)->get();

    if(isset($ship))
    {
      $ship=$ship->last(); 
      $request['ship_id']=$ship['id'];
    }
    if(empty($ship))
    {
      $ship=ship::create(['order_id'=>$request->mevcutsiparis_id,'firma_id'=>$orderdetails->order->firma_id,'users_id'=>Auth::id()]);
      $request['ship_id']=$ship->id;
    }        
    if(strlen($request->barcode) !=19)
      return back()->with('error','Hatalı Barcode!')->with('oldorderfocus'.$request->urun_id, true);
    else{
      if($shipping)
        return back()->with('error','Hatalı Barcode !')->with('oldorderfocus'.$request->urun_id, true);
      else {
        if(count($oldorder)>0)
        {
         $request['urun_id'] =$urun_id; $request['users_id']=Auth::id(); 
         shipping::create($request->all());
         storedetail::where('no',$request->barcode)->delete();
         store::where('urun_id',$urun_id)->decrement('miktar'); 
        $orderdetails->decrement('kalan');

         return back()->with('success','Başarılı Ürün Eklendi..')->with('oldorderfocus'.$request->urun_id, true);
       }
       else return back()->with('error','Hatalı Ürün !')->with('oldorderfocus'.$request->urun_id, true);
     }
   }
 }

 public function ship()
 {
  return view('shipping.ship');
}

public function shipjs()
{
 $ship=ship::with('order.firma')->orderbydesc('id')->get();
 return Datatables::of($ship)
 ->addColumn('action', function ($ship) {
  $a= '<table><tr>';
  $a .= '<td><a href="'.route('shipfis',$ship->id).'" title="Fiş" style="color:black"><i class="fas fa-desktop fa-1x"></i></a></td>';
  $a .= '</div></td></tr></table>';
  return $a;
})
 ->removeColumn('password')
 ->make(true);
}

public function shipfis($id)
{
 $ship=ship::where('id',$id)->with(['order.firma','shipping'=>function($q){
  $q->groupBy('order_id','urun_id');
}])->first();
       //return $ship;
 return view('shipping.fis',compact('ship'));
}


public function fis($id)
{
   $shipa=ship::where('id',$id)->with(['order.firma','order.orderdetails'])->first();
 $ship=ship::where('ships.id',$id)
  ->join('shippings','shippings.ship_id','=','ships.id')
  ->leftjoin('uruns','shippings.urun_id','=','uruns.id')
  ->select('ships.id as id','ships.order_id','shippings.order_id as urunorder_id','shippings.id as shippings_id','uruns.id as urun_id','uruns.name','uruns.no','uruns.tmad','uruns.ticariad',DB::raw('count(urun_id) as tmadcount'),DB::raw('count(ticariad) as ticariadcount') )
  ->groupby('shippings.order_id','tmad')
  ->get();
  $order=orderdetails::get();
  return view('irsaliye.fisfiyat',compact('ship','shipa','order'));
}

public function shipirsaliye($id)
{
   $shipa=ship::where('id',$id)->with(['order.firma'])->first();

  $ship=ship::where('ships.id',$id)
  ->join('shippings','shippings.ship_id','=','ships.id')
  ->leftjoin('uruns','shippings.urun_id','=','uruns.id')
  ->select('ships.id as id','shippings.id as shippings_id','uruns.id as urun_id','uruns.name','uruns.no','uruns.tmad','uruns.ticariad',DB::raw('count(tmad) as tmadcount'),DB::raw('count(ticariad) as ticariadcount') )
  ->groupby('tmad')
  ->get();
  //return $ship;
 return view('irsaliye.irsaliye',compact('ship','shipa'));

}

}
