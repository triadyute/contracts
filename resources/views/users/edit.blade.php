@extends('layouts.login')

@section('content')
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
<form class="form-signin" method="POST" action="{{ route('users.update', $user) }}" autocomplete="off">
    @csrf
    @method('PUT')
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
        <h4>Edit profile</h4>
        @include('inc.messages')
    </div>
    <div class="form-label-group">
    <input type="text" id="name" class="form-control" name="name" value="{{$user->name}}" autofocus>
    <label for="name">Name</label>
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    </div>

    <div class="form-label-group">
    <input type="email" id="email" class="form-control" value="{{$user->email}}" name="email">
    <label for="email">Email address</label>
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    </div>

    <div class="form-label-group">
    <input type="password" id="password" class="form-control" placeholder="Password" name="password" autocomplete="new-password">
    <label for="password">Password</label>
    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    </div>

    <div class="form-label-group">
    <input type="password" id="password_confirmation" class="form-control" placeholder="Password" @error('password') is-invalid @enderror" name="password_confirmation">
    <label for="password_confirmation">Confirm Password</label>
    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    </div>

    <div class="form-label-group service-small">
            <select name="role_select" class="form-control" id="" required>
                <option value="" selected disabled>Rights</option>
                <option @if ($user->hasRole('Admin')) selected @endif value="role_admin">Admin</option>
                <option @if ($user->hasRole('Editor')) selected @endif value="role_editor">Editor</option>
                <option @if ($user->hasRole('User')) selected @endif value="role_user">Viewer</option>
            </select>
    </div>

    <div class="text-center">
        <button class="btn btn-primary" type="submit">
            Save changes
        </button>
    </div>
    <p class="mt-5 mb-3 text-muted text-center copyright">&copy; 2019 Fabian Henry. All rights reserved.</p>
<form>