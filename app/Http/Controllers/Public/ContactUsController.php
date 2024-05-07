<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\AbstractController;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;




class ContactUsController extends AbstractController
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'full_name' => 'string',
            'phone_number' => 'string',
            'email' => 'email',
            'message' => 'string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return $this->errorResponse(Response::HTTP_BAD_REQUEST, ['message' => $validator->errors()->first()]);
        }

        // Create a new contact us message record
        try {
            $validatedData = $validator->validated();
            $contactUsMessage = ContactUs::create($validatedData);
            return $this->successResponseWithData(['contact_us_message' => $contactUsMessage]);

        } catch (\Exception $e) {
            return $this->errorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => 'Failed to send message']);
        }
    }
}