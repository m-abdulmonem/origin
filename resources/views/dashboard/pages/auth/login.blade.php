@extends('dashboard.pages.auth.layouts.app')
@section('content')
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="#" class="h1"><b>Admin</b>LTE</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">@lang('Sign in to start your session')</p>

            <form action="{{ route('dashboard.login') }}" method="post">
                @csrf

                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                        placeholder="{{ __('Email Address') }}" required name="email" autocomplete autofocus
                        value="{{ old('email') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                @if ($errors && $errors->has('password'))
                    <div class="alert alert-danger mb-3 text-center  pt-2 pb-2">{{ $errors->first('password') }}</div>
                @endif
                <div class="input-group mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="{{ __('Password') }}" required name="password" autocomplete="current-password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            @if (Route::has('dashboard.password.request'))
                <a class="btn btn-link" href="{{ route('dashboard.password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
            {{-- <p class="mb-1">
                <a href="{{ route('dashboard.password.request') }}">@lang('I forgot my password')</a>
            </p> --}}
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
