<?php

namespace App;

use App\Business\Pairs\PairFinder;
use Illuminate\Database\Eloquent\Model;

class AlertHistory extends Model
{
    protected $fillable = [
        'primary',
        'secondary',
        'threshold',
        'price',
    ];

    public static function add($primary, $secondary, $threshold)
    {
        $pair = (new PairFinder())->find($primary, $secondary);

        return self::create([
            'primary' => $primary,
            'secondary' => $secondary,
            'threshold' => $threshold,
            'price' => $pair->lastPrice,
        ]);
    }
}
