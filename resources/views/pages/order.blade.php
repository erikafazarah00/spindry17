@extends('app')

@section('title', 'Order')
@section('page-heading', 'Order')

@section('content')
    <div class="page-content">
        <section class="row">
            <div class="row mb-3">
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
                    <form action="">
                        <div class="row mb-5">
                            <div class="col-2">
                                <div class="form-group">
                                    <select name="pagination" id="pagination" class="form-control" onchange="pagination()">
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
                </div>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>No.</th>
                                    <th>User Id</th>
                                    <th>Promo Id</th>
                                    <th>Service Id</th>
                                    <th>Weight</th>
                                    <th>date</th>
                                    <th>total price</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration + $orders->perPage() * ($orders->currentPage() - 1) }}
                                            </td>
                                            <td>{{ $order->user->name }}</td>
                                            <td>{{ $order->promotion->title }}</td>
                                            <td>{{ $order->service->title }}</td>
                                            <td>{{ $order->weight }}</td>
                                            <td>{{ $order->date }}</td>
                                            <td>{{ $order->total_price }}</td>
                                            <td>{!! App\Helpers\Display::status_order($order->status) !!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection

@push('script')
    <script>
        function pagination() {
            nilai = $(this).val();
            url = {{ url('/hero?pagination=') }} + nilai;
            console.log(nilai);
        }
    </script>
@endpush
