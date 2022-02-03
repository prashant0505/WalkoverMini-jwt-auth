<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryPatchRequest;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(Category $category)
    {
        return $category->all();
    }


    public function store(CategoryRequest $request, Category $category)
    {
        $logUser = auth()->user();
        if ($logUser->id != $request->user_id) {
            return response()->json(['error' => "denied{userId}"]);
        }
        $cat = $category->create([
            'Name' => $request->Name,
            'user_id' => $request->user_id,
        ]);
        return response()->json([
            'message' => 'Category successfully Created',
            'category' => $cat
        ], 201);
    }

    public function show($userId_id, Category $category, $id)
    {
        return $category->find($id);
    }

    public function update(CategoryPatchRequest $request, Category $category, $userId, $id)
    {
        $cat = $category->find($id);
        $logUser = auth()->user();
        if ($logUser->id != $cat->user_id) {
            return response()->json(['error' => "cannot update to another users category"]);
        }
        $updatedCategory = $cat->where("id", $id)->update([
            'Name' => $request->Name,
            'user_id' => $request->user_id,
        ]);
        return response()->json([
            'message' => 'Category successfully Updated',
            'category' => $updatedCategory
        ], 201);
    }

    public function destroy(Category $category, $id)
    {
        $cat = $category->find($id);
        if ($cat) {
            $cat->delete();
            return response()->json([
                'message' => 'Category destroyed successfully',
            ], 201);
        } else {
            return response()->json([
                'message' => 'Category does not exists',
            ], 404);
        }
    }
}
