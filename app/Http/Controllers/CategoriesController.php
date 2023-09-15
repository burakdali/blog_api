<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Categories;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Exception;

class CategoriesController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        try {
            $categories = Category::paginate(15);
            return $this->successWithData($categories);
        } catch (Exception $e) {
            return $this->errorWithMessage($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $category = Category::create([
                'name' => $request->name,
            ]);
            return $this->successWithData($category);
        } catch (Exception $e) {
            return $this->errorWithMessage($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->update([
                'name' => $request->name,
            ]);
            return $this->successWithData($category);
        } catch (Exception $e) {
            return $this->errorWithMessage($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return $this->successWithData($category);
        } catch (Exception $e) {
            return $this->errorWithMessage($e);
        }
    }
}
