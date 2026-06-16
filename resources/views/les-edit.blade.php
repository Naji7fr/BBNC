@extends('layout')

@section('title', 'Les bewerken')

@section('content')
    <div class="card">
        <h1>Les bewerken</h1>

        @if ($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 1.25rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('lessons.update', $lesson) }}" method="POST"
              data-confirm-save
              data-confirm-message="Weet je zeker dat je de wijzigingen wilt opslaan?">
            @csrf
            @method('PUT')

            @include('partials.les-form', ['lesson' => $lesson])

            <div class="actions">
                <button type="submit" class="btn btn-primary">Wijzigingen opslaan</button>
                <a href="{{ route('lessons.index') }}" class="btn btn-secondary">Annuleren</a>
            </div>
        </form>
    </div>
@endsection
