{{--
    Gaya bersama FORM (create & edit).
    Dipanggil lewat: @push('styles') @include('courses._theme') @include('courses._form') @endpush
--}}
<style>
    .kc-section { padding: 1.75rem; }
    .kc-section + .kc-section { margin-top: 1.25rem; }
    .kc-head { display: flex; gap: .9rem; align-items: flex-start; margin-bottom: 1.5rem; }
    .kc-num { flex: 0 0 auto; width: 38px; height: 38px; border-radius: 10px; display: grid; place-items: center; background: var(--kc-dark); color: var(--kc-yellow); font-weight: 800; }
    .kc-head h2 { font-size: 1.05rem; font-weight: 800; margin: 0; color: var(--kc-dark); }
    .kc-head p { margin: .15rem 0 0; font-size: .85rem; color: var(--kc-muted); }

    /* Field */
    .kc-page .form-label { font-weight: 700; font-size: .86rem; margin-bottom: .4rem; color: var(--kc-dark); }
    .kc-page .form-label .req { color: #dc2626; margin-left: 2px; }
    .kc-page .form-control, .kc-page .input-group-text { border-radius: 9px; border: 1.5px solid var(--kc-border); padding: .7rem .9rem; font-size: .93rem; }
    .kc-page .input-group-text { background: var(--kc-teal-soft); color: var(--kc-teal); font-weight: 800; }
    .kc-page .input-group > .form-control { border-top-left-radius: 0; border-bottom-left-radius: 0; }
    .kc-page .input-group > .input-group-text { border-top-right-radius: 0; border-bottom-right-radius: 0; }
    .kc-page .form-control:focus { border-color: var(--kc-teal); box-shadow: 0 0 0 .22rem rgba(15,118,110,.15); }
    .kc-page .form-control.is-invalid { border-color: #dc2626; background-image: none; }
    .kc-page .form-control.is-invalid:focus { box-shadow: 0 0 0 .22rem rgba(220,38,38,.15); }
    .kc-page .invalid-feedback { font-weight: 600; font-size: .8rem; }
    .kc-hint { font-size: .78rem; color: var(--kc-muted); margin-top: .35rem; }
    #code { text-transform: uppercase; letter-spacing: .6px; font-weight: 700; }

    /* Stepper kuota */
    .kc-stepper { display: flex; }
    .kc-stepper button { flex: 0 0 auto; width: 46px; border: 1.5px solid var(--kc-border); background: var(--kc-teal-soft); color: var(--kc-teal); font-weight: 800; font-size: 1.1rem; cursor: pointer; }
    .kc-stepper button:hover { background: #d3ece7; }
    .kc-stepper button:first-child { border-radius: 9px 0 0 9px; border-right: 0; }
    .kc-stepper button:last-child  { border-radius: 0 9px 9px 0; border-left: 0; }
    .kc-stepper .form-control { border-radius: 0 !important; text-align: center; font-weight: 700; }

    /* Chip pilih cepat tanggal */
    .kc-chip { border: 1.5px dashed #e3c35a; background: #fffbea; color: #8a6100; font-size: .76rem; font-weight: 700; border-radius: 999px; padding: .28rem .8rem; cursor: pointer; }
    .kc-chip:hover { background: #fff1bd; }

    /* Pilihan status */
    .kc-status-opt { position: relative; display: block; height: 100%; cursor: pointer; padding: 1rem 1rem 1rem 1.1rem; border: 1.5px solid var(--kc-border); border-radius: 12px; background: #fff; transition: all .15s ease; }
    .kc-status-opt:hover { border-color: #9cc3bb; }
    .kc-status-opt .t { display: flex; align-items: center; gap: .5rem; font-weight: 800; color: var(--kc-dark); }
    .kc-status-opt .d { font-size: .78rem; color: var(--kc-muted); margin-top: .25rem; }
    .kc-dot { width: 10px; height: 10px; border-radius: 50%; }
    .kc-dot.draft { background: #f59e0b; } .kc-dot.open { background: #10b981; } .kc-dot.closed { background: #ef4444; }
    .btn-check:checked + .kc-status-opt { border-color: var(--kc-teal-line); background: var(--kc-teal-soft); box-shadow: 0 0 0 3px rgba(15,118,110,.12); }
    .btn-check:checked + .kc-status-opt::after { content: "\2713"; position: absolute; top: 10px; right: 10px; width: 22px; height: 22px; border-radius: 50%; display: grid; place-items: center; background: var(--kc-teal); color: #fff; font-size: .75rem; font-weight: 800; }
    .btn-check:focus-visible + .kc-status-opt { outline: 2px solid var(--kc-teal); outline-offset: 2px; }

    .kc-actions { display: flex; flex-wrap: wrap; gap: .75rem; align-items: center; justify-content: space-between; padding: 1rem 1.25rem; margin-top: 1.25rem; }
    .kc-sticky { position: sticky; top: 90px; }
    .kc-alert-err { border-radius: 12px; background: #fef2f2; color: #991b1b; border-left: 4px solid #dc2626 !important; }
</style>