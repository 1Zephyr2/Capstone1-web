<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'category', 'is_active', 'sort_order'];

    public static function getGrouped()
    {
        return self::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category');
    }
}