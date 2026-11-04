<style>
    .kn-navbar { background: #0b2e2b; border-bottom: 3px solid #fbbf24; position: sticky; top: 0; z-index: 1030; }
    .kn-inner { display: flex; align-items: center; justify-content: space-between; min-height: 66px; }
    .kn-brand { color: #fff; font-weight: 800; font-size: 1.35rem; letter-spacing: -.5px; text-decoration: none; }
    .kn-brand span { color: #fbbf24; }
    .kn-brand:hover { color: #fff; }

    .kn-menu { display: flex; align-items: center; gap: 1.6rem; }
    .kn-link {
        position: relative; color: rgba(255,255,255,.72); font-weight: 600; font-size: .9rem;
        text-decoration: none; padding: .4rem 0;
    }
    .kn-link:hover { color: #fff; }
    .kn-link.active { color: #fff; }
    .kn-link.active::after {
        content: ""; position: absolute; left: 0; right: 0; bottom: -8px; height: 2px; background: #fbbf24; border-radius: 2px;
    }

    /* Tombol Daftar Kursus */
    .kn-cta {
        background: #fbbf24; color: #0b2e2b; font-weight: 800; font-size: .82rem; text-decoration: none;
        padding: .5rem 1.1rem; border-radius: 8px; box-shadow: 0 6px 14px rgba(251,191,36,.3);
        transition: transform .15s ease, background .15s ease;
    }
    .kn-cta:hover { background: #f5b50f; color: #0b2e2b; transform: translateY(-1px); }
    .kn-cta.active { outline: 2px solid #fff; outline-offset: 2px; }

    .kn-toggle { display: none; background: transparent; border: 1.5px solid rgba(255,255,255,.4); color: #fff; border-radius: 8px; padding: .35rem .7rem; font-size: 1.1rem; line-height: 1; }

    @media (max-width: 767.98px) {
        .kn-toggle { display: inline-block; }
        .kn-menu { display: none; position: absolute; top: 100%; left: 0; right: 0; flex-direction: column; align-items: flex-start; gap: 1rem; padding: 1.2rem 1.5rem 1.5rem; background: #0b2e2b; border-bottom: 3px solid #fbbf24; }
        .kn-menu.open { display: flex; }
        .kn-link.active::after { bottom: -4px; right: auto; width: 100%; }
    }
</style>

<header class="kn-navbar">
    <div class="container kn-inner">
        <a class="kn-brand" href="{{ url('/') }}">KursusKu<span>.</span></a>

        <button type="button" class="kn-toggle" id="knToggle" aria-label="Buka menu" aria-expanded="false">&#9776;</button>

        <nav class="kn-menu" id="knMenu">
            <a class="kn-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>

            {{-- TOMBOL BARU: di tengah, antara Beranda dan Pendaftaran --}}
            <a class="kn-cta {{ request()->routeIs('courses.*') ? 'active' : '' }}" href="{{ route('courses.index') }}">Daftar Kursus</a>

            {{-- GANTI href ini dengan alamat Pendaftaran milik Anda yang lama --}}
            <a class="kn-link {{ request()->is('pendaftaran*') ? 'active' : '' }}" href="{{ url('/pendaftaran') }}">Pendaftaran</a>
        </nav>
    </div>
</header>

<script>
    (function () {
        var btn = document.getElementById('knToggle');
        var menu = document.getElementById('knMenu');
        if (!btn || !menu) return;
        btn.addEventListener('click', function () {
            var open = menu.classList.toggle('open');
            btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
    })();
</script>