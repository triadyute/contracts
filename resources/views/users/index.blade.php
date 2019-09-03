@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 small">
            <div class="row">
                <div class="col-md-6">
                    <h4>Manage users</h4>
                </div>
                <div class="col-md-6">
                    <a href="{{route('users.create')}}"><span class="float-right"><button class="btn btn-primary btn-sm add-btn"><i class="fa fa-plus"></i> New user</button></span></a>
                </div>
            </div>
            <hr>
            @include('inc.messages')
            <table id="myTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>COMPANY</th>
                        <th class="text-center">VIEWER</th>
                        <th class="text-center">EDITOR</th>
                        <th class="text-center">ADMIN</th>
                        <th class="text-center">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td><a href="{{route('users.show', $user)}}">{{$user->name}}</a></td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->company->company_name}}</td>
                            <td class="text-center"><input type="checkbox" {{ $user->hasRole('User') ? 'checked' : '' }} name="role_user" disabled></td>
                            <td class="text-center"><input type="checkbox" {{ $user->hasRole('Editor') ? 'checked' : '' }} name="role_editor" disabled></td>
                            <td class="text-center"><input type="checkbox" {{ $user->hasRole('Admin') ? 'checked' : '' }} name="role_admin" disabled></td>
                            <td class="text-center">
                                <a href="{{ route('users.edit', $user) }}"><i class="fa fa-edit" style="display:inline;" title="delete"></i></a>
                                <form method="POST" action="{{route('users.delete', $user)}}" class="user-delete" style="display:inline;">
                                    @csrf 
                                    @method('DELETE')
                                    <a href="#"><button type="submit" class="text-primary" style="padding:0; background:transparent; border:0; position:relative; top: -1px;" onclick="return confirm('Are you sure?')"><i class="fa fa-user-times" style="display:inline;" title="delete"></i></button></a>
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