<div class="row">
    <div class="col-md-4">
        <img src="{{ asset($book->image ?? 'images/no-image.png') }}" alt="{{ $book->title }}" class="img-fluid rounded">
    </div>
    <div class="col-md-8">
        <h5>{{ $book->title }}</h5>
        <p class="text-muted mb-2">by {{ $book->author }}</p>
        <p class="mb-4">{{ $book->description }}</p>
        <div class="d-flex align-items-center">
            @if ($book->category)
                <span class="badge bg-primary me-2">Category: {{ $book->category->name }}</span>
            @endif
            <span class="badge bg-secondary">Price: ${{ $book->price }}</span>
        </div>
    </div>
</div>