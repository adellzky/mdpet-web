<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $client = new Client();

        if (request('month') != null && request('year') != null && request('category') == "Semua") {
            $orders = json_decode($client->request("GET", 'http://localhost:8000/api/orders?month=' . request('month') . '&year=' . request('year'))->getBody(), true)['data'];
        } else if (request('month') != null && request('year') != null && request('category') != "Semua") {
            $orders = json_decode($client->request("GET", 'http://localhost:8000/api/orders?month=' . request('month') . '&year=' . request('year') . '&category=' . request('category'))->getBody(), true)['data'];
        } else {
            $orders = json_decode($client->request("GET", 'http://localhost:8000/api/orders')->getBody(), true)['data'];
        }

        foreach ($orders as &$order) {
            $order['total_harga'] = $order['jumlah_pembelian'] * $order['products']['price'];
        }
        return view('pages.app.manage_order.index', compact('orders'));
    }

    public function show(String $id)
    {
        $client = new Client();

        $response = $client->request("GET", 'http://localhost:8000/api/orders/' . $id);

        $order = json_decode($response->getBody(), true)['data'];

        return view('pages.app.manage_order.show', compact('order'));
    }

    public function add()
    {
        return view('pages.app.manage_order.add');
    }

    public function store(Request $request)
    {
        $client = new Client();

        $response = $client->request("POST", 'http://localhost:8000/api/orders', [
            'multipart' => [
                'id_cust' => $request->id_cust,
                'id_product' => $request->id_product,
                'jumlah_pembelian' => $request->jumlah_pembelian,
                'total_harga' => $request->total_harga

            ],
        ]);

        $result = json_decode($response->getBody(), true);

        if ($result['status']) {
            return redirect('/orders')->with('success', 'Success');
        }

        return redirect('/orders')->with('failed', 'Failed');
    }

    public function edit(String $id)
    {
        $client = new Client();

        $response = $client->request("GET", 'http://localhost:8000/api/orders/' . $id);

        $order = json_decode($response->getBody(), true)['data'];

        return view('pages.app.manage_order.edit', compact('order'));
    }

    public function update(Request $request, String $id)
    {
        $client = new Client();

        $response = $client->request("POST", 'http://localhost:8000/api/orders/' . $id, [
            "multipart" => [
                [
                    "name" => "status_pesanan",
                    "contents" => $request->status_pesanan
                ],
            ]
        ]);

        $result = json_decode($response->getBody(), true);

        if ($result['status']) {
            return redirect('/orders')->with('success', 'Success');
        }
        return redirect('/orders')->with('failed', 'Failed');
    }

    public function destroy(String $id)
    {
        $client = new Client();

        $response = $client->request("DELETE", 'http://localhost:8000/api/orders/' . $id);

        $result = json_decode($response->getBody(), true);

        if ($result['status']) {
            return redirect('/orders')->with('success', 'Success');
        }

        return redirect('/orders')->with('failed', 'Failed');
    }
}
