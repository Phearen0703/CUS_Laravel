@extends('backends.layouts.master')
@section('title')
    permission page
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
                        <th>Permission</th>
                        <th>View</th>
                        <th>Create</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        
                    </tr>
                </thead>
                <tbody>


                    
                </tbody>
            </table>
        </div>
    </div><!--end card-body-->

@endsection