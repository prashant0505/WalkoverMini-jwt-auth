<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteCategoryRequest;
use App\Http\Requests\IndexCategoryRequest;
use App\Http\Requests\ShowCategoryRequest;
use App\Models\User;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(IndexCategoryRequest $request, User $user, Category $category)
    {
        return $category;
    }

    public function show(ShowCategoryRequest $category, User $user)
    {
        return $user->categories()->get();
    }

    public function store(StoreCategoryRequest $request, User $user)
    {
        $category = $user->categories()->create([
            'name' => $request->name,
        ]);
        return response()->json([
            'message' => 'Category Created Successfully',
            'Category' => $category
        ], 201);
    }

    public function update(UpdateCategoryRequest $request, User $user, Category $category)
    {
        $updated = $category->update($request->all());
        return response()->json([
            'message' => 'Category Created Updated',
            'Category' => $updated
        ], 201);
    }

    public function destroy(DeleteCategoryRequest $request, User $user, Category $category)
    {
        if($category->delete())
        return response()->json("Category Deleted Successfully");
    }
}
