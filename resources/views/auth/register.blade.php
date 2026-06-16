@extends('layout')

@section('title', 'Registreren')

@section('content')
    <div class="card" style="max-width: 440px; margin: 2rem auto;">
        <h1>Registreren als student</h1>
        <p style="color: #64748b; margin-bottom: 1.5rem;">
            Maak een studentaccount aan om pakketten en prijzen te bekijken.
        </p>

        @if ($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 1.25rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">Naam</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
            </div>
            <div class="form-group">
                <label for="email">E-mailadres</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Bevestig wachtwoord</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <div class="actions">
                <button type="submit" class="btn btn-primary">Account aanmaken</button>
                <a href="{{ route('login') }}" class="btn btn-secondary">Al een account? Inloggen</a>
            </div>
        </form>
    </div>
@endsection
