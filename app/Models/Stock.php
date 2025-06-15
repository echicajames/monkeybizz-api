<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $primaryKey = 'stock_id';
    protected $keyType = 'integer';
    public $incrementing = true;

    protected $fillable = [
        'stock_id',
        'stock_code',
        'stock_name',
        'stock_status',
        'category',
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