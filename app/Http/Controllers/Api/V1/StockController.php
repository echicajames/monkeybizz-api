<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class StockController extends BaseApiController
{
    public function index()
    {
        $stocks = Stock::with('user')->get();
        return $this->successResponse($stocks);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'stock_name' => 'required|string|max:255',
            'stock_type' => 'required|in:ingredients,machine,tools',
            'stock_status' => 'boolean'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        $stock = Stock::create([
            'stock_id' => 'STK-' . Str::random(8),
            'stock_name' => $request->stock_name,
            'stock_type' => $request->stock_type,
            'stock_status' => $request->stock_status ?? true,
            'userid' => $request->user()->id
        ]);

        return $this->successResponse($stock, 'Stock created successfully', 201);
    }

    public function show($id)
    {
        $stock = Stock::with('user')->find($id);
        
        if (!$stock) {
            return $this->errorResponse('Stock not found', 404);
        }

        return $this->successResponse($stock);
    }

    public function update(Request $request, $id)
    {
        $stock = Stock::find($id);
        
        if (!$stock) {
            return $this->errorResponse('Stock not found', 404);
        }

        $validator = Validator::make($request->all(), [
            'stock_name' => 'string|max:255',
            'stock_type' => 'in:ingredients,machine,tools',
            'stock_status' => 'boolean'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        $stock->update($request->only([
            'stock_name',
            'stock_type',
            'stock_status'
        ]));

        return $this->successResponse($stock, 'Stock updated successfully');
    }

    public function destroy($id)
    {
        $stock = Stock::find($id);
        
        if (!$stock) {
            return $this->errorResponse('Stock not found', 404);
        }

        $stock->delete();
        return $this->successResponse(null, 'Stock deleted successfully');
    }
} 