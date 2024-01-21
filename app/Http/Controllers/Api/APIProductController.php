<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class APIProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::all();

            for ($i = 0; $products->count() > $i; $i++) {
                $products[$i]['image'] = url('/product/' . $products[$i]['image']);
            }

            return response()->json([
                "status" => true,
                "message" => "GET all data products",
                "data" => $products
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function show(String $id)
    {
        try {
            $product = Product::findOrFail($id);

            $product['image'] = url('/product/' . $product['image']);

            return response()->json([
                "status" => true,
                "message" => "GET data product by id",
                "data" => $product
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
                "name" => "required",
                "category" => "required|in:grooming,vaksin,item",
                "stok" => "required",
                "price" => "required",
                "deskripsi" => "required",
                'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => $validator->errors()
                ]);
            }

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('/product'), $fileName);
            }

            $create =  Product::create([
                "name" => $request->name,
                "category" => $request->category,
                "stok" => $request->stok,
                "price" => $request->price,
                "deskripsi" => $request->deskripsi,
                "image" => $fileName,
            ]);

            return response()->json([
                "status" => true,
                "message" => "ADD data product successfully",
                "data" => $create
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
            $product = Product::findOrFail($id);

            $name = $product->name;
            if ($request->name) {
                $name = $request->name;
            }

            $category = $product->category;
            if ($request->category) {
                $category = $request->category;
            }

            $stok = $product->stok;
            if ($request->stok) {
                $stok = $request->stok;
            }

            $price = $product->price;
            if ($request->price) {
                $price = $request->price;
            }

            $deskripsi = $product->deskripsi;
            if ($request->deskripsi) {
                $deskripsi = $request->deskripsi;
            }

            $image = $product->image;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                if ($product->image) {
                    unlink(public_path('/product/' . $product->image));
                }
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('/product'), $fileName);
                $image = $fileName;
            }

            $product->update([
                "name" => $name,
                "category" => $category,
                "stok" => $stok,
                "price" => $price,
                "deskripsi" => $deskripsi,
                "image" => $image,
            ]);

            return response()->json([
                "status" => true,
                "message" => "EDIT data product by id",
                "data" => [
                    "name" => $name,
                    "category" => $category,
                    "stok" => $stok,
                    "price" => $price,
                    "deskripsi" => $deskripsi,
                    "image" => url('/product/' . $image),
                ]
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
            $product = Product::findOrFail($id);

            if ($product->image) {
                unlink(public_path('/product/' . $product->image));
            }

            $product->delete();

            return response()->json([
                "status" => true,
                "message" => "DELETE product by id"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
