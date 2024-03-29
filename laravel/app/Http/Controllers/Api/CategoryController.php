<?php

namespace App\Http\Controllers\Api;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return CategoryResource::collection(Categories::latest()->paginate(8));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                "message" => $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "category" => ['required', 'min:3', 'unique:categories,category'],
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 200);
            }
            $category = Categories::create($request->all());
            if ($category) {
                return response()->json([
                    'success' => true,
                    "message" => "Successfully created data!",
                    'data' => $category
                ], 201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                "message" => $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return new CategoryResource(Categories::find($id));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                "message" => $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                "category" => ['required', 'min:3', 'unique:categories,category'],
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 200);
            }

            $category = Categories::find($id);
            $request['Old Category'] = $category->category;
            $request['New Category'] = $request['category'];
            $update = $category->update($request->all());
            if ($update) {
                return response()->json([
                    'success' => true,
                    'message' => "Successfully updated data!",
                    'data' => $request->only(['Old Category', 'New Category'])
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                "message" => $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Categories::find($id);
            if ($category) {
                $category->delete();
                return response()->json([
                    'success' => true,
                    'message' => "Data deleted successfully!",
                    'data' => $category
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => "Cannot find the data!"
                ], 400);
            }
            return response()->json([
                'success' => false,
                'message' => "Failed to delete data!"
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                "message" => $e->getMessage(),
                'data' => []
            ], 500);
        }
    }
}
