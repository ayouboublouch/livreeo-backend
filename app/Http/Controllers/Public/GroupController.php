<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\AbstractController;
use App\Http\Resources\Public\GroupResource;
use App\Models\School;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;


class GroupController extends AbstractController
{
   
    public function index(Request $request, ?School $school = null)
    {
        try {
            $query = Group::query();

            if ($languages = request()->get('languages')) {
                $query->whereHas('language', function ($q) use ($languages) {
                    $q->whereIn('id', explode(',', $languages));
                });
            }
            
            if ($school) {
                $query->where('school_id', $school->id);
            }

            if ($request->has('keyword')) {

                $validator = Validator::make($request->all(), [
                    'keyword' => 'string|nullable',
                ]);
    
                if ($validator->fails()) {
                    return $this->errorResponse(Response::HTTP_BAD_REQUEST, ['message' => $validator->errors()->first()]);
                }

                $keyword = strtolower($request->input('keyword'));
                $query->whereRaw('LOWER(name) LIKE ?', ["%$keyword%"]);
            }


            $groups = $query->with(['schoolList' => function($q){
                $q->select(['path']);
            }])->get();

            return $this->successResponseWithData(['groups' => GroupResource::collection($groups)]);
        } catch (\Exception $e) {
            return $this->errorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => 'An unexpected error occurred.']);
        }
    }

}
