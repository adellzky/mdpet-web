<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class APIOrderController extends Controller
{
    public function index()
    {
        try {
            if (request('month') != null && request('year') != null && request('category') == "Semua") {
                $orders = Order::with(['users', 'products'])->whereMonth('created_at', request('month'))
                    ->whereYear('created_at', request('year'))
                    ->get();
            } else if (request('month') != null && request('year') != null && request('category') != "Semua") {
                $orders = Order::with(['users', 'products'])->whereMonth('created_at', request('month'))
                    ->whereYear('created_at', request('year'))->whereHas('products', function ($query) {
                        $query->where('category', request('category'));
                    })
                    ->get();
            } else {
                $orders = Order::with(['users', 'products'])->get();
            }

            return response()->json([
                "status" => true,
                "message" => "GET all data orders",
                "data" => $orders
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    "status" => false,
                    "message" => $e->getMessage()
                ]
            );
        }
    }

    public function show(String $id)
    {
        try {
            $order = Order::where('id_orders', '=', $id)->with(['users', 'products'])->first();

            return response()->json([
                "status" => true,
                "message" => "GET data order by id",
                "data" => $order
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "id_cust" => "required|numeric",
                "id_product" => "required|numeric",
                "jumlah_pembelian" => "required|numeric",
                "status_pesanan" => "in:ditolak,belum_bayar,lunas",
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => $validator->errors()
                ]);
            }

            $product = Product::find($request->id_product);
            $total_harga = $request->jumlah_pembelian * $product->price;

            $request['jumlah_pembelian'] = $request->jumlah_pembelian;
            $request['total_harga'] = $total_harga;
            $request['status_pesanan'] = "belum_bayar";

            $product->update([
                'stok' => $product->stok - $request->jumlah_pembelian
            ]);

            Order::create($request->all());

            return response()->json([
                "status" => true,
                "message" => "ADD data orders",
                "data" => $request->all()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, String $id)
    {
        try {
            $order = Order::where('id_orders', '=', $id)->first();

            $product = Product::find($order->id_product);
            $total_harga = $request->jumlah_pembelian * $product->price;

            $order->update([
                "jumlah_pembelian" => $request->jumlah_pembelian,
                "total_harga" => $total_harga,
                "status_pesanan" => $request->status_pesanan
            ]);

            $product->update([
                'stok' => $product->stok + $order->jumlah_pembelian - $request->jumlah_pembelian
            ]);

            return response()->json([
                "status" => true,
                "message" => "Update data orders by id",
                "data" => $request->all()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function destroy(String $id)
    {
        try {
            $order = Order::where('id_orders', '=', $id)->first();

            $order->delete();

            return response()->json([
                "status" => true,
                "message" => "Delete data order by id"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
