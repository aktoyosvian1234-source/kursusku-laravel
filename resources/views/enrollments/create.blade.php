@extends('layouts.app')

@section('title', 'Pendaftaran Kursus')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card kk-card">

                <div class="kk-card-header">
                    <h1 class="h3 fw-bold mb-1">Pendaftaran Kursus</h1>
                    <p>Pilih kursus. Jumlah kursi akan dicek tanpa reload halaman.</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('enrollments.preview') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" id="name" name="name"
                                   value="{{ old('name') }}"
                                   class="form-control @error('name') is-invalid @enderror"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email"
                                   value="{{ old('email') }}"
                                   class="form-control @error('email') is-invalid @enderror"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="course_id" class="form-label">Pilih Kursus</label>
                            <select id="course_id" name="course_id"
                                    class="form-select @error('course_id') is-invalid @enderror"
                                    required>
                                <option value="">-- pilih kursus --</option>
                                @foreach ($courses as $id => $course)
                                    <option value="{{ $id }}" @selected(old('course_id') == $id)>
                                        {{ $course['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div id="availability" class="alert alert-secondary kk-availability">
                            Pilih kursus untuk melihat sisa kursi.
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <button class="btn btn-kk" type="submit">
                            Kirim Pendaftaran
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection