<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'BBNC') — Rijschool</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Inter', system-ui, sans-serif;
            background: #f4f6f8;
            color: #1a1a1a;
            line-height: 1.5;
        }
        .header {
            background: #0f172a;
            color: #fff;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 12px rgba(0,0,0,0.15);
        }
        .header a {
            color: #e2e8f0;
            text-decoration: none;
            margin-left: 1.5rem;
            font-weight: 500;
            font-size: 0.95rem;
        }
        .header nav { display: flex; align-items: center; flex-wrap: wrap; gap: 0.25rem; }
        .header .user-badge {
            margin-left: 1rem;
            padding: 0.25rem 0.65rem;
            background: rgba(251, 191, 36, 0.2);
            border-radius: 999px;
            font-size: 0.8rem;
            color: #fbbf24;
        }
        .header form { display: inline; margin: 0; }
        .header .btn-logout {
            background: none;
            border: none;
            color: #e2e8f0;
            font-weight: 500;
            font-size: 0.95rem;
            cursor: pointer;
            font-family: inherit;
            margin-left: 1.5rem;
            padding: 0;
        }
        .header .btn-logout:hover { color: #fff; text-decoration: underline; }
        .header .brand {
            font-weight: 800;
            font-size: 1.25rem;
            letter-spacing: -0.02em;
        }
        .header .brand span { color: #fbbf24; }
        .container { max-width: 1100px; margin: 2rem auto; padding: 0 1.5rem; }
        .container--wide { max-width: 100%; margin: 0; padding: 0; }
        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            padding: 1.5rem 2rem;
        }
        h1 { margin-top: 0; font-size: 1.75rem; }
        .btn {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: transform 0.15s, background 0.15s;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn-primary { background: #2563eb; color: #fff; }
        .btn-primary:hover { background: #1d4ed8; }
        .btn-secondary { background: #e5e7eb; color: #374151; }
        .btn-secondary:hover { background: #d1d5db; }
        .btn-danger { background: #dc2626; color: #fff; }
        .btn-danger:hover { background: #b91c1c; }
        .btn-sm { padding: 0.4rem 0.75rem; font-size: 0.8rem; }
        .btn-outline { background: transparent; border: 1px solid #cbd5e1; color: #475569; }
        .btn-outline:hover { background: #f8fafc; }
        .table-actions { display: flex; gap: 0.5rem; flex-wrap: wrap; }
        .alert {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .alert.is-hiding { opacity: 0; transform: translateY(-8px); }
        .alert-success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { padding: 0.75rem 1rem; text-align: left; border-bottom: 1px solid #e5e7eb; vertical-align: middle; }
        th { background: #f9fafb; font-weight: 600; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.04em; color: #6b7280; }
        tr:hover td { background: #f9fafb; }
        .form-group { margin-bottom: 1.25rem; }
        label { display: block; font-weight: 600; margin-bottom: 0.35rem; font-size: 0.9rem; }
        input, select, textarea {
            width: 100%;
            padding: 0.6rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            font-family: inherit;
        }
        input:focus, select:focus, textarea:focus {
            outline: 2px solid #2563eb;
            outline-offset: 0;
            border-color: #2563eb;
        }
        .error { color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem; }
        .actions { display: flex; gap: 0.75rem; margin-top: 1.5rem; flex-wrap: wrap; }
        .empty { color: #6b7280; text-align: center; padding: 2rem; }

        /* Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .modal-overlay.is-open { display: flex; }
        .modal {
            background: #fff;
            border-radius: 16px;
            padding: 1.75rem;
            max-width: 420px;
            width: 100%;
            box-shadow: 0 25px 50px rgba(0,0,0,0.25);
            animation: modalIn 0.2s ease;
        }
        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        .modal h2 { margin: 0 0 0.5rem; font-size: 1.25rem; }
        .modal p { margin: 0 0 1.5rem; color: #64748b; }
        .modal-actions { display: flex; gap: 0.75rem; justify-content: flex-end; }
    </style>
    @stack('styles')
</head>
<body class="@yield('body_class')">
    <header class="header">
        <a href="{{ route('home') }}" class="brand" style="color:#fff;text-decoration:none;">
            BBNC <span>Rijschool</span>
        </a>
        <nav>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('packages.index') }}">Pakketten</a>
            <a href="{{ route('prices.index') }}">Prijzen</a>

            @auth
                @if (auth()->user()->isStaff())
                    <a href="{{ route('lessons.index') }}">Lesoverzicht</a>
                    <a href="{{ route('lessons.create') }}">Les inplannen</a>
                    <span class="user-badge">{{ auth()->user()->role->label() }}</span>
                @else
                    <span class="user-badge">Student</span>
                @endif
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">Uitloggen</button>
                </form>
            @else
                <a href="{{ route('register') }}">Registreren</a>
                <a href="{{ route('login') }}">Inloggen</a>
            @endauth
        </nav>
    </header>

    <main class="@yield('container_class', 'container')">
        @if (session('success'))
            <div class="alert alert-success" data-auto-dismiss="4000">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-error" data-auto-dismiss="4000">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>

    {{-- Confirmation modal --}}
    <div class="modal-overlay" id="confirmModal" role="dialog" aria-modal="true" aria-labelledby="confirmModalTitle">
        <div class="modal">
            <h2 id="confirmModalTitle">Bevestigen</h2>
            <p id="confirmModalMessage">Weet je het zeker?</p>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" id="confirmModalCancel">Annuleren</button>
                <button type="button" class="btn btn-primary" id="confirmModalOk">Bevestigen</button>
            </div>
        </div>
    </div>

    <script>
        // Auto-dismiss alerts after 4 seconds
        document.querySelectorAll('[data-auto-dismiss]').forEach(function (alert) {
            var delay = parseInt(alert.getAttribute('data-auto-dismiss'), 10);
            setTimeout(function () {
                alert.classList.add('is-hiding');
                setTimeout(function () { alert.remove(); }, 500);
            }, delay);
        });

        // Reusable confirmation modal
        var confirmModal = document.getElementById('confirmModal');
        var confirmMessage = document.getElementById('confirmModalMessage');
        var confirmOk = document.getElementById('confirmModalOk');
        var confirmCancel = document.getElementById('confirmModalCancel');
        var pendingAction = null;

        function showConfirm(message, onConfirm, okLabel, okClass) {
            confirmMessage.textContent = message;
            confirmOk.textContent = okLabel || 'Bevestigen';
            confirmOk.className = 'btn ' + (okClass || 'btn-primary');
            pendingAction = onConfirm;
            confirmModal.classList.add('is-open');
        }

        function hideConfirm() {
            confirmModal.classList.remove('is-open');
            pendingAction = null;
        }

        confirmOk.addEventListener('click', function () {
            if (pendingAction) pendingAction();
            hideConfirm();
        });

        confirmCancel.addEventListener('click', hideConfirm);

        confirmModal.addEventListener('click', function (e) {
            if (e.target === confirmModal) hideConfirm();
        });

        // Delete lesson confirmation
        document.querySelectorAll('[data-confirm-delete]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var form = btn.closest('form');
                showConfirm(
                    'Weet je zeker dat je deze les wilt verwijderen?',
                    function () { form.submit(); },
                    'Verwijderen',
                    'btn-danger'
                );
            });
        });

        // Save lesson confirmation (create & edit forms)
        document.querySelectorAll('[data-confirm-save]').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                if (form.dataset.confirmed === 'true') {
                    form.dataset.confirmed = 'false';
                    return;
                }
                e.preventDefault();
                var message = form.getAttribute('data-confirm-message')
                    || 'Weet je zeker dat je deze les wilt opslaan?';
                showConfirm(message, function () {
                    form.dataset.confirmed = 'true';
                    form.requestSubmit();
                }, 'Opslaan');
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
