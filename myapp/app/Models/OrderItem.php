<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'cmd_produits';

    protected $fillable = [
        'produit_id',
        'command_id',
        'qte',
        'prix_vente',
        'description'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'produit_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'command_id');
    }
}
