<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $siteName }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="navbar">
    <div class="container">
        <a href="{{ route('home') }}" class="brand">
            <span class="brand-logo">{{ substr($siteName, 0, 1) }}</span>
            {{ $siteName }}
        </a>
        <nav>
            <a href="{{ route('home') }}" class="nav-link">Beranda</a>
            <a href="#kursus" class="nav-link">Kursus</a>
        </nav>
    </div>
</header>

<main>
    <section class="hero">
        <div class="container hero-inner">
            <div>
                <span class="hero-badge">Belajar Web Secara Bertahap</span>
                <h1>Bangun kemampuan web dari <span class="highlight">PHP sampai Laravel.</span></h1>
                <p class="hero-text">KursusKu menyediakan latihan terarah untuk pemula.</p>
                <a href="#kursus" class="btn btn-accent">Lihat Kursus</a>

                <div class="hero-stats">
                    <div class="stat">
                        <strong>{{ count($featured) }}</strong>
                        <span>Kursus Pilihan</span>
                    </div>
                    <div class="stat">
                        <strong>MVC</strong>
                        <span>Struktur Terarah</span>
                    </div>
                    <div class="stat">
                        <strong>Pemula</strong>
                        <span>Ramah untuk Semua</span>
                    </div>
                </div>
            </div>

            <div class="hero-visual">
                <img src="{{ asset('images/hero-kursus.jpg') }}"
                     alt="Ilustrasi kelas KursusKu">
            </div>
        </div>
    </section>

    <section class="section container" id="kursus">
        <div class="section-head">
            <span class="section-eyebrow">Program Kami</span>
            <h2 class="section-title">Kursus Pilihan</h2>
            <p class="section-subtitle">Mulai dari dasar sampai framework, langkah demi langkah.</p>
        </div>

        <div class="course-grid">
            @foreach ($featured as $course)
                <article class="card">
                    <div class="card-number">{{ $loop->iteration }}</div>
                    <span class="card-code">{{ $course['code'] }}</span>
                    <h3>{{ $course['name'] }}</h3>
                    <p>{{ $course['description'] }}</p>
                </article>
            @endforeach
        </div>
    </section>
</main>

<footer class="footer">
    <div class="container">
        &copy; {{ date('Y') }} <strong>{{ $siteName }}</strong> · Praktikum Pemrograman Web III
    </div>
</footer>

</body>
</html>