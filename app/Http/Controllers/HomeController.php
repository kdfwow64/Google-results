<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Info;
use App\Model\BlackList;
use App\Model\Permission;
use DB;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission = Permission::get(['*'])->first();
        return view('home',compact('permission'));
    }

    public function getDomains(Request $request) {
        $domain = $request->input('domain');
        $ss = '%'.$domain.'%';
        $items = Info::where('domain_name','like',$ss)->get(['*']);
        return response()->json($items);
    }

    public function getEmail(Request $request) {
        $email = $request->input('email');
        $ss = '%'.$email.'%';
        $items = Info::where('email','like',$ss)->get(['*']);
        return response()->json($items);
    }

    public function blacklist() {
        $blacklist = BlackList::get(['*']);
        $domain_count = 0;
        $email_count = 0;
        return view('others.blacklist',compact('blacklist','domain_count','email_count'));
    }

    public function permission() {
        $permission = Permission::get(['*']);
        return view('others.permission',compact('permission'));
    }

    public function insertD(Request $request) {
        $new_info = new BlackList;
        $new_info->domain = $request->input('blacklist_domain');
        $new_info->domainORemail = '1';
        $new_info->save();
        $blacklist = BlackList::get(['*']);
        $domain_count = 0;
        $email_count = 0;
        return redirect()->action('HomeController@blacklist');
    }

    public function insertE(Request $request) {
        $new_info = new BlackList;
        $new_info->domain = $request->input('blacklist_email');
        $new_info->domainORemail = '2';
        $new_info->save();
        $blacklist = BlackList::get(['*']);
        $domain_count = 0;
        $email_count = 0;
        return redirect()->action('HomeController@blacklist');
    }

    public function blacklistDelete($id) {
        $del = BlackList::where('id',$id)->first();
        $del->delete();
        $blacklist = BlackList::get(['*']);
        $domain_count = 0;
        $email_count = 0;
        return redirect()->action('HomeController@blacklist');
    }

    public function setPermission(Request $request) {
        $id = $request->input('id');
        $value = $request->input('value');
        if($value == 'true')
            DB::update('update permissions set value = 1 where id = ?' , [$id]);
        else
            DB::update('update permissions set value = 0 where id = ?' , [$id]);
        echo $value;
    }
}
