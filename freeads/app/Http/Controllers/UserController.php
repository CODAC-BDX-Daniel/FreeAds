<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public static function checkAdminRight()
    {
        //get user status
//        $user = Auth::user();
//        $email = Auth::user()->email;
//        $userIsAdmin = Auth::user()->admin;
//        dd($userIsAdmin);
        if (Auth::user()->admin == 'no') {
            redirect('/home');
        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Display  users in adminPage
    public function index()
    {
        //retrieve all users from DB
        $usersList = DB::table('users')
            ->where('admin', 'no')
            ->paginate(3);
//            ->get();
        //send users data to the view named
        return view('users_admin', ['usersList' => $usersList]);
    }


    //Display user to be edited by admin inside a form
    public function show($user_id)
    {
        //retrieve data about the user
        $userInfo = DB::table('users')
            ->where('id', '=', $user_id)
            ->first();
//        return $userInfo;
        //send user data to the view called
        return view('userEdit_admin', ['user' => $userInfo]);
    }


    public function update(Request $request, $user_id)
    {
        // Check if is admin
        UserController::checkAdminRight();


        //if admin status OK proceed to user update
        DB::table('users')
            ->where('id', $user_id)
            ->update(
                [
                    'login' => request('login'),
                    'name' => request('name'),
                    'email' => request('email'),
                    'phone' => request('phone'),
                    'admin' => request('admin'),
                ]
            );
        return redirect()->route('users_admin');
    }

    public function destroy($user_id)
    {
        //Delete the user from db
        DB::table('users')
            ->where('id', '=', $user_id)
            ->delete();
        //redirect to user list
        return redirect()->route('users_admin');
    }

}
