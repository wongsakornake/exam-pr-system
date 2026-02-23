<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PublicRelation extends Model
{
    use HasFactory;

    protected $table = 'public_relations';

    protected $fillable = [
        'subject',
        'content',
        'status',
        'reviewer_uid',
        'reject_note',
        'sent_at',
        'created_uid',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'reviewer_uid' => 'integer',
        'created_uid' => 'integer',
    ];

    public function attachments(): HasMany
    {
        return $this->hasMany(PrDistributionAttachment::class, 'pr_distribution_id');
    }
}