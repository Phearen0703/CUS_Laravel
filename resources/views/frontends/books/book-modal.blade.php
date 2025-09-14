<div class="row">
    <div class="col-md-5">
        <img src="{{ asset($book->image ?? 'images/no-image.png') }}" class="img-fluid rounded"
            alt="{{ $book->title }}">
    </div>
    <div class="col-md-7">
        <h4>{{ $book->title }}</h4>
        <p><strong>Author:</strong> {{ $book->author }}</p>
        <p><strong>Category:</strong> {{ $book->category->name ?? 'N/A' }}</p>
        <p><strong>Published:</strong> {{ $book->published_date ?? 'Unknown' }}</p>
        <p><strong>Book Code:</strong> {{ $book->code ?? 'Unknown' }}</p>
        <p>{{ $book->description ?? 'No description available.' }}</p>

        <div class="mt-3">
            @if($book->pdf)
                <a href="{{ asset($book->pdf) }}" target="_blank" class="btn btn-sm btn-primary">
                    <i class="fa-solid fa-file-pdf"></i> View PDF
                </a>
            @else
                <span class="text-muted">No PDF</span>
            @endif
        </div>

    </div>
</div>