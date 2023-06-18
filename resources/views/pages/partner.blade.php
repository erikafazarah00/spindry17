@extends('app')

@section('title', 'Partner')
@section('page-heading', 'Partner')

@section('content')
    <div class="page-content">
        <section class="row">
            <div class="row mb-3">
                <div class="col">
                    <a href="{{ url('/partner/create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-square-plus"></i> Tambah Data
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-5">
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            <i class="fa-solid fa-circle-check fa-bounce"></i> {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row-12 mb-5">
                        <form action="">
                            <div class="col-4 d-flex justify-content-end">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="q" value="{{ $q }}"
                                        placeholder="Cari...">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th>No.</th>
                                        <th>Title</th>
                                        <th>Logo</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($partners as $partner)
                                            <tr>
                                                <td>{{ $partner->id }}</td>
                                                <td>{{ $partner->title }}</td>
                                                <td>{{ $partner->logo }}</td>
                                                <td>{{ $partner->status }}</td>
                                                <td>
                                                    <a href="{{ url('/partner/' . $partner->id . '/edit') }}"
                                                        class="btn btn-warning">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </a>
                                                    <form class="d-inline" action="{{ url('/partner/' . $partner->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
