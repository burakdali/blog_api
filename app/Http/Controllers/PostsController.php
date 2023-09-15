<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Posts;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ResponseTrait;
use Exception;

class PostsController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        try {
            $post = Post::all();
            return $this->successWithData($post);
        } catch (Exception $e) {
            return $this->errorWithMessage($e);
        }
    }
    public function getMyPosts()
    {
        try {
            $posts = Post::where('user_id', Auth::user()->id)->get();
            return $this->successWithData($posts);
        } catch (Exception $e) {
            return $this->errorWithMessage($e);
        }
    }
    public function attachTagToPost(Request $req)
    {
        try {
            $post = Post::findOrFail($req->post_id);
            $tag = Tag::findOrFail($req->tag_id);
            $post->tag()->attach($tag->id);
            return $this->successWithMessage("Your attached tag is established");
        } catch (Exception $e) {
            return $this->errorWithMessage($e);
        }
    }


    public function store(PostRequest $request)
    {
        try {
            $post = Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'status' => $request->status,
                'user_id' => Auth::user()->id,
                'category_id' => $request->category_id
            ]);
            return $this->successWithData($post);
        } catch (Exception $e) {
            return $this->errorWithMessage($e);
        }
    }

    public function show($id)
    {
        try {
            $post = Post::findOrFail($id);
            return $this->successWithData($post);
        } catch (Exception $e) {
            return $this->errorWithMessage($e);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $userPost = Auth::user()->posts;
            $posts = json_decode($userPost, true);
            $isOwner = false;

            foreach ($posts as $sub) {
                foreach ($sub as $key => $value) {
                    if ($key == 'id' && $value == $id) {
                        $isOwner = true;
                    }
                }
            }

            if ($isOwner) {
                $post = Post::find($id);
                $post->update([
                    'title' => $request->title,
                    'content' => $request->content,
                    'status' => $request->status,
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id
                ]);
                return $this->successWithData($post);
            }
        } catch (Exception $e) {
            return $this->errorWithMessage($e);
        }
    }

    public function destroy(Posts $posts)
    {
    }
}
