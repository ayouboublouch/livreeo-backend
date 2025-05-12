<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\AbstractController;
use App\Http\Resources\Public\PromoCodeResource;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class CouponCodeController extends AbstractController
{
    public function index()
    {
        $promoCodes = PromoCode::orderBy('code')->paginate(10);
        return $this->successResponseWithData(['promo_codes' => $promoCodes]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:promo_codes,code',
            'available_from' => 'required|date',
            'available_to' => 'required|date|after_or_equal:available_from',
            'reduction_rate' => 'required|numeric|min:0|max:1',
        ]);

        $promoCode = PromoCode::create($validated);

        return $this->successResponseWithData(['promo_code' => $promoCode], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $promoCode = PromoCode::findOrFail($id);
        return $this->successResponseWithData(['promo_code' => $promoCode]);
    }

    public function update(Request $request, $id)
    {
        $promoCode = PromoCode::findOrFail($id);

        $validated = $request->validate([
            'code' => 'required|string|unique:promo_codes,code,' . $promoCode->id,
            'available_from' => 'required|date',
            'available_to' => 'required|date|after_or_equal:available_from',
            'reduction_rate' => 'required|numeric|min:0|max:1',
        ]);

        $promoCode->update($validated);

        return $this->successResponseWithData(['promo_code' => $promoCode]);
    }

    public function destroy($id)
    {
        $promoCode = PromoCode::findOrFail($id);
        $promoCode->delete();

        return $this->successResponseWithData([], Response::HTTP_NO_CONTENT);
    }

    public function toggleStatus($id)
    {
        $promoCode = PromoCode::findOrFail($id);
        $promoCode->status = !$promoCode->status;
        $promoCode->save();

        return $this->successResponseWithData(['promo_code' => $promoCode]);
    }

    public function verify()
    {
        if (
            !$code = PromoCode::where(
                'code',
                request()->input('code')
            )->where('available_to', '>=', now())->first()
        ) {
            return $this->errorResponse(
                Response::HTTP_BAD_REQUEST,
                [
                    'message' => 'The code is not valid or expired'
                ]
            );
        }

        return $this->successResponseWithData([
            'code' => new PromoCodeResource($code),
        ]);
    }
}
