@extends('layouts.app')

@section('title', 'Consultation')

@push('style')
    {{-- CSS Libraries --}}
@endpush

@section('main')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Consultation</h1>
            </div>

            <div class="section-body" style="display: flex; align-items: start;">
                @foreach ($posts as $post)
                    <div class="card pt-2" style="width: 18rem; margin-right:10px;">
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: start">{{ $post['title'] }}</h5>
                            <p class="card-text">{{ $post['deskripsi'] }}</p>
                            <div>
                                <p>Comments ({{ count($post['comments']) }})</p>
                                <div>
                                    @foreach ($post['comments'] as $comment)
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5 style="font-size: 12px !important; text-align: start">
                                                    {{ $comment['users']['name'] }}</h5>
                                                <p>{{ $comment['deskripsi'] }}</p>
                                            </div>
                                            <form action="/comments/{{ $comment['id'] }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <form action="/comments" method="POST">
                                @csrf
                                @method('POST')
                                <input type="text" style="display: none" value="{{ $post['id'] }}" name="id_post"
                                    id="id_post">
                                <input type="text" class="form-control" name="deskripsi" id="deskripsi">
                                <button type="submit" class="btn mt-2 btn-primary" style="width: 100%">Kirim</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

@endsection

@push('scripts')
    <!-- JS Libraies -['
                                                                                                                                                                                                                                                    @section('js')
    @endsection
@endpush
