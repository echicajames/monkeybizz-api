<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InventoryController extends BaseApiController
{
    public function index(Request $request)
    {
        $query = Inventory::with(['branch', 'stock', 'user']);

        // Include trashed records if requested
        if ($request->has('include_trashed') && $request->include_trashed) {
            $query->withTrashed();
        }

        // Apply filters
        $filters = $request->only([
            'branch_id',
            'stock_id',
            'userid',
            'status',
            'type',
            'tag'
        ]);

        foreach ($filters as $field => $value) {
            if ($value !== null) {
                $query->where($field, $value);
            }
        }

        // Apply date range filter if provided
        if ($request->has('date_from')) {
            $query->where('date_created', '>=', $request->date_from);
        }
        if ($request->has('date_to')) {
            $query->where('date_created', '<=', $request->date_to);
        }

        // Apply search if provided
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('reason', 'like', "%{$search}%")
                  ->orWhere('tag', 'like', "%{$search}%");
            });
        }

        // Apply sorting
        $sortField = $request->input('sort_by', 'date_created');
        $sortDirection = $request->input('sort_direction', 'desc');

        // Validate sort direction
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }

        // Validate sort field
        $allowedSortFields = [
            'inventory_id',
            'branch_id',
            'stock_id',
            'userid',
            'quantity',
            'type',
            'status',
            'date_created',
            'created_at',
            'updated_at'
        ];

        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'date_created';
        }

        $query->orderBy($sortField, $sortDirection);

        // Get paginated results
        $perPage = $request->input('per_page', 15);
        $inventory = $query->paginate($perPage);

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

        $inventory->delete(); // This will now perform a soft delete
        return $this->successResponse(null, 'Inventory record deleted successfully');
    }

    public function restore($id)
    {
        $inventory = Inventory::withTrashed()->find($id);
        
        if (!$inventory) {
            return $this->errorResponse('Inventory record not found', 404);
        }

        if (!$inventory->trashed()) {
            return $this->errorResponse('Inventory record is not deleted', 400);
        }

        $inventory->restore();
        return $this->successResponse($inventory, 'Inventory record restored successfully');
    }

    public function forceDelete($id)
    {
        $inventory = Inventory::withTrashed()->find($id);
        
        if (!$inventory) {
            return $this->errorResponse('Inventory record not found', 404);
        }

        $inventory->forceDelete();
        return $this->successResponse(null, 'Inventory record permanently deleted');
    }
}
