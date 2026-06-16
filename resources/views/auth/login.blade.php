@extends('layout')

@section('title', 'Inloggen')

@section('content')
    <div class="card" style="max-width: 440px; margin: 2rem auto;">
        <h1>Inloggen</h1>
        <p style="color: #64748b; margin-bottom: 1.5rem;">
            Log in met je e-mailadres en wachtwoord. Admin en medewerkers zien lesbeheer; studenten zien pakketten en prijzen.
        </p>

        @if ($errors->any())
            <div class="alert alert-error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">E-mailadres</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label style="display:flex;align-items:center;gap:0.5rem;font-weight:500;">
                    <input type="checkbox" name="remember" style="width:auto;"> Onthoud mij
                </label>
            </div>
            <div class="actions">
                <button type="submit" class="btn btn-primary">Inloggen</button>
            </div>
        </form>

        <p style="margin-top: 1.5rem; font-size: 0.9rem; color: #64748b;">
            Nog geen account? <a href="{{ route('register') }}">Registreren als student</a>
        </p>
    </div>
@endsection
