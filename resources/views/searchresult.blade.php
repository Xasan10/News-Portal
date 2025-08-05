{{-- resources/views/searchresult.blade.php --}}
@extends('layouts.app')

@section('content')
   <div class="container">
     <h1 style="color:gray; font-weight:700; align-items: center; margin-top: 20px; text-align: center;">Search Results</h1>

    @if($articles->isEmpty())
        <p style="color:gray; font-weight:400; align-items: center; margin-top: 20px; text-align: center;">No results found.</p>
    @else
        <div class="row">
            @foreach($articles as $article)
             <div class="col-12 mb-4" >
                <div class="card" >
                    <img src="https://placehold.co/640x480.png?text=News+Article" class="card-img-top" alt="" style="height: 400px; object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('show.details', $article->id) }}">{{ $article->title }}</a>
                        </h5>
                        <p class="card-text text-muted">{{ $article->category->name ?? 'No Category' }}</p>
                        
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
   </div>
@endsection
