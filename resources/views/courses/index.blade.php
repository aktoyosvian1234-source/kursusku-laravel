@extends('layouts.app')

@section('title', 'Daftar Kursus | KursusKu')

@push('styles')
<style>
    .kc-page {
        --kc-dark: #0b2e2b;
        --kc-teal: #0f766e;
        --kc-teal-soft: #e6f4f1;
        --kc-yellow: #fbbf24;
        --kc-yellow-dark: #e9a90c;
        --kc-ink: #0f2a27;
        --kc-muted: #5b6b68;
        --kc-bg: #f1f6f4;
        --kc-border: #dfe8e5;
        color: var(--kc-ink);
    }

    /* ---------- Hero ---------- */
    .kc-hero {
        padding: 3.25rem 0 2.25rem;
        background: linear-gradient(120deg, #e3f5f1 0%, #ffffff 55%, #fff4d6 100%);
        border-bottom: 1px solid var(--kc-border);
    }
    .kc-eyebrow {
        display: flex; align-items: center; gap: .6rem;
        font-size: .75rem; font-weight: 800; letter-spacing: 1.5px; text-transform: uppercase; color: var(--kc-teal);
    }
    .kc-eyebrow::before { content: ""; width: 26px; height: 3px; border-radius: 3px; background: var(--kc-yellow); }
    .kc-title { font-weight: 800; letter-spacing: -1px; font-size: clamp(2rem, 4.2vw, 2.9rem); color: var(--kc-dark); line-height: 1.1; }
    .kc-title mark { background: linear-gradient(transparent 62%, #fde68a 62%); color: inherit; padding: 0 .15em; }
    .kc-lead { color: var(--kc-muted); line-height: 1.75; }

    .kc-btn {
        display: inline-flex; align-items: center; gap: .55rem; text-decoration: none; cursor: pointer;
        font-weight: 700; font-size: .92rem; border-radius: 10px; padding: .8rem 1.4rem; border: 1.5px solid transparent;
        transition: transform .15s ease, box-shadow .15s ease, background .15s ease;
    }
    .kc-btn-yellow { background: var(--kc-yellow); color: var(--kc-dark); box-shadow: 0 10px 22px rgba(251,191,36,.38); }
    .kc-btn-yellow:hover { background: var(--kc-yellow-dark); color: var(--kc-dark); transform: translateY(-1px); }

    .kc-stats { display: flex; flex-wrap: wrap; gap: 1rem 2.5rem; margin-top: 2rem; padding-top: 1.4rem; border-top: 1px solid var(--kc-border); }
    .kc-stat strong { display: block; font-size: 1.5rem; font-weight: 800; color: var(--kc-teal); line-height: 1.1; }
    .kc-stat span { font-size: .78rem; color: var(--kc-muted); }

    /* ---------- Body ---------- */
    .kc-body { background: var(--kc-bg); padding: 2rem 0 3.5rem; }
    .kc-card {
        background: #fff; border: 1px solid var(--kc-border); border-radius: 14px;
        box-shadow: 0 1px 2px rgba(11,46,43,.04), 0 12px 32px rgba(11,46,43,.05);
    }
    .kc-card-top { border-top: 3px solid var(--kc-teal); }

    /* ---------- Toolbar ---------- */
    .kc-toolbar { display: flex; flex-wrap: wrap; gap: 1rem; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; }
    .kc-search { position: relative; flex: 1 1 280px; max-width: 380px; }
    .kc-search svg { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--kc-muted); }
    .kc-search input {
        width: 100%; padding: .7rem 1rem .7rem 2.5rem; border-radius: 10px; border: 1.5px solid var(--kc-border); background: #fff; font-size: .92rem;
    }
    .kc-search input:focus { outline: 0; border-color: var(--kc-teal); box-shadow: 0 0 0 .22rem rgba(15,118,110,.15); }
    .kc-group { display: flex; flex-wrap: wrap; gap: .5rem; align-items: center; }
    .kc-pill {
        border: 1.5px solid var(--kc-border); background: #fff; color: var(--kc-muted);
        font-weight: 700; font-size: .82rem; border-radius: 999px; padding: .42rem .95rem; cursor: pointer;
    }
    .kc-pill:hover { color: var(--kc-dark); border-color: #b9ccc7; }
    .kc-pill.active { background: var(--kc-dark); border-color: var(--kc-dark); color: #fff; }
    .kc-view { display: inline-flex; background: #fff; border: 1.5px solid var(--kc-border); border-radius: 10px; padding: 3px; }
    .kc-view button { border: 0; background: transparent; font-weight: 700; font-size: .82rem; color: var(--kc-muted); padding: .35rem .85rem; border-radius: 7px; cursor: pointer; }
    .kc-view button.active { background: var(--kc-teal-soft); color: var(--kc-teal); }

    /* ---------- Chip & status ---------- */
    .kc-code {
        display: inline-block; background: var(--kc-dark); color: var(--kc-yellow);
        font-size: .7rem; font-weight: 800; letter-spacing: 1px; padding: .35rem .65rem; border-radius: 6px; white-space: nowrap;
    }
    .kc-status { display: inline-flex; align-items: center; gap: .4rem; font-size: .74rem; font-weight: 800; padding: .3rem .7rem; border-radius: 999px; white-space: nowrap; }
    .kc-status::before { content: ""; width: 7px; height: 7px; border-radius: 50%; background: currentColor; }
    .kc-status.open   { background: #d1fae5; color: #047857; }
    .kc-status.draft  { background: #fef3c7; color: #92400e; }
    .kc-status.closed { background: #fee2e2; color: #b91c1c; }

    /* ---------- Tabel ---------- */
    .kc-table { margin: 0; }
    .kc-table thead th {
        background: #f7fbfa; color: var(--kc-muted); font-size: .7rem; font-weight: 800; letter-spacing: .8px; text-transform: uppercase;
        padding: .95rem 1rem; border-bottom: 1px solid var(--kc-border); white-space: nowrap;
    }
    .kc-table tbody td { padding: 1.05rem 1rem; border-color: #eef3f1; vertical-align: middle; }
    .kc-table tbody tr:hover { background: #fafdfc; }
    .kc-name { font-weight: 700; color: var(--kc-dark); }
    .kc-sub  { font-size: .8rem; color: var(--kc-muted); }
    .kc-fee  { font-weight: 800; color: var(--kc-teal); white-space: nowrap; }

    /* ---------- Kartu ---------- */
    .kc-course { padding: 1.4rem; height: 100%; border-top: 3px solid var(--kc-teal); transition: transform .18s ease, box-shadow .18s ease; }
    .kc-course:hover { transform: translateY(-3px); box-shadow: 0 18px 40px rgba(11,46,43,.10); }
    .kc-course h3 { font-size: 1.1rem; font-weight: 800; color: var(--kc-dark); margin: 1rem 0 .3rem; letter-spacing: -.2px; }
    .kc-course p { font-size: .85rem; color: var(--kc-muted); min-height: 2.6em; margin-bottom: 1rem; }
    .kc-meta { display: grid; grid-template-columns: 1fr 1fr; gap: .75rem; padding-top: 1rem; border-top: 1px dashed var(--kc-border); }
    .kc-meta small { display: block; font-size: .68rem; font-weight: 700; letter-spacing: .6px; text-transform: uppercase; color: var(--kc-muted); }
    .kc-meta strong { font-size: .92rem; }
    .kc-meta .wide { grid-column: span 2; }

    /* ---------- Kosong ---------- */
    .kc-empty { text-align: center; padding: 4rem 1.5rem; }
    .kc-empty-icon {
        width: 72px; height: 72px; border-radius: 50%; margin: 0 auto 1rem; display: grid; place-items: center;
        background: var(--kc-teal-soft); color: var(--kc-teal); font-size: 2rem; font-weight: 800;
    }
    .kc-foot { display: flex; justify-content: space-between; flex-wrap: wrap; gap: .5rem; padding: .9rem 1.25rem; border-top: 1px solid var(--kc-border); font-size: .82rem; color: var(--kc-muted); }
</style>
@endpush

@section('content')
<div class="kc-page">

    {{-- ===== HERO ===== --}}
    <section class="kc-hero">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-end gap-4">
                <div style="max-width: 640px;">
                    <div class="kc-eyebrow">Manajemen Kursus</div>
                    <h1 class="kc-title mt-3 mb-3">Daftar <mark>Kursus</mark></h1>
                    <p class="kc-lead mb-0">
                        Seluruh data kursus tersimpan di MySQL dan dibaca melalui Eloquent.
                        Tambahkan kursus baru kapan saja, datanya langsung tampil di sini.
                    </p>
                </div>
                <a href="{{ route('courses.create') }}" class="kc-btn kc-btn-yellow">
                    Tambah Kursus <span aria-hidden="true">+</span>
                </a>
            </div>

            <div class="kc-stats">
                <div class="kc-stat"><strong>{{ $stats['total'] }}</strong><span>Total kursus</span></div>
                <div class="kc-stat"><strong>{{ $stats['open'] }}</strong><span>Pendaftaran open</span></div>
                <div class="kc-stat"><strong>{{ $stats['draft'] }}</strong><span>Masih draft</span></div>
                <div class="kc-stat"><strong>{{ $stats['closed'] }}</strong><span>Sudah ditutup</span></div>
            </div>
        </div>
    </section>

    {{-- ===== ISI ===== --}}
    <section class="kc-body">
        <div class="container">

            @if ($courses->isEmpty())

                <div class="kc-card kc-card-top kc-empty">
                    <div class="kc-empty-icon">+</div>
                    <h2 class="h5 fw-bold mb-1">Belum ada data kursus.</h2>
                    <p class="text-muted mb-4">Mulai dengan menambahkan kursus pertama Anda.</p>
                    <a href="{{ route('courses.create') }}" class="kc-btn kc-btn-yellow">Tambah Kursus <span aria-hidden="true">+</span></a>
                </div>

            @else

                {{-- Toolbar (pencarian & filter berjalan di browser, tidak mengubah query database) --}}
                <div class="kc-toolbar">
                    <div class="kc-search">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
                        <input type="search" id="kcSearch" placeholder="Cari kode atau nama kursus...">
                    </div>

                    <div class="kc-group" id="kcFilters">
                        <button type="button" class="kc-pill active" data-status="all">Semua</button>
                        <button type="button" class="kc-pill" data-status="open">Open</button>
                        <button type="button" class="kc-pill" data-status="draft">Draft</button>
                        <button type="button" class="kc-pill" data-status="closed">Closed</button>
                    </div>

                    <div class="kc-view" id="kcViews">
                        <button type="button" class="active" data-view="table">Tabel</button>
                        <button type="button" data-view="grid">Kartu</button>
                    </div>
                </div>

                {{-- ===== TAMPILAN TABEL ===== --}}
                <div class="kc-card kc-card-top overflow-hidden" id="kcTable">
                    <div class="table-responsive">
                        <table class="table kc-table">
                            <thead>
                                <tr>
                                    <th class="ps-4">Kode</th>
                                    <th>Nama Kursus</th>
                                    <th class="text-end">Biaya</th>
                                    <th class="text-center">Kuota</th>
                                    <th>Mulai</th>
                                    <th class="pe-4">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr class="kc-item"
                                        data-status="{{ $course->status }}"
                                        data-search="{{ strtolower($course->code . ' ' . $course->name) }}">
                                        <td class="ps-4"><span class="kc-code">{{ $course->code }}</span></td>
                                        <td>
                                            <div class="kc-name">{{ $course->name }}</div>
                                            @if ($course->description)
                                                <div class="kc-sub">{{ \Illuminate\Support\Str::limit($course->description, 60) }}</div>
                                            @endif
                                        </td>
                                        <td class="text-end kc-fee">Rp {{ number_format($course->fee, 0, ',', '.') }}</td>
                                        <td class="text-center fw-semibold">{{ $course->quota }}</td>
                                        <td class="text-nowrap">{{ $course->start_date->format('d/m/Y') }}</td>
                                        <td class="pe-4"><span class="kc-status {{ $course->status }}">{{ ucfirst($course->status) }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- ===== TAMPILAN KARTU ===== --}}
                <div class="row g-4 d-none" id="kcGrid">
                    @foreach ($courses as $course)
                        <div class="col-md-6 col-xl-4 kc-item"
                             data-status="{{ $course->status }}"
                             data-search="{{ strtolower($course->code . ' ' . $course->name) }}">
                            <article class="kc-card kc-course">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="kc-code">{{ $course->code }}</span>
                                    <span class="kc-status {{ $course->status }}">{{ ucfirst($course->status) }}</span>
                                </div>
                                <h3>{{ $course->name }}</h3>
                                <p>{{ $course->description ? \Illuminate\Support\Str::limit($course->description, 90) : 'Belum ada deskripsi.' }}</p>
                                <div class="kc-meta">
                                    <div><small>Biaya</small><strong class="kc-fee">Rp {{ number_format($course->fee, 0, ',', '.') }}</strong></div>
                                    <div><small>Kuota</small><strong>{{ $course->quota }} peserta</strong></div>
                                    <div class="wide"><small>Tanggal mulai</small><strong>{{ $course->start_date->format('d/m/Y') }}</strong></div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>

                {{-- Tampil jika pencarian tidak menemukan hasil --}}
                <div class="kc-card kc-card-top kc-empty d-none" id="kcNoResult">
                    <div class="kc-empty-icon">?</div>
                    <h2 class="h5 fw-bold mb-1">Tidak ada kursus yang cocok.</h2>
                    <p class="text-muted mb-0">Coba kata kunci atau filter status yang lain.</p>
                </div>

                <div class="kc-foot">
                    <span>Menampilkan <strong id="kcShown">{{ $stats['total'] }}</strong> dari {{ $stats['total'] }} kursus</span>
                    <span>Diurutkan dari data terbaru</span>
                </div>

            @endif

        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    (function () {
        const items = document.querySelectorAll('#kcTable .kc-item');
        if (!items.length) return;

        const allItems  = document.querySelectorAll('.kc-item');
        const search    = document.getElementById('kcSearch');
        const filters   = document.querySelectorAll('#kcFilters .kc-pill');
        const views     = document.querySelectorAll('#kcViews button');
        const tableBox  = document.getElementById('kcTable');
        const gridBox   = document.getElementById('kcGrid');
        const noResult  = document.getElementById('kcNoResult');
        const shownEl   = document.getElementById('kcShown');
        let status = 'all';
        let view = 'table';

        function apply() {
            const q = search.value.trim().toLowerCase();
            let shown = 0;

            allItems.forEach(el => {
                const ok = (status === 'all' || el.dataset.status === status) && el.dataset.search.includes(q);
                el.classList.toggle('d-none', !ok);
            });
            items.forEach(el => { if (!el.classList.contains('d-none')) shown++; });

            shownEl.textContent = shown;
            noResult.classList.toggle('d-none', shown !== 0);
            tableBox.classList.toggle('d-none', view !== 'table' || shown === 0);
            gridBox.classList.toggle('d-none', view !== 'grid' || shown === 0);
        }

        search.addEventListener('input', apply);

        filters.forEach(btn => btn.addEventListener('click', () => {
            filters.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            status = btn.dataset.status;
            apply();
        }));

        function setView(v) {
            view = v;
            views.forEach(b => b.classList.toggle('active', b.dataset.view === v));
            try { localStorage.setItem('kc-course-view', v); } catch (e) {}
            apply();
        }
        views.forEach(btn => btn.addEventListener('click', () => setView(btn.dataset.view)));

        let saved = null;
        try { saved = localStorage.getItem('kc-course-view'); } catch (e) {}
        setView(saved === 'grid' ? 'grid' : 'table');
    })();
</script>
@endpush