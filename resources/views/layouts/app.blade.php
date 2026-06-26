<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <title>@yield('title', 'SIAKAD') - Sistem Informasi Akademik</title>
    <style>
        :root {
            --siakad-maroon: #7a1f2b;
            --siakad-maroon-dark: #5c1620;
            --siakad-maroon-light: #fbeef0;
            --siakad-gold: #c98a2c;
            --siakad-gold-light: #fbf1e1;
            --siakad-olive: #4a6741;
            --siakad-olive-light: #eaf1e8;
            --siakad-bg: #f5f3ef;
            --siakad-ink: #2b2420;
            --siakad-muted: #6b6258;
            --siakad-border: #e6e1d8;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--siakad-bg);
            color: var(--siakad-ink);
            min-height: 100vh;
        }

        h1, h2, h3, h4, h5, .brand-font {
            font-family: 'Poppins', sans-serif;
        }

        a {
            text-decoration: none;
        }

        /* ---------- Sidebar (Admin) ---------- */
        .sidebar {
            min-height: 100vh;
            width: 252px;
            background: linear-gradient(165deg, var(--siakad-maroon) 0%, var(--siakad-maroon-dark) 100%);
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1030;
            display: flex;
            flex-direction: column;
        }

        .sidebar .brand {
            padding: 1.4rem 1.25rem 1.1rem;
            border-bottom: 1px solid rgba(255,255,255,.12);
        }

        .sidebar .brand-icon {
            width: 38px;
            height: 38px;
            border-radius: .6rem;
            background: rgba(255,255,255,.14);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .sidebar .brand small {
            opacity: .7;
            font-size: .76rem;
            letter-spacing: .01em;
        }

        .sidebar .nav-section-label {
            font-size: .68rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: rgba(255,255,255,.45);
            padding: 1rem 1.25rem .35rem;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,.82);
            padding: .6rem 1.25rem;
            border-radius: 0;
            font-size: .91rem;
            display: flex;
            align-items: center;
            gap: .65rem;
            position: relative;
            transition: background .15s ease, color .15s ease;
        }

        .sidebar .nav-link i { font-size: 1.02rem; width: 1.2rem; }

        .sidebar .nav-link:hover {
            background: rgba(255,255,255,.08);
            color: #fff;
        }

        .sidebar .nav-link.active {
            background: rgba(255,255,255,.14);
            color: #fff;
            font-weight: 600;
        }

        .sidebar .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 3px;
            background: var(--siakad-gold);
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 1rem 1.25rem;
            border-top: 1px solid rgba(255,255,255,.12);
            font-size: .74rem;
            color: rgba(255,255,255,.5);
        }

        .main-content {
            margin-left: 252px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            flex: 1;
            min-width: 0;
        }

        .topbar {
            background: #fff;
            border-bottom: 1px solid var(--siakad-border);
            padding: .85rem 1.75rem;
        }

        .content-wrap {
            padding: 2rem 2.5rem;
            flex: 1;
            max-width: 1400px;
            width: 100%;
        }

        /* ---------- Top navbar (Mahasiswa) ---------- */
        .navbar-mahasiswa {
            background: linear-gradient(100deg, var(--siakad-maroon) 0%, var(--siakad-maroon-dark) 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,.08);
        }

        .navbar-mahasiswa .nav-link {
            color: rgba(255,255,255,.85) !important;
            font-weight: 500;
            border-radius: .5rem;
            padding: .45rem .8rem !important;
            transition: background .15s ease;
        }

        .navbar-mahasiswa .nav-link.active,
        .navbar-mahasiswa .nav-link:hover {
            color: #fff !important;
            background: rgba(255,255,255,.12);
        }

        /* ---------- Avatar ---------- */
        .avatar-circle {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: .82rem;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            background: var(--siakad-gold-light);
            color: var(--siakad-maroon);
            flex-shrink: 0;
        }

        .avatar-circle-light {
            background: rgba(255,255,255,.16);
            color: #fff;
        }

        /* ---------- Shared components ---------- */
        .card {
            border: 1px solid var(--siakad-border);
            border-radius: .75rem;
            width: 100%;
            box-shadow: 0 1px 2px rgba(43,36,32,.03);
        }

        .card-header {
            background: #fff;
            font-weight: 600;
            border-bottom: 1px solid var(--siakad-border);
            border-radius: .75rem .75rem 0 0 !important;
        }

        .card-body {
            padding: 1.5rem;
        }

        .btn {
            transition: transform .12s ease, box-shadow .12s ease, background .15s ease, border-color .15s ease;
        }

        .btn-maroon {
            background-color: var(--siakad-maroon);
            border-color: var(--siakad-maroon);
            color: #fff;
        }

        .btn-maroon:hover {
            background-color: var(--siakad-maroon-dark);
            border-color: var(--siakad-maroon-dark);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(122,31,43,.25);
        }

        .btn-sm:active, .btn:active {
            transform: translateY(0);
        }

        /* Badge pills */
        .pill {
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            padding: .25rem .65rem;
            border-radius: 999px;
            font-size: .76rem;
            font-weight: 600;
        }

        .pill-maroon { background: var(--siakad-maroon-light); color: var(--siakad-maroon); }
        .pill-gold { background: var(--siakad-gold-light); color: #8a5e1c; }
        .pill-olive { background: var(--siakad-olive-light); color: var(--siakad-olive); }

        /* Stat cards */
        .stat-card {
            border-radius: 1rem;
            border: 1px solid var(--siakad-border);
            background: #fff;
            padding: 1.6rem;
            transition: transform .15s ease, box-shadow .15s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 .6rem 1.5rem rgba(43,36,32,.08);
        }

        .stat-card .stat-icon {
            width: 58px;
            height: 58px;
            border-radius: .8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.7rem;
            color: #fff;
            background: var(--siakad-maroon);
            flex-shrink: 0;
        }

        .stat-card .stat-number {
            font-family: 'Poppins', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            line-height: 1.1;
        }

        .stat-card .stat-label {
            font-size: .92rem;
            color: var(--siakad-muted);
        }

        /* Tables */
        .table thead th {
            background-color: var(--siakad-bg);
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: var(--siakad-muted);
            font-weight: 600;
            border-bottom-width: 1px;
            padding-top: .85rem;
            padding-bottom: .85rem;
        }

        .table tbody tr {
            transition: background .12s ease;
        }

        .table-hover tbody tr:hover {
            background-color: var(--siakad-bg);
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--siakad-muted);
        }

        .empty-state i {
            font-size: 2.6rem;
            color: var(--siakad-border);
            margin-bottom: .75rem;
            display: block;
        }

        .empty-state p {
            margin-bottom: 1rem;
        }

        /* Pagination */
        .siakad-pagination .page-link {
            color: var(--siakad-maroon);
            border-color: var(--siakad-border);
        }

        .siakad-pagination .page-item.active .page-link {
            background-color: var(--siakad-maroon);
            border-color: var(--siakad-maroon);
            color: #fff;
        }

        .siakad-pagination .page-item.disabled .page-link {
            color: #c9c2b8;
        }

        .siakad-pagination .page-link:hover {
            background-color: var(--siakad-maroon-light);
            color: var(--siakad-maroon-dark);
        }

        /* Page heading helper */
        .page-eyebrow {
            font-size: .8rem;
            color: var(--siakad-muted);
            text-transform: uppercase;
            letter-spacing: .06em;
            font-weight: 600;
            margin-bottom: .2rem;
        }

        .footer-note {
            text-align: center;
            font-size: .82rem;
            color: #9c948a;
            padding: 1.25rem 0;
        }

        @media (max-width: 768px) {
            .sidebar {
                left: -252px;
                transition: left .2s ease;
            }
            .sidebar.show {
                left: 0;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    @yield('body')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
