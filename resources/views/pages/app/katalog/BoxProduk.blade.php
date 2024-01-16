    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
        <article class="article">
            <div class="article-header">
                <div class="article-image" style="background-image: url('{{ asset('product'.$products->image) }}')"></div>
                <div class="article-title">
                    <h2>{{$product->name}}</h2>
                </div>
            </div>
            <div class="article-details">
                <p>{{$product->deskripsi}}</p>
                <div class="article-cta">
                    <a href="#"
                        class="btn btn-primary">IDR {{$product->price}}</a>
                </div>
            </div>
        </article>
    </div>

