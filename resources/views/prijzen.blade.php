@extends('layout')

@section('title', 'Prijzen')

@push('styles')
<style>
    .price-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1.25rem;
        margin-top: 1.5rem;
    }
    .price-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.25rem 1.5rem;
    }
    .price-item h3 { margin: 0 0 0.35rem; font-size: 1.05rem; }
    .price-item p { margin: 0; color: #64748b; font-size: 0.9rem; }
    .price-item .amount {
        font-size: 1.75rem;
        font-weight: 800;
        color: #2563eb;
        margin-top: 0.75rem;
    }
</style>
@endpush

@section('content')
    <div class="card">
        <h1>Prijzen</h1>
        <p style="color: #64748b;">Overzicht van losse tarieven. Voordeel met onze pakketten? Bekijk <a href="{{ route('packages.index') }}">pakketten</a>.</p>

        <div class="price-grid">
            @foreach ($prices as $item)
                <article class="price-item">
                    <h3>{{ $item['name'] }}</h3>
                    <p>{{ $item['description'] }}</p>
                    <div class="amount">€ {{ number_format($item['price'], 2, ',', '.') }}</div>
                </article>
            @endforeach
        </div>
    </div>
@endsection
