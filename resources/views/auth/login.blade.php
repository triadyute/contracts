@extends('layouts.login')

@section('content')

<form class="form-signin" method="POST" action="{{ route('login') }}">
        @csrf
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/contract') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('users.create') }}">Sign up</a>
                    @endif
                @endauth
            </div>
        @endif
        <div class="text-center mb-4">
          <img class="mb-4" src="{{asset('images/contracts_logo.png')}}" alt="" height="72">
          <!--paragraph was here-->
          <h4>Sign in</h4>
        </div>
  
        <div class="form-label-group">
          <input type="email" id="inputEmail" class="form-control" placeholder="Email address" @error('email') is-invalid @enderror" name="email" required autofocus>
          <label for="inputEmail">Email address</label>
          @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
  
        <div class="form-label-group">
          <input type="password" id="inputPassword" class="form-control" placeholder="Password" @error('password') is-invalid @enderror" name="password" required>
          <label for="inputPassword">Password</label>
          @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
  
        <div class="checkbox mb-3 text-center">
          <label>
            <input type="checkbox" value="remember-me" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
          </label>
          @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
          @endif
        </div>
        <div class="text-center">
            <button class="btn btn-primary" type="submit">Sign in</button>
        </div>
        <p class="mt-5 mb-3 text-muted text-center copyright">&copy; 2019 Fabian Henry. All rights reserved.</p>
</form>
                    
@endsection
