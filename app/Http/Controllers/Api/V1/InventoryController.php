<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InventoryController extends BaseApiController
{
    public function index()
    {
        $inventory = Inventory::with(['branch', 'stock', 'user'])->get();
        return $this->successResponse($inventory);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch_id' => 'required|exists:branches,branch_id',
            'stock_id' => 'required|exists:stocks,stock_id',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|in:stock_in,stock_out',
            'reason' => 'nullable|string',
            'status' => 'boolean',
            'tag' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        $inventory = Inventory::create([
            'branch_id' => $request->branch_id,
            'stock_id' => $request->stock_id,
            'userid' => $request->user()->id,
            'quantity' => $request->quantity,
            'type' => $request->type,
            'reason' => $request->reason,
            'status' => $request->status ?? true,
            'tag' => $request->tag
        ]);

        return $this->successResponse($inventory, 'Inventory record created successfully', 201);
    }

    public function show($id)
    {
        $inventory = Inventory::with(['branch', 'stock', 'user'])->find($id);
        
        if (!$inventory) {
            return $this->errorResponse('Inventory record not found', 404);
        }

        return $this->successResponse($inventory);
    }

    public function update(Request $request, $id)
    {
        $inventory = Inventory::find($id);
        
        if (!$inventory) {
            return $this->errorResponse('Inventory record not found', 404);
        }

        $validator = Validator::make($request->all(), [
            'branch_id' => 'exists:branches,branch_id',
            'stock_id' => 'exists:stocks,stock_id',
            'quantity' => 'integer|min:1',
            'type' => 'in:stock_in,stock_out',
            'reason' => 'nullable|string',
            'status' => 'boolean',
            'tag' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        $inventory->update($request->only([
            'branch_id',
            'stock_id',
            'quantity',
            'type',
            'reason',
            'status',
            'tag'
        ]));

        return $this->successResponse($inventory, 'Inventory record updated successfully');
    }

    public function destroy($id)
    {
        $inventory = Inventory::find($id);
        
        if (!$inventory) {
            return $this->errorResponse('Inventory record not found', 404);
        }

        $inventory->delete();
        return $this->successResponse(null, 'Inventory record deleted successfully');
    }
}
