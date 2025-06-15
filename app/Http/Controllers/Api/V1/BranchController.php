<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BranchController extends BaseApiController
{
    public function index()
    {
        $branches = Branch::all();
        return $this->successResponse($branches);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'date_opened' => 'required|date',
            'status' => 'boolean',
            'rent_amount' => 'required|numeric|min:0',
            'rent_type' => 'required|in:daily,weekly,monthly'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        $branch = Branch::create([
            'name' => $request->name,
            'address' => $request->address,
            'date_opened' => $request->date_opened,
            'status' => $request->status ?? true,
            'rent_amount' => $request->rent_amount,
            'rent_type' => $request->rent_type,
            'userid' => $request->user()->id
        ]);

        return $this->successResponse($branch, 'Branch created successfully', 201);
    }

    public function show($id)
    {
        $branch = Branch::find($id);
        
        if (!$branch) {
            return $this->errorResponse('Branch not found', 404);
        }

        return $this->successResponse($branch);
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::find($id);
        
        if (!$branch) {
            return $this->errorResponse('Branch not found', 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'address' => 'string',
            'date_opened' => 'date',
            'status' => 'boolean',
            'rent_amount' => 'numeric|min:0',
            'rent_type' => 'in:daily,weekly,monthly'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        $branch->update($request->only([
            'name',
            'address',
            'date_opened',
            'status',
            'rent_amount',
            'rent_type'
        ]));

        return $this->successResponse($branch, 'Branch updated successfully');
    }

    public function destroy($id)
    {
        $branch = Branch::find($id);
        
        if (!$branch) {
            return $this->errorResponse('Branch not found', 404);
        }

        $branch->delete();
        return $this->successResponse(null, 'Branch deleted successfully');
    }
}
