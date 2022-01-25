<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function destroy($ad_id)
    {
//        //delete the ad from db
//        DB::table('ads')
//            ->where('id', '=', $ad_id)
//            ->delete();
//        //redirect to the users list updated
//        return view('users_admin');
    }
}
