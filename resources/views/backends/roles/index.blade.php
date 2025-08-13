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
        @if (checkPermission('key_role', 'create'))
            <a class="btn btn-primary" href="{{ route('roles.create') }}"><i class="fa-solid fa-plus"></i> Create</a>       
        
        @endif
    
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
                            @if (checkPermission('key_role', 'view'))
                                <a class="btn btn-sm btn-success" href="{{ route('roles.permissions', $role->id) }}">
                                    <i class="fa-solid fa-key"></i> Permissions</a>
                            
                            @endif
                            @if (checkPermission('key_role', 'edit'))
                                <a class="btn btn-sm btn-warning" href="{{ route('roles.edit', $role->id) }}">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            
                            @endif
                            @if (checkPermission('key_role', 'delete'))
                                <form action="{{ route('roles.delete', $role->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this role?')">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>
                            
                            @endif
                        </td>
                    </tr>
                    @endforeach

                    
                </tbody>
            </table>
        </div>
    </div><!--end card-body-->

@endsection