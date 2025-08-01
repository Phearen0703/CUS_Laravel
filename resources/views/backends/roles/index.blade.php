@extends('backends.layouts.master')
@section('title')
    role page
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
                        <th>Name</th>
                        <th>Description</th>
                        <th>Active</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $index => $role)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->description ?? 'No Description' }}</td>
                        <td>
                            <a class="btn btn-sm btn-warning" href="{{ route('roles.edit', $role->id) }}">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                        </td>
                    </tr>
                    @endforeach

                    
                </tbody>
            </table>
        </div>
    </div><!--end card-body-->

@endsection