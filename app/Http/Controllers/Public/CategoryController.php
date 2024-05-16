<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\AbstractController;
use App\Models\Article;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Public\ArticleResource;
use App\Http\Resources\Public\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryController extends AbstractController
{
    public function index(Request $request)
    {
        try {
            $query = Category::query();

            if ($keyword = $request->input('keyword')) {
                $query->where('name', 'LIKE', "$keyword%");
            }

            $categories = $query->get();

            return $this->successResponseWithData([
                'categories' => CategoryResource::collection($categories)
            ]);

        } catch (\Exception $e) {
            return $this->errorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => 'An unexpected error occurred']);
        }
    }
}

