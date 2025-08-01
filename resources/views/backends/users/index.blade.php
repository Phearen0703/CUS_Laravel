@extends('backends.layouts.master')
@section('title')
    user page
@endsection



@section('content')
    @if (session('status'))
        <div class="alert alert-{{ session('status') }}">
            {{ session('sms') }}
        </div>
    @endif
    <div class="card-body pt-0">
        <a class="btn btn-primary" href="{{route('roles.create')}}"><i class="fa-solid fa-plus"></i> Create</a>
        <div class="table-responsive pt-2">
            <table class="table datatable" id="datatable_1">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Active</th>
                        
                    </tr>
                </thead>
                <tbody>


                    
                </tbody>
            </table>
        </div>
    </div><!--end card-body-->

@endsection