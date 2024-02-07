<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Nette\Utils\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PostResource::collection(Post::latest()->paginate(8));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'thumbnail' => ['required', 'image:jpeg,png,jpg,gif,svg', 'max:2048'],
            "title" => ['required', 'min:8', 'unique:posts,title'],
            'content' => ['required', 'min:30'],
            'category_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 200);
        }

        $request['slug'] = Str::slug($request->input('title'));
        $request['id'] = Str::uuid();

        //? File input
        $pathTujuan =  '/storage/posts_thumbnail/';
        $file = $request->file('thumbnail');
        $fileExt = $file->getClientOriginalExtension();
        $filename =  $request['id'] . '.' . $fileExt;

        $request['file_name'] = $filename;
        $file->move(public_path($pathTujuan), $filename);

        //? Data yang sudah di validasi
        $validatedData = [
            'id' => $request->input('id'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'slug' => $request->input('slug'),
            'thumbnail' => $filename,
            'category_id' => $request->input('category_id')
        ];

        Post::create($validatedData);
        return response()->json([
            'success' => true,
            'message' => "Successfully created data!",
            'data' => [
                'id' => $request->input('id'),
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'slug' => $request->input('slug'),
                'thumbnail' => [
                    'filename' => $filename,
                    'url' => asset($pathTujuan . $filename),
                    'size' => filesize(public_path($pathTujuan . $filename)) / 1000  . " Kb",
                ],
            ]
        ], 200);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new PostResource(Post::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            "title" => ['min:8', 'unique:posts,title'],
            'content' => ['min:30'],
            'category_id' => [],
            'thumbnail' => []
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 200);
        }

        $request['slug'] = Str::slug($request->input('title'));
        $post = Post::find($id);

        if ($request->hasFile('thumbnail')) {
            return response()->json('tes', 200);
            $pathTujuan =  '/storage/posts_thumbnail/';
            if (File::exists(public_path($pathTujuan . $post->thumbnail))) {
                File::delete(public_path($pathTujuan . $post->thumbnail));
            }
            $file = $request->file('thumbnail');
            $file->move(public_path($pathTujuan), $post->thumbnail);
        }

        $post->update($request->all());
        return response()->json([
            'success' => true,
            'message' => "Successfully updated data!",
            'data' => $request->all()
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return response()->json([
                'success' => true,
                'message' => "Data deleted successfully!",
                'data' => $post
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
    }
}
