<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TargetArea extends Model
{
    protected $table = 'target_areas';

    protected $fillable = [
        'name_en',
        'name_jp',
        'display_order'
    ];

    public function mediaReceivers()
    {
        return $this->hasMany(TargetMediaReceiver::class, 'target_area_id');
    }
}