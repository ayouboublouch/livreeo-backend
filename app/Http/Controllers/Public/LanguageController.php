<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\AbstractController;
use Illuminate\Http\Request;
use App\Http\Resources\Public\LanguageResource;
use App\Models\Language;
use Illuminate\Http\Response;

class LanguageController extends AbstractController
{
    public function index(Request $request)
    {
        try {
            $query = Language::query();

            if ($keyword = $request->input('keyword')) {
                $query->where('name', 'LIKE', "$keyword%");
            }

            $languages = $query->get();

            return $this->successResponseWithData([
                'languages' => LanguageResource::collection($languages)
            ]);

        } catch (\Exception $e) {
            return $this->errorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => 'An unexpected error occurred']);
        }
    }
}

