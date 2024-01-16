<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class APIPostController extends Controller
{
    public function index()
    {
        try {
            $posts = Post::with('users')->orderBy('id', 'desc')->get();
            $comments = Comment::with('users')->get();

            $result = [];

            foreach ($posts as $post) {
                $postArray = $post->toArray();
                $postArray['comments'] = [];

                foreach ($comments as $comment) {
                    if ($comment->id_post == $post->id) {
                        $postArray['comments'][] = $comment;
                    }
                }

                $result[] = $postArray;
            }


            return response()->json([
                "status" => true,
                "message" => "GET All data posts",
                "data" => $result
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
            $post = Post::find($id);

            return response()->json([
                "status" => true,
                "message" => "GET data post by id",
                "data" => $post
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
            $post = Post::find($id);

            $title = $post->title;
            if ($request->title) {
                $title = $request->title;
            }

            $deskripsi = $post->deskripsi;
            if ($request->deskripsi) {
                $deskripsi = $request->deskripsi;
            }

            $id_user = $post->id_user;
            if ($request->id_user) {
                $id_user = $request->id_user;
            }

            $post->update([
                "title" => $title,
                "deskripsi" => $deskripsi,
                "id_user" => $id_user
            ]);

            return response()->json([
                "status" => true,
                "message" => "UPDATE data post by id",
                "data" => [
                    "title" => $title,
                    "deskripsi" => $deskripsi,
                    "id_user" => $id_user
                ]
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
                "title" => "required",
                "id_user" => "required"
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => $validator->errors()
                ]);
            }

            $post = Post::create($request->all());

            return response()->json([
                "status" => true,
                "message" => "ADD data post successfully",
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
            $post = Post::find($id);

            $post->delete();

            return response()->json([
                "status" => true,
                "message" => "DELETE post data successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
