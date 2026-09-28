<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Produit::with('categorie')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'qte' => 'integer',
            'prix_vente' => 'required|numeric',
            'prix_achat' => 'nullable|numeric',
            'reference' => 'required|string|unique:produits,reference',
            'images' => 'nullable|array',
            'statut' => 'boolean',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $produit = Produit::create($validated);
        return response()->json($produit, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function show(Produit $produit)
    {
        return response()->json($produit->load('categorie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produit $produit)
    {
        $validated = $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'qte' => 'integer',
            'prix_vente' => 'sometimes|required|numeric',
            'prix_achat' => 'nullable|numeric',
            'reference' => 'sometimes|required|string|unique:produits,reference,' . $produit->id,
            'images' => 'nullable|array',
            'statut' => 'boolean',
            'categorie_id' => 'sometimes|required|exists:categories,id',
        ]);

        $produit->update($validated);
        return response()->json($produit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
