@extends('layouts.layout')

@section('content')
    {{--        <div>{{$AdToDisplay}}</div>--}}
    {{--        <div>{{$AdToDisplay[0]->id}}</div>--}}

    @if(isset($AdToDisplay))
        {{--        Manage edition of existing ad--}}
        <form class="freeads_form" action="/update_ad/{{$AdToDisplay[0]->id}}" method="POST"
              enctype="multipart/form-data">
            <h3 class="form_title">Edit ad</h3>
            @csrf
            <input type="number" id="user_id" name="user_id" value="{{Auth::id()}}" hidden/>
            <label id="title">Title</label>
            <input type="text" id="title" name="title" placeholder="title" value="{{$AdToDisplay[0]->title}}" required/>

            {{--            <input type="text" id="category" name="category" placeholder="category"--}}
            {{--                   value="{{$AdToDisplay[0]->category}}"--}}
            {{--                   required/>--}}
            <label id="category">Category</label>
            <select name="category" required>
                {{--                <option selected disabled >Choose category</option>--}}
                <option value="cars" {{$AdToDisplay[0]->category=='cars'? 'selected' : ''}}>Cars</option>
                <option value="property" {{$AdToDisplay[0]->category=='property'? 'selected' : ''}}>Property</option>
                <option value="tech" {{$AdToDisplay[0]->category=='tech'? 'selected' : ''}}>Tech</option>
            </select>
            <label id="location">Location</label>
            <input type="text" id="location" name="location" placeholder="location"
                   value="{{$AdToDisplay[0]->location}}"
                   required/>
            <label id="price">Price</label>
            <input type="number" id="price" name="price" placeholder="price" value="{{$AdToDisplay[0]->price}}"
                   required/>
            <label id="title">Description</label>
            <textarea type="textarea" rows="10" cols="30" id="description" name="description" placeholder="description"
                      value="{{$AdToDisplay[0]->description}}" required>{{$AdToDisplay[0]->description}}
            </textarea>
            {{--            <input type="textarea"  id="description" name="description" placeholder="description"--}}
            {{--                   value="{{$AdToDisplay[0]->description}}" required/>--}}

            <input type="file" id="image" name="image" value="{{$AdToDisplay[0]->picture}}">
            <button type="submit">UPDATE</button>
        </form>
    @else
        {{--        Manage new ad creation--}}

        <form class="freeads_form" action="/" method="POST" enctype="multipart/form-data">
            @csrf
            <h3 class="form_title">Create an ad</h3>
            <input type="number" id="user_id" name="user_id" value="{{Auth::id()}}" hidden/>
            <label id="" title>Title</label>
            <input type="text" id="title" name="title" placeholder="title" required/>
            {{--            <input type="text" id="category" name="category" placeholder="category" required/>--}}
            <label id="" category>Category</label>
            <select name="category" required>
                <option selected disabled>Choose category</option>
                <option value="cars">Cars</option>
                <option value="property">Property</option>
                <option value="tech">Tech</option>
            </select>

            <label id="location">Location</label>
            <input type="text" id="location" name="location" placeholder="location" required/>
            <label id="price">Price</label>
            <input type="number" id="price" name="price" placeholder="price" required/>
            <label id="description">Description</label>
            <textarea type="textarea" rows="10" cols="30" id="description" name="description" placeholder="description"
                      required>
            </textarea>
            {{--            <input type="text" id="description" name="description" placeholder="description" required/>--}}
            <input type="file" id="image" name="image" required>
            <button type="submit">CREATE</button>
        </form>
    @endif





    {{--    <form action="/" method="POST" enctype="multipart/form-data">--}}
    {{--        @csrf--}}
    {{--        <input type="number" id="user_id" name="user_id" value="{{Auth::id()}}" hidden/>--}}
    {{--        <input type="text" id="title" name="title" placeholder="title" required/>--}}
    {{--        <input type="text" id="category" name="category" placeholder="category" required/>--}}
    {{--        <input type="text" id="location" name="location" placeholder="location" required/>--}}
    {{--        <input type="number" id="price" name="price" placeholder="price" required/>--}}
    {{--                <input type="text" id="picture" name="picture" placeholder="picture" required/>--}}
    {{--        <input type="text" id="description" name="description" placeholder="description" required/>--}}
    {{--        <input type="file" id="image" name="image" required>--}}
    {{--        <button type="submit">CREATE</button>--}}
    {{--    </form>--}}

@endsection


