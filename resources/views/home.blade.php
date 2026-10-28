@extends('layouts.app')

@section('title', 'KursusKu - Bangun Skill Web Bersama KursusKu')

@section('content')

{{-- ===== Hero ===== --}}
<section class="kk-hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <span class="kk-eyebrow">Belajar Web Lebih Terarah</span>

                <h1>Bangun Skill Web Bersama <span class="kk-hl">KursusKu</span></h1>

                <p class="kk-hero-text">
                    Pelajari langkah demi langkah dari konsep dasar HTML, CSS,
                    logika pemrograman PHP, hingga arsitektur modern
                    menggunakan Laravel framework.
                </p>

                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('enrollments.create') }}" class="btn btn-kk-accent">Daftar Kursus</a>
                    <a href="#kursus" class="btn btn-kk-outline">Lihat Kursus</a>
                </div>

                <div class="kk-points">
                    <div class="kk-point">
                        <strong>{{ count($featured ?? []) }}</strong>
                        <span>Kursus Pilihan</span>
                    </div>
                    <div class="kk-point">
                        <strong>Bertahap</strong>
                        <span>Dari dasar sampai Laravel</span>
                    </div>
                    <div class="kk-point">
                        <strong>Tanpa Reload</strong>
                        <span>Cek kursi lewat Ajax</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="kk-hero-visual">
                    <img src="{{ asset('images/hero-kursus.jpg') }}"
                         alt="Ilustrasi kelas KursusKu"
                         class="kk-hero-img">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== Kursus Pilihan (data dari HomeController) ===== --}}
<section class="py-5" id="kursus">
    <div class="container">
        <h2 class="kk-section-title">Kursus Pilihan</h2>
        <p class="kk-section-sub">
            Materi terstruktur yang dirancang bertahap untuk mahasiswa dan pemula.
        </p>

        <div class="row g-4">
            @foreach (($featured ?? []) as $course)
                <div class="col-md-6 col-lg-4">
                    <article class="kk-course-card">
                        <span class="kk-course-code">{{ $course['code'] }}</span>
                        <h3>{{ $course['name'] }}</h3>
                        <p>{{ $course['description'] }}</p>
                    </article>
                </div>
            @endforeach
        </div>
    
    </div>
</section>

@endsection