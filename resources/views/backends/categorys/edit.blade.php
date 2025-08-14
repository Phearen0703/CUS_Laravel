@extends('backends.layouts.master')
@section('title')
    Edit Catagory
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 col-lg-6">
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
                        <a class="btn btn-sm btn-danger" href="{{ route('categorys.index') }}">
                            <i class="fa-solid fa-reply"></i> Back
                        </a>
                        <h4 class="card-title">Edit Category</h4>
                    </div>
                </div>
            </div>

            <div class="card-body pt-0">
                <form id="form-validation-2" class="form" action="{{ route('categorys.update', ['id' => $category->id]) }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label for="name" class="form-label">Category Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" 
                               type="text" name="name" id="categoryname" 
                               value="{{ old('name', $category->name) }}" 
                               placeholder="Enter Category Name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary float-end">
                        <i class="fa-solid fa-floppy-disk"></i> Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
