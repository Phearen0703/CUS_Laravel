@extends('frontends.layouts.app')

@section('nav')
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.html">NewsPortal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.html">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Politics</a></li>
                            <li><a class="dropdown-item" href="#">Business</a></li>
                            <li><a class="dropdown-item" href="#">Technology</a></li>
                            <li><a class="dropdown-item" href="#">Sports</a></li>
                            <li><a class="dropdown-item" href="#">Entertainment</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex" action="{{ route('books.search') }}" method="GET">
                    <input class="form-control me-2" type="search" name="query"
                        placeholder="Search by title or code"
                                    name="search"
                                    value="{{ request('search') }}">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>

            </div>
        </div>
    </nav>

@endsection
@section('content')
    <div class="col-lg-8">

        @foreach($categories as $category)
            <div class="mb-5">
                <h3 class="category-title mb-3">{{ $category->name }}</h3>
                <div class="row g-4">
                    @forelse($category->books as $book)
                        <div class="col-md-3 col-sm-6">
                            <div class="card h-100 shadow-sm border-0">
                                <img src="{{ asset($book->image ?? 'images/no-image.png') }}" class="card-img-top w-100"
                                    style="height: 220px; object-fit: cover;" alt="{{ $book->title }}">

                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title mb-1">{{ $book->title }}</h6>
                                    <small class="text-muted mb-2">{{ $book->author }}</small>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-primary mt-auto view-book"
                                        data-id="{{ $book->id }}">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No books available in this category.</p>
                    @endforelse
                </div>
            </div>
        @endforeach


        @section('categories')
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Book Categories</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($categories as $category)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="#" class="text-decoration-none">
                                    {{ $category->name }}
                                </a>
                                <span class="badge bg-primary rounded-pill">{{ $category->books_count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        @endsection

        @section('recent_news')
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Recent Books</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @foreach($recentBooks as $book)
                            <a href="{{ route('books.show', $book->id) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ $book->title }}</h6>
                                    <small>{{ $book->created_at->diffForHumans() }}</small>
                                </div>
                                <small class="text-muted">{{ $book->author ?? 'Unknown Author' }}</small>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endsection


    </div>

    <!-- Modal -->
    <div class="modal fade" id="bookModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Book Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Initialize the modal once outside the click handler
        const bookModal = new bootstrap.Modal(document.getElementById('bookModal'));

        $(document).on('click', '.view-book', function () {
            let bookId = $(this).data('id');

            // Show a loading spinner
            $("#bookModal .modal-body").html(`
                        <div class="text-center py-5">
                            <div class="spinner-border text-primary"></div>
                        </div>
                    `);

            bookModal.show();

            // Make the AJAX request
            $.ajax({
                url: "/book/" + bookId + "/modal",
                type: "GET",
                success: function (response) {
                    $("#bookModal .modal-body").html(response);
                },
                error: function () {
                    $("#bookModal .modal-body").html(
                        `<p class="text-danger text-center">Failed to load book details.</p>`
                    );
                }
            });
        });
    </script>
@endpush