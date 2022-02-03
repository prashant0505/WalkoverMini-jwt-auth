<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryPatchRequest;
use App\Models\Category;
class CategoryController extends Controller
{
    public function store(CategoryRequest $request, User $user)
    {
        $category = $user->categories()->create([
            'name' => $request->name,
        ]);
        return response()->json([
            'message' => 'Category Created Successfully',
            'Category' => $category
        ], 201);
    }

    public function show(Category $Category, $userid, $id)
    {
        return $Category->find($id);
    }

    public function update(CategoryPatchRequest $request, User $user, $id)
    {
        $category = $user->categories()->where('id', $id)->update([
            'name' => $request->name,
        ]);
        return response()->json([
            'message' => 'Category Created Updated',
            'Category' => $category
        ], 201);
    }

    public function destroy(CategoryRequest $request, User $user, $id)
    {
        $user->categories()->delete($id);
        return response()->json("Category deleted Successfully");
    }
}
