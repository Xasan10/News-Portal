@extends('layouts.app')

@section('content')


@forelse($articles as $article)
    <div class="col-lg-6 col-md-6">
        <div class="single-what-news mb-100">
            <div class="what-img">
                <img src="https://placehold.co/640x480.png?text=News+Article" alt="">
            </div>
            <div class="what-cap">
                <span class="color1">{{ $article->category_name }}</span>
                <h4><a href="{{ route('show.details',$article->id)}}">{{ $article->title }}</a></h4>
            </div>
        </div>
    </div>
@empty
    <div class="col-12">
        <p>No articles found.</p>
    </div>
@endforelse



@endsection