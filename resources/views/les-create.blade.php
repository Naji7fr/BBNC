@extends('layout')

@section('title', 'Nieuwe les inplannen')

@section('content')
    <div class="card">
        <h1>Nieuwe les inplannen</h1>

        @if ($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 1.25rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('lessons.store') }}" method="POST"
              data-confirm-save
              data-confirm-message="Weet je zeker dat je deze les wilt inplannen?">
            @csrf

            @include('partials.les-form')

            <div class="actions">
                <button type="submit" class="btn btn-primary">Les opslaan</button>
                <a href="{{ route('lessons.index') }}" class="btn btn-secondary">Annuleren</a>
            </div>
        </form>
    </div>
@endsection
