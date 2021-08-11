<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\order;
use App\models\orderdetails;
use App\models\orderstatus;
use App\models\shipping;
use App\models\uretim;
use App\models\firma;
use App\models\firmadetay;
use App\models\kur;
use App\models\urun;
use App\models\cari;
use App\models\kgsevk;
use App\models\store;
use App\models\unit;
use Auth;
use DB;
use Yajra\Datatables\Datatables;

class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        $order=order::orderbydesc('id')->paginate(15);
        return view('order.index',compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $firma=firma::orderby('name')->get();
        $kur=kur::get();
        $orderstatus=orderstatus::get();
        $nakliye=firma::Where('firmatipi_id','2')->get();
        return view('order.create',compact('firma','kur','orderstatus','nakliye'));
    }
    public function fdetay($id)
    {
        $firmadetay= firma::with('firmadetay','kur')->where('id',$id)->get();
        return $firmadetay;
    }

    public function detay($id)
    {
        $firmadetay= firmadetay::with('kur')->where('id',$id)->get();
        return $firmadetay;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $yil = mb_substr(date('Y'),-2);
        $no = order::where('no','like','NP'.$yil.date('md').'%')->select('no')->orderBy('no','desc')->first();   
         if($no) 
         {
         $getno = mb_substr($no->no, -2, null, 'utf8'); $getno = $getno+1;
         $numara=str_pad($getno, 2 , "0",STR_PAD_LEFT);
         $sipno =  'NP'.$yil.date('md').$numara; 
         }
         else $sipno =  'NP'.$yil.date('md').'01';
          $money = str_replace([',', ','], ['.', '.'], $request ->get('bazkur'));
           
            $request['no']=$sipno;
            $request['bazkur']=$money;
            $request['users_id']=Auth::id();
            $order=order::create($request->all());
        
        return redirect('/orderdetail/orderdetail/'.$order['id'])->with('success','Sipariş Ekleme Başarılı..');

    }   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
    {
        $order=order::with('orderdetails')->find($id);
        return view('order.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order=order::find($id);
        $firma=firma::get();
        $orderstatus=orderstatus::get();
        $kur=kur::get();
        return view('order.edit',compact('order','orderstatus','firma','kur'));
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
        if ($_POST['action'] == 'Güncelle') 
        {
        $order = order::find($id);
        $request['bazkur']=str_replace(['.',','], ['.','.'], $request ->get('bazkur'));
        if ($order->iskonta != $request->iskonta || $order->bazkur != $request->bazkur || $order->kur_id != $request->kur_id || $order->orderstatuses_id != $request->orderstatuses_id)
        {
            $orderdetail=orderdetails::where('order_id',$id)->get();
            foreach($orderdetail as $list)
            {
                $fiyat=$list->listefiyat - ($list->listefiyat * $request->iskonta / 100 );
                $tutar = $fiyat * $list->miktar;
            if($request['kur_id']==1)
                $bakiye=$tutar;
            else 
                $bakiye= $tutar*$request->get('bazkur');
                    
                        orderdetails::find($list->id)->update([
                                    'tutar'=>$tutar,
                                    'bakiye'=>$bakiye,
                                    'fiyat'=>$fiyat,
                                    'kur_id'=>$request->get('kur_id'),
                                    'bazkur'=>$request->get('bazkur')
                                    ]);   
                    if($order->orderstatuses_id!=$request->orderstatuses_id && $list->kalan > 0)
                    {
                        if($request->orderstatuses_id == 3 || $request->orderstatuses_id == 4)
                        $store=store::where('urun_id',$list->urun_id)->increment('miktar',$list->kalan);
                        else if($request->orderstatuses_id == 2)
                        $store=store::where('urun_id',$list->urun_id)->decrement('miktar',$list->kalan);
                    }
            }
        }    
         $order->update($request->all());
        return redirect('/order/order')->with('success','Sipariş Güncellendi');
        }
        else if ($_POST['action'] == 'Farklı Kaydet') 
        {
            $yil = mb_substr(date('Y'),-2);
            $no = order::where('no','like','NP'.$yil.date('md').'%')->select('no')->orderBy('no','desc')->first();   
         if($no) 
         {
         $getno = mb_substr($no->no, -2, null, 'utf8'); $getno = $getno+1;
         $numara=str_pad($getno, 2 , "0",STR_PAD_LEFT);
         $sipno =  'NP'.$yil.date('md').$numara; 
         }
         else $sipno =  'NP'.$yil.date('md').'01';
          $money = str_replace([',', ','], ['.', '.'], $request ->get('bazkur'));
           
            $request['no']=$sipno;
            $request['bazkur']=$money;
            $request['users_id']=Auth::id();
            $order=order::create($request->all());
            $oldorder=order::where('id',$id)->with('orderdetails')->first();

            foreach ($oldorder->orderdetails as $list) {
                            $fiyat= $list->listefiyat - (($list->listefiyat)*($request->iskonta/100));
                            $tutar= (($list->listefiyat)-(($list->listefiyat)*($request->iskonta/100))) * ($list->miktar);
                                  if($order->kur_id==1)
                                   $bakiye=$tutar;
                                   else
                                   $bakiye= $tutar*$request->get('bazkur');
                orderdetails::insert([
                       'order_id'=>$order->id,
                       'urun_id'=>$list->urun_id,
                       'kur_id'=>$order->kur_id,
                       'listefiyat'=>$list->listefiyat,
                       'fiyat'=>$fiyat,
                       'bazkur'=>$request->bazkur,
                       'miktar'=>$list->miktar,
                       'kalan'=>$list->miktar,
                       'tutar'=>$tutar,
                       'bakiye'=>$bakiye,
                       'users_id'=>Auth::id(),
                       'created_at'=> now()
                   ]);
                   if($list->miktar)
                        {
                        if(store::where('urun_id',$list->urun_id)->first())   
                           {
                               store::where('urun_id',$list->urun_id)->decrement('miktar',$list->miktar);
                           }
                           else 
                           {
                               store::insert([
                                   'urun_id'=>$list->urun_id,
                                   'miktar'=>'-'.$list->miktar,
                                   'users_id'=>Auth::id()
                               ]);
                           }
                       }
            }
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
        $order = order::find($id);
        $orderdetails=orderdetails::where('order_id',$id)->get();
        $order -> delete(); $orderdetails->delete();
        return redirect('/order/order')->with('success','Sipariş Silindi');
    }
    public function js()
    {
        $order=order::with('firma','orderstatus')->orderbydesc('id')->get();
        return Datatables::of($order)
      ->addColumn('action', function ($order) {
        $a= '<table><tr>
        <td><a href="order/'.$order->id.'" title="Detay" style="color:black"><i class="fas fa-desktop fa-1x"></i></a></td>
        <td><a href="proforma/'.$order->id.'" title="Proforma" style="color:orange"><i class="fas fa-desktop fa-1x"></i></a></td>
        <td><a href="sevkreport/'.$order->id.'" title="Sevk Bilgileri" style="color:black"><i class="fas fa-truck fa-1x"></i></a></td>
        <td><a href="'.route('orderdetail.show',$order->id).'" title="Ürün Ekle" style="color:black"><i class="fas fa-plus-circle fa-1x"></i></a></td>
        <td><a href="order/'.$order->id.'/edit" style="color:black" title="Düzenle"><i class="far fa-edit fa-1x"></i></a></td>
        <td class="sil"><div class="delete-form">
        <form action="order/'.$order->id.'" method="POST">
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

    public function sevkreport($id)
    {
        $order=order::with(['firma','orderdetails','shipping'=>function($q){
            $q->groupby('ship_id');
        }])->where('id',$id)->first();
        //return $order;
        return view('order.sevkreport',compact('order'));
    }
    public function kgsevk()
    {
        $kgsevk=kgsevk::orderbydesc('id')->paginate(10);
        return view('order.kgsevk',compact('kgsevk'));
    }
    public function kgsevkcreate()
    {
        $firma=firma::get();
        $urun=urun::get();
        $unit=unit::get();
        return view('order.kgsevkcreate',compact('urun','firma','unit'));
    }
    public function kgsevkstore(Request $request)
    {
        $request['users_id']=Auth::id();
        kgsevk::create($request->all());
        $cari=cari::where('firma_id',$request->firma_id)->latest()->first();
        cari::create([
            'firma_id'=>$request->firma_id,
            'trh'=> now(),
            'vadetrh'=> now(),
            'tutar'=> $request->fiyat*$request->miktar,
            'bakiye'=> $request->fiyat*$request->miktar + $cari->bakiye ,
            'aciklama'=> 'Standart Dışı Satış',
            'users_id'=> Auth::id()
        ]);
        return redirect('order/kgsevk');
    }
    public function kgsevkshow($id)
    {
        $kgsevk=kgsevk::where('id',$id)->with('firma','urun','unit')->first();
        return view('order.kgsevkshow',compact('kgsevk'));
    }

    public function report()
    {
        return view('order.report');
    }

    public function reportjs()
    {
        $order=DB::table('orderdetails as od')
        ->join('uruns as u','u.id','=','od.urun_id')
        ->leftjoin('orders as o','o.id','=','od.order_id')
        ->leftjoin('orderstatuses as os','os.id','=','o.orderstatuses_id')
        ->leftjoin('firmas as f','f.id','=','o.firma_id')
        ->select('f.name as firma','u.no','u.name as urun','os.name as durum','o.no as orderno','o.id as order_id','u.id as urun_id',DB::raw('SUM(od.miktar) AS sipmik'),DB::raw('SUM(od.kalan) AS kalansipmik'),'u.koliiciadet','od.fiyat',(DB::raw('SUM(od.miktar) - SUM(od.kalan) as giden')),(DB::raw('(SUM(od.kalan))/u.koliiciadet as koli')),(DB::raw('(SUM(od.kalan))*od.fiyat as tutar'))  )
        ->where('od.kalan','>',0)
        ->whereNotNull('o.id')
        ->groupby('f.id','od.urun_id','o.id')
        ->orderby('o.id')
        ->get();
        return Datatables::of($order)
      ->make(true);

    }

    public function proforma($id)
    {
        $order=order::
        leftjoin('orderdetails as od','od.order_id','=','orders.id')
        ->leftjoin('uruns as u','u.id','=','od.urun_id')
        ->select('orders.*',DB::raw('(SUM(od.kalan)) as miktar')
            // ,DB::raw('(SUM(od.fiyat)) as fiyat')
            ,'od.fiyat as fiyat'
            ,DB::raw('(SUM(od.kalan * od.fiyat)) as tutar'),'u.tmad','u.no')
        ->where('orders.id',$id)
        ->where('od.kalan','>', 0)
        ->groupby('u.tmad')
        ->get();
        // return $order;
        return view('order.proforma',compact('order'));
    }

    public function urunreport()
    {
        return view('order.urunreport');
    }
    public function urunreportjs(Request $request)
    {
        $gtrh='';$ctrh='';
        $urun= new shipping;
        $urun= $urun->leftjoin('uruns as u','u.id','=','shippings.urun_id');
        // $urun= $urun->leftjoin('orderdetails as od','u.id','=','od.urun_id');
        if(isset($request->date))
        {
            $date = explode(" > ", $request->date);
            $urun = $urun->where('shippings.created_at','>=',date('Y-m-d',strtotime($date[0])));
            $urun = $urun->where('shippings.created_at','<=' ,date('Y-m-d',strtotime($date[1])));
        $gtrh=date('d-m-Y',strtotime($date[0]));
        $ctrh=date('d-m-Y',strtotime($date[1]));
        }
        if(isset($request->kod))
        {
            $urun =$urun->where('u.no',$request->kod);
        }
        if(isset($request->urun))
        {
            $urun =$urun->where('u.name','LIKE','%'.$request->urun.'%');
        }
        $urun=$urun->select('u.id','u.name','u.no'
            ,DB::raw('count(shippings.id) as mik')
        );

        $urun=$urun->groupby('u.id')->orderby('u.no')->get();
                    return view('order.urunreport' ,compact('urun','gtrh','ctrh'));

        // $urun= new urun;
        // // $urun=$urun->join(DB::raw("(SELECT 
        // //                     count(s.id) as count,s.urun_id,s.order_id,od.fiyat,od.fiyat*count(s.id) as tl,od.created_at as date
        // //                     FROM shippings as s
        // //                     left join orderdetails od on od.order_id=s.order_id 
        // //                     left join uruns u on u.id=s.urun_id 
        // //                     GROUP BY s.order_id
        // //                     ) as a"),function($join){
        // //                     $join->on("a.urun_id","=","uruns.id");
        // //                    });
        // $urun=$urun->select('uruns.*','a.fiyat','a.order_id'
        //                     // ,'a.count'
        //                     ,DB::raw('sum(a.count) as mik')
        //                     ,DB::raw('sum(a.tl) as tl')
        //                     // ,'a.tl'
        //                     );
        // // if(isset($request->date))
        // // {
        // //     $date = explode(" > ", $request->date);
        // //     $urun = $urun->where('date','>=',$date[0]);
        // //     $urun = $urun->where('date','<=' ,$date[1]);
        // // }
        // $urun=$urun->groupby('uruns.id')->get();
    }
     public function urunreport2()
    {
        return view('order.urunreport2');
    }
    public function urunreportjs2(Request $request)
    {
        $gtrh='';$ctrh='';
        $urun= new shipping;
        $urun= $urun->leftjoin('uruns as u','u.id','=','shippings.urun_id');
        $urun= $urun->leftjoin('urunaltkategoris as ua','ua.id','=','u.urunaltkategori_id');
        if(isset($request->date))
        {
        $date = explode(" > ", $request->date);
        $urun = $urun->where('shippings.created_at','>=',date('Y-m-d',strtotime($date[0])));
        $urun = $urun->where('shippings.created_at','<=' ,date('Y-m-d',strtotime($date[1])));
        $gtrh=date('d-m-Y',strtotime($date[0]));
        $ctrh=date('d-m-Y',strtotime($date[1]));
        }
        if(isset($request->kod))
        {
            $urun =$urun->where('u.no',$request->kod);
        }
        if(isset($request->urun))
        {
            $urun =$urun->where('u.name','LIKE','%'.$request->urun.'%');
        }
        // $urun=$urun->join(DB::raw("(select sum(a.asd) as cmik,a.no from(select count(s.id)*u.paketiciadet as asd,u.id,u.no
        //                             from shippings s 
        //                             join uruns u on u.id=s.urun_id
        //                             group by u.id)a group by(a.no)) as b"),function($join){
        //                      $join->on("b.no","=","u.no");
        //                     });
        $urun=$urun->select('u.id','u.name','u.no','ua.urunkategori_id'
            ,DB::raw('count(shippings.id) as mik')
            // ,DB::raw('count(shippings.id)*u.paketiciadet as cmik')
            // ,DB::raw('sum(a.asd) as kdjasbdcmik')
            ,DB::raw('count(shippings.id)*u.paketiciadet as cmik')
            // ,'b.cmik'
        );

        $urun=$urun->groupby('u.no')->orderby('u.no')->get();
                    return view('order.urunreport2' ,compact('urun','gtrh','ctrh'));
    }

    public function urunreport3()
    {
        $urun=urun::get();
        return view('order.urunreport3',compact('urun'));
    }
    public function urunreportjs3(Request $request)
    {
        // $urun=new urun;
        // // $urun=$urun->join(DB::raw("(select  count(s.id) as ship,s.created_at as shipdate,u.id,u.no
        // //                             from shippings s 
        // //                             left join uruns u on u.id=s.urun_id
        // //                             group by DAY(s.created_at),u.id)a"),function($join){
        // //                      $join->on("a.id","=","uruns.id");
        // //                     });
        // // $urun=$urun->join(DB::raw("(select  count(s.id) as product,s.created_at as productdate,u.id,u.no
        // //                             from uretims s 
        // //                             left join uruns u on u.id=s.urun_id
        // //                             group by DAY(s.created_at),u.id)b"),function($join){
        // //                      $join->on("b.id","=","uruns.id");
        // //                     });
        // $urun=$urun->join(DB::raw("select * from (
        //                                 select  count(s.id) as count,date_format(s.created_at,'%Y-%m-%d') as date,u.id,u.no,'SEVK' as type
        //                                 from shippings s 
        //                                 left join uruns u on u.id=s.urun_id
        //                                 group by date_format(s.created_at,'%Y-%m-%d'),u.id
        //                                 UNION ALL
        //                                 select  count(s.id) as count,date_format(s.created_at,'%Y-%m-%d') as date,u.id,u.no,'ÜRETİM' as type
        //                                 from uretims s 
        //                                 left join uruns u on u.id=s.urun_id
        //                                 group by date_format(s.created_at,'%Y-%m-%d'),u.id
        //                             )a "),function($join){
        //                      $join->on("a.id","=","uruns.id");
        //                     });
        // $urun=$urun->where('uruns.id',1856);
        // $urun=$urun->select(
        //     // 'uruns.id'
        //     // ,'uruns.no'
        //     // ,'uruns.name'
        //     // ,'a.count'
        //     // ,'a.date'
        //     // ,'a.type'
        //     'a.*'
        //     // ,'a.ship'
        //     // ,'a.shipdate'
        //     // ,'b.product'
        //     // ,'b.productdate'
        // );
        // $urun=$urun->groupby('a.date')->get();

        $urun=new shipping; 
        $urun=$urun->join('uruns as u','u.id','shippings.urun_id');
        if($request->urun) $urun=$urun->where('u.id',$request->urun);
        if($request->kod) $urun=$urun->where('u.no',$request->kod);
        $urun=$urun->select(
            DB::raw("DATE_FORMAT(shippings.created_at,'%d-%m-%Y') date")
            ,DB::raw("count(shippings.id) count")
            ,'u.id'
            ,'u.no'
            ,'u.name'
            ,DB::raw("'sevk' as type")
                );
        $urun=$urun->groupby(DB::raw("DATE_FORMAT(shippings.created_at,'%Y-%m-%d')"));

        $uruns= new uretim;
        $uruns=$uruns->join('uruns as u','u.id','uretims.urun_id');
        if($request->urun)$uruns=$uruns->where('u.id',$request->urun);
        if($request->kod) $uruns=$uruns->where('u.no',$request->kod);
        $uruns=$uruns->select(
            DB::raw("DATE_FORMAT(uretims.created_at,'%d-%m-%Y') date")
            ,DB::raw("count(uretims.id) count")
            ,'u.id'
            ,'u.no'
            ,'u.name'
            ,DB::raw("'üretim' as type")
                );
        $uruns=$uruns->groupby(DB::raw("DATE_FORMAT(uretims.created_at,'%Y-%m-%d')"))->unionAll($urun)->get();
        // $s=$urun->UNIONALL($uruns);

        $urun=urun::get();
                    return view('order.urunreport3' ,compact('uruns','urun'));
    }

}
