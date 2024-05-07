<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\AbstractController;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;


class PartnerController extends AbstractController
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'association_name' => 'string',
            'school_name' => 'string',
            'name' => 'string',
            'surname' => 'string',
            'phone_number' => 'string',
            'function_in_association' => 'string',
            'email' => 'email',
            'message' => 'string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return $this->errorResponse(Response::HTTP_BAD_REQUEST, ['message' => $validator->errors()->first()]);

        }

        // Create a new partner record
        try {
            $validatedData = $validator->validated();
            $partner = Partner::create($validatedData);
            return $this->successResponseWithData(['partner' => $partner]);

        } catch (\Exception $e) {
            return $this->errorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => 'Failed to create partner']);

        }
    }
}
