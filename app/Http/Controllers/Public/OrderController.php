<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\AbstractController;
use App\Models\Article;
use App\Models\Order;
use App\Models\OrderArticle;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Public\ArticleResource;


class OrderController extends AbstractController
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'articles' => 'required|array',
            'articles.*.id' => 'required|exists:articles,id',
            'articles.*.quantity' => 'required|integer|min:1',
            'articles.*.plastification' => 'nullable|integer|min:0',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return $this->errorResponse(Response::HTTP_BAD_REQUEST, ['message' => $validator->errors()->first()]);
        }

        // Generate a unique tracking number
        $trackingNumber = base_convert(hash('sha256', uniqid(mt_rand(), true) . random_bytes(16)), 16, 36);
        
        // Create the order with default status
        try {
            $order = Order::create([
                'tracking_number' => $trackingNumber,
            ]);

            // Attach articles to the order with quantity and plastification
            foreach ($request->articles as $articleData) {
                $article = Article::findOrFail($articleData['id']);

                $orderArticle = new OrderArticle([
                    'quantity' => $articleData['quantity'],
                    'plastification' => $articleData['plastification'] ?? 0, 
                ]);

                $order->articles()->attach($article, [
                    'quantity' => $orderArticle->quantity,
                    'plastification' => $orderArticle->plastification,
                    'created_at' => now(), 
                    'updated_at' => now(),
                ]);
            }


            return $this->successResponseWithData(['message' => 'Order created successfully', 'tracking_number' => $trackingNumber]);

        } catch (\Exception $e) {

            return $this->errorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => 'An unexpected error occurred']);
        }
    }



    public function show($trackingNumber)
    {
        // Find the order by tracking number
        $order = Order::where('tracking_number', $trackingNumber)->first();

        // Check if the order exists
        if (!$order) {
            return $this->errorResponse(Response::HTTP_NOT_FOUND, ['message' => 'Order not found']);
        }

        // Load the articles relationship with pivot data
        $order->load('articles', 'articles.image');
        // return $order->articles;
        // Calculate the total price of the order
        $totalPrice = $order->totalPrice();

        // Return the order details with status, articles, and total price
        return response()->json([
            'id' => $order->id,
            'status' => $order->status,
            'articles' => ArticleResource::collection($order->articles),
            'total_price' => $totalPrice,
        ]);
    }
}
