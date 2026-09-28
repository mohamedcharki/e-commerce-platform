<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom',
        'description',
        'qte',
        'prix_vente',
        'prix_achat',
        'reference',
        'images',
        'statut',
        'categorie_id',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function commandes()
    {
        return $this->belongsToMany(Command::class, 'cmd_produits')
                    ->withPivot(['qte', 'prix_vente', 'description'])
                    ->withTimestamps();
    }

    public function fournisseurs()
    {
        return $this->belongsToMany(Fournisseur::class, 'frs_produits')
                    ->withTimestamps();
    }
}
