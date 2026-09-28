<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Client;
use App\Models\Category;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function getDashboardStats()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        
        // Revenue from all orders for the demo (including pending)
        $totalRevenue = Order::sum('total');
        
        $latestOrders = Order::with(['client', 'items.product'])->latest()->take(5)->get();

        return response()->json([
            'total_products' => $totalProducts,
            'total_orders' => $totalOrders,
            'revenue' => $totalRevenue,
            'latest_orders' => $latestOrders
        ]);
    }

    public function getArchivedProducts()
    {
        return response()->json(Product::onlyTrashed()->with('category')->get());
    }

    public function restoreProduct($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();
        return response()->json(['message' => 'Product restored successfully', 'product' => $product]);
    }

    // --- Products ---
    public function addProduct(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required', 
            'prix_vente' => 'required|numeric',
            'qte' => 'required|integer', 
            'categorie_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'images' => 'nullable|array'
        ]);
        
        $data['reference'] = 'APP-' . strtoupper(Str::random(6));
        if(!isset($data['images']) || count($data['images']) == 0) {
            $data['images'] = ['https://placehold.co/800x800?text=New+Product'];
        }
        
        return response()->json(Product::create($data), 201);
    }

    public function editProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return response()->json($product);
    }

    public function deleteProduct($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(['message' => 'Product deleted']);
    }

    // --- Categories ---
    public function addCategory(Request $request) {
        $data = $request->validate([ 'nom' => 'required', 'description' => 'nullable' ]);
        return response()->json(Category::create($data));
    }

    public function editCategory(Request $request, $id) {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return response()->json($category);
    }

    public function deleteCategory($id) {
        Category::findOrFail($id)->delete();
        return response()->json(['message' => 'Category deleted']);
    }

    // --- Orders ---
    public function getOrders()
    {
        return response()->json(Order::with(['client', 'items.product'])->latest()->get());
    }

    public function updateOrderStatus(Request $request, $id) {
        $request->validate(['statut' => 'required|string']);
        $order = Order::findOrFail($id);
        $order->update(['statut' => $request->statut]);
        return response()->json($order);
    }

    // --- Customers ---
    public function getUsers()
    {
        // Store customers are in the clients table
        return response()->json(Client::latest()->get());
    }
}
