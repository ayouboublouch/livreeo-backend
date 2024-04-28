<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\AbstractController;
use App\Models\School;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;


class SchoolController extends AbstractController
{
   
    public function index(Request $request, ?City $city = null)
    {
        try {
            $query = School::query();

            if ($city) {
                $query->where('city_id', $city->id);
            }

            // Check if keyword is provided in the URL
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

            $schools = $query->get();

            return $this->successResponseWithData(['schools' => $schools]);
        } catch (\Exception $e) {
            return $this->errorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => 'An unexpected error occurred.']);
        }
    }

}
