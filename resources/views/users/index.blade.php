@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 small">
            <h4>Manage users</h4>
            <hr>
            <table id="myTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th class="text-center">Viewer</th>
                        <th class="text-center">Editor</th>
                        <th class="text-center">Admin</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td><a href="{{route('users.show', $user)}}">{{$user->name}}</a></td>
                            <td>{{$user->email}}</td>
                            <td>Row 3 Data 3</td>
                            <td class="text-center"><input type="checkbox" {{ $user->hasRole('User') ? 'checked' : '' }} name="role_user" disabled></td>
                            <td class="text-center"><input type="checkbox" {{ $user->hasRole('Editor') ? 'checked' : '' }} name="role_editor" disabled></td>
                            <td class="text-center"><input type="checkbox" {{ $user->hasRole('Admin') ? 'checked' : '' }} name="role_admin" disabled></td>
                            <td>
                                <a href="{{ route('users.edit', $user) }}"><i class="fa fa-edit" style="display:inline;" title="delete"></i></a>
                                <form method="POST" action="#" class="user-delete" style="display:inline;">
                                    @csrf 
                                    @method('DELETE')
                                    <a href="#"><button class="text-primary" style="padding:0; background:transparent; border:0; position:relative; top: -1px;"><i class="fa fa-user-times" style="display:inline;" title="edit"></i></button></a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table> 
        </div>
    </div>
</div>
@section('scripts')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@endsection
@endsection