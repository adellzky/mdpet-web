@extends('layouts.app')

@section('title', 'List Produk')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>List Produk</h1>
        </div>
        <div class="section-body">
            <div class="row">
                @foreach ($product as $products)
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <article class="article">
                        <div class="article-header">
                            <div class="article-image"
                                style="background-image: url('{{ asset($products->image) }}')">
                            </div>
                        </div>
                        <div class="article-details">
                            <div class="article-title">
                                <h2>{{ $products->name }}</h2>
                            </div>
                            {{-- <p>{{ $products->deskripsi }}</p> --}}
                            <div class="article-cta">
                                <a href="#" class="btn btn-primary">IDR {{ $products->price }}</a>
                            </div>
                        </div>
                    </article>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
