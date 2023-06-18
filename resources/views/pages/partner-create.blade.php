@extends('app')

@section('title', 'Create Partner')
@section('page-heading', 'Create Partner')
@push('style')
    <style>
        .blink {
            animation: blinker 1s linear infinite;
        }

        @keyframes blinker {
            50% {
                opacity: 0;
            }
        }
    </style>
@endpush

@section('content')
    <div class="page-content">
        <section class="row">
            <div class="row-10">
                <div class="col-6">
                    {{-- @if ($errors->any())
                        @foreach ($errors->all() as $item)
                            <div class="alert alert-danger mb-2" role="alert">
                                {{ $item }}
                            </div>
                        @endforeach
                    @endif --}}
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ url('/partner') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title') }}">
                                    <div class="invalid-feedback blink">
                                        @error('title')
                                            <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Logo</label>
                                    <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                        id="logo" name="logo">
                                    <div class="invalid-feedback blink">
                                        @error('logo')
                                            <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <input type="text" class="form-control @error('discount') is-invalid @enderror"
                                        id="status" name="status" value="{{ old('status') }}">
                                    <div class="invalid-feedback blink">
                                        @error('status')
                                            <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" role="switch" id="status"
                                        name="status">
                                    <label class="form-check-label" for="status">Geser Untuk Menampilkan</label>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary" type="submit">simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
