<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $primaryKey = 'stock_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'stock_id',
        'stock_name',
        'stock_status',
        'stock_type',
        'userid',
        'date_created'
    ];

    protected $casts = [
        'stock_status' => 'boolean',
        'date_created' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
} 