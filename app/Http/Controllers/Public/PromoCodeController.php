<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\AbstractController;
use App\Http\Resources\Public\PromoCodeResource;
use App\Models\PromoCode;
use Illuminate\Http\Response;


class PromoCodeController extends AbstractController
{
    public function verify()
    {
        if (!$code = PromoCode::where('code', request()->input('code'))) {
            return $this->errorResponse(
                Response::HTTP_BAD_REQUEST,
                [
                    'message' => 'The code is not valid'
                ]
            );
        }

        return $this->successResponseWithData([
            'code' => new PromoCodeResource($code),
        ]);
    }
}

