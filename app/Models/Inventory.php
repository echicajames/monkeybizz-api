<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'inventory';
    protected $primaryKey = 'inventory_id';

    protected $fillable = [
        'branch_id',
        'stock_id',
        'userid',
        'quantity',
        'type',
        'reason',
        'status',
        'tag',
        'date_created'
    ];

    protected $casts = [
        'date_created' => 'datetime',
        'deleted_at' => 'datetime',
        'status' => 'boolean',
        'quantity' => 'integer'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
}
