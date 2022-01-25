@extends('layouts.layout')

@section('content')

    @if(!count($ads) == 0)

        <div class="search_filter_wrapper">
            {{--   Search --}}
            <form action="{{route('ads_filtered', $categoryName)}}" method="post">
                @csrf
                <input type="search" name="search_submitted" placeholder="I'm looking for..." required/>
                <button type="submit">Search</button>
            </form>

            {{--       Filters--}}
            <form action="{{route('ads_filtered', $categoryName)}}" method="post">
                @csrf
                {{--        <input type="text" name="categoryName" value="{{$categoryName}}" hidden >--}}
                <select name="filter">
                    <option selected disabled>Filter by</option>
                    <option value="mostRecent">Most recent</option>
                    <option value="oldest">Oldest</option>
                    <option value="priceAsc">Price: Low to High</option>
                    <option value="priceDesc">Price: High to Low</option>
                </select>
                <button type="submit">Apply</button>
            </form>
        </div>

    @endif

    <h1>{{ucfirst($categoryName)}}</h1>

    <div>
        {{--        Message if no ads found--}}
        @if(count($ads) == 0)
            <div>Sorry we don't have what U're looking for...</div>
            <a href="{{route('category_ads',$categoryName)}}">Let's try a new search</a>
        @else
            @foreach($ads as $ad)
                <a class="ad_link_superWrapper" href="/ad_details/{{$ad->id}}">
                    <div class="product_ad_tag_wrapper">
                        <img src="{{asset("/images/$ad->picture")}}"/>
                        <div class="product_info_block">
{{--                            <div class="category">Category - {{$ad->category}}</div>--}}
                            <div class="title">{{$ad->title}}</div>
                            <div class="price">{{number_format($ad->price,0,",",".")}} EUR</div>

                            <div class="location">{{$ad->location}}</div>
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
        @endif
    </div>
    {{--        PAGINATION--}}
    <div class="pagination_wrapper">
        {{$ads->appends($next_query)->links()}}
    </div>
@endsection


