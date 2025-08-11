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
        <div class="col d-flex justify-content-between">
            <a class="btn btn-primary" href="{{route('permissions.create')}}"><i class="fa-solid fa-plus"></i> Create</a>
        </div>
        <div class="table-responsive pt-2">
            <table class="table datatable" id="datatable_1">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Key</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $index => $permission)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->key }}</td>
                        <td>
                            <a class="btn btn-sm btn-warning" href="{{ route('permissions.edit', $permission->id) }}">
                                <i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            
                        <a class="btn btn-sm btn-danger"
                                href="{{route('permissions.delete', $permission->id) }}"
                                onclick="return confirm('Are you sure you want to delete this permission?');"><i class="fa-solid fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                    @endforeach


                    
                </tbody>
            </table>
        </div>
    </div><!--end card-body-->

@endsection