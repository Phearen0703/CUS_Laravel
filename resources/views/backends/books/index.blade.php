@extends('backends.layouts.master')
@section('title')
    book page
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        @if (session('status'))
            <div class="alert alert-{{ session('status') }}">
                {{ session('sms') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">Book Management</h4>
                    </div>
                    <div class="col-auto">
                        <form class="row g-2 align-items-center" action="{{ route('books.index') }}" method="GET">
                            
                            {{-- Search --}}
                            <div class="col-auto">
                                <input type="search" class="form-control"
                                    placeholder="Search by title or code"
                                    name="search"
                                    value="{{ request('search') }}">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-solid fa-magnifying-glass"></i> Search
                                </button>
                            </div>

                            {{-- Filter --}}
                            <div class="col-auto">
                                <a class="btn bg-primary-subtle text-primary dropdown-toggle d-flex align-items-center arrow-none"
                                data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                                aria-expanded="false" data-bs-auto-close="outside">
                                    <i class="iconoir-filter-alt me-1"></i> Filter
                                </a>
                                <div class="dropdown-menu dropdown-menu-start p-2">
                                    <div class="form-check mb-2">
                                        <input type="radio" name="type" value="" class="form-check-input"
                                            id="filter-all" {{ request('type') == '' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="filter-all">All</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="radio" name="type" value="book" class="form-check-input"
                                            id="filter-book" {{ request('type') == 'book' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="filter-book">Books Only</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="radio" name="type" value="ebook" class="form-check-input"
                                            id="filter-ebook" {{ request('type') == 'ebook' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="filter-ebook">Ebooks Only</label>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary w-100 mt-2">Apply</button>
                                </div>
                            </div><!--end col-->

                            {{-- Add Book --}}
                            <div class="col-auto">
                                <a href="{{ route('books.create') }}" type="button" class="btn btn-primary">
                                    <i class="fa-solid fa-plus me-1"></i> Add Book
                                </a>
                            </div>
                        </form>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end card-header-->

            <div class="card-body pt-0">

                <div class="table-responsive">
                    <table class="table mb-0 checkbox-all" id="datatable_1">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th class="ps-0">Category</th>
                                <th>Book Title</th>
                                <th>Author</th>
                                <th>Publisher</th>
                                <th>Published Date</th>
                                <th>Book Code</th>
                                <th>EBook</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($books)
                            @php($i = 1)
                            @foreach ($books as $book)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td class="ps-0">{{ $book->category }}</td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ $book->publisher }}</td>
                                    <td>{{ $book->published_date }}</td>
                                    <td>{{ $book->code }}</td>
                                    <td>{{ $book->ebook }}</td>
                                    <td>{{ $book->created_by_name }}</td>
                                    <td>{{ $book->updated_by_name }}</td>

                                    <td class="text-end">
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('books.edit', ['id' => $book->id]) }}"><i
                                                class="las la-pen fs-18"></i></a>
                                        <a class="btn btn-warning btn-sm"
                                            href="{{ route('books.show', ['id' => $book->id]) }}"><i class="fa-regular fa-eye fs-18"></i>
                                        </a>
                                        
                                        <a class="btn btn-danger btn-sm"
                                            href="{{ route('books.delete', ['id' => $book->id]) }}"><i
                                                class="las la-trash-alt fs-18"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            @endif


                        </tbody>
                    </table>
                    {{-- Pagination Links --}}
                    <div class="mt-3">
                        {{ $books->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection