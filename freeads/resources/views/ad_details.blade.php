@extends('layouts.layout')

@section('content')
    @if(isset($AdToDisplay))
        <div class="product_ad_detailed_wrapper">

            <div class="img_info_wrapper">

                <img src="/images/{{$AdToDisplay[0]->picture}}"/>
                <div class="product_info_block">
                    {{--                    <div class="category">{{ucfirst($AdToDisplay[0]->category)}}</div>--}}
                    <div class="title">{{ucfirst($AdToDisplay[0]->title)}}</div>
                    <div class="location">{{ucfirst($AdToDisplay[0]->location)}}</div>
                    <div class="price">{{ number_format($AdToDisplay[0]->price,0,",",".")}} EUR</div>
                    {{--                publication date--}}
                    <div>
                        @if(number_format((time()-strtotime($AdToDisplay[0]->updated_at))/86400,0,",",".")==0)
                            <div class="date">Published today</div>
                        @elseif(number_format((time()-strtotime($AdToDisplay[0]->updated_at))/86400,0,",",".")==1)
                            <div class="date">Published 1 day ago</div>
                        @else
                            <div class="date">
                                Published {{number_format((time()-strtotime($AdToDisplay[0]->updated_at))/86400,0,",",".")}}
                                days
                                ago
                            </div>
                        @endif
                    </div>
                    <h3>Description</h3>
                    <div>{{$AdToDisplay[0]->description}}</div>

                    <div class="edit_delete_btn button">
                        {{--        if user is both connected and has admin privileges -> show edit & delete button--}}
                        @if(Auth::check() && Auth::user()->admin=='yes')
                            {{--        @if(auth()->user()->admin == 'yes')--}}
                            <a href="/edit_ad/{{$AdToDisplay[0]->id}}">
                                <button>Edit</button>
                            </a>
                            <form action="/admin_delete_ad/{{$AdToDisplay[0]->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        @endif
                    </div>

                </div>
            </div>

            <div class="contact_block">
                <h3>Contact</h3>
                <div>Seller name: {{$AdToDisplay[0]->name}}</div>
                <div>Email: {{$AdToDisplay[0]->email}}</div>
                <div>Phone: {{$AdToDisplay[0]->phone}}</div>

            </div>
        </div>

    @else
        <h1>Cet Ad n'existe pas!</h1>
    @endif
@endsection
