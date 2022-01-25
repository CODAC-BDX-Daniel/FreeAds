@extends('layouts.layout')

@section('content')

    @if(isset($message))
        <h3 style="color:green">{{$message}}</h3>
    @endif

    @foreach($ads as $ad)

        <a class="ad_link_superWrapper" href="/ad_details/{{$ad->id}}">
            <div class="product_ad_tag_wrapper">
                <img src="images/{{$ad->picture}}"/>
                <div class="product_info_block">
                    <div class="category">Category - {{ucfirst($ad->category)}}</div>
                    <div class="title">Title - {{ucfirst($ad->title)}}</div>
                    <div class="location">Location - {{ucfirst($ad->location)}}</div>
                    <div class="price">Price - EUR {{number_format($ad->price,0,",",".")}}  </div>
                    @if(number_format((time()-strtotime($ad->updated_at))/86400,0,",",".")==0)
                        <div class="date">Published today</div>
                        @elseif(number_format((time()-strtotime($ad->updated_at))/86400,0,",",".")==1)
                        <div class="date">Published 1 day ago</div>
                    @else
                        <div class="date">Published {{number_format((time()-strtotime($ad->updated_at))/86400,0,",",".")}} days ago</div>
                    @endif
                </div>
            </div>
        </a>

        <hr>

    @endforeach
    {{--        PAGINATION--}}
    <div class="pagination_wrapper">
        {{$ads->links()}}
    </div>

@endsection



