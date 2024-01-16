<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $client = new Client();

        $i = 0;
        $posts = json_decode($client->request("GET", "http://localhost:8000/api/posts")->getBody(), true)['data'];

        return view('pages.app.posts.index', compact('posts', 'i'));
    }

    public function show(String $id)
    {
        $client = new Client();

        $post = json_decode($client->request("GET", "http://localhost:8000/api/posts/$id")->getBody(), true)['data'];

        return view('', compact('post'));
    }

    public function store(Request $request)
    {
        $client = new Client();

        $response = json_decode($client->request("POST", "http://localhost:8000/api/posts", [
            "multipart" => [
                [
                    "name" => "title",
                    "contents" => $request->title
                ],
                [
                    "name" => "deskripsi",
                    "contents" => $request->deskripsi
                ],
                [
                    "name" => "id_user",
                    "contents" => $request->id_user
                ]
            ]
        ])->getBody(), true);

        if ($response['status']) {
            return redirect('/posts')->with('success', 'Success add post');
        } else {
            return redirect('/posts')->with('failed', 'Failed add post');
        }
    }

    public function update(Request $request, String $id)
    {
        $client = new Client();

        $response = json_decode($client->request("POST", "http://localhost:8000/api/posts/$id", [
            "multipart" => [
                [
                    "name" => "title",
                    "contents" => $request->title
                ],
                [
                    "name" => "deskripsi",
                    "contents" => $request->deskripsi
                ],
                [
                    "name" => "id_user",
                    "contents" => $request->id_user
                ]
            ]
        ])->getBody(), true);

        if ($response['status']) {
            return redirect('/posts')->with('success', 'Success edit post');
        } else {
            return redirect('/posts')->with('failed', 'Failed edit post');
        }
    }

    public function destroy(String $id)
    {
        $client = new Client();

        $response = json_decode($client->request("DELETE", "http://localhost:8000/api/posts/$id")->getBody(), true);

        if ($response['status']) {
            return redirect('/posts')->with('success', 'Success deleted post');
        } else {
            return redirect('/posts')->with('failed', 'Failed deleted post');
        }
    }
}
