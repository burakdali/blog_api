<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Posts;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Posts that is stored in database',
            'Posts' => $post,
        ]);
    }
    public function getMyPosts()
    {
        $posts = Post::where('user_id', Auth::user()->id)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Your Posts',
            'Posts' => $posts,
        ]);
    }
    public function attachTagToPost(Request $req)
    {
        $post = Post::findOrFail($req->post_id);
        $tag = Tag::findOrFail($req->tag_id);
        $post->tag()->attach($tag->id);
        return response()->json([
            'status' => 'success',
            'message' => 'Your attached tag is established',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Post has been added succesfully',
            'Post' => $post,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Post that you asked for',
            'Post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $userPost = Auth::user()->posts;
        if ($post == $userPost) {
            $post->update([
                'title' => $request->title,
                'content' => $request->content,
                'status' => $request->status,
                'user_id' => Auth::user()->id,
                'category_id' => $request->category_id
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Post has been updated succesfully',
                'Post' => 'post edited succesfully',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $posts)
    {
        //
    }
}
