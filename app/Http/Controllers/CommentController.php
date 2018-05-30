<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;

use App\Http\Resources\CommentCollection;
use App\Http\Resources\CommentResource;

use App\Comment;
use App\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CommentCollection::collection(Comment::paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function addComments(CommentRequest $request, Product $product)
    {
        $userId = Auth::id();

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->product_id = $product->id;
        $comment->user_id = $userId;
        $comment->save();

        return response()->json([
            'data' => new CommentResource($comment)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return response()->json([
            'data' => new CommentResource($comment)
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $comment->update($request->all());

        return response()->json([
            'data' => new CommentResource($comment)
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
