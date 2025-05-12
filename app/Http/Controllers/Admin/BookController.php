<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $books = Article::with(['category', 'image'])->orderBy('created_at', 'desc')->paginate(10);
        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'nullable|string',
            'price' => 'required|numeric',
            'status' => 'boolean',
            'image_id' => 'nullable|exists:files,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $book = Article::create($validated);

        return response()->json($book, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $book = Article::with(['category', 'image'])->findOrFail($id);
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $book = Article::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('articles')->ignore($book->id)],
            'description' => 'nullable|string',
            'type' => 'nullable|string',
            'price' => 'required|numeric',
            'status' => 'boolean',
            'image_id' => 'nullable|exists:files,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $book->update($validated);

        return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $book = Article::findOrFail($id);
        $book->delete();

        return response()->json(null, 204);
    }
}
