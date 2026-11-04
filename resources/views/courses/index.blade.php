@extends('layouts.app')

@section('title', 'Daftar Kursus | KursusKu')

@push('styles')
    @include('courses._theme')
<style>
    /* Toolbar */
    .kc-toolbar { display: flex; flex-wrap: wrap; gap: 1rem; align-items: center; justify-content: space-between; margin: 1.6rem 0 1.4rem; }
    .kc-search { position: relative; flex: 1 1 280px; max-width: 380px; }
    .kc-search svg { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--kc-muted); }
    .kc-search input { width: 100%; padding: .7rem 1rem .7rem 2.5rem; border-radius: 9px; border: 1.5px solid var(--kc-border); background: #fff; font-size: .92rem; }
    .kc-search input:focus { outline: 0; border-color: var(--kc-teal); box-shadow: 0 0 0 .22rem rgba(15,118,110,.15); }
    .kc-group { display: flex; flex-wrap: wrap; gap: .5rem; align-items: center; }
    .kc-pill { border: 1.5px solid var(--kc-border); background: #fff; color: var(--kc-muted); font-weight: 700; font-size: .82rem; border-radius: 999px; padding: .42rem .95rem; cursor: pointer; }
    .kc-pill:hover { color: var(--kc-dark); border-color: #b9ccc7; }
    .kc-pill.active { background: var(--kc-dark); border-color: var(--kc-dark); color: #fff; }
    .kc-view { display: inline-flex; background: #fff; border: 1.5px solid var(--kc-border); border-radius: 9px; padding: 3px; }
    .kc-view button { border: 0; background: transparent; font-weight: 700; font-size: .82rem; color: var(--kc-muted); padding: .35rem .85rem; border-radius: 6px; cursor: pointer; }
    .kc-view button.active { background: var(--kc-teal-soft); color: var(--kc-teal); }

    /* Kartu kursus (seperti "Kursus Pilihan" di beranda) */
    .kc-course { padding: 1.5rem; height: 100%; transition: transform .18s ease, box-shadow .18s ease; }
    .kc-course:hover { transform: translateY(-3px); box-shadow: 0 18px 40px rgba(11,46,43,.10); }
    .kc-course h3 { font-size: 1.12rem; font-weight: 800; margin: 1.1rem 0 .35rem; letter-spacing: -.2px; }
    .kc-course h3 a { color: var(--kc-dark); text-decoration: none; }
    .kc-course h3 a:hover { color: var(--kc-teal); }
    .kc-course p { font-size: .87rem; color: var(--kc-muted); min-height: 2.7em; margin-bottom: 1rem; }
    .kc-meta { display: grid; grid-template-columns: 1fr 1fr; gap: .75rem; padding-top: 1rem; border-top: 1px dashed var(--kc-border); margin-bottom: 1.1rem; }
    .kc-meta small { display: block; font-size: .66rem; font-weight: 800; letter-spacing: .7px; text-transform: uppercase; color: var(--kc-muted); }
    .kc-meta strong { font-size: .92rem; }
    .kc-meta .wide { grid-column: span 2; }
    .kc-fee { font-weight: 800; color: var(--kc-teal); white-space: nowrap; }

    /* Tabel */
    .kc-table { margin: 0; }
    .kc-table thead th { background: #f7fbfa; color: var(--kc-muted); font-size: .7rem; font-weight: 800; letter-spacing: .8px; text-transform: uppercase; padding: .95rem 1rem; border-bottom: 1px solid var(--kc-border); white-space: nowrap; }
    .kc-table tbody td { padding: 1.05rem 1rem; border-color: #eef3f1; vertical-align: middle; }
    .kc-table tbody tr:hover { background: #fafdfc; }
    .kc-name { font-weight: 700; color: var(--kc-dark); text-decoration: none; }
    .kc-name:hover { color: var(--kc-teal); text-decoration: underline; }
    .kc-sub { font-size: .8rem; color: var(--kc-muted); }

    /* Tombol aksi kecil */
    .kc-acts { display: flex; flex-wrap: wrap; gap: .4rem; }
    .kc-act { font-size: .78rem; font-weight: 700; line-height: 1.2; padding: .42rem .85rem; border-radius: 8px; border: 1.5px solid; background: #fff; text-decoration: none; cursor: pointer; }
    .kc-act.detail { color: var(--kc-teal); border-color: #9cc3bb; }
    .kc-act.detail:hover { background: var(--kc-teal-soft); color: var(--kc-teal); }
    .kc-act.edit { color: #92400e; border-color: #f3d28a; }
    .kc-act.edit:hover { background: #fffbea; color: #92400e; }
    .kc-act.del { color: #b91c1c; border-color: #f5b5b5; }
    .kc-act.del:hover { background: #fef2f2; }

    /* Kosong & footer */
    .kc-empty { text-align: center; padding: 4rem 1.5rem; }
    .kc-empty-icon { width: 72px; height: 72px; border-radius: 50%; margin: 0 auto 1rem; display: grid; place-items: center; background: var(--kc-teal-soft); color: var(--kc-teal); font-size: 2rem; font-weight: 800; }
    .kc-foot { display: flex; justify-content: space-between; flex-wrap: wrap; gap: .5rem; padding: .9rem 0 0; font-size: .82rem; color: var(--kc-muted); }
</style>
@endpush

@section('content')
<div class="kc-page">

    {{-- ===== HERO (dua kolom seperti beranda) ===== --}}
    <section class="kc-hero">
        <div class="container">
            <div class="row align-items-center g-5">

                <div class="col-lg-7">
                    <div class="kc-eyebrow">Manajemen Kursus</div>
                    <h1 class="kc-title mt-3 mb-3">Kelola Kursus <mark>KursusKu</mark></h1>
                    <p class="kc-lead mb-4">
                        Lihat detail, ubah, atau hapus kursus langsung dari satu halaman.
                        Semua data tersimpan di MySQL dan dibaca melalui Eloquent.
                    </p>

                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('courses.create') }}" class="kc-btn kc-btn-yellow">Tambah Kursus <span aria-hidden="true">&rarr;</span></a>
                        <a href="#daftar" class="kc-btn kc-btn-outline">Lihat Daftar</a>
                    </div>

                    <div class="kc-stats">
                        <div class="kc-stat"><strong>{{ $stats['total'] }}</strong><span>Total kursus</span></div>
                        <div class="kc-stat"><strong>{{ $stats['open'] }}</strong><span>Pendaftaran open</span></div>
                        <div class="kc-stat"><strong>{{ $stats['draft'] }}</strong><span>Masih draft</span></div>
                        <div class="kc-stat"><strong>{{ $stats['closed'] }}</strong><span>Sudah ditutup</span></div>
                    </div>
                </div>

                <div class="col-lg-5 d-none d-lg-block">
                    <div class="kc-panel">
                        <div class="kc-panel-label">Kursus Terbaru</div>
                        @forelse ($courses->take(3) as $latest)
                            <a href="{{ route('courses.show', $latest) }}" class="kc-mini">
                                <span class="kc-code">{{ $latest->code }}</span>
                                <span>
                                    <span class="kc-mini-name d-block">{{ $latest->name }}</span>
                                    <span class="kc-mini-sub">{{ $latest->start_date->format('d/m/Y') }} &middot; {{ ucfirst($latest->status) }}</span>
                                </span>
                            </a>
                        @empty
                            <p class="mb-0" style="color: rgba(255,255,255,.7);">Belum ada kursus. Tambahkan yang pertama.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ===== DAFTAR ===== --}}
    <section class="kc-body" id="daftar">
        <div class="container">

            <h2 class="kc-section-title">Semua Kursus</h2>
            <p class="kc-section-sub">Materi terstruktur yang dirancang bertahap untuk mahasiswa dan pemula.</p>

            @if ($courses->isEmpty())

                <div class="kc-card kc-card-top kc-empty mt-4">
                    <div class="kc-empty-icon">+</div>
                    <h3 class="h5 fw-bold mb-1">Belum ada data kursus.</h3>
                    <p class="text-muted mb-4">Mulai dengan menambahkan kursus pertama Anda.</p>
                    <a href="{{ route('courses.create') }}" class="kc-btn kc-btn-yellow">Tambah Kursus <span aria-hidden="true">&rarr;</span></a>
                </div>

            @else

                {{-- Toolbar: pencarian & filter berjalan di browser, tidak mengubah query database --}}
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
                        <button type="button" data-view="grid">Kartu</button>
                        <button type="button" data-view="table">Tabel</button>
                    </div>
                </div>

                {{-- ===== TAMPILAN KARTU ===== --}}
                <div class="row g-4" id="kcGrid">
                    @foreach ($courses as $course)
                        <div class="col-md-6 col-xl-4 kc-item"
                             data-status="{{ $course->status }}"
                             data-search="{{ strtolower($course->code . ' ' . $course->name) }}">
                            <article class="kc-card kc-card-top kc-course">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="kc-code">{{ $course->code }}</span>
                                    <span class="kc-status {{ $course->status }}">{{ ucfirst($course->status) }}</span>
                                </div>
                                <h3><a href="{{ route('courses.show', $course) }}">{{ $course->name }}</a></h3>
                                <p>{{ $course->description ? \Illuminate\Support\Str::limit($course->description, 90) : 'Belum ada deskripsi.' }}</p>
                                <div class="kc-meta">
                                    <div><small>Biaya</small><strong class="kc-fee">Rp {{ number_format($course->fee, 0, ',', '.') }}</strong></div>
                                    <div><small>Kuota</small><strong>{{ $course->quota }} peserta</strong></div>
                                    <div class="wide"><small>Tanggal mulai</small><strong>{{ $course->start_date->format('d/m/Y') }}</strong></div>
                                </div>
                                <div class="kc-acts">
                                    <a href="{{ route('courses.show', $course) }}" class="kc-act detail">Detail</a>
                                    <a href="{{ route('courses.edit', $course) }}" class="kc-act edit">Edit</a>

                                    {{-- Delete: form POST + @csrf + @method('DELETE'), bukan link biasa --}}
                                    <form method="POST" action="{{ route('courses.destroy', $course) }}"
                                          onsubmit="return confirm('Hapus kursus ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="kc-act del">Hapus</button>
                                    </form>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>

                {{-- ===== TAMPILAN TABEL ===== --}}
                <div class="kc-card kc-card-top overflow-hidden d-none" id="kcTable">
                    <div class="table-responsive">
                        <table class="table kc-table">
                            <thead>
                                <tr>
                                    <th class="ps-4">Kode</th>
                                    <th>Nama Kursus</th>
                                    <th class="text-end">Biaya</th>
                                    <th class="text-center">Kuota</th>
                                    <th>Mulai</th>
                                    <th>Status</th>
                                    <th class="pe-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr class="kc-item"
                                        data-status="{{ $course->status }}"
                                        data-search="{{ strtolower($course->code . ' ' . $course->name) }}">
                                        <td class="ps-4"><span class="kc-code">{{ $course->code }}</span></td>
                                        <td>
                                            <a class="kc-name" href="{{ route('courses.show', $course) }}">{{ $course->name }}</a>
                                            @if ($course->description)
                                                <div class="kc-sub">{{ \Illuminate\Support\Str::limit($course->description, 60) }}</div>
                                            @endif
                                        </td>
                                        <td class="text-end kc-fee">Rp {{ number_format($course->fee, 0, ',', '.') }}</td>
                                        <td class="text-center fw-semibold">{{ $course->quota }}</td>
                                        <td class="text-nowrap">{{ $course->start_date->format('d/m/Y') }}</td>
                                        <td><span class="kc-status {{ $course->status }}">{{ ucfirst($course->status) }}</span></td>
                                        <td class="pe-4">
                                            <div class="kc-acts">
                                                <a href="{{ route('courses.show', $course) }}" class="kc-act detail">Detail</a>
                                                <a href="{{ route('courses.edit', $course) }}" class="kc-act edit">Edit</a>
                                                <form method="POST" action="{{ route('courses.destroy', $course) }}"
                                                      onsubmit="return confirm('Hapus kursus ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="kc-act del">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                
                {{-- Tampil jika pencarian tidak menemukan hasil --}}
                <div class="kc-card kc-card-top kc-empty d-none" id="kcNoResult">
                    <div class="kc-empty-icon">?</div>
                    <h3 class="h5 fw-bold mb-1">Tidak ada kursus yang cocok.</h3>
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
        const tableItems = document.querySelectorAll('#kcTable .kc-item');
        if (!tableItems.length) return;

        const allItems = document.querySelectorAll('.kc-item');
        const search   = document.getElementById('kcSearch');
        const filters  = document.querySelectorAll('#kcFilters .kc-pill');
        const views    = document.querySelectorAll('#kcViews button');
        const tableBox = document.getElementById('kcTable');
        const gridBox  = document.getElementById('kcGrid');
        const noResult = document.getElementById('kcNoResult');
        const shownEl  = document.getElementById('kcShown');
        let status = 'all';
        let view = 'grid';

        function apply() {
            const q = search.value.trim().toLowerCase();
            let shown = 0;

            allItems.forEach(el => {
                const ok = (status === 'all' || el.dataset.status === status) && el.dataset.search.includes(q);
                el.classList.toggle('d-none', !ok);
            });
            tableItems.forEach(el => { if (!el.classList.contains('d-none')) shown++; });

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
        setView(saved === 'table' ? 'table' : 'grid');
    })();
</script>
@endpush