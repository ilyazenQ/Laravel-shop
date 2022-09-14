<?php

namespace App\Domain\Category;

use App\Domain\Product\Product;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static function newFactory()
    {
        return new CategoryFactory();
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
