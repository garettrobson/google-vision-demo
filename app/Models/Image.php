<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'path',
        'file_name',
        'mime_type',
        'thumbnail',
        'is_local',
    ];

    protected $attributes = [
        'is_local' => 1,
    ];

    public function labels()
    {
        return $this->belongsToMany('App\Models\Label');
    }

    public function labelsSorted()
    {
        return $this->labels()->orderBy('label');
    }
}
