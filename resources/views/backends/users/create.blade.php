@extends('backends.layouts.master')
@section('title')
    Create User
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
                            <a class="btn btn-sm btn-danger" href="{{ route('users.index') }}">
                                <i class="fa-solid fa-reply"></i> Back
                            </a>
                            <h4 class="card-title">Create User</h4>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-0">
                    <form id="form-validation-2" class="form" action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row mb-2">
                                    <label for="name" class="col-lg-3 col-form-label text-end">Name <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input id="name" name="name" type="text" class="form-control" required>
                                    </div>
                                </div><!--end form-group-->
                            </div><!--end col-->
                            <div class="col-md-6">
                                <div class="form-group row mb-2">
                                    <label for="email" class="col-lg-3 col-form-label text-end">Email </label>
                                    <div class="col-lg-9">
                                        <input id="email" name="email" type="email" class="form-control" placeholder="example@email.com">
                                    </div>
                                </div><!--end form-group-->
                            </div><!--end col-->
                            <div class="col-md-6">
                                <div class="form-group row mb-2">
                                    <label for="username" class="col-lg-3 col-form-label text-end">Username <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input id="username" name="username" type="text" class="form-control" required>
                                    </div>
                                </div><!--end form-group-->
                            </div><!--end col-->
                            <div class="col-md-6">
                                <div class="form-group row mb-2">
                                    <label for="role" class="col-lg-3 col-form-label text-end">Role <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select class="form-select" name="role_id" id="role_id" required>
                                            <option selected disabled value="">Choose...</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                          </select>
                                          <div class="invalid-tooltip">
                                            Please select a valid state.
                                          </div>
                                    </div>
                                </div><!--end form-group-->

                        </div><!--end row-->
                            <div class="col-md-6">
                                <div class="form-group row mb-2">
                                    <label for="Photo" class="col-lg-3 col-form-label text-end">Photo </label>
                                    <div class="col-lg-9">
                                        <input type="file" class="form-control" name="photo" id="photo" accept="image/*">
                                    </div>
                                </div><!--end form-group-->
                            </div><!--end col-->
                            <div class="col-md-6">
                                <div class="form-group row mb-2">
                                    <label for="password" class="col-lg-3 col-form-label text-end">Password <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
                                    </div>
                                </div><!--end form-group-->

                        </div><!--end row-->
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