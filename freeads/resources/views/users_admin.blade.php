@extends('layouts.layout')

@section('content')
    <h1>ADMIN PAGE - USERS MANAGEMENT </h1>
    {{--       {{dd($usersList)}}--}}
    {{--        <div>Name - {{$user->name}}</div>--}}
    <table>
        <tr>
            <th>ID</th>
            <th>LOGIN</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>PHONE</th>
            <th>ADMIN</th>
            <th>CREATED AT</th>
            <th>UPDATE AT</th>
            <th></th>
            <th></th>
        </tr>
        @foreach($usersList as &$user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->login}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->admin}}</td>
                <td>{{date('Y-m-d', strtotime($user->created_at ))}}</td>
                <td>{{date('Y-m-d', strtotime($user->updated_at ))}}</td>
                <td>
                    <a href="/display_user_edit_admin/{{$user->id}}">
                        <button>Edit</button>
                    </a>
                </td>
                <td>
                    <form action="/admin_delete_user/{{$user->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="pagination_wrapper">
        {{$usersList->links()}}
    </div>

@endsection
