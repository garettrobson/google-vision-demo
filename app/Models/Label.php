<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{

    protected $fillable = [
        'label',
    ];

    public static function fromName(string $label) {
        $existing = static::where('label', $label)->first();
        if(!$existing) {
            $existing = Label::create([
                'label' => $label
            ]);
            $existing->save();
        }
        return $existing;
    }
}
