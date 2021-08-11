<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\ DB;
use Yajra\Datatables\Datatables;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        //Role::create(['name'=>'admin']);
        //$permission =permission::create(['name'=>'publisher post']);
        //$role = role::findbyid(1);
        //$permission = permission::findbyid(2);
        //$role->givePermissionTo($permission); // role has permission
        //$permission->assignRole($role);         //role has permission
        //auth()->user()->givePermissionTo('edit post');  //model has permission
        //auth()->user()->assingleRole('writer');   //model has role 
        //return auth()->user()->permission; //kullanıcı izinleri getirir
        //return auth()->user()->fetDirectPermission; //kullanıcı izinleri getirir
        return view('home');
    }
}
