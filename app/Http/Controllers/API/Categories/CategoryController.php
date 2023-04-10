<?php

namespace App\Http\Controllers\API\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\StoreCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use App\Models\Categories\Category;
use App\Services\Categories\StoreCategory;
use App\Services\Categories\UpdateCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(): JsonResponse
    {
        $categories = Auth::user()->categories()->get();

        return response()->json($categories);
    }

    public function show(Request $request, Category $category): JsonResponse
    {
        return response()->json($category);
    }

    public function store(StoreCategoryRequest $request): JsonResponse
    {
        (new StoreCategory($request->user(), $request->all()))->store();

        return response()->json(null, 201);
    }

    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        (new UpdateCategory($request->user(), $category, $request->all()))->update();

        return response()->json('', 204);
    }
}
