<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\AbstractController;
use App\Models\Article;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Public\ArticleResource;
use Illuminate\Http\Response;


class ArticleController extends AbstractController
{

    const ARTICLE_TYPES = [
        'BOOK' => 1,
        'SUPPLY' => 2,
        'EXTRA' => 3,
    ];

    public function index(Request $request, ?Group $group = null)
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

            // Check if group is provided in the URL
            if ($group) {
                $query->whereHas('groups', function ($q) use ($group) {
                    $q->where('group_id', $group->id);
                })->with(['groups' => function ($q) use ($group) {
                    $q->where('group_id', $group->id)
                        ->wherePivot('quantity', '>', 0)
                        ->select('quantity'); 
                }]);
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

            // Check if category_id is provided in the URL
            if ($request->has('category_id')) {
                $categoryId = $request->input('category_id');
                $query->where('category_id', $categoryId);
            }

            $articles = $query->get();
            
            return $this->successResponseWithData(['articles' => ArticleResource::collection($articles)]);

        } catch (\Exception $e) {

            return $this->errorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => 'An unexpected error occurred']);

        }
    }
}

