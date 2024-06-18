<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\AbstractController;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Public\ArticleResource;
use App\Models\GroupLanguage;
use Illuminate\Http\Response;


class ArticleController extends AbstractController
{

    const ARTICLE_TYPES = [
        'BOOK' => 1,
        'SUPPLY' => 2,
        'EXTRA' => 3,
    ];

    public function index(Request $request, ?GroupLanguage $groupLanguage = null)
    {
        try {

            $request->merge(['types' => array_map('strtoupper', explode(',', $request->types))]);
            
            $validator = Validator::make($request->all(), [
                'keyword' => 'string|nullable',
                'types' => 'array|nullable',
                'types.*' => 'string|in:' . implode(',', array_keys(self::ARTICLE_TYPES)),
                'category_id' => 'numeric|exists:categories,id|nullable',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse(Response::HTTP_BAD_REQUEST, ['message' => $validator->errors()->first()]);
            }

            $query = Article::query();

            $query->where('status', 1);

            // Check if group language is provided in the URL
            if ($groupLanguage) {
                $query->whereHas('groupLanguages', function ($q) use ($groupLanguage) {
                    $q->where('group_id', $groupLanguage->id);
                });
            }

            // Check if keyword is provided in the URL
            if ($request->has('keyword')) {
                $keyword = strtolower($request->input('keyword'));
                $query->whereRaw('LOWER(name) LIKE ?', ["%$keyword%"]);
            }

            // Check if type is provided in the URL
            if ($request->has('types')) {
                $types = $request->input('types');
                $typeCodes = [];

                foreach ($types as $type) {
                    if (isset(self::ARTICLE_TYPES[$type])) {
                        $typeCodes[] = self::ARTICLE_TYPES[$type];
                    }
                }

                if (!empty($typeCodes)) {
                    $query->whereIn('type', $typeCodes);
                }
            }

            if ($colors = $request->colors) {
                $colors = explode(',', $colors);
                $query->whereHas('variants', function ($q) use ($colors) {
                    $q->whereIn('color', $colors);
                });
            }

            // Check if category_id is provided in the URL
            if ($request->has('category_id')) {
                $categoryId = $request->input('category_id');
                $query->where('category_id', $categoryId);
            }

            if ($minPrice = $request->input('min_price')) {
                $query->where('price', '>=', $minPrice);
            }

            if ($maxPrice = $request->input('max_price')) {
                $query->where('price', '<=', $maxPrice);
            }

            $articles = $query->with('variants')->get();
            
            return $this->successResponseWithData(['articles' => ArticleResource::collection($articles)]);

        } catch (\Exception $e) {
            return $this->errorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => 'An unexpected error occurred']);
        }
    }
}

