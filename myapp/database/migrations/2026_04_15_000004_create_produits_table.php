<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description')->nullable();
            $table->integer('qte')->default(0);
            $table->decimal('prix_vente', 10, 2);
            $table->decimal('prix_achat', 10, 2)->nullable();
            $table->string('reference')->unique();
            $table->json('images')->nullable();
            $table->boolean('statut')->default(1);
            
            $table->foreignId('categorie_id')->constrained('categories')->onDelete('cascade');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
};
