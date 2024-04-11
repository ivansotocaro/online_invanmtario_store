<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Buy extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'total', 'discount'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class,'detail_buy', 'buy_id', 'product_id')
                        ->withPivot('quantity', 'total');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
