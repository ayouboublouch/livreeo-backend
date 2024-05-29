<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\AbstractController;
use App\Http\Resources\Public\FileResource;
use App\Models\Recruitment;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RecruitmentController extends AbstractController
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'phone' => 'string',
            'email' => 'email',
            'city' => 'string',
            'post_id' => 'exists:posts,id',
            'cv' => 'nullable|file|max:5120', // 5MB maximum file size (5120 KB)
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return $this->errorResponse(Response::HTTP_BAD_REQUEST, ['message' => $validator->errors()->first()]);
        }

        // Process the uploaded file
        $cvFile = $request->file('cv');
        if ($cvFile) {
            $filePath = $cvFile->store('public'); // Store the file in the "storage/app/cv_files" directory
            $file = File::create(['path' => $filePath]);
            $cvId = $file->id;
        } else {
            $cvId = null; // No file uploaded
        }

        // Create a new recruitment request
        try {
            DB::beginTransaction();
            $validatedData = $validator->validated();
            $validatedData['cv'] = $cvId;
            $recruitment = Recruitment::create($validatedData);
            DB::commit();

            if ($recruitment->cv) {
                $recruitment->cv = new FileResource($recruitment->cv()->first());
            }
            
            return $this->successResponseWithData(['recruitment' => $recruitment]);
            
        } catch (\Exception $e) {
            throw $e;
            DB::rollBack();
            return $this->errorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => 'Failed to create recruitment request']);

        }
    }
}