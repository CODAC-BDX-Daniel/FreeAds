<?php

use Illuminate\Support\Facades\Auth;

//$user = Auth::user();
//$user = Auth::id();
//$email = Auth::user()->email;
//$admin = Auth::user()->admin;
//dd($user);
//dd($email);
//    dd($admin);
?>

<nav class="header_nav">
    {{--    IF USER LAMBDA CONNECTED --}}
    @if(Auth::check() && Auth::user()->admin == 'no')

        <div class="home_btn">
            <a href="{{route('home')}}">
                <div class="company_logo">
                    <img src="{{asset("icones/icone_logo.png")}}"/>
                    <span>FREE-ADS</span>
                </div>
            </a>
        </div>

        <div class="other_btns">
            <p>Welcome {{ucfirst(Auth::user()->name)}}!</p>
            <a href="{{route('my_ads',Auth::id())}}">My ads</a>
            <a href="{{route('ad_create')}}">Create Ad</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <input type="submit" value="LOGOUT">
            </form>
        </div>

        {{--    if USER ADMIN -CONNECTED --}}
    @elseif(Auth::check() && Auth::user()->admin == 'yes')
        <div class="home_btn">
            <a href="{{route('home')}}">
                <div class="company_logo">
                    <img src="{{asset("icones/icone_logo.png")}}"/>
                    <span>FREE-ADS</span>
                </div>
            </a>
        </div>        <div class="other_btns">
            <a href="/adminPage">AdminPage</a>
            <a href="{{route('ad_create')}}">Create Ad</a>
            {{--            LOGOUT BUTTON--}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                {{--                <a href="route('logout')">--}}
                <input type="submit" value="LOGOUT"/>
                {{--                </a>--}}
            </form>
        </div>
    @else
        {{--    if USER NOT CONNECTED--}}
        <div class="home_btn">
            <a href="{{route('home')}}">
                <div class="company_logo">
                    <img src="{{asset("icones/icone_logo.png")}}"/>
                    <span>FREE-ADS</span>
                </div>
            </a>
        </div>
        <div class="other_btns">
            <a href="{{route('ad_create')}}">Create Ad</a>
            <a href="/login">LOGIN</a>
            <a href="{{route('register')}}">
                REGISTER
            </a>
        </div>
    @endif
</nav>

<div class="ads_categories">
    <a href="{{route('category_ads','cars')}}">Cars</a>
    <a href="{{route('category_ads','property')}}">Property</a>
    <a href="{{route('category_ads','tech')}}">Tech</a>
</div>


