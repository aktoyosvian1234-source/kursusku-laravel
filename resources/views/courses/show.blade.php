@extends('layouts.app')

@section('title', 'Detail ' . $course->code . ' | KursusKu')

@push('styles')
    @include('courses._theme')
<style>
    .kc-hero-code { display: flex; flex-wrap: wrap; align-items: center; gap: .6rem; margin-bottom: 1rem; }

    .kc-detail { padding: 1.75rem; }
    .kc-row { display: flex; gap: 1rem; padding: .85rem 0; border-bottom: 1px dashed var(--kc-border); font-size: .93rem; }
    .kc-row:first-of-type { padding-top: 0; }
    .kc-row:last-child { border-bottom: 0; padding-bottom: 0; }
    .kc-row dt { flex: 0 0 150px; color: var(--kc-muted); font-weight: 600; }
    .kc-row dd { margin: 0; font-weight: 600; word-break: break-word; }

    .kc-danger { padding: 1.5rem; border-color: #f5c2c2; background: #fffafa; border-top: 3px solid #dc2626; }
    .kc-danger h3 { font-size: 1rem; font-weight: 800; color: #991b1b; }
    .kc-danger p { font-size: .85rem; color: #7f4a4a; }
    .kc-side-sticky { position: sticky; top: 90px; }
</style>
@endpush

@section('content')
<div class="kc-page">

    {{-- ===== HERO (dua kolom seperti beranda) ===== --}}
    <section class="kc-hero">
        <div class="container">
            <div class="kc-crumb">
                <a href="{{ route('courses.index') }}">Kursus</a> &nbsp;/&nbsp; Detail
            </div>

            <div class="row align-items-center g-5">

                <div class="col-lg-7">
                    <div class="kc-hero-code">
                        <span class="kc-code">{{ $course->code }}</span>
                        <span class="kc-status {{ $course->status }}">{{ ucfirst($course->status) }}</span>
                    </div>
                    <h1 class="kc-title mb-3">{{ $course->name }}</h1>
                    <p class="kc-lead mb-4">
                        {{ $course->description ?: 'Belum ada deskripsi untuk kursus ini.' }}
                    </p>

                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('courses.edit', $course) }}" class="kc-btn kc-btn-yellow">Edit Kursus <span aria-hidden="true">&rarr;</span></a>
                        <a href="{{ route('courses.index') }}" class="kc-btn kc-btn-outline">Kembali</a>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="kc-panel">
                        <div class="kc-panel-label">Ringkasan Kursus</div>
                        <div class="kc-facts">
                            <div><small>Biaya</small><strong class="yellow">Rp {{ number_format($course->fee, 0, ',', '.') }}</strong></div>
                            <div><small>Kuota</small><strong>{{ $course->quota }} peserta</strong></div>
                            <div><small>Tanggal mulai</small><strong>{{ $course->start_date?->format('d/m/Y') }}</strong></div>
                            <div><small>Status</small><strong>{{ ucfirst($course->status) }}</strong></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ===== ISI ===== --}}
    <section class="kc-body">
        <div class="container">

            <div class="row g-4">

                {{-- Rincian data --}}
                <div class="col-lg-8">
                    <h2 class="kc-section-title mb-4">Rincian Kursus</h2>
                    <div class="kc-card kc-card-top kc-detail">
                        <dl class="mb-0">
                            <div class="kc-row"><dt>Kode</dt><dd>{{ $course->code }}</dd></div>
                            <div class="kc-row"><dt>Nama</dt><dd>{{ $course->name }}</dd></div>
                            <div class="kc-row"><dt>Deskripsi</dt><dd>{{ $course->description ?: '-' }}</dd></div>
                            <div class="kc-row"><dt>Biaya</dt><dd>Rp {{ number_format($course->fee, 0, ',', '.') }}</dd></div>
                            <div class="kc-row"><dt>Kuota</dt><dd>{{ $course->quota }} peserta</dd></div>
                            <div class="kc-row"><dt>Tanggal Mulai</dt><dd>{{ $course->start_date?->format('d/m/Y') }}</dd></div>
                            <div class="kc-row"><dt>Status</dt><dd>{{ ucfirst($course->status) }}</dd></div>
                            <div class="kc-row"><dt>Dibuat</dt><dd>{{ $course->created_at?->format('d/m/Y H:i') }}</dd></div>
                            <div class="kc-row"><dt>Diperbarui</dt><dd>{{ $course->updated_at?->format('d/m/Y H:i') }}</dd></div>
                        </dl>
                    </div>
                </div>

                {{-- Zona hapus --}}
                <div class="col-lg-4">
                    <div class="kc-side-sticky" style="padding-top: 3.3rem;">
                        <div class="kc-card kc-danger">
                            <h3>Hapus kursus ini</h3>
                            <p>Data yang dihapus tidak dapat dikembalikan. Untuk pengujian, gunakan kursus dummy seperti <strong>DEL-001</strong>.</p>

                            <form method="POST" action="{{ route('courses.destroy', $course) }}"
                                  onsubmit="return confirm('Hapus kursus ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="kc-btn kc-btn-danger w-100">Hapus Kursus</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection