<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'produits';

    protected $fillable = [
        'nom',
        'description',
        'qte',
        'prix_vente',
        'prix_achat',
        'reference',
        'images',
        'colors',
        'statut',
        'categorie_id'
    ];

    protected $casts = [
        'images' => 'array',
        'colors' => 'array',
        'prix_vente' => 'float',
        'prix_achat' => 'float',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categorie_id');
    }
}
