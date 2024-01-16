<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client();
        

        $i = 0;
        $product = json_decode($client->request('GET', 'http://localhost:8000/api/products')->getBody())->data;


        return view('pages.app.katalog.index', compact('product', 'i'));

    }
}
