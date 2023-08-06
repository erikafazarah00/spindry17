@extends('app')

@section('title', 'Edit Service')
@section('page-heading', 'Edit Service')
@push('style')
    <title>Blinking feature using CSS</title>
    <style>
        .blink {
            animation: blinker 1.5s linear infinite;
            color: red;
            font-family: sans-serif;
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
            <div class="row-12">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ url('/service/' . $service->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Logo</label>
                                    <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                        id="logo" name="logo">
                                    {{-- menampilkan image pada form --}}
                                    <img src="{{ asset('img/services/' . $service->logo) }}" alt="{{ $service->logo }}">
                                    {{-- ini untuk alert validation --}}
                                    <div class="invalid-feedback blink">
                                        @error('logo')
                                            <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    {{-- ini akhir alert validation --}}
                                </div>
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ $service->title }}">
                                    {{-- ini untuk alert validation --}}
                                    <div class="invalid-feedback blink">
                                        @error('title')
                                            <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{ $message }}
                                        @enderror
                                    </div>
                                    {{-- ini akhir alert validation --}}
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror"
                                        id="price" name="price" value="{{ $service->price }}">
                                    {{-- ini untuk alert validation --}}
                                    <div class="invalid-feedback blink">
                                        @error('price')
                                            <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{ $message }}
                                        @enderror
                                    </div>
                                    {{-- ini akhir alert validation --}}
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                                        name="description" rows="6">{{ $service->description }}</textarea>
                                    {{-- ini untuk alert validation --}}
                                    <div class="invalid-feedback blink">
                                        @error('description')
                                            <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{ $message }}
                                        @enderror
                                    </div>
                                    {{-- ini akhir alert validation --}}
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/tinymce/plugins/code/plugin.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '#description'
        });
    </script>

@endpush