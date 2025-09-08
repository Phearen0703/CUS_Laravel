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
        <a class="btn btn-danger" href="{{route('roles.index')}}"><i class="fa-solid fa-reply"></i> Back</a>
        <div class="table-responsive pt-2">
            <table class="table datatable" id="datatable_1">
                <thead class="table-light">
                    <tr>
                        <th>N.o</th>
                        <th>Permission</th>
                        <th>View</th>
                        <th>Create</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                        @foreach ($role_permission as $permission)
                            <tr>
                                <td>{{ $loop->iteration }}</td> {{-- Use $loop->iteration instead of $i++ --}}
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <input onclick="handlePermission('list', {{ $permission->role_permission_id }}, {{ $permission->list }}, {{ $permission->id }}, this)"
                                        type="checkbox" value="{{ $permission->list }}" {{ $permission->list == 1 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input onclick="handlePermission('store', {{ $permission->role_permission_id }}, {{ $permission->store }}, {{ $permission->id }}, this)"
                                        type="checkbox" value="{{ $permission->store }}" {{ $permission->store == 1 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input onclick="handlePermission('edit', {{ $permission->role_permission_id }}, {{ $permission->edit }}, {{ $permission->id }}, this)"
                                        type="checkbox" value="{{ $permission->edit }}" {{ $permission->edit == 1 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input onclick="handlePermission('remove', {{ $permission->role_permission_id }}, {{ $permission->remove }}, {{ $permission->id }}, this)"
                                        type="checkbox" value="{{ $permission->remove }}" {{ $permission->remove == 1 ? 'checked' : '' }}>
                                </td>
                            </tr>
                        @endforeach


                    
                </tbody>
            </table>
        </div>
    </div><!--end card-body-->

@endsection

{{-- @push('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    const roleId = {{ $id }};
    function handlePermission(permission, role_permission_id, role_permission_value, permission_id) {
        let url = "{{ url('admin/roles') }}/" + roleId + "/permissions-update";

        role_permission_value = role_permission_value == 0 ? 1 : 0;

        url += "?permission=" + permission +
               "&role_permission_id=" + role_permission_id +
               "&role_permission_value=" + role_permission_value +
               "&permission_id=" + permission_id;

        window.location.href = url;
    }
</script>

@endpush --}}

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    const roleId = {{ $id }};

    function handlePermission(permission, role_permission_id, role_permission_value, permission_id, checkboxElement) {
        let url = "{{ url('admin/roles') }}/" + roleId + "/permissions-update";
        let newValue = checkboxElement.checked ? 1 : 0;

        $.ajax({
            url: url,
            type: "POST", // Use POST for updates, which is more secure and correct
            data: {
                _token: "{{ csrf_token() }}", // Include CSRF token for security
                permission: permission,
                role_permission_id: role_permission_id,
                role_permission_value: newValue,
                permission_id: permission_id
            },
            success: function(response) {
                // The update was successful. No page redirect.
                // You can add a success message here if you want
                console.log("Permission updated successfully!");
            },
            error: function(xhr) {
                // If the request fails, revert the checkbox state
                checkboxElement.checked = !checkboxElement.checked;
                console.error("Failed to update permission:", xhr.responseText);
                alert("Failed to update permission.");
            }
        });
    }
</script>
@endpush