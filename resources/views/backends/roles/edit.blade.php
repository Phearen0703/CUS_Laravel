@extends('backends.layouts.master')
@section('title')
    Edit Role
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
                        <a class="btn btn-sm btn-danger" href="{{ route('roles.index') }}">
                            <i class="fa-solid fa-reply"></i> Back
                        </a>
                        <h4 class="card-title">Edit Roles</h4>
                    </div>
                </div>
            </div>

            <div class="card-body pt-0">
                <form id="form-validation-2" class="form" action="{{route('roles.update',$role->id)}}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label for="rolename" class="form-label">Role Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" 
                               type="text" name="name" id="rolename" 
                               value="{{ $role->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  name="description" id="description">{{ $role->description }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary float-end">
                        <i class="fa-solid fa-floppy-disk"></i> Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
