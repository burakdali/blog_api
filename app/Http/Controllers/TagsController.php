<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use App\Models\Tags;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Exception;

class TagsController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        try {
            $tags = Tag::paginate(15);
            return $this->successWithData($tags);
        } catch (Exception $e) {
            return $this->errorWithMessage($e->__toString());
        }
    }


    public function store(TagRequest $request)
    {
        try {
            $tag = Tag::create([
                'name' => $request->name,
            ]);
            return $this->successWithData($tag);
        } catch (Exception $e) {
            return $this->errorWithMessage($e);
        }
    }



    public function update(TagRequest $request, $id)
    {
        try {
            $tag = Tag::findOrFail($id);
            $tag->update([
                'name' => $request->name,
            ]);
            return $this->successWithData($tag);
        } catch (Exception $e) {
            return $this->errorWithMessage($e);
        }
    }


    public function destroy($id)
    {
        try {
            $tag = Tag::findOrFail($id);
            $tag->delete();
            return $this->successWithMessage("Tag has been Deleted Successfully");
        } catch (Exception $e) {
            return $this->errorWithMessage($e);
        }
    }
}
