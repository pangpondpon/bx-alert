<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoAlertConfig extends Model
{
    protected $fillable = [
        'primary',
        'secondary',
        'threshold',
    ];

    public static function add($primary, $secondary, $threshold)
    {
        return self::create([
            'primary' => $primary,
            'secondary' => $secondary,
            'threshold' => $threshold,
        ]);
    }
}
