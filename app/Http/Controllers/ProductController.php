<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $client = new Client();

        $i = 0;
        $product = json_decode($client->request('GET', 'http://localhost:8000/api/products')->getBody(), true)['data'];

        return view('pages.app.product.index', compact('product', 'i'));
    }

    public function show(string $id)
    {
        $client = new Client();

        $response = json_decode($client->request('GET', 'http://localhost:8000/api/products/' . $id)->getBody(), true);

        if (isset($response['data'])) {
            $product = $response['data'];
            return view('pages.app.product.show', compact('product'));
        } else {
            return redirect('/products')->with('error', 'Produk tidak ditemukan');
        }
    }

    public function add()
    {
        return view('pages.app.product.add');
    }

    public function store(Request $request)
    {
        $client = new Client();
        // dd($request);
        $response = json_decode(
            $client
                ->request('POST', 'http://localhost:8000/api/products', [
                    'multipart' => [
                        [
                            'name' => 'name',
                            'contents' => $request->name,
                        ],
                        [
                            'name' => 'category',
                            'contents' => $request->category,
                        ],
                        [
                            'name' => 'stok',
                            'contents' => $request->stok,
                        ],
                        [
                            'name' => 'price',
                            'contents' => $request->price,
                        ],
                        [
                            'name' => 'deskripsi',
                            'contents' => $request->deskripsi,
                        ],
                        [
                            'name' => 'image',
                            'contents' => fopen($request->file('image'), 'r'),
                            'filename' => $request->file('image')->getClientOriginalName(),
                            'headers' => [
                                'Content-Type' => '<Content-type header>',
                            ],
                        ],
                    ],
                ])
                ->getBody(),
            true,
        );

        if ($response['status']) {
            return redirect('/products')->with('success', 'Success');
        } else {
            return redirect('/products')->with('error', 'Failed');
        }
    }

    public function edit(string $id)
    {
        $client = new Client();

        $product = json_decode($client->request('GET', 'http://localhost:8000/api/products/' . $id)->getBody(), true)['data'];

        return view('pages.app.product.edit', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        $client = new Client();

        if ($request->hasFile('image')) {
            $response = json_decode(
                $client
                    ->request('POST', 'http://localhost:8000/api/products/' . $id, [
                        'multipart' => [
                            [
                                'name' => 'name',
                                'contents' => $request->name,
                            ],
                            [
                                'name' => 'category',
                                'contents' => $request->category,
                            ],
                            [
                                'name' => 'stok',
                                'contents' => $request->stok,
                            ],
                            [
                                'name' => 'price',
                                'contents' => $request->price,
                            ],
                            [
                                'name' => 'deskripsi',
                                'contents' => $request->deskripsi,
                            ],
                            [
                                'name' => 'image',
                                'contents' => fopen($request->file('image'), 'r'),
                                'filename' => $request->file('image')->getClientOriginalName(),
                                'headers' => [
                                    'Content-Type' => '<Content-type header>',
                                ],
                            ],
                        ],
                    ])
                    ->getBody(),
                true,
            );
        } else {
            $response = json_decode(
                $client
                    ->request('POST', 'http://localhost:8000/api/products/' . $id, [
                        'multipart' => [
                            [
                                'name' => 'name',
                                'contents' => $request->name,
                            ],
                            [
                                'name' => 'category',
                                'contents' => $request->category,
                            ],
                            [
                                'name' => 'stok',
                                'contents' => $request->stok,
                            ],
                            [
                                'name' => 'price',
                                'contents' => $request->price,
                            ],
                            [
                                'name' => 'deskripsi',
                                'contents' => $request->deskripsi,
                            ],
                        ],
                    ])
                    ->getBody(),
                true,
            );
        }

        if ($response['status']) {
            return redirect('/products')->with('success', 'Success');
        } else {
            return redirect('/products')->with('error', 'Failed');
        }
    }

    public function destroy(string $id)
    {
        $client = new Client();

        $response = json_decode($client->request('DELETE', 'http://localhost:8000/api/products/' . $id)->getBody(), true);

        if ($response['status']) {
            return redirect('/products')->with('success', 'Success');
        } else {
            return redirect('/products')->with('error', 'Failed');
        }
    }
}
