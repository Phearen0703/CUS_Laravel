<div class="row">
    <div class="col-md-5">
        <img src="{{ asset($book->image ?? 'images/no-image.png') }}" 
             class="img-fluid rounded" 
             alt="{{ $book->title }}">
    </div>
    <div class="col-md-7">
        <h4>{{ $book->title }}</h4>
        <p><strong>Author:</strong> {{ $book->author }}</p>
        <p><strong>Category:</strong> {{ $book->category->name ?? 'N/A' }}</p>
        <p><strong>Published:</strong> {{ $book->published_at ?? 'Unknown' }}</p>
        <p>{{ $book->description ?? 'No description available.' }}</p>

        <div class="mt-3">
            @if($book->pdf)
                <a href="{{ route('books.viewPdf', $book->id) }}" 
                class="btn btn-success">
                View PDF
                </a>
            @else
                <button class="btn btn-secondary" disabled>
                    No PDF Available
                </button>
            @endif
        </div>

    </div>
</div>
