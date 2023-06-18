@extends('app')

@section('title', 'Create Promotion')
@section('page-heading', 'Create Promotion')
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
                            <form action="{{ url('/promotion') }}" method="POST" enctype="multipart/form-data">
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
                                    <label for="discount" class="form-label">Discount</label>
                                    <input type="number" class="form-control @error('discount') is-invalid @enderror"
                                        id="discount" name="discount" value="{{ old('discount') }}">
                                    <div class="invalid-feedback blink">
                                        @error('discount')
                                            <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="picture" class="form-label">Picture</label>
                                    <input type="file" class="form-control @error('picture') is-invalid @enderror"
                                        id="picture" name="picture">
                                    <div class="invalid-feedback blink">
                                        @error('picture')
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