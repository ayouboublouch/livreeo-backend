<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

abstract class AbstractController
{
    /**
     * @var User
     */
    protected $user;
    
    /**
     * Respond successfully with item
     * @param array $data = []
     * 
     * @return JsonResponse
     */
    public function successResponseWithData(array $data = []): JsonResponse
    {
        return new JsonResponse(
            array_merge(['status' => 'success'], $data),
            Response::HTTP_OK,
        );
    }

    /**
     * Respond with not error
     * @param int $errorCode = Response::HTTP_BAD_REQUEST
     * @param array $data = []
     * 
     * @return JsonResponse
     */
    public function errorResponse(int $errorCode = Response::HTTP_BAD_REQUEST, array $data = []): JsonResponse
    {
        return new JsonResponse(
            array_merge(['status' => 'error'], $data),
            $errorCode,
        );
    }

    /**
     * Get the authenticated user and abort if not authenticated
     * 
     * @return User
     */
    public function getAuthUser(): User
    {
        if ($this->user) {
            return $this->user;
        }
        
        if (!$user = auth()->user()) {
            return $this->abortWithResponse(['status' => 'error'], Response::HTTP_UNAUTHORIZED);
        }

        $this->user = $user;
        return $user;
    }

    /**
     * Send the response and stop
     * 
     * @return void
     */
    public function abortWithResponse(
        array|Collection|MessageBag $payload,
        int $statusCode = Response::HTTP_OK
    ): void
    {
        response()->json($payload, $statusCode)->send();

        exit();
    }

    /**
     * Get the validated data or abort if validation error
     * 
     * @return array
     */
    public function getValidatedData(array $rules): array
    {
        $validator = validator()->make(
            request()->only(
                array_filter( // remove uneeded keys from rules
                    array_keys($rules),
                    fn ($key) => !preg_match('/[.]/', $key),
                )
            ),
            $rules
        );

        if ($validator->fails()) {
            return $this->abortWithResponse(
                $validator->errors()
            );
        }

        return $validator->validated();
    }

    public function paginateQueryWithResource(Builder $query, string $resourceClassName)
    {
        $size = request()->input('page_size', 10);
        $offset = request()->input('page', 0) * $size;
            
        return new LengthAwarePaginator(
            $resourceClassName::collection($query->skip($offset)->take($size)->get()),
            $query->count(),
            $size,
            $offset,
            [
                'path' => request()->url()
            ]
        );
    }
}
