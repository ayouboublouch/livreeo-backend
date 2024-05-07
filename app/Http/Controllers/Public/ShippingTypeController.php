<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\AbstractController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\ShippingType;
use Illuminate\Http\Request;


class ShippingTypeController extends AbstractController
{

    public function index(Request $request)
    {
        try {

            $query = ShippingType::query();

            $shippingTypes = $query->get();

            return $this->successResponseWithData(['shipping_types' => $shippingTypes]);
    
        } catch (\Exception $e) {
            return $this->errorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => 'An unexpected error occurred.']);
        }
    }


    
    


}