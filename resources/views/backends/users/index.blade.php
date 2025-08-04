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
        <a class="btn btn-primary" href="{{route('users.create')}}"><i class="fa-solid fa-plus"></i> Create</a>
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
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>

                  
                     @foreach ($data as $index => $user)
                      <tr>
                        <td>{{$index + 1}}</td>
                        <td>
                            <img src="{{asset($user->photo)}}" alt="user profile" class="rounded-circle" width="50px"
                                height="50px">
                        </td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->role_name}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if ($user->status == 1)
                                <span class="badge bg-success">{{__('Active')}}</span>
                            @else
                                <span class="badge bg-danger">{{__('Inactive')}}</span>

                            @endif
                        </td>
                        <td>
                            <a href="$">Edit</a>
                            <a href="$">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                 


                </tbody>
            </table>
        </div>
    </div><!--end card-body-->

@endsection