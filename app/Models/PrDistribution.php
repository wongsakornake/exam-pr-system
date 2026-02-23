<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrDistribution extends Model
{
    use HasFactory;

    protected $table = 'pr_distributions';

    protected $fillable = [
        'public_relation_id',
        'target_media_id',
    ];

    protected $casts = [
        'public_relation_id' => 'integer',
        'target_media_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}