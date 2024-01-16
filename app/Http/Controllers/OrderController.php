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

        return view('pages.app.manage_order.index', compact('orders'));
    }

    public function show(String $id)
    {
        $client = new Client();

        $order = json_decode($client->request("GET", 'http://localhost:8000/api/orders/' . $id)->getBody(), true)['data'];
        return view('pages.app.manage_order.show', compact('order'));
    }

    public function add()
    {
        return view('pages.app.manage_order.add');
    }

    public function store(Request $request)
    {
        $client = new Client();

        $response = json_decode($client->request("POST", 'http://localhost:8000/api/orders', [
            "multipart" => [
                [
                    "name" => "id_cust",
                    "contents" => $request->id_cust
                ],
                [
                    "name" => "id_product",
                    "contents" => $request->id_product,
                ]

            ]
        ])->getBody(), true);

        if ($response['status']) {
            return redirect('/orders')->with('success', 'Success');
        }
        return redirect('/orders')->with('failed', 'Failed');
    }

    public function edit(String $id)
    {
        $client = new Client();

        $order = json_decode($client->request("GET", 'http://localhost:8000/api/orders/' . $id)->getBody(), true)['data'];

        return view('pages.app.manage_order.edit', compact('order'));
    }

    public function update(Request $request, String $id)
    {
        $client = new Client();

        $response = json_decode($client->request("POST", 'http://localhost:8000/api/orders/' . $id, [
            "multipart" => [
                [
                    "name" => "status_pesanan",
                    "contents" => $request->status_pesanan
                ],
            ]
        ])->getBody(), true);

        if ($response['status']) {
            return redirect('/orders')->with('success', 'Success');
        }
        return redirect('/orders')->with('failed', 'Failed');
    }

    public function destroy(String $id)
    {
        $client = new Client();

        $response = json_decode($client->request("DELETE", 'http://localhost:8000/api/orders/' . $id)->getBody(), true);

        if ($response['status']) {
            return redirect('/orders')->with('success', 'Success');
        }
        return redirect('/orders')->with('failed', 'Failed');
    }
}
