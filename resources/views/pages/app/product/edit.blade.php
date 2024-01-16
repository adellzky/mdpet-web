@extends('layouts.app')

@section('title', 'Edit Item')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Item</h1>
            </div>

            <div class="section-body">

                <p class="section-lead">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Maaf!</strong> Terdapat kesalahan dengan inputan Anda.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </p>

                <form action={{ '/products/' . $product['id'] }} method="POST">
                    @csrf
                    @method('POST')

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $product['name'] }}">
                                </div>
                                <div class="form-group">
                                    <label>Stok</label>
                                    <input type="text" class="form-control" name="stok"
                                        value="{{ $product['stok'] }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="text" class="form-control" name="harga"
                                        value="{{ $product['price'] }}">
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <input type="text" class="form-control" name="deskripsi"
                                        value="{{ $product['deskripsi'] }}">
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <center><button type="submit" class="btn btn-primary">Simpan</button></center>
                    </div>
                </form>

            </div>
    </div>

    </div>
    </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    @section('js')
    @endsection
@endpush
