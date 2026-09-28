<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class FrontendController extends Controller
{
    public function getProducts(Request $request)
    {
        $query = Product::with('category');

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('nom', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('description', 'LIKE', '%' . $request->search . '%');
            });
        }

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('categorie_id', $request->category_id);
        }

        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('prix_vente', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('prix_vente', '<=', $request->max_price);
        }

        return response()->json($query->orderBy('created_at', 'desc')->get());
    }

    public function getProduct($id)
    {
        return response()->json(Product::with('category')->findOrFail($id));
    }

    public function getCategories()
    {
        return response()->json(Category::all());
    }
}
