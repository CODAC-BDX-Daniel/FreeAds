@extends('layouts.layout')

@section('content')

{{--        {{dd($user)}}--}}
<form class="freeads_form" action="{{route('update_user_by_admin',$user->id)}}" method="POST">
    @csrf
    <h3>Edit user data</h3>
    <label id="login">Login</label>
    <input type="text" id='login' name='login' value="{{$user->login}}" required/>
    <label id="name">Name</label>
    <input type="text" id='name' name='name' value="{{$user->name}}" required/>
    <label id="email">Email</label>
    <input type="text" id='email' name='email' value="{{$user->email}}" required/>
    <label id="phone">Phone</label>
    <input type="text" id='phone' name='phone' value="{{$user->phone}}" required/>
    <label id="isAdmin">Admin Privileges</label>
    <select id="admin" name="admin" required >
        <option value="yes" {{$user->admin =='yes'? 'selected' : ''}}>YES</option>
        <option value="no" {{$user->admin =='no'? 'selected' : ''}}>NO</option>
    </select>
    <button type="submit">UPDATE</button>
</form>

@endsection
