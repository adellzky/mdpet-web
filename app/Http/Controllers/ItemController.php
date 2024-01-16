<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{

    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $item = Item::oldest()->paginate(100);
        if ($request->wantsJson()) {
            return response()->json($item);
        }
        return view('pages.app.manage_item.index', compact('item'))
            ->with('i', (request()->input('page', 1) - 1) * 100);;
    }

    /**
     * Store a newly created resource in storage.
     */

    public function create()
    {
        return view('pages.app.manage_item.create',);
    }


    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|mimes:png,jpg,jpeg|max:2048',
            'nama_produk' => 'required|max:100',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|max:100',
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $filename = date('Y-m-d') . $gambar->getClientOriginalName();
            $path = 'gambar-produk/' . $filename;

            Storage::disk('public')->put($path, file_get_contents($gambar));

            $item = new Item([
                'nama_produk' => $request->nama_produk,
                'stok' => $request->stok,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi,
                'image' => $filename,
            ]);

            $item->save();
        }

        // if ($request->wantsJson()) {
        //     return response()->json([
        //         'message'=>'item berhasil ditambahkan',
        //         "item" => $item,
        //     ]);
        // }
        return redirect()->route('Item.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_item)
    {
        $item = Item::findOrFail($id_item);
        return view('pages.app.manage_item.show', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function edit($id_item)
    {
        $item = Item::find($id_item);
        return view('pages.app.manage_item.edit', compact('item'));
    }


    public function update(Request $request, $id_item)
    {
        $request->validate([
            'gambar' => 'required|mimes:png,jpg,jpeg|max:2048',
            'nama_produk' => 'required',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|max:100',

        ]);



        $item = Item::find($id_item);
        $item->update($request->all());
        if ($request->wantsJson()) {
            return response()->json([
                'message'=>'item berhasil diperbarui',
                "item" => $item
            ]);
        }
        return redirect()->route('Item.index')->with('success', 'Item berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_item, Request $request)
{
    $item = Item::find($id_item);

    if (!$item) {
        return response()->json(['message' => 'Item tidak ditemukan'], 404);
    }

    $item->delete();

    if ($request->wantsJson()) {
        return response()->json([
            'message' => 'Item berhasil dihapus'
        ]);
    }

    return redirect()->route('Item.index')->with('success', 'Item berhasil dihapus');
}

}
