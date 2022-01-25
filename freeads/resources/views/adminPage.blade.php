@extends('layouts.layout')

@section('content')
    <h1>ADMINPAGE</h1>
    <a href={{route('users_admin')}}>USERS</a>
    <a href={{route('ads_admin')}}>ADS</a>
@endsection
