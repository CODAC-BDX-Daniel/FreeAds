@extends('layouts.layout')

@section('content')
    <h1 id="adminpage">ADMIN - Ads Management</h1>
    {{--    build table --}}
    @isset($deletionSuccess)
        <h2>{{$deletionSuccess}}</h2>
    @endisset
    <table>
        <tr>
            <th>ID</th>
            <th>TITLE</th>
            <th>CATEGORY</th>
            <th>DESCRIPTION</th>
            <th>LOCATION</th>
            <th>PRICE</th>
            <th>USERNAME</th>
            <th>EMAIL</th>
            <th>PHONE</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        @foreach($ads as $ad)
            <tr>
                <td>{{$ad->id}}</td>
                <td>{{$ad->title}}</td>
                <td>{{$ad->category}}</td>
                <td>{{$ad->description}}</td>
                <td>{{$ad->location}}</td>
                <td>{{$ad->price}} EUR</td>
                <td>{{$ad->name}}</td>
                <td>{{$ad->email}}</td>
                <td>{{$ad->phone}}</td>
                <td>
                    <a href="/ad_details/{{$ad->id}}">
                        <button>View</button>
                    </a>
                </td>
                <td>
                    <a href="/edit_ad/{{$ad->id}}">
                        <button>Edit</button>
                    </a>
                </td>
                <td>
                    <form action="/admin_delete_ad/{{$ad->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>

        @endforeach
    </table>
    <div class="pagination_wrapper">
        {{$ads->links()}}
    </div>

@endsection


