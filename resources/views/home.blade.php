@extends('layouts.app')

@section('content')
    <div class="col-lg-8">

        @foreach($categories as $category)
            <div class="mb-5">
                <h3 class="category-title">{{ $category->name }}</h3>
                <div class="row">
                    @forelse($category->books->take(4) as $book)
                        <div class="col-md-3 col-6 mb-4">
                            <div class="card news-card shadow-sm">
                                <img src="{{ asset($book->image ?? 'images/no-image.png') }}" 
                                     class="card-img-top news-card-img" 
                                     alt="{{ $book->title }}">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $book->title }}</h6>
                                    <small class="text-muted">{{ $book->author }}</small>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No books available in this category.</p>
                    @endforelse
                </div>
            </div>
        @endforeach

    </div>
@endsection
