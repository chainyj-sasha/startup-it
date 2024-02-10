<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'price',
        'discount',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('count')->withTimestamps();
    }

    public function getPriceForCount()
    {
        if (!is_null($this->pivot)) {
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }
}
