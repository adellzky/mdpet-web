<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class APICommentController extends Controller
{
    public function index()
    {
        try {
            $comments = Comment::with('users')->get();

            return response()->json([
                "status" => true,
                "message" => "GET All data comments successfully",
                "data" => $comments
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
            $comment = Comment::find($id);

            return response()->json([
                "status" => true,
                "message" => "GET comment data by id",
                "data" => $comment
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
            $comment = Comment::find($id);

            $deskripsi = $comment->deskripsi;
            if ($request->deskripsi) {
                $deskripsi = $request->deskripsi;
            }

            $id_post = $comment->id_post;
            if ($request->id_post) {
                $id_post = $request->id_post;
            }

            $id_user = $comment->id_user;
            if ($request->id_user) {
                $id_user = $request->id_user;
            }

            $comment->update([
                "deskripsi" => $deskripsi,
                "id_post" => $id_post,
                "id_user" => $id_user,
            ]);

            return response()->json([
                "status" => true,
                "message" => "UPDATE data post by id",
                "data" => [
                    "deskripsi" => $deskripsi,
                    "id_post" => $id_post
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
                "deskripsi" => "required",
                "id_post" => "required",
                "id_user" => "required",
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => $validator->errors()
                ]);
            }

            $comment = Comment::create($request->all());

            return response()->json([
                "status" => true,
                "message" => "CREATED data comments successfully",
                "data" => $comment
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
            $comment = Comment::find($id);

            $comment->delete();

            return response()->json([
                "status" => true,
                "message" => "DELETE comment successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
