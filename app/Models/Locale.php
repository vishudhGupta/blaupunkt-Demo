<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Locale extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'country_code',
        'language_code',
        'is_default_for_country',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_default_for_country' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function productTranslations(): HasMany
    {
        return $this->hasMany(ProductTranslation::class);
    }

    public function blogTranslations(): HasMany
    {
        return $this->hasMany(BlogTranslation::class);
    }

    public function pages(): HasMany
    {
        return $this->hasMany(PageTranslation::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_market_assignments', 'locale_id', 'product_id');
    }
}
