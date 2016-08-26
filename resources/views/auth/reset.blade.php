@extends('themes.default.layout')

@section('content')
    <main class="createAccount">
        <div class="bread">
            <div class="content">
                <p><a href="/">HOME</a> / <b>RESET PASSWORD</b></p>
            </div>
        </div>
        <h1>PASSWORD RESET</h1>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form method="POST" action="/password/reset" novalidate>
                {!! csrf_field() !!}
                <input type="hidden" name="token" value="{{ $token }}">

                @if (count($errors) > 0)
                    <div class="alert alert-danger error-message" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="payer_email" value="{{ $email }}">
                </div>
                <div class="form-group">
                    <label for="password">New password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <label form="password_confirmation">Confirm new password</label>
                    <input type="password" class="form-control" name="password_confirmation">
                </div>
                <div>
                    <button type="submit">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
        </div>

    </main>
@stop
