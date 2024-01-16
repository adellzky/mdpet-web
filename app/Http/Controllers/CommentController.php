<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $client = new Client();

        $i = 0;
        $comments = json_decode($client->request("GET", "http://localhost:8000/api/comments")->getBody(), true)['data'];

        return view('', compact('comments', 'i'));
    }

    public function show(String $id)
    {
        $client = new Client();

        $comments = json_decode($client->request("GET", "http://localhost:8000/api/comments/$id")->getBody(), true)['data'];

        return view('', compact('comments'));
    }

    public function store(Request $request)
    {
        $client = new Client();

        $response = json_decode($client->request("POST", "http://localhost:8000/api/comments", [
            "multipart" => [
                [
                    "name" => "id_post",
                    "contents" => $request->id_post
                ],
                [
                    "name" => "deskripsi",
                    "contents" => $request->deskripsi
                ],
                [
                    "name" => "id_user",
                    "contents" => Auth::id()
                ]
            ]
        ])->getBody(), true);

        if ($response['status']) {
            return redirect('/posts')->with('success', 'Success add comments');
        } else {
            return redirect('/posts')->with('failed', 'Failed add comments');
        }
    }

    public function update(Request $request, String $id)
    {
        $client = new Client();

        $response = json_decode($client->request("POST", "http://localhost:8000/api/comments/$id", [
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
            return redirect('/comments')->with('success', 'Success edit comments');
        } else {
            return redirect('/comments')->with('failed', 'Failed edit comments');
        }
    }

    public function destroy(String $id)
    {
        $client = new Client();

        $response = json_decode($client->request("DELETE", "http://localhost:8000/api/comments/$id")->getBody(), true);

        if ($response['status']) {
            return redirect('/posts')->with('success', 'Success deleted comments');
        } else {
            return redirect('/posts')->with('failed', 'Failed deleted comments');
        }
    }
}
