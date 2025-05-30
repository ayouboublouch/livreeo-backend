<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\AbstractController;
use App\Models\Article;
use App\Models\Variant;
use App\Models\Order;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Public\ArticleResource;
use App\Http\Resources\Public\OrderResource;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends AbstractController
{
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'phone' => 'string',
            'email' => 'email',
            'address' => 'required|string',
            'city' => 'string',
            'comment' => 'nullable|string',
            'shipping_type' => 'required|exists:shipping_types,id',
            'class' => 'string',
            'school' => 'string',
            'language' => 'string',
            'promo_code' => [
                'nullable',
                'string',
                'exists:promo_codes,code'
            ],
            'variants' => 'required|array',
            'variants.*.id' => 'required|exists:variants,id',
            'variants.*.quantity' => 'required|integer|min:1',
            'variants.*.plastification' => 'nullable|integer|min:0',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return $this->errorResponse(Response::HTTP_BAD_REQUEST, ['message' => $validator->errors()->first()]);
        }
        
        
        if ($request->has('promo_code')) {
            $promoCode = PromoCode::where('code', $request->promo_code)
            ->where('available_from', '<=', now())
            ->where('available_to', '>=', now())
            ->first();

            if (!$promoCode) {
                return $this->errorResponse(Response::HTTP_BAD_REQUEST, ['message' => 'Invalid or expired promo code']);
            }

            
            $promoCodeValue = $promoCode->code;
            $reductionRate = $promoCode->reduction_rate;
            
        }
        
        $validatedData = $validator->validated();

        // Generate a unique tracking number
        $trackingNumber = now()->year . '-' . $this->getUniqueOrderTrackingNumber();
        
        // Create the order with default status
        try {
            $order = Order::create([
                'tracking_number' => $trackingNumber,
                'name' => $validatedData['name'] ?? null,
                'phone' => $validatedData['phone'] ?? null,
                'email' => $validatedData['email'] ?? null,
                'address' => $validatedData['address'] ?? null, 
                'city' => $validatedData['city'] ?? null,
                'comment' => $validatedData['comment'] ?? null,
                'shipping_type' => $validatedData['shipping_type'] ?? null,
                'promo_code' => $promoCodeValue ?? null,
                'reduction_rate' => $reductionRate ?? 0,
                'class' => $city ?? '',
                'school' => $school ?? '',
                'language' => $language ?? '',
            ]);

            // Attach articles to the order with quantity and plastification
            foreach ($request->variants as $variantData) {
                $variant = Variant::findOrFail($variantData['id']);

                // $orderArticle = new OrderArticle([
                //     'quantity' => $variant['quantity'],
                //     'plastification' => $variant['plastification'] ?? 0, 
                // ]);

                $order->variants()->attach($variant, [
                    'quantity' => $variantData['quantity'],
                    'plastification' => $variantData['plastification'] ?? 0,
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
        $order->load('variants.image', 'variants.article');
        
        $totalPrice = $order->totalPrice();

        // Return the order details with status, articles, and total price
        return $this->successResponseWithData([
            'order' => new OrderResource($order)
        ]);
    }

    protected function getUniqueOrderTrackingNumber()
    {
        $len = 8;
        
        $base = strtoupper(
            base_convert(
                hash('sha256', uniqid(mt_rand(), true)
                . random_bytes(16)),
                10,
                36
            )
        );

        $keep = floor(strlen($base) / $len) * $len;

        $res = '';
        for ($i=1; $i <= $keep; $i++) { 
            $res .= $base[$i - 1] . (($i % $len == 0) && ($i != $keep) ? '-' : '');
        }

        return $res;
    }

    public function getInvoice($trackingNumber)
    {
        // Find the order by tracking number
        $order = Order::where('tracking_number', $trackingNumber)->first();

        // Check if the order exists
        if (!$order) {
            return $this->errorResponse(Response::HTTP_NOT_FOUND, ['message' => 'Order not found']);
        }

        return view('public.invoice', [
            'order' => $order
        ]);

        Pdf::setOption([
            'isRemoteEnabled' => 'true',
        ]);

        $pdf = Pdf::loadView('public.invoice', [
            'order' => $order
        ]);

        return $pdf->download("invoice-{$order->tracking_number}.pdf");
    }
}
