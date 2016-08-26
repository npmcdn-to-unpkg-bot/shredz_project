<form method="POST" action="/email/verify" novalidate>
    {!! csrf_field() !!}
    <input type="hidden" name="verify_token" value="{{ $token }}">

    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div>
        Email
        <input type="email" name="payer_email" value="{{ $email }}">
    </div>
    <div>
        <button type="submit">
            Verify Email
        </button>
    </div>
</form>