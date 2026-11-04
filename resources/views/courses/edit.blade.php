@extends('layouts.app')

@section('title', 'Edit ' . $course->code . ' | KursusKu')

@push('styles')
    @include('courses._theme')
    @include('courses._form')
<style>
    /* Panel samping: data tersimpan saat ini */
    .kc-saved-name { font-size: 1.15rem; font-weight: 800; letter-spacing: -.3px; margin: .8rem 0 1.1rem; word-break: break-word; }
    .kc-tip { font-size: .85rem; color: var(--kc-muted); margin: 0; padding-left: 1.1rem; }
    .kc-tip li { margin-bottom: .4rem; }
</style>
@endpush

@section('content')
<div class="kc-page">

    {{-- ===== HERO ===== --}}
    <section class="kc-hero kc-hero-sm">
        <div class="container">
            <div class="kc-crumb">
                <a href="{{ route('courses.index') }}">Kursus</a> &nbsp;/&nbsp;
                <a href="{{ route('courses.show', $course) }}">{{ $course->code }}</a> &nbsp;/&nbsp; Edit
            </div>
            <div class="kc-eyebrow">Ubah Data Kursus</div>
            <h1 class="kc-title mt-3 mb-3">Edit <mark>Kursus</mark></h1>
            <p class="kc-lead mb-0">
                Anda sedang mengubah <strong>{{ $course->code }}</strong>.
                Semua field sudah terisi nilai dari database; ubah yang perlu saja, lalu simpan.
            </p>
        </div>
    </section>

    {{-- ===== FORM ===== --}}
    <section class="kc-body">
        <div class="container">

            {{-- Ringkasan error validasi --}}
            @if ($errors->any())
                <div class="alert border-0 mb-4 kc-alert-err">
                    <div class="fw-bold mb-1">Terdapat {{ $errors->count() }} kesalahan, perubahan belum dapat disimpan</div>
                    <ul class="mb-0 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('courses.update', $course) }}" id="courseForm" novalidate>
                @csrf
                @method('PUT')

                <div class="row g-4">

                    {{-- ========== KOLOM FORM ========== --}}
                    <div class="col-lg-8">

                        {{-- 1. Informasi dasar --}}
                        <section class="kc-card kc-card-top kc-section">
                            <div class="kc-head">
                                <div class="kc-num">1</div>
                                <div>
                                    <h2>Informasi Dasar</h2>
                                    <p>Identitas kursus yang tampil di daftar.</p>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="code">Kode Kursus<span class="req">*</span></label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code"
                                           value="{{ old('code', $course->code) }}" required maxlength="20" autocomplete="off">
                                    @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="kc-hint">Boleh tetap sama, asal tidak dipakai kursus lain.</div>
                                    @enderror
                                </div>

                                <div class="col-md-8">
                                    <label class="form-label" for="name">Nama Kursus<span class="req">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                           value="{{ old('name', $course->name) }}" required maxlength="120" autocomplete="off">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="kc-hint">Minimal 3, maksimal 120 karakter.</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-end">
                                        <label class="form-label" for="description">Deskripsi</label>
                                        <span class="kc-hint mb-2"><span id="descCount">0</span>/2000 &middot; opsional</span>
                                    </div>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                              name="description" rows="4">{{ old('description', $course->description) }}</textarea>
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
                                    <p>Biaya pendaftaran dan jumlah peserta maksimal.</p>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="fee">Biaya Kursus<span class="req">*</span></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control @error('fee') is-invalid @enderror" id="fee" name="fee"
                                               value="{{ old('fee', $course->fee) }}" min="0" step="1" required>
                                        @error('fee') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="kc-hint">Terbaca: <strong id="feeText">Rp 0</strong></div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="quota">Kuota Peserta<span class="req">*</span></label>
                                    <div class="kc-stepper">
                                        <button type="button" data-step="-5" aria-label="Kurangi 5">&minus;</button>
                                        <input type="number" class="form-control @error('quota') is-invalid @enderror" id="quota" name="quota"
                                               value="{{ old('quota', $course->quota) }}" min="1" max="500" required>
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
                                    <p>Tanggal mulai dan status pendaftaran.</p>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="start_date">Tanggal Mulai<span class="req">*</span></label>
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date"
                                           value="{{ old('start_date', $course->start_date?->format('Y-m-d')) }}" required>
                                    @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="form-label d-block">Status Pendaftaran<span class="req">*</span></label>
                                @php
                                    $statusNow = old('status', $course->status);
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
                                                   value="{{ $value }}" @checked($statusNow === $value) required>
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
                                <a class="kc-btn kc-btn-outline" href="{{ route('courses.show', $course) }}">Batal</a>
                                <button class="kc-btn kc-btn-yellow" type="submit" id="submitBtn">Simpan Perubahan</button>
                            </div>
                        </div>
                    </div>

                    {{-- ========== KOLOM SAMPING ========== --}}
                    <div class="col-lg-4">
                        <div class="kc-sticky">

                            {{-- Data tersimpan saat ini (dari database, tidak berubah saat Anda mengetik) --}}
                            <div class="kc-panel mb-4">
                                <div class="kc-panel-label">Data tersimpan saat ini</div>
                                <span class="kc-code" style="background: var(--kc-yellow); color: var(--kc-dark);">{{ $course->code }}</span>
                                <div class="kc-saved-name">{{ $course->name }}</div>
                                <div class="kc-facts">
                                    <div><small>Biaya</small><strong class="yellow" style="font-size:1rem;">Rp {{ number_format($course->fee, 0, ',', '.') }}</strong></div>
                                    <div><small>Kuota</small><strong style="font-size:1rem;">{{ $course->quota }} peserta</strong></div>
                                    <div><small>Mulai</small><strong style="font-size:1rem;">{{ $course->start_date?->format('d/m/Y') }}</strong></div>
                                    <div><small>Status</small><strong style="font-size:1rem;">{{ ucfirst($course->status) }}</strong></div>
                                </div>
                            </div>

                            <div class="kc-card kc-card-top p-4">
                                <div class="fw-bold mb-2">Catatan saat mengedit</div>
                                <ul class="kc-tip">
                                    <li>Kode lama tetap boleh dipakai; Laravel mengabaikan kursus yang sedang diedit saat cek unik.</li>
                                    <li>Jika validasi gagal, isian terakhir Anda dipertahankan, bukan kembali ke nilai database.</li>
                                    <li>Perubahan baru tersimpan setelah klik <strong>Simpan Perubahan</strong>.</li>
                                </ul>
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

        function update() {
            $('feeText').textContent   = rupiah($('fee').value);
            $('descCount').textContent = $('description').value.length;
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

        // Tombol simpan menampilkan status memproses
        $('courseForm').addEventListener('submit', function () {
            const btn = $('submitBtn');
            btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Menyimpan...';
            setTimeout(() => btn.setAttribute('disabled', 'disabled'), 0);
        });

        ['fee', 'description'].forEach(id => $(id).addEventListener('input', update));
        update();
    })();
</script>
@endpush