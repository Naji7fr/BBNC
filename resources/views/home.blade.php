@extends('layout')

@section('title', 'Home')
@section('container_class', 'container--wide')

@push('styles')
<style>
    .hero {
        position: relative;
        min-height: 85vh;
        display: flex;
        align-items: center;
        background: url('https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?w=1920&q=80') center/cover no-repeat;
    }
    .hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(15,23,42,0.92) 0%, rgba(15,23,42,0.65) 50%, rgba(37,99,235,0.4) 100%);
    }
    .hero-content {
        position: relative;
        z-index: 1;
        max-width: 1100px;
        margin: 0 auto;
        padding: 4rem 1.5rem;
        color: #fff;
    }
    .hero-badge {
        display: inline-block;
        background: rgba(251, 191, 36, 0.2);
        border: 1px solid rgba(251, 191, 36, 0.5);
        color: #fbbf24;
        padding: 0.35rem 0.85rem;
        border-radius: 999px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 1.25rem;
    }
    .hero h1 {
        font-size: clamp(2.5rem, 6vw, 3.75rem);
        font-weight: 800;
        line-height: 1.1;
        margin: 0 0 1.25rem;
        letter-spacing: -0.03em;
    }
    .hero h1 span { color: #fbbf24; }
    .hero p {
        font-size: 1.15rem;
        max-width: 540px;
        color: #cbd5e1;
        margin: 0 0 2rem;
        line-height: 1.7;
    }
    .hero-buttons { display: flex; gap: 1rem; flex-wrap: wrap; }
    .btn-hero {
        padding: 0.85rem 1.75rem;
        font-size: 1rem;
        border-radius: 10px;
    }
    .btn-gold { background: #fbbf24; color: #0f172a; }
    .btn-gold:hover { background: #f59e0b; }
    .btn-ghost {
        background: rgba(255,255,255,0.1);
        color: #fff;
        border: 1px solid rgba(255,255,255,0.3);
    }
    .btn-ghost:hover { background: rgba(255,255,255,0.2); }

    .stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 1.5rem;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(255,255,255,0.15);
    }
    .stat strong { display: block; font-size: 2rem; font-weight: 800; color: #fbbf24; }
    .stat span { font-size: 0.9rem; color: #94a3b8; }

    .section { padding: 5rem 1.5rem; max-width: 1100px; margin: 0 auto; }
    .section-title {
        text-align: center;
        margin-bottom: 3rem;
    }
    .section-title h2 {
        font-size: 2rem;
        font-weight: 800;
        margin: 0 0 0.5rem;
        letter-spacing: -0.02em;
    }
    .section-title p { color: #64748b; margin: 0; font-size: 1.05rem; }

    .features {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }
    .feature-card {
        border-radius: 16px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        transition: transform 0.2s;
    }
    .feature-card:hover { transform: translateY(-4px); }
    .feature-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .feature-card-body { padding: 1.5rem; }
    .feature-card h3 { margin: 0 0 0.5rem; font-size: 1.15rem; }
    .feature-card p { margin: 0; color: #64748b; font-size: 0.95rem; line-height: 1.6; }

    .cta {
        background: #0f172a;
        color: #fff;
        text-align: center;
        padding: 4rem 1.5rem;
        margin-top: 2rem;
    }
    .cta h2 { font-size: 2rem; margin: 0 0 0.75rem; font-weight: 800; }
    .cta p { color: #94a3b8; margin: 0 0 2rem; max-width: 500px; margin-left: auto; margin-right: auto; }
</style>
@endpush

@section('content')
    <section class="hero">
        <div class="hero-content">
            <span class="hero-badge">★ Erkende rijschool</span>
            <h1>Snel en veilig<br>naar je <span>rijbewijs</span></h1>
            <p>
                Bij BBNC Rijschool leer je rijden bij ervaren instructeurs.
                Theorie, praktijk en examenvoorbereiding — alles onder één dak.
            </p>
            <div class="hero-buttons">
                <a href="{{ route('packages.index') }}" class="btn btn-gold btn-hero">Bekijk pakketten</a>
                <a href="{{ route('prices.index') }}" class="btn btn-ghost btn-hero">Prijzen</a>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-ghost btn-hero">Registreren</a>
                @endguest
                @auth
                    @if (auth()->user()->isStaff())
                        <a href="{{ route('lessons.create') }}" class="btn btn-ghost btn-hero">Les inplannen</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-ghost btn-hero">Inloggen</a>
                @endauth
            </div>
            <div class="stats">
                <div class="stat"><strong>15+</strong><span>Jaar ervaring</span></div>
                <div class="stat"><strong>98%</strong><span>Slagingspercentage</span></div>
                <div class="stat"><strong>500+</strong><span>Tevreden leerlingen</span></div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section-title">
            <h2>Waarom BBNC Rijschool?</h2>
            <p>Professionele begeleiding van je eerste les tot je examen</p>
        </div>
        <div class="features">
            <article class="feature-card">
                <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=600&q=80" alt="Theorieles in klaslokaal">
                <div class="feature-card-body">
                    <h3>Theorielessen</h3>
                    <p>Heldere uitleg over verkeersregels, voorrang en examenvragen in moderne lokalen.</p>
                </div>
            </article>
            <article class="feature-card">
                <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?w=600&q=80" alt="Praktijkles in auto">
                <div class="feature-card-body">
                    <h3>Praktijklessen</h3>
                    <p>Rijden in een moderne lesauto met persoonlijke begeleiding van gecertificeerde instructeurs.</p>
                </div>
            </article>
            <article class="feature-card">
                <img src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=600&q=80" alt="Examen voorbereiding">
                <div class="feature-card-body">
                    <h3>Examen training</h3>
                    <p>Simulatie-examens en tips zodat je vol vertrouwen je rijexamen aflegt.</p>
                </div>
            </article>
        </div>
    </section>

    <section class="cta">
        <h2>Klaar om te starten?</h2>
        <p>Bekijk onze pakketten en prijzen, of registreer je als student.</p>
        <a href="{{ route('register') }}" class="btn btn-gold btn-hero">Registreren als student</a>
    </section>
@endsection
