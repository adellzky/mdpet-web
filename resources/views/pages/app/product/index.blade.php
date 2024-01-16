@extends('layouts.app')

@section('title', 'Manage Item')

@push('style')
    {{-- CSS Libraries --}}
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Manage Product</h1>
            </div>


            <div class="section-body">

                <div class="col-12 col-md-12 col-lg-12">

                    <a href="/products/add" class="btn btn-primary mt-5">
                        <h3>Add Item</h3>
                    </a>
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-bordered table-md table">
                                    <tr>

                                        <th>Id</th>
                                        <th>Gambar</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Stok</th>
                                        <th>Harga</th>
                                        <th>Deskripsi</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($product as $products)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td><img src="{{ $products['image'] }}" alt="" width="100"></td>
                                            <td>{{ $products['name'] }}</td>
                                            <td>{{ $products['category'] }}</td>
                                            <td>{{ $products['stok'] }}</td>
                                            <td>{{ $products['price'] }}</td>
                                            <td>{{ $products['deskripsi'] }}</td>

                                            <td>




                                                <form action={{ '/products/' . $products['id'] }} method="POST">

                                                    <a href={{ '/products/' . $products['id'] . '/edit' }}
                                                    class="btn btn-primary btn-action mr-1"
                                                    data-toggle="tooltip"
                                                    title="Edit"><i class="fas fa-pencil-alt"></i></a>

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-action"
                                                    data-toggle="tooltip"
                                                    title="Delete" ><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

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
    <!-- JS Libraies -['
                        @section('js')
    @endsection
@endpush
