@extends('layouts.app')
@include('navbar')
@include('footer')
@section('content')
@include('common.banner')
<div class="main">
<h5>みんなの投稿した記事</h5> 
@if(!is_null($headline))
<div class="row align-items-center my-5">
  <div class="col-lg-7">
    <h6 style="text-align: left;">{{ $headline->post_type }}</h6>
    @if($headline->post_image_path)
    <img src="{{ $headline->post_image_path }}" alt="headline_img" class="headline-img" />
    
    @elseif ($headline->post_image_path == null && $headline->post_type == "book")    
        <img src="{{ secure_asset('/images/book.jpg' ) }}" alt="post_img" class="headline-img" /> 
    
    @elseif ($headline->post_image_path == null && $headline->post_type == "business")    
        <img src="{{ secure_asset('/images/business.jpg' ) }}" alt="post_img" class="headline-img" /> 
    
    @elseif ($headline->post_image_path == null && $headline->post_type == "daily")    
        <img src="{{ secure_asset('/images/daily.jpg' ) }}" alt="post_img" class="headline-img" /> 
    
    @elseif ($headline->post_image_path == null && $headline->post_type == "hobby")    
        <img src="{{ secure_asset('/images/hobby.jpg' ) }}" alt="post_img" class="headline-img" /> 
    
    @elseif ($headline->post_image_path == null && $headline->post_type == "movie")
        <img src="{{ secure_asset('/images/movie.jpg' ) }}" alt="post_img" class="headline-img" /> 
    
    @elseif ($headline->post_image_path == null && $headline->post_type == "society")    
        <img src="{{ secure_asset('/images/society.jpg' ) }}" alt="post_img" class="headline-img" /> 
    
    @elseif ($headline->post_image_path == null && $headline->post_type == "sport")    
        <img src="{{ secure_asset('/images/sport.jpg' ) }}" alt="post_img" class="headline-img" /> 
    
    @elseif ($headline->post_image_path == null && $headline->post_type == "study")    
        <img src="{{ secure_asset('/images/study.jpg' ) }}" alt="post_img" class="headline-img" /> 
    
    @elseif ($headline->post_image_path == null && $headline->post_type == "travel")
        <img src="{{ secure_asset('/images/travel.jpg' ) }}" alt="post_img" class="headline-img" /> 
    
    @endif
    
  </div>
  <div class="col-lg-5">
    <h3 class="card-title mt">「{{ \Illuminate\Support\Str::limit($headline->post_title, 50, '...') }}」</h3>
    <p class="card-text p-1">{{ \Illuminate\Support\Str::limit($headline->post_first_greeting, 130, '...') }}</p>
    <p class="card-text p-1">{{ \Illuminate\Support\Str::limit($headline->post_introduction, 130, '...') }}</p>
    <a class="card-next" href="{{ action('PostsController@show', $headline->id) }}">この記事を読む</a>
    <p class="card-text p-1">投稿日:{{ $headline->created_at->format('Y年m月d日') }}</p>
    <br>
    @if ($headline->likedBy(Auth::user())->count() > 0)
        <ul class="like-icon" style="text-align: left;">
          <li>
            <a class="no-text-decoration" data-remote="true" rel="nofollow" data-method="DELETE" href="/likes/{{ $headline->likedBy(Auth::user())->firstOrFail()->id }}">
              <img src="/images/parts7.png" />
              <span>{{$headline->likes->count() }} like</span>
            </a>
          </li>
        </ul>
        @else
        <ul class="like-icon" style="text-align: left;">
          <li>
            <a class="no-text-decoration" data-remote="true" rel="nofollow" data-method="POST" href="/posts/{{ $headline->id }}/likes">
              <img src="/images/parts5.png" />
              <span>{{$headline->likes->count() }} like</span>
            </a>
          </li>
        </ul>  
        @endif
        
    <div class="profile-wrap mt-4">
        <a class="no-text-decoration" href="/users/{{ $headline->user->id }}">
            @if ($headline->user->profile_photo)
            <img class="post-profile-icon round-img mr-4" src="{{ $headline->user->profile_photo }}" />
            @else 
            <img class="post-profile-icon round-img mr-4" src="{{ secure_asset('/images/blank_profile.png') }}" />
            @endif
        <span>{{ $headline->user->name }}</span>
        </a>
        <br>
        <h7>{{ $headline->user->introduction }}</h7>
        @if($headline->user->id == Auth::user()->id)
        <ul  class="delete-icon mt-3" style="text-align: left;">
            <li>
              <a class="no-text-decoration" href="/postsdelete/{{ $headline->id }}">
                <img src="/images/parts9.png" />
                <span>delete</span>
              </a>
            </li> 
        </ul>
        @endif
    </div>
  </div>
</div>
@endif

<!-- /.row -->

<!-- Call to Action Well -->
<hr class="mt">

<!-- Content Row -->
<div class="row">
@foreach ($posts as $post)
  <div class="col-md-6 col-lg-4 mb-5">
    @include('common.card')
  </div>
@endforeach
</div>

{{ $posts->links('pagination::default') }}
@endsection