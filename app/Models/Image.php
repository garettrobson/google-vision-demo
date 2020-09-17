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
    ];

}
