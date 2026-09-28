<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CmdProduit extends Pivot
{
    // If you need to access this as an independent Eloquent Model rather than just a Pivot model,
    // you can extend Model instead of Pivot. Given there's an ID we can extend Pivot for better relationship handling
    // but often it's also set up as a standard model for more complex business logic.
    // For now we will use a standard model approach as requested in the task.

    protected $table = 'cmd_produits';

    protected $fillable = [
        'produit_id',
        'command_id',
        'qte',
        'prix_vente',
        'description',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function command()
    {
        return $this->belongsTo(Command::class);
    }
}
