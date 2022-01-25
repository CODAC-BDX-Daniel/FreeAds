@extends('layouts.layout')

@section('content')
    {{--    <h2>{{$myAds}}</h2>--}}
    <h1>MY ADS</h1>
    <div>{{$message ?? ''}}</div>
    {{--    <h2 style="color:red">{{$message ?? ''}}</h2>--}}

    @foreach($myAds as $myAd)

        {{--@dd($myAd)--}}

        <div class="product_ad_tag_wrapper">
            <img src="{{asset("/images/$myAd->picture")}}"/>
            <div class="product_info_block">
                <div>Category - {{ucfirst($myAd->category)}}</div>
                <div>Title - {{ucfirst($myAd->title)}}</div>
                <div>Price - {{ucfirst($myAd->price)}} EUR</div>
                <div>Location - {{ucfirst($myAd->location)}}</div>
                <div>Published {{ucfirst($myAd->updated_at)}}</div>
                <h3>Description</h3>
                <div>{{ucfirst($myAd->description)}}</div>

                <div class="edit_delete_btn button">
                    <a href="/edit_ad/{{$myAd->id}}">
                        <button>Edit</button>
                    </a>
                    <form action="/delete_ad/{{$myAd->id}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button>Delete</button>
                    </form>
                </div>
            </div>
        </div>
        <hr>
    @endforeach
@endsection



