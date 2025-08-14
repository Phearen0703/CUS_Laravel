@extends('backends.layouts.master')
@section('title')
    Create Book
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-12">
            <div class="card">

                {{-- Flash message --}}
                @if (session('status'))
                    <div class="alert alert-{{ session('status') }}">
                        {{ session('sms') }}
                    </div>
                @endif

                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col d-flex justify-content-between">
                            <a class="btn btn-sm btn-danger" href="{{ route('books.index') }}">
                                <i class="fa-solid fa-reply"></i> Back
                            </a>
                            <h4 class="card-title">Create Book</h4>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-0">
                    <form id="form-validation-2" class="form" action="{{ route('books.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row mb-2">
                                    <label for="category" class="col-lg-3 col-form-label text-end">Category</label>
                                    <div class="col-lg-9">

                                        <select name="category_id" id="category"
                                            class="form-select @error('category_id') is-invalid @enderror">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div><!--end form-group-->
                            </div><!--end col-->
                            <div class="col-md-6">
                                <div class="form-group row mb-2">
                                    <label for="title" class="col-lg-3 col-form-label text-end">Book Title</label>
                                    <div class="col-lg-9">
                                        <input id="title" name="title" type="text" class="form-control">
                                    </div>
                                </div><!--end form-group-->
                            </div><!--end col-->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row mb-2">
                                    <label for="auther" class="col-lg-3 col-form-label text-end">Author</label>
                                    <div class="col-lg-9">

                                        <input id="auther" name="author" type="text"
                                            class="form-control @error('author') is-invalid @enderror">
                                        @error('author')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div><!--end form-group-->
                            </div><!--end col-->
                            <div class="col-md-6">
                                <div class="form-group row mb-2">
                                    <label for="publisher" class="col-lg-3 col-form-label text-end">Publisher</label>
                                    <div class="col-lg-9">
                                        <input id="publisher" name="publisher" type="text" class="form-control">
                                    </div>
                                </div><!--end form-group-->
                            </div><!--end col-->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row mb-2">
                                    <label for="description" class="col-lg-3 col-form-label text-end">Description</label>
                                    <div class="col-lg-9">

                                        <textarea id="description" name="description"
                                            class="form-control @error('description') is-invalid @enderror"
                                            rows="2"></textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div><!--end form-group-->
                            </div><!--end col-->
                            <div class="col-md-6">
                                <div class="form-group row mb-2">
                                    <label for="published_date" class="col-lg-3 col-form-label text-end">Published
                                        Date</label>
                                    <div class="col-lg-9">
                                        <input id="published_date" name="published_date" type="date"
                                            class="form-control @error('published_date') is-invalid @enderror">
                                        @error('published_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div><!--end form-group-->
                            </div><!--end col-->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row mb-2">
                                    <label for="photo" class="col-lg-3 col-form-label text-end">Photo</label>
                                    <div class="col-lg-9">

                                        <input id="photo" name="photo" type="file"
                                            class="form-control @error('photo') is-invalid @enderror">
                                        @error('photo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div><!--end form-group-->
                            </div><!--end col-->
                            <div class="col-md-6">
                                <div class="form-group row mb-2">
                                    <label for="pdf" class="col-lg-3 col-form-label text-end">PDF</label>
                                    <div class="col-lg-9">
                                        <input id="pdf" name="pdf" type="file"
                                            class="form-control @error('pdf') is-invalid @enderror">
                                        @error('pdf')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div><!--end form-group-->
                            </div><!--end col-->
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary float-end">
                                <i class="fa-solid fa-floppy-disk"></i> Save
                            </button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection