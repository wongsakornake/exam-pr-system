<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class PublicRelationFile extends Model
{
    use HasFactory;

    protected $table = 'public_relation_files';

    public $timestamps = false;

    protected $fillable = [
        'public_relation_id',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'created_at',
    ];

    protected $casts = [
        'public_relation_id' => 'integer',
        'created_at' => 'datetime',
        'file_size' => 'integer',
    ];

}