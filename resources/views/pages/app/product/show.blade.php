@extends('layouts.app')

@section('title', 'Detail Produk')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Produk</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <article class="article">
                        <div class="article-header">
                            <div class="article-image"
                                style="background-image: url('{{ asset('storage/gambar-produk/'.$product['image']) }}');">
                            </div>
                            <div class="article-title">
                                <h2>{{ $product['name'] }}</h2>
                            </div>
                        </div>
                        <div class="article-details">
                            <p>{{ $product['deskripsi'] }}</p>
                            <div class="article-cta">
                                <a href="#" class="btn btn-primary">IDR {{ $product['price'] }}</a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
