<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\cari;
use App\models\current;
use App\models\pay;
use App\models\paydetail;
use App\models\payloadtype;
use App\models\type;
use App\models\kur;
use App\models\firma;
use App\models\ship;
use Auth;
use Yajra\DataTables\DataTables;

class currentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('current.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $firma = firma::with('firmatipi')->get();
        return Datatables::of($firma)
            ->addColumn('action', function ($firma) {
                $a= '<table><tr>
        <td><a href="current/'.$firma->id.'/edit" style="color:black" title="Cari"><i class="far fa-edit fa-1x"></i></a></td></tr></table>';
                return $a;
            })
            ->removeColumn('password')
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->option == 2)
        {
        $debt=current::find($request->checkbox_id);
        $paid=current::find($request->id);
        }
        else if($request->option == 1)
        {
        $debt=current::find($request->id);
        $paid=current::find($request->checkbox_id);
        }
            if($debt['debt'] > $paid['paid'])
            {
                $val=$debt['debt'] - $paid['paid']; 
                $newdebt=current::create($debt->toArray());
                $newdebt->update(['debt'=>$val]);$newdebt->save();
                $debt->update(['open_id'=>$newdebt->id,'debt'=>$paid->paid,'paid'=>$paid->paid,'close_id'=>$paid->id,'pay_id'=>$paid->pay_id,'paydetail_id'=>$paid->paydetail_id,'vadetrh'=>$paid->vadetrh,'kur_id'=>$paid->kur_id,'durum_id'=>2,'users_id'=>Auth::id()]);
                $paid->update(['open_id'=>$newdebt->id,'close_id'=>$debt->id,'debt'=>$paid->paid,'order_id'=>$debt->order_id,'ship_id'=>$debt->ship_id,'durum_id'=>2,'users_id'=>Auth::id()]);

            }else if ($debt['debt'] < $paid['paid'])
            {
                $val=$paid['paid'] - $debt['debt']; 
                $newpaid=current::create($paid->toArray());
                $newpaid->update(['paid'=>$val]);$newpaid->save();
                $debt->update(['open_id'=>$newpaid->id,'close_id'=>$paid->id,'paid'=>$debt->debt,'pay_id'=>$paid->pay_id,'paydetail_id'=>$paid->paydetail_id,'vadetrh'=>$paid->vadetrh,'kur_id'=>$paid->kur_id,'durum_id'=>2,'users_id'=>Auth::id()]);
                $paid->update(['open_id'=>$newpaid->id,'close_id'=>$debt->id,'paid'=>$debt->debt,'debt'=>$debt->debt,'order_id'=>$debt->order_id,'ship_id'=>$debt->ship_id,'durum_id'=>2,'users_id'=>Auth::id()]);

            }else if ($debt['debt'] == $paid['paid'])
            {
                $debt->update(['close_id'=>$paid->id,'paid'=>$debt->debt,'pay_id'=>$paid->pay_id,'paydetail_id'=>$paid->paydetail_id,'vadetrh'=>$paid->vadetrh,'kur_id'=>$paid->kur_id,'durum_id'=>2,'users_id'=>Auth::id()]);
                $paid->update(['close_id'=>$debt->id,'debt'=>$debt->debt,'order_id'=>$debt->order_id,'ship_id'=>$debt->ship_id,'durum_id'=>2,'users_id'=>Auth::id()]);
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
        $firma = firma::find($id);
        $current=current::with('order','ship','pay','kur','durum')->where('firma_id',$id)->orderby('vadetrh')->get();
        return view('current.edit',compact('current','firma'));
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

    }
    public function back(Request $request)
    {
        $current=current::find($request->id);
        $currentback=current::where('id',$current->open_id)->first();
        if(isset($currentback))
        {
            if($currentback->option == 2 && empty($currentback->close_id) && empty($currentback->open_id))
            {
                // return 'jknasdn';
                $val= $current['paid'] + $currentback['paid'];
                $currentback->update(['paid'=>$val]);
                   if($current->option == 1)
                {
                current::where('id',$current->id)->update(['pay_id'=>null,'paydetail_id'=>null,'paid'=>null,'durum_id'=>1,'close_id'=>null,'open_id'=>null,'users_id'=>Auth::id()]);
                current::where('id',$current->close_id)->delete();
                }
                    else if($current->option == 2)
                {
                current::where('id',$current->close_id)->update(['pay_id'=>null,'paydetail_id'=>null,'paid'=>null,'durum_id'=>1,'close_id'=>null,'open_id'=>null,'users_id'=>Auth::id()]);
                current::where('id',$current->id)->delete();   
                }
            }
            else if($currentback->option==1 && empty($currentback->close_id) && empty($currentback->open_id))
            {
                // return 'asd';
                $val= $current['paid'] + $currentback['debt'];
                $currentback->update(['debt'=>$val]);
                if($current->option == 1)
                {
                current::where('id',$current->close_id)->update(['ship_id'=>null,'order_id'=>null,'debt'=>null,'durum_id'=>1,'close_id'=>null,'open_id'=>null,'users_id'=>Auth::id()]);
                current::where('id',$current->id)->delete();
                }elseif ($current->option == 2) 
                {
                current::where('id',$current->id)->update(['ship_id'=>null,'order_id'=>null,'debt'=>null,'durum_id'=>1,'close_id'=>null,'open_id'=>null,'users_id'=>Auth::id()]);
                current::where('id',$current->close_id)->delete();
                }    
            }
            else
            {
                 if($current->option == 1)
                {
                current::where('id',$current->id)->update(['pay_id'=>null,'paydetail_id'=>null,'paid'=>null,'durum_id'=>1,'close_id'=>null,'open_id'=>null,'users_id'=>Auth::id()]);
                current::where('id',$current->close_id)->update(['ship_id'=>null,'order_id'=>null,'debt'=>null,'durum_id'=>1,'close_id'=>null,'open_id'=>null,'users_id'=>Auth::id()]);
                }elseif ($current->option == 2) 
                {
                current::where('id',$current->id)->update(['ship_id'=>null,'order_id'=>null,'debt'=>null,'durum_id'=>1,'close_id'=>null,'open_id'=>null,'users_id'=>Auth::id()]);
                current::where('id',$current->close_id)->update(['pay_id'=>null,'paydetail_id'=>null,'paid'=>null,'durum_id'=>1,'close_id'=>null,'open_id'=>null,'users_id'=>Auth::id()]);
                }    
            }

        }
    }
}
