@extends('layouts.app')

@section('title', 'Tambah Kursus | KursusKu')

@push('styles')
<style>
    .kc-page {
        --kc-dark: #0b2e2b;
        --kc-dark-2: #0f4a44;
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
        padding: 2.5rem 0 2rem;
        background: linear-gradient(120deg, #e3f5f1 0%, #ffffff 55%, #fff4d6 100%);
        border-bottom: 1px solid var(--kc-border);
    }
    .kc-crumb { font-size: .82rem; color: var(--kc-muted); margin-bottom: 1rem; }
    .kc-crumb a { color: var(--kc-teal); font-weight: 600; text-decoration: none; }
    .kc-crumb a:hover { text-decoration: underline; }
    .kc-eyebrow { display: flex; align-items: center; gap: .6rem; font-size: .75rem; font-weight: 800; letter-spacing: 1.5px; text-transform: uppercase; color: var(--kc-teal); }
    .kc-eyebrow::before { content: ""; width: 26px; height: 3px; border-radius: 3px; background: var(--kc-yellow); }
    .kc-title { font-weight: 800; letter-spacing: -1px; font-size: clamp(1.9rem, 4vw, 2.6rem); color: var(--kc-dark); line-height: 1.1; }
    .kc-title mark { background: linear-gradient(transparent 62%, #fde68a 62%); color: inherit; padding: 0 .15em; }
    .kc-lead { color: var(--kc-muted); line-height: 1.75; max-width: 640px; }

    .kc-btn {
        display: inline-flex; align-items: center; justify-content: center; gap: .55rem; text-decoration: none; cursor: pointer;
        font-weight: 700; font-size: .92rem; border-radius: 10px; padding: .8rem 1.5rem; border: 1.5px solid transparent;
        transition: transform .15s ease, box-shadow .15s ease, background .15s ease;
    }
    .kc-btn-yellow { background: var(--kc-yellow); color: var(--kc-dark); box-shadow: 0 10px 22px rgba(251,191,36,.38); }
    .kc-btn-yellow:hover { background: var(--kc-yellow-dark); color: var(--kc-dark); transform: translateY(-1px); }
    .kc-btn-yellow:disabled { opacity: .75; transform: none; }
    .kc-btn-outline { background: #fff; color: var(--kc-teal); border-color: var(--kc-teal); }
    .kc-btn-outline:hover { background: var(--kc-teal-soft); color: var(--kc-teal); }

    /* ---------- Body ---------- */
    .kc-body { background: var(--kc-bg); padding: 2rem 0 3.5rem; }
    .kc-card {
        background: #fff; border: 1px solid var(--kc-border); border-radius: 14px;
        box-shadow: 0 1px 2px rgba(11,46,43,.04), 0 12px 32px rgba(11,46,43,.05);
    }
    .kc-card-top { border-top: 3px solid var(--kc-teal); }
    .kc-section { padding: 1.75rem; }
    .kc-section + .kc-section { margin-top: 1.25rem; }
    .kc-head { display: flex; gap: .9rem; align-items: flex-start; margin-bottom: 1.5rem; }
    .kc-num {
        flex: 0 0 auto; width: 38px; height: 38px; border-radius: 10px; display: grid; place-items: center;
        background: var(--kc-dark); color: var(--kc-yellow); font-weight: 800;
    }
    .kc-head h2 { font-size: 1.05rem; font-weight: 800; margin: 0; color: var(--kc-dark); }
    .kc-head p { margin: .15rem 0 0; font-size: .85rem; color: var(--kc-muted); }

    /* ---------- Field ---------- */
    .kc-page .form-label { font-weight: 700; font-size: .86rem; margin-bottom: .4rem; color: var(--kc-dark); }
    .kc-page .form-label .req { color: #dc2626; margin-left: 2px; }
    .kc-page .form-control,
    .kc-page .input-group-text {
        border-radius: 10px; border: 1.5px solid var(--kc-border); padding: .7rem .9rem; font-size: .93rem;
    }
    .kc-page .input-group-text { background: var(--kc-teal-soft); color: var(--kc-teal); font-weight: 800; }
    .kc-page .input-group > .form-control { border-top-left-radius: 0; border-bottom-left-radius: 0; }
    .kc-page .input-group > .input-group-text { border-top-right-radius: 0; border-bottom-right-radius: 0; }
    .kc-page .form-control:focus { border-color: var(--kc-teal); box-shadow: 0 0 0 .22rem rgba(15,118,110,.15); }
    .kc-page .form-control.is-invalid { border-color: #dc2626; background-image: none; }
    .kc-page .form-control.is-invalid:focus { box-shadow: 0 0 0 .22rem rgba(220,38,38,.15); }
    .kc-page .invalid-feedback { font-weight: 600; font-size: .8rem; }
    .kc-hint { font-size: .78rem; color: var(--kc-muted); margin-top: .35rem; }
    #code { text-transform: uppercase; letter-spacing: .6px; font-weight: 700; }

    /* ---------- Stepper & chip tanggal ---------- */
    .kc-stepper { display: flex; }
    .kc-stepper button {
        flex: 0 0 auto; width: 46px; border: 1.5px solid var(--kc-border); background: var(--kc-teal-soft); color: var(--kc-teal);
        font-weight: 800; font-size: 1.1rem; cursor: pointer;
    }
    .kc-stepper button:hover { background: #d3ece7; }
    .kc-stepper button:first-child { border-radius: 10px 0 0 10px; border-right: 0; }
    .kc-stepper button:last-child  { border-radius: 0 10px 10px 0; border-left: 0; }
    .kc-stepper .form-control { border-radius: 0 !important; text-align: center; font-weight: 700; }
    .kc-chip {
        border: 1.5px dashed #e3c35a; background: #fffbea; color: #8a6100; font-size: .76rem; font-weight: 700;
        border-radius: 999px; padding: .28rem .8rem; cursor: pointer;
    }
    .kc-chip:hover { background: #fff1bd; }

    /* ---------- Pilihan status ---------- */
    .kc-status-opt {
        position: relative; display: block; height: 100%; cursor: pointer; padding: 1rem 1rem 1rem 1.1rem;
        border: 1.5px solid var(--kc-border); border-radius: 12px; background: #fff; transition: all .15s ease;
    }
    .kc-status-opt:hover { border-color: #9cc3bb; }
    .kc-status-opt .t { display: flex; align-items: center; gap: .5rem; font-weight: 800; color: var(--kc-dark); }
    .kc-status-opt .d { font-size: .78rem; color: var(--kc-muted); margin-top: .25rem; }
    .kc-dot { width: 10px; height: 10px; border-radius: 50%; }
    .kc-dot.draft { background: #f59e0b; } .kc-dot.open { background: #10b981; } .kc-dot.closed { background: #ef4444; }
    .btn-check:checked + .kc-status-opt { border-color: var(--kc-teal); background: var(--kc-teal-soft); box-shadow: 0 0 0 3px rgba(15,118,110,.12); }
    .btn-check:checked + .kc-status-opt::after {
        content: "\2713"; position: absolute; top: 10px; right: 10px; width: 22px; height: 22px; border-radius: 50%;
        display: grid; place-items: center; background: var(--kc-teal); color: #fff; font-size: .75rem; font-weight: 800;
    }
    .btn-check:focus-visible + .kc-status-opt { outline: 2px solid var(--kc-teal); outline-offset: 2px; }

    .kc-actions { display: flex; flex-wrap: wrap; gap: .75rem; align-items: center; justify-content: space-between; padding: 1rem 1.25rem; margin-top: 1.25rem; }

    /* ---------- Pratinjau ---------- */
    .kc-sticky { position: sticky; top: 90px; }
    .kc-preview { overflow: hidden; }
    .kc-pv-top {
        position: relative; padding: 1.4rem; color: #fff;
        background: radial-gradient(circle at 92% 0%, rgba(251,191,36,.28), transparent 45%),
                    linear-gradient(135deg, var(--kc-dark), var(--kc-dark-2));
    }
    .kc-pv-code { display: inline-block; background: var(--kc-yellow); color: var(--kc-dark); font-size: .7rem; font-weight: 800; letter-spacing: 1px; padding: .35rem .65rem; border-radius: 6px; }
    .kc-pv-status { position: absolute; top: 1.3rem; right: 1.3rem; font-size: .72rem; font-weight: 800; padding: .28rem .7rem; border-radius: 999px; background: #fff; }
    .kc-pv-status.draft { color: #92400e; } .kc-pv-status.open { color: #047857; } .kc-pv-status.closed { color: #b91c1c; }
    .kc-pv-name { font-size: 1.25rem; font-weight: 800; letter-spacing: -.3px; margin: .9rem 0 0; word-break: break-word; }
    .kc-pv-body { padding: 1.25rem 1.4rem 1.4rem; }
    .kc-pv-desc { font-size: .85rem; color: var(--kc-muted); min-height: 2.6em; word-break: break-word; }
    .kc-pv-meta { display: grid; grid-template-columns: 1fr 1fr; gap: .7rem; margin-top: 1rem; }
    .kc-pv-meta div { background: var(--kc-bg); border-radius: 10px; padding: .65rem .8rem; }
    .kc-pv-meta small { display: block; font-size: .67rem; font-weight: 700; letter-spacing: .6px; text-transform: uppercase; color: var(--kc-muted); }
    .kc-pv-meta strong { font-size: .9rem; }
    .kc-pv-meta .wide { grid-column: span 2; }

    .kc-track { height: 8px; background: #e6eeeb; border-radius: 999px; overflow: hidden; }
    .kc-bar { height: 100%; width: 0; background: linear-gradient(90deg, var(--kc-yellow), var(--kc-yellow-dark)); border-radius: 999px; transition: width .25s ease; }
    .kc-check { display: flex; align-items: center; gap: .55rem; font-size: .85rem; color: var(--kc-muted); padding: .22rem 0; }
    .kc-check i { width: 18px; height: 18px; border-radius: 50%; border: 1.5px solid #c5d3cf; display: grid; place-items: center; font-style: normal; font-size: .65rem; font-weight: 800; color: transparent; }
    .kc-check.done { color: var(--kc-ink); font-weight: 600; }
    .kc-check.done i { background: var(--kc-teal); border-color: var(--kc-teal); color: #fff; }
</style>
@endpush

@section('content')
<div class="kc-page">

    {{-- ===== HERO ===== --}}
    <section class="kc-hero">
        <div class="container">
            <div class="kc-crumb">
                <a href="{{ route('courses.index') }}">Kursus</a> &nbsp;/&nbsp; Tambah Kursus
            </div>
            <div class="kc-eyebrow">Form Kursus Baru</div>
            <h1 class="kc-title mt-3 mb-3">Tambah <mark>Kursus</mark></h1>
            <p class="kc-lead mb-0">
                Isi data kursus pada tiga bagian berikut. Kartu pratinjau di sisi kanan
                akan ikut berubah saat Anda mengetik.
            </p>
        </div>
    </section>

    {{-- ===== FORM ===== --}}
    <section class="kc-body">
        <div class="container">

            {{-- Ringkasan error validasi --}}
            @if ($errors->any())
                <div class="alert border-0 mb-4" style="border-radius:12px; background:#fef2f2; color:#991b1b; border-left:4px solid #dc2626 !important;">
                    <div class="fw-bold mb-1">Terdapat {{ $errors->count() }} kesalahan, data belum dapat disimpan</div>
                    <ul class="mb-0 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('courses.store') }}" id="courseForm" novalidate>
                @csrf

                <div class="row g-4">

                    {{-- ========== KOLOM FORM ========== --}}
                    <div class="col-lg-8">

                        {{-- 1. Informasi dasar --}}
                        <section class="kc-card kc-card-top kc-section">
                            <div class="kc-head">
                                <div class="kc-num">1</div>
                                <div>
                                    <h2>Informasi Dasar</h2>
                                    <p>Identitas kursus yang akan tampil di daftar.</p>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="code">Kode Kursus<span class="req">*</span></label>
                                    <input class="form-control @error('code') is-invalid @enderror" id="code" name="code"
                                           value="{{ old('code') }}" required maxlength="20" placeholder="WEB-101" autocomplete="off">
                                    @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="kc-hint">Unik, maksimal 20 karakter.</div>
                                    @enderror
                                </div>

                                <div class="col-md-8">
                                    <label class="form-label" for="name">Nama Kursus<span class="req">*</span></label>
                                    <input class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                           value="{{ old('name') }}" required maxlength="120" placeholder="Contoh: Web Dasar" autocomplete="off">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="kc-hint">Maksimal 120 karakter.</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-end">
                                        <label class="form-label" for="description">Deskripsi</label>
                                        <span class="kc-hint mb-2"><span id="descCount">0</span> karakter &middot; opsional</span>
                                    </div>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                              name="description" rows="4"
                                              placeholder="Jelaskan secara singkat materi yang dipelajari peserta...">{{ old('description') }}</textarea>
                                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </section>

                        {{-- 2. Biaya & kapasitas --}}
                        <section class="kc-card kc-card-top kc-section">
                            <div class="kc-head">
                                <div class="kc-num">2</div>
                                <div>
                                    <h2>Biaya &amp; Kapasitas</h2>
                                    <p>Tentukan biaya pendaftaran dan jumlah peserta maksimal.</p>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="fee">Biaya Kursus<span class="req">*</span></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text">Rp</span>
                                        <input class="form-control @error('fee') is-invalid @enderror" id="fee" type="number"
                                               name="fee" value="{{ old('fee', 0) }}" min="0" step="1" required>
                                        @error('fee') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="kc-hint">Terbaca: <strong id="feeText">Rp 0</strong> &middot; isi 0 jika gratis.</div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="quota">Kuota Peserta<span class="req">*</span></label>
                                    <div class="kc-stepper">
                                        <button type="button" data-step="-5" aria-label="Kurangi 5">&minus;</button>
                                        <input class="form-control @error('quota') is-invalid @enderror" id="quota" type="number"
                                               name="quota" value="{{ old('quota', 20) }}" min="1" max="500" required>
                                        <button type="button" data-step="5" aria-label="Tambah 5">+</button>
                                    </div>
                                    @error('quota')
                                        <div class="text-danger small fw-semibold mt-1">{{ $message }}</div>
                                    @else
                                        <div class="kc-hint">Antara 1 sampai 500 peserta.</div>
                                    @enderror
                                </div>
                            </div>
                        </section>

                        {{-- 3. Jadwal & publikasi --}}
                        <section class="kc-card kc-card-top kc-section">
                            <div class="kc-head">
                                <div class="kc-num">3</div>
                                <div>
                                    <h2>Jadwal &amp; Publikasi</h2>
                                    <p>Atur tanggal mulai dan status pendaftaran kursus.</p>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="start_date">Tanggal Mulai<span class="req">*</span></label>
                                    <input class="form-control @error('start_date') is-invalid @enderror" id="start_date"
                                           type="date" name="start_date" value="{{ old('start_date') }}" required>
                                    @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    <div class="d-flex flex-wrap align-items-center gap-2 mt-2">
                                        <span class="kc-hint m-0">Pilih cepat:</span>
                                        <button type="button" class="kc-chip" data-days="7">+7 hari</button>
                                        <button type="button" class="kc-chip" data-days="14">+14 hari</button>
                                        <button type="button" class="kc-chip" data-days="30">+30 hari</button>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="form-label d-block">Status Pendaftaran<span class="req">*</span></label>
                                @php
                                    $statusOld = old('status', 'draft');
                                    $statusOptions = [
                                        'draft'  => ['Draft',  'Belum dibuka untuk peserta.'],
                                        'open'   => ['Open',   'Pendaftaran sedang dibuka.'],
                                        'closed' => ['Closed', 'Pendaftaran sudah ditutup.'],
                                    ];
                                @endphp
                                <div class="row g-3">
                                    @foreach ($statusOptions as $value => [$label, $desc])
                                        <div class="col-md-4">
                                            <input type="radio" class="btn-check" name="status" id="status_{{ $value }}"
                                                   value="{{ $value }}" @checked($statusOld === $value) required>
                                            <label class="kc-status-opt" for="status_{{ $value }}">
                                                <div class="t"><span class="kc-dot {{ $value }}"></span>{{ $label }}</div>
                                                <div class="d">{{ $desc }}</div>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('status') <div class="text-danger small fw-semibold mt-2">{{ $message }}</div> @enderror
                            </div>
                        </section>

                        {{-- Aksi --}}
                        <div class="kc-card kc-actions">
                            <div class="small text-muted"><span class="text-danger fw-bold">*</span> wajib diisi</div>
                            <div class="d-flex gap-2">
                                <a class="kc-btn kc-btn-outline" href="{{ route('courses.index') }}">Batal</a>
                                <button class="kc-btn kc-btn-yellow" type="submit" id="submitBtn">Simpan Kursus</button>
                            </div>
                        </div>
                    </div>

                    {{-- ========== KOLOM PRATINJAU ========== --}}
                    <div class="col-lg-4">
                        <div class="kc-sticky">

                            <div class="kc-card kc-preview mb-3">
                                <div class="kc-pv-top">
                                    <span class="kc-pv-code" id="pvCode">KODE</span>
                                    <span class="kc-pv-status draft" id="pvStatus">Draft</span>
                                    <h3 class="kc-pv-name" id="pvName">Nama kursus</h3>
                                </div>
                                <div class="kc-pv-body">
                                    <div class="kc-pv-desc" id="pvDesc">Deskripsi kursus akan tampil di sini.</div>
                                    <div class="kc-pv-meta">
                                        <div><small>Biaya</small><strong id="pvFee">Rp 0</strong></div>
                                        <div><small>Kuota</small><strong id="pvQuota">20 peserta</strong></div>
                                        <div class="wide"><small>Tanggal mulai</small><strong id="pvDate">Belum dipilih</strong></div>
                                    </div>
                                </div>
                            </div>

                            <div class="kc-card kc-card-top p-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="fw-bold">Kelengkapan data</span>
                                    <span class="small fw-bold" style="color:var(--kc-teal)" id="progText">0%</span>
                                </div>
                                <div class="kc-track mb-3"><div class="kc-bar" id="progBar"></div></div>
                                <div class="kc-check" data-check="code"><i>&#10003;</i>Kode kursus</div>
                                <div class="kc-check" data-check="name"><i>&#10003;</i>Nama kursus</div>
                                <div class="kc-check" data-check="desc"><i>&#10003;</i>Deskripsi</div>
                                <div class="kc-check" data-check="date"><i>&#10003;</i>Tanggal mulai</div>
                            </div>

                        </div>
                    </div>

                </div>
            </form>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    (function () {
        const $ = id => document.getElementById(id);
        const rupiah = n => 'Rp ' + (parseInt(n, 10) || 0).toLocaleString('id-ID');
        const statusLabel = { draft: 'Draft', open: 'Open', closed: 'Closed' };

        function currentStatus() {
            const c = document.querySelector('input[name="status"]:checked');
            return c ? c.value : 'draft';
        }

        function setCheck(key, done) {
            document.querySelector('[data-check="' + key + '"]').classList.toggle('done', done);
        }

        function update() {
            const code = $('code').value.trim().toUpperCase();
            const name = $('name').value.trim();
            const desc = $('description').value.trim();
            const date = $('start_date').value; // yyyy-mm-dd
            const status = currentStatus();

            $('pvCode').textContent   = code || 'KODE';
            $('pvName').textContent   = name || 'Nama kursus';
            $('pvDesc').textContent   = desc ? (desc.length > 110 ? desc.slice(0, 110) + '...' : desc)
                                             : 'Deskripsi kursus akan tampil di sini.';
            $('pvFee').textContent    = rupiah($('fee').value);
            $('pvQuota').textContent  = ($('quota').value || 0) + ' peserta';
            $('pvDate').textContent   = date ? date.split('-').reverse().join('/') : 'Belum dipilih';
            $('pvStatus').textContent = statusLabel[status];
            $('pvStatus').className   = 'kc-pv-status ' + status;

            $('feeText').textContent   = rupiah($('fee').value);
            $('descCount').textContent = $('description').value.length;

            const done = { code: !!code, name: !!name, desc: !!desc, date: !!date };
            Object.keys(done).forEach(k => setCheck(k, done[k]));
            const pct = Object.values(done).filter(Boolean).length * 25;
            $('progBar').style.width = pct + '%';
            $('progText').textContent = pct + '%';
        }

        // Kode otomatis huruf besar
        $('code').addEventListener('input', function () {
            const pos = this.selectionStart;
            this.value = this.value.toUpperCase();
            this.setSelectionRange(pos, pos);
        });

        // Tombol +/- kuota
        document.querySelectorAll('.kc-stepper [data-step]').forEach(btn => {
            btn.addEventListener('click', () => {
                const next = (parseInt($('quota').value, 10) || 0) + parseInt(btn.dataset.step, 10);
                $('quota').value = Math.min(500, Math.max(1, next));
                update();
            });
        });

        // Pilih cepat tanggal mulai
        document.querySelectorAll('[data-days]').forEach(btn => {
            btn.addEventListener('click', () => {
                const d = new Date();
                d.setDate(d.getDate() + parseInt(btn.dataset.days, 10));
                const m = String(d.getMonth() + 1).padStart(2, '0');
                const day = String(d.getDate()).padStart(2, '0');
                $('start_date').value = d.getFullYear() + '-' + m + '-' + day;
                update();
            });
        });

        // Tombol simpan menampilkan status memproses
        $('courseForm').addEventListener('submit', function () {
            const btn = $('submitBtn');
            btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Menyimpan...';
            setTimeout(() => btn.setAttribute('disabled', 'disabled'), 0);
        });

        ['code', 'name', 'description', 'fee', 'quota', 'start_date'].forEach(id => {
            $(id).addEventListener('input', update);
            $(id).addEventListener('change', update);
        });
        document.querySelectorAll('input[name="status"]').forEach(r => r.addEventListener('change', update));

        update();
    })();
</script>
@endpush