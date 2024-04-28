<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\AbstractController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CityController extends AbstractController
{

    public function index(Request $request)
    {
        try {

            $query = City::query();

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

            $cities = $query->get();

            return $this->successResponseWithData(['cities' => $cities]);
    
        } catch (\Exception $e) {
            return $this->errorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => 'An unexpected error occurred.']);
        }
    }


    
    


}