@extends('layout')

@section('title', 'Lesoverzicht')

@section('content')
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <h1>Lesoverzicht</h1>
            <a href="{{ route('lessons.create') }}" class="btn btn-primary">Nieuwe les inplannen</a>
        </div>

        @if ($lessons->isEmpty())
            <p class="empty">Er zijn nog geen lessen ingepland.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Datum</th>
                        <th>Tijd</th>
                        <th>Les type</th>
                        <th>Instructeur</th>
                        <th>Locatie</th>
                        <th>Max. deelnemers</th>
                        <th>Opmerkingen</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lessons as $lesson)
                        <tr>
                            <td>{{ $lesson->date->format('d-m-Y') }}</td>
                            <td>{{ substr($lesson->time, 0, 5) }}</td>
                            <td>{{ $lesson->lessonType->name }}</td>
                            <td>{{ $lesson->instructor->name }}</td>
                            <td>{{ $lesson->location->name }}</td>
                            <td>{{ $lesson->max_participants }}</td>
                            <td>{{ $lesson->notes ?? '—' }}</td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('lessons.edit', $lesson) }}" class="btn btn-outline btn-sm">Bewerken</a>
                                    <form action="{{ route('lessons.destroy', $lesson) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" data-confirm-delete>Verwijderen</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
