<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $primaryKey = 'branch_id';

    protected $fillable = [
        'name',
        'address',
        'date_opened',
        'status',
        'rent_amount',
        'rent_type',
        'userid'
    ];

    protected $casts = [
        'date_opened' => 'date',
        'status' => 'boolean',
        'rent_amount' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
}
