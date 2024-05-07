<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\AbstractController;
use App\Models\ReturnRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;


class ReturnRequestController extends AbstractController
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'tracking_number' => 'required|string',
            'email' => 'required|email',
            'type' => 'required|string|in:return,exchange',
            'comment' => 'string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return $this->errorResponse(Response::HTTP_BAD_REQUEST, ['message' => $validator->errors()->first()]);
        }

        $validatedData = $validator->validated();
        if (!$order = Order::where('tracking_number', $validatedData['tracking_number'])->first()){
            return $this->errorResponse(Response::HTTP_NOT_FOUND, ['message' => 'order not found']);
        }
        $validatedData['order_id'] = $order->id;
        
        // Create a new returnRequest record
        try {
            $returnRequest = ReturnRequest::create($validatedData);
            return $this->successResponseWithData(['return_request' => $returnRequest]);

        } catch (\Exception $e) {
            return $this->errorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => 'Failed to create partner']);

        }
    }
}
