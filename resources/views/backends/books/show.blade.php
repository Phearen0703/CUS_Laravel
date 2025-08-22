@extends('backends.layouts.master')

@section('title')
    Show Book
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Book Details</h4>
        <a href="{{ route('books.index') }}" class="btn btn-sm btn-secondary float-end">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Book Code</th>
                <td>{{ $book->code }}</td>
            </tr>
            <tr>
                <th>Ebook Code</th>
                <td>{{ $book->ebook ?? '-' }}</td>
            </tr>
            <tr>
                <th>Title</th>
                <td>{{ $book->title }}</td>
            </tr>
            <tr>
                <th>Author</th>
                <td>{{ $book->author }}</td>
            </tr>
            <tr>
                <th>Publisher</th>
                <td>{{ $book->publisher }}</td>
            </tr>
            <tr>
                <th>Published Date</th>
                <td>{{ $book->published_date ? $book->published_date->format('Y-m-d') : '-' }}</td>
            </tr>
            <tr>
                <th>Category</th>
                <td>{{ $book->category->name ?? '-' }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $book->description ?? '-' }}</td>
            </tr>
            <tr>
                <th>Image</th>
                <td>
                    @if($book->image)
                        <img src="{{ asset( $book->image) }}" alt="Book Image" width="150" class="img-thumbnail">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>PDF</th>
                <td>
                    @if($book->pdf)
                        <a href="{{ asset($book->pdf) }}" target="_blank" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-file-pdf"></i> View PDF
                        </a>
                    @else
                        <span class="text-muted">No PDF</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Created By</th>
                <td>{{ $book->createdBy->name ?? 'System' }}</td>
            </tr>
            <tr>
                <th>Updated By</th>
                <td>{{ $book->updatedBy->name ?? '-' }}</td>
            </tr>
            <tr>
                <th>Deleted By</th>
                <td>{{ $book->deletedBy->name ?? '-' }}</td>
            </tr>
            <tr>
                <th>Created At</th>
                <td>{{ $book->created_at ? $book->created_at->format('Y-m-d H:i:s') : '-' }}</td>
            </tr>
            <tr>
                <th>Updated At</th>
                <td>{{ $book->updated_at ? $book->updated_at->format('Y-m-d H:i:s') : '-' }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection
