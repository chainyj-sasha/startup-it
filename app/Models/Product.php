<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Product
 *
 * @property int $id
 * @property string $title
 * @property string $image
 * @property float $price
 * @property int $discount
 */

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'image',
        'price',
        'discount',
    ];

    /**
     * Get the orders associated with the product.
     *
     * @return BelongsToMany
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)->withPivot('count')->withTimestamps();
    }

    /**
     * Calculate the total price for the given count of the product.
     *
     * @return float|int
     */
    public function getPriceForCount(): float|int
    {
        if (!is_null($this->pivot)) {
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }
}
