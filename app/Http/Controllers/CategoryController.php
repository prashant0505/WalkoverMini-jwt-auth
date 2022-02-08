<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\DeleteCategoryRequest;
use App\Http\Requests\Category\IndexCategoryRequest;
use App\Http\Requests\Category\ShowCategoryRequest;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\User;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(IndexCategoryRequest $request, User $user)
    {
        return $user->categories;
    }

    public function show(ShowCategoryRequest $request, User $user, Category $category)
    {
        return $category;
    }

    public function store(StoreCategoryRequest $request, User $user)
    {
        $category = $user->categories()->create($request->validated);
        return response()->json([
            'message' => 'Category Created Successfully',
            'Category' => $category
        ], 201);
    }

    public function update(UpdateCategoryRequest $request ,User $user, Category $category)
    {
        $updated = $category->update($request->validated);
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
