@extends('layouts.login')

@section('content')
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <form class="form-signin" method="POST" action="{{ route('users.store') }}" autocomplete="off">
        @csrf
            <div class="top-right links">
                @auth
                    <a href="{{ url('/contract') }}">Home</a>
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                @else
                @endauth
            </div>
        <div class="text-center mb-4">
            <img class="mb-4" src="{{asset('images/contracts_logo.png')}}" alt="" height="72">
            <!--paragraph was here-->
            @guest
                <h4>Create account</h4>
            @endguest
            @auth
                <h4>Add user</h4>
            @endauth
            @include('inc.messages')
        </div>
        <div class="form-label-group">
        <input type="text" id="name" class="form-control" placeholder="Name" @error('name') is-invalid @enderror" name="name" required autofocus>
        <label for="name">Name</label>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>

        <div class="form-label-group">
        <input type="email" id="email" class="form-control" placeholder="Email address" @error('email') is-invalid @enderror" name="email" required>
        <label for="email">Email address</label>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>

        <div class="form-label-group">
        <input type="password" id="password" class="form-control" placeholder="Password" @error('password') is-invalid @enderror" name="password" required>
        <label for="password">Password</label>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>

        <div class="form-label-group">
        <input type="password" id="password_confirmation" class="form-control" placeholder="Password" @error('password') is-invalid @enderror" name="password_confirmation" required>
        <label for="password_confirmation">Confirm Password</label>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
        @auth
        <div class="form-label-group service-small">
                <select name="role_select" class="form-control" id="" required>
                    <option value="" selected disabled>Rights</option>
                    <option value="role_admin">Admin</option>
                    <option value="role_editor">Editor</option>
                    <option value="role_user">Viewer</option>
                </select>
        </div>
        @endauth
        @guest
            <input type="hidden" name="guest_role_select"  value="role_admin" id="">
            <div class="mb-3 text-center" style="color: gray;">
                Already have an account? &nbsp;<a href="/login">Sign in</a>
            </div>
        @endguest
        <div class="text-center">
            <button class="btn btn-primary" type="submit">
                @auth
                Create User
                @endauth
                @guest
                Register
                @endguest
            </button>
        </div>
        <p class="mt-5 mb-3 text-muted text-center copyright">&copy; 2019 Fabian Henry. All rights reserved.</p>
    <form>
@endsection