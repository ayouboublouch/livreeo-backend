<?php

namespace App\Http\Controllers;

use App\Models\GroupLanguage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $languages = GroupLanguage::orderBy('name')->paginate(10);
        return response()->json($languages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $language = GroupLanguage::create($validated);

        return response()->json($language, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $language = GroupLanguage::findOrFail($id);
        return response()->json($language);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $language = GroupLanguage::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('group_languages')->ignore($language->id)],
        ]);

        $language->update($validated);

        return response()->json($language);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $language = GroupLanguage::findOrFail($id);
        $language->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Toggle the status of the specified language.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleStatus($id)
    {
        $language = GroupLanguage::findOrFail($id);
        $language->status = !$language->status;
        $language->save();

        return response()->json($language);
    }
}