<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TargetMediaReceiver extends Model
{
    protected $table = 'target_media_receivers';

    protected $fillable = [
        'target_area_id',
        'organization_name',
        'department',
        'contact_name',
        'phone',
        'email',
        'address',
        'display_name',
        'category',
        'is_opt_in',
    ];

    protected $casts = [
        'is_opt_in' => 'boolean',
    ];

    public function targetArea(): BelongsTo
    {
        return $this->belongsTo(TargetArea::class, 'target_area_id');
    }
}