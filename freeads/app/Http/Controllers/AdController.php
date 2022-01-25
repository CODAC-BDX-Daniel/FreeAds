<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class AdController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = DB::table('ads')
//            ->join('users', 'ads.user_id', '=', 'users.id')
//            ->select('ads.*', 'users.name', 'users.email', 'users.phone')
            ->paginate(3);

        // retrieve ads from db

//        $ads = Ad::all();

        // send ads to the view
        return view('homePage', ['ads' => $ads]);
    }

    public function showOneCategoryAds(Request $request, $categoryName)
    {
//if filter applied


        if (isset($request->filter)) {
//            dd($request->filter);
            $filter = $request->filter;
            //Switch filter
            switch ($filter) {
                case 'mostRecent':
                    $ads = DB::table('ads')
                        ->where('category', '=', $categoryName)
                        ->orderBy('created_at', 'desc')
//                        ->latest()
                        ->paginate(3)
                        ->withQueryString();
                    break;
                case 'oldest':
                    $ads = DB::table('ads')
                        ->where('category', '=', $categoryName)
                        ->orderBy('created_at', 'asc')
//                        ->oldest()
                        ->paginate(3)
                        ->withQueryString();

                    break;
                case 'priceAsc':
                    $ads = DB::table('ads')
                        ->where('category', '=', $categoryName)
                        ->orderBy('price', 'asc')
                        ->paginate(3)
                        ->withQueryString();
                    break;
                case 'priceDesc':
                    $ads = DB::table('ads')
                        ->where('category', '=', $categoryName)
                        ->orderBy('price', 'desc')
                        ->paginate(3)
                        ->withQueryString();
                    break;
                default:
                    return 'What else?';
            }

            //if search input submitted
        } else if ($request->search_submitted) {

            $input = $request->search_submitted;
            $ads = DB::table('ads')
                ->where('category', '=', $categoryName)
                ->where(function ($query) use ($request) {
                    $query->where('title', 'like', '%' . $request->search_submitted . '%')
                        ->orwhere('description', 'like', '%' . $request->search_submitted . '%')
                ->orWhere('description', 'like', '%' . $request->search_submitted . '%')
                ->orWhere('location', 'like', '%' . $request->search_submitted . '%')
                ->orWhere('price', 'like', '%' . $request->search_submitted . '%');
           })
                ->paginate(3);

    } else
{
//if no filter and no search submitted then retrieve all the ads and display them
$ads = DB::table('ads')
->where('category', '=', $categoryName)
->paginate(3);
}


return view('oneCategoryAds', [
        'categoryName' => $categoryName,
        'ads' => $ads,
        'filter' => $request->filter,
        'next_query' => $request->all()
    ]
);
}

/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public
function create()
{
    //
}

/**
 * Store a newly created resource in storage.
 *
 * @param \Illuminate\Http\Request $request
 * @return \Illuminate\Http\Response
 */
public
function store(Request $request)
{

    //Methods we can use on request
    //guessExtension()
    //getMimeType()
    //store()
    //asStore()
    //storePublicly()
    //move()
    //getClientOriginalName()
    //guessClientExtension()
    //getSize()
    //getError()
    //isValid()
//        $test = $request->file("image")->guessExtension();
//        $test = $request->file("image")->getClientOriginalName();
//        dd($test);
//        dd($request);


//        $request->validate(
//            [
//                'image' => 'required|mimes:jpg,jpeg,png|max:5048'
//            ]
//        );
    $newImageName = time() . '-' . str_replace(' ', '', $request->title) . '.' . $request->image->extension();
    $request->image->move(public_path('images'), $newImageName);

//        dd($newImageName);


    $AdToCreate = new Ad();
    $AdToCreate->title = request('title');
    $AdToCreate->category = request('category');
    $AdToCreate->location = request('location');
    $AdToCreate->price = request('price');
    $AdToCreate->picture = $newImageName;
    $AdToCreate->description = request('description');
    $AdToCreate->user_id = request('user_id');
//
    $AdToCreate->save();
//        dd($AdToCreate);
//        return 'I created an ad';

    $userId = Auth::id();
    return redirect()->route('my_ads', ['userId' => $userId]);
//        return redirect('/', ['message'=> 'New offer added']);
}

/**
 * Display the specified resource.
 *
 * @param int $id
 * @return \Illuminate\Http\Response
 */
public
function show($id)
{

//        return $id;
//        return 'Hello offer details';
    //retrieve ad with id from db
//        $AdToDisplay = Ad::find($id);
//        $AdToDisplay = 'toto';
//        $AdToDisplay= DB::table('ads')->where('location', 'lille')->first();
//        $AdToDisplay= DB::table('ads')->where('id', '2')->first();
//        $AdToDisplay = DB::table('ads')->find($id);

//        dd($AdToDisplay);
//        return view('ad_details', ['AdToDisplay' => $AdToDisplay]);

    $AdToDisplay = DB::table('ads')
        ->join('users', 'ads.user_id', '=', 'users.id')
        ->select('ads.id', 'ads.title', 'ads.category', 'ads.description', 'ads.location', 'ads.price', 'ads.updated_at', 'ads.picture', 'users.name', 'users.phone', 'users.email')
        ->where('ads.id', '=', $id)
        ->get();

//        var_dump($AdToDisplay);

    return view('/ad_details', ['AdToDisplay' => $AdToDisplay]);
}

/**
 * Show the form for editing the specified resource.
 *
 * @param int $id
 * @return \Illuminate\Http\Response
 */
public
function edit($id)
{
    //
}

/**
 * Update the specified resource in storage.
 *
 * @param \Illuminate\Http\Request $request
 * @param int $id
 * @return \Illuminate\Http\Response
 */
public
function update(Request $request, $id)
{

    // Retrieve ad details

    //Display view with ad details
}

/**
 * Remove the specified resource from storage.
 *
 * @param int $id
 * @return \Illuminate\Http\Response
 */
public
function destroy($ad_id)
{
    //delete the ad from db
    DB::table('ads')
        ->where('id', '=', $ad_id)
        ->delete();
//        return 'Chiiiip.... I AM DESTROYED';

    $userId = Auth::id();
//        return view('homePage');
//        return redirect()->route('my_ads', ['userId' => $userId])->with('message','OFFER REMOVED');

//        once ad deleted, if user is an admin then redirect to admin ads list
    if (Auth::user()->admin == 'yes') {
        return redirect()->route('ads_admin');
    } else {
//         if connected user is not admin then  redirect to this user's ads list
        return redirect()->route('my_ads', ['userId' => $userId]);
    }

}


public
function showAdsToAdmin()
{
    // retrieve ads from db
    $ads = DB::table('ads')
        ->join('users', 'ads.user_id', '=', 'users.id')
        ->select('ads.*', 'users.name', 'users.email', 'users.phone')
        ->paginate(5)//            ->get()
    ;
    // send ads to the view

//        dd($ads);
    return view('ads_admin', ['ads' => $ads]);
}
}
