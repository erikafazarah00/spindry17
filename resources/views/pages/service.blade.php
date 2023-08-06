@extends('app')

@section('title', 'Service')
@section('page-heading', 'Promotion')

@section('content')
    <div class="page-content">
        <section class="row">
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
                    <form action="">
                        <div class="row mb-5">
                            <div class="col-4">
                                <a href="{{ url('/service/create') }}" class="btn btn-primary">Tambah Data</a>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <select name="pagination" id="pagination" class="form-control">
                                        <option>5</option>
                                        <option>10</option>
                                        <option>15</option>
                                        <option>20</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="q" value="{{ $q }}"
                                        placeholder="Cari...">
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th>No.</th>
                                        <th>Logo</th>
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($services as $service)
                                            <tr>
                                                <td>{{ $loop->iteration + $services->perpage() * ($services->currentPage() - 1) }}
                                                </td>
                                                <td>{{ $service->logo }}</td>
                                                <td>{{ $service->title }}</td>
                                                <td>{{ $service->price }}</td>
                                                <td>{!! $service->description !!}</td>
                                                <td>
                                                    <form class="d-inline-flex"
                                                        action="{{ url('/service/' . $service->id) }}" method="POST">
                                                        {{-- Button Edit --}}
                                                        <a class="btn btn-warning btn-sm"
                                                            href="{{ url('/service/' . $service->id . '/edit') }}">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                        {{-- Akhir Button Edit --}}
                                                        @csrf
                                                        @method('DELETE')
                                                        {{-- Button Delete --}}
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                        {{-- Akhir Button Delete --}}
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $services->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
