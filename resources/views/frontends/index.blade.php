@extends('frontends.layouts.app')

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