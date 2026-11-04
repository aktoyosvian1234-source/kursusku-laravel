
<style>
    .kc-page {
        --kc-dark: #0b2e2b;
        --kc-dark-2: #0f4a44;
        --kc-teal: #0f766e;
        --kc-teal-line: #1b6b5e;
        --kc-teal-soft: #e6f4f1;
        --kc-yellow: #fbbf24;
        --kc-yellow-dark: #e5a912;
        --kc-ink: #0f2a27;
        --kc-muted: #5b6b68;
        --kc-bg: #f1f6f4;
        --kc-border: #e1eae7;
        color: var(--kc-ink);
    }

    /* ---------- Hero ---------- */
    .kc-hero {
        padding: 3.5rem 0 3rem;
        background: linear-gradient(120deg, #e3f5f1 0%, #ffffff 52%, #fff4d6 100%);
        border-bottom: 1px solid var(--kc-border);
    }
    .kc-hero-sm { padding: 2.5rem 0 2.25rem; }
    .kc-crumb { font-size: .82rem; color: var(--kc-muted); margin-bottom: 1.1rem; }
    .kc-crumb a { color: var(--kc-teal); font-weight: 600; text-decoration: none; }
    .kc-crumb a:hover { text-decoration: underline; }
    .kc-eyebrow { display: flex; align-items: center; gap: .6rem; font-size: .75rem; font-weight: 800; letter-spacing: 1.6px; text-transform: uppercase; color: var(--kc-teal); }
    .kc-eyebrow::before { content: ""; width: 24px; height: 3px; border-radius: 3px; background: var(--kc-yellow); }
    .kc-title { font-weight: 800; letter-spacing: -1.5px; font-size: clamp(2.1rem, 4.6vw, 3.4rem); color: var(--kc-dark); line-height: 1.08; }
    .kc-title mark { background: linear-gradient(transparent 58%, #fde68a 58%); color: inherit; padding: 0 .12em; }
    .kc-lead { color: var(--kc-muted); line-height: 1.8; font-size: 1rem; max-width: 560px; }

    /* Deretan angka di bawah hero */
    .kc-stats { display: flex; flex-wrap: wrap; gap: 1rem 2.6rem; margin-top: 2rem; padding-top: 1.4rem; border-top: 1px solid var(--kc-border); max-width: 560px; }
    .kc-stat strong { display: block; font-size: 1.35rem; font-weight: 800; color: var(--kc-teal); line-height: 1.15; }
    .kc-stat span { font-size: .76rem; color: var(--kc-muted); }

    /* ---------- Panel hijau dengan bayangan kuning (seperti foto di beranda) ---------- */
    .kc-panel {
        margin: 0 16px 16px 0; padding: 1.6rem; color: #fff; border: 4px solid #fff; border-radius: 16px;
        background: radial-gradient(circle at 92% 0%, rgba(251,191,36,.26), transparent 48%),
                    linear-gradient(135deg, var(--kc-dark), var(--kc-dark-2));
        box-shadow: 16px 16px 0 var(--kc-yellow-dark), 0 26px 50px rgba(11,46,43,.2);
    }
    .kc-panel-label { font-size: .68rem; font-weight: 800; letter-spacing: 1.2px; text-transform: uppercase; color: var(--kc-yellow); margin-bottom: 1rem; }
    .kc-mini { display: flex; align-items: center; gap: .8rem; padding: .8rem 0; border-top: 1px solid rgba(255,255,255,.12); text-decoration: none; color: #fff; }
    .kc-mini:first-of-type { border-top: 0; padding-top: 0; }
    .kc-mini:hover { color: #fff; }
    .kc-mini:hover .kc-mini-name { text-decoration: underline; }
    .kc-mini-name { font-weight: 700; font-size: .95rem; line-height: 1.25; }
    .kc-mini-sub { font-size: .76rem; color: rgba(255,255,255,.62); }
    .kc-mini .kc-code { background: var(--kc-yellow); color: var(--kc-dark); }
    .kc-facts { display: grid; grid-template-columns: 1fr 1fr; gap: 1.1rem 1.25rem; }
    .kc-facts small { display: block; font-size: .66rem; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; color: rgba(255,255,255,.6); margin-bottom: .25rem; }
    .kc-facts strong { font-size: 1.25rem; font-weight: 800; letter-spacing: -.3px; }
    .kc-facts .yellow { color: var(--kc-yellow); }

    /* ---------- Tombol ---------- */
    .kc-btn {
        display: inline-flex; align-items: center; justify-content: center; gap: .55rem; text-decoration: none; cursor: pointer;
        font-weight: 700; font-size: .9rem; border-radius: 9px; padding: .8rem 1.5rem; border: 1.5px solid transparent;
        transition: transform .15s ease, box-shadow .15s ease, background .15s ease;
    }
    .kc-btn-yellow { background: var(--kc-yellow); color: var(--kc-dark); box-shadow: 0 12px 24px rgba(251,191,36,.4); }
    .kc-btn-yellow:hover { background: #f5b50f; color: var(--kc-dark); transform: translateY(-1px); }
    .kc-btn-yellow:disabled { opacity: .75; transform: none; }
    .kc-btn-outline { background: #fff; color: var(--kc-teal); border-color: var(--kc-teal-line); }
    .kc-btn-outline:hover { background: var(--kc-teal-soft); color: var(--kc-teal); }
    .kc-btn-danger { background: #fff; color: #b91c1c; border-color: #dc2626; }
    .kc-btn-danger:hover { background: #fef2f2; color: #991b1b; }

    /* ---------- Body, judul bagian, kartu ---------- */
    .kc-body { background: var(--kc-bg); padding: 2.5rem 0 3.5rem; }
    .kc-section-title { font-size: 1.65rem; font-weight: 800; letter-spacing: -.6px; color: var(--kc-dark); margin: 0; }
    .kc-section-title::after { content: ""; display: block; width: 46px; height: 4px; border-radius: 4px; background: var(--kc-yellow); margin-top: .65rem; }
    .kc-section-sub { color: var(--kc-muted); font-size: .92rem; margin: .7rem 0 0; }

    .kc-card {
        background: #fff; border: 1px solid var(--kc-border); border-radius: 12px;
        box-shadow: 0 1px 2px rgba(11,46,43,.04), 0 10px 28px rgba(11,46,43,.04);
    }
    .kc-card-top { border-top: 3px solid var(--kc-teal-line); }

    /* ---------- Chip kode & status ---------- */
    .kc-code {
        display: inline-block; background: var(--kc-dark); color: var(--kc-yellow);
        font-size: .68rem; font-weight: 800; letter-spacing: 1px; padding: .35rem .65rem; border-radius: 6px; white-space: nowrap;
    }
    .kc-status { display: inline-flex; align-items: center; gap: .4rem; font-size: .74rem; font-weight: 800; padding: .3rem .7rem; border-radius: 999px; white-space: nowrap; }
    .kc-status::before { content: ""; width: 7px; height: 7px; border-radius: 50%; background: currentColor; }
    .kc-status.open   { background: #d1fae5; color: #047857; }
    .kc-status.draft  { background: #fef3c7; color: #92400e; }
    .kc-status.closed { background: #fee2e2; color: #b91c1c; }
</style>