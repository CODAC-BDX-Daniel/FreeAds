<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\MyAds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MyAdsController extends Controller
{
    public function show($ad_id)
    {
        //get ad details
        $AdToDisplay = DB::table('ads')
            ->join('users', 'ads.user_id', '=', 'users.id')
            ->select('ads.id', 'ads.title', 'ads.category', 'ads.description', 'ads.location', 'ads.price', 'ads.updated_at', 'ads.picture', 'users.name', 'users.phone', 'users.email')
            ->where('ads.id', '=', $ad_id)
            ->get();
        //display form filled with ad details

        return view('ad_create', ['AdToDisplay' => $AdToDisplay]);

//        dd($AdToDisplay);


//        return 'hououuuuuu';
    }


    public function index($userId)
    {
        //récupérer les annonces du user connecté
        $myAds = DB::table('ads')
            ->join('users', 'ads.user_id', '=', 'users.id')
            ->select('ads.id', 'ads.title', 'ads.category', 'ads.description', 'ads.location', 'ads.price', 'ads.updated_at', 'ads.picture', 'users.name', 'users.phone', 'users.email')
            ->where('users.id', '=', $userId)
            ->get();
//        var_dump($myAds);
//        var_dump($userId);
//        return 'JE FONCTIONNE BIEN ';
        //envoyer les données dans la view

//        check si  l'user id dans l'url est le même que celui qui est connecté

//        id dans l'url
//       var_dump($userId,);
//       dd($userId);
//        var_dump(Auth::id());
//        id de celui qui est connecté
//$connectedUser = Auth::id();
        if ($userId != Auth::id()) {
//           return redirect(route('homePage'));
            return redirect('/');
        } else {
            return view('my_ads', ['myAds' => $myAds]);
        }
    }

    public function update(Request $request, $ad_id)
    {

        //picture update
        //if new images downloaded
        $userId = Auth::id();
        if ($request->hasFile('image')) {
            $newImageName = time() . '-' . str_replace(' ', '', $request->title) . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $newImageName);
            DB::table('ads')
                ->where('id', $ad_id)
                ->update(
                    [
                        'title' => request('title'),
                        'category' => request('category'),
                        'location' => request('location'),
                        'price' => request('price'),
                        'picture' => $newImageName,
                        'description' => request('description')
                    ]
                );
//            if admin -> redirect to ads admin page
            if (Auth::user()->admin == 'yes') {

                return redirect()->route('ads_admin');
            } else {
//                else if user not admin -> redirect to my ads
                return redirect()->route('my_ads', ['userId' => $userId]);
            }

        } else {
            DB::table('ads')
                ->where('id', $ad_id)
                ->update(
                    [
                        'title' => request('title'),
                        'category' => request('category'),
                        'location' => request('location'),
                        'price' => request('price'),
                        'description' => request('description')
                    ]
                );
            // if the connected user is admin -> redirect to ads admin page
            if (Auth::user()->admin == 'yes') {

                return redirect()->route('ads_admin');
            } else {
            //else if user connected not admin -> redirect to my ads
                return redirect()->route('my_ads', ['userId' => $userId]);
            }
        }

        $request->image->move(public_path('images'), $newImageName);

    }
}
