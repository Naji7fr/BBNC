@extends('layout')

@section('title', 'Pakketten')

@push('styles')
<style>
    .packages-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-top: 1.5rem;
    }
    .package-card {
        background: #fff;
        border-radius: 16px;
        border: 2px solid #e2e8f0;
        padding: 1.75rem;
        position: relative;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .package-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(0,0,0,0.1); }
    .package-card.is-popular {
        border-color: #fbbf24;
        box-shadow: 0 8px 24px rgba(251, 191, 36, 0.2);
    }
    .popular-badge {
        position: absolute;
        top: -12px;
        right: 1rem;
        background: #fbbf24;
        color: #0f172a;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.25rem 0.75rem;
        border-radius: 999px;
    }
    .package-price {
        font-size: 2.25rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0.5rem 0;
    }
    .package-price small { font-size: 1rem; font-weight: 500; color: #64748b; }
    .package-features { list-style: none; padding: 0; margin: 1.25rem 0 0; }
    .package-features li {
        padding: 0.4rem 0;
        color: #475569;
        font-size: 0.95rem;
    }
    .package-features li::before { content: '✓ '; color: #16a34a; font-weight: 700; }
</style>
@endpush

@section('content')
    <div class="card">
        <h1>Rijles pakketten</h1>
        <p style="color: #64748b;">Kies het pakket dat bij jou past. Alle prijzen zijn inclusief BTW.</p>

        <div class="packages-grid">
            @foreach ($packages as $package)
                <article class="package-card {{ $package->is_popular ? 'is-popular' : '' }}">
                    @if ($package->is_popular)
                        <span class="popular-badge">Meest gekozen</span>
                    @endif
                    <h2 style="margin: 0; font-size: 1.35rem;">{{ $package->name }}</h2>
                    <p style="color: #64748b; margin: 0.5rem 0 0; font-size: 0.95rem;">{{ $package->description }}</p>
                    <div class="package-price">
                        € {{ number_format($package->price, 2, ',', '.') }}
                        <small>/ {{ $package->lessons_count }} lessen</small>
                    </div>
                    <ul class="package-features">
                        @foreach ($package->features as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                </article>
            @endforeach
        </div>

        <p style="margin-top: 2rem; text-align: center;">
            <a href="{{ route('prices.index') }}" class="btn btn-secondary">Bekijk losse prijzen →</a>
        </p>
    </div>
@endsection
