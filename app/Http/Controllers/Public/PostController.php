<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\AbstractController;
use App\Http\Resources\Public\PostResource;
use App\Models\Post;
use Illuminate\Http\Response;


class PostController extends AbstractController
{
    public function index()
    {
        try {
            $query = Post::query();

            if ($keyword = request()->input('keyword')) {
                $query->where('name', $keyword);
            }

            $posts = $query->get();
            
            return $this->successResponseWithData(['posts' => PostResource::collection($posts)]);
        } catch (\Exception $e) {
            return $this->errorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => 'An unexpected error occurred']);
        }
    }
}

