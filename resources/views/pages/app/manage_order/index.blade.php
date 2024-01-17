@extends('layouts.app')

@section('title', 'Table')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Manage Order</h1>
            </div>
            <div style="margin-top: 138px" class="section-body">

            <div class="col-12 col-md-12 col-lg-12">
                <div class="card pt-5 pl-5 mt-4">
                    <form method="get" action="/orders">
                        <label for="month">Month:</label>
                        <select class="form-select" aria-label="Default select example" name="month" id="month">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                </option>
                            @endfor
                        </select>

                        <label for="year">Year:</label>
                        <select class="form-select" aria-label="Default select example" name="year" id="year">
                            @for ($i = date('Y'); $i >= 2000; $i--)
                                <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>
                                    {{ $i }}</option>
                            @endfor
                        </select>

                        <label for="category">Category:</label>
                        <select class="form-select" aria-label="Default select example" name="category" id="category">
                            <option selected disabled>Semua</option>
                            <option value="grooming">Grooming</option>
                            <option value="vaksin">Vaksin</option>
                            <option value="item">Item</option>
                        </select>
                        <button type="submit">Filter</button>
                    </form>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-bordered table-md table">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Pesanan</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Jumlah Pembelian</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Status</th>
                                    <th>Action</th>
                                </tr>
                                @if (count($orders) > 0)
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="text-center">{{ ++$i }}</td>
                                            <td class="text-center">{{ $order['users']['name'] }}</td>
                                            <td class="text-center">{{ $order['products']['name'] }}</td>
                                            <td class="text-center">{{ $order['products']['category'] }}</td>
                                            <td class="text-center">{{ $order['jumlah_pembelian'] }}</td>
                                            <td class="text-center">{{ $order['products']['price'] }}</td>
                                            <td class="text-center">{{ $order['total_harga'] }}</td>
                                            <td class="text-center">
                                                @if ($order['status_pesanan'] == 'belum_bayar')
                                                    <p style="font-weight: 700; width: max-content;margin: auto ;padding: 3px 23px; border-radius: 10px"
                                                        class="bg-secondary">Pesanan belum dibayar</p>
                                                @elseif($order['status_pesanan'] == 'ditolak')
                                                    <p style="font-weight: 700; width: max-content;margin: auto ;padding: 3px 23px; border-radius: 10px"
                                                        class="bg-danger text-white">Pesanan di tolak</p>
                                                @elseif($order['status_pesanan'] == 'lunas')
                                                    <p style="font-weight: 700; width: max-content;margin: auto ;padding: 3px 23px; border-radius: 10px"
                                                        class="bg-success text-white">
                                                        Lunas
                                                    </p>
                                                @endif
                                            </td>
                                            @if ($order['status_pesanan'] == 'belum_bayar')
                                                <td class="d-flex flex-column gap-2">
                                                    <form action="/orders/{{ $order['id_orders'] }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input class="d-none" type="text" value="lunas" name="status_pesanan" id="status_pesanan">
                                                        <button type="submit" class="btn mb-2 btn-success">Pesanan Lunas</button>
                                                    </form>
                                                    <form action="/orders/{{ $order['id_orders'] }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input class="d-none" type="text" value="ditolak" name="status_pesanan" id="status_pesanan">
                                                        <button type="submit" class="btn btn-danger">Tolak Pesanan</button>
                                                    </form>
                                                </td>
                                            @else
                                                <td>-</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">Data is empty...</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
