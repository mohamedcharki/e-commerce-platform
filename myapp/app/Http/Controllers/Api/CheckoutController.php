<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            'cart' => 'required|array',
            'cart.*.id' => 'required|exists:produits,id',
            'cart.*.quantity' => 'required|integer|min:1',
            'client_id' => 'required|exists:clients,id'
        ]);

        $total = 0;
        foreach ($request->cart as $item) {
            $product = Product::find($item['id']);
            $total += $product->prix_vente * $item['quantity'];
        }

        $order = Order::create([
            'reference' => 'CMD-' . strtoupper(Str::random(8)),
            'statut' => 'pending',
            'client_id' => $request->client_id,
            'total' => $total
        ]);

        foreach ($request->cart as $item) {
            $product = Product::find($item['id']);
            
            OrderItem::create([
                'produit_id' => $product->id,
                'command_id' => $order->id,
                'qte' => $item['quantity'],
                'prix_vente' => $product->prix_vente,
                'description' => $product->nom
            ]);
            
            // Deduct stock
            if($product->qte >= $item['quantity']) {
                $product->qte -= $item['quantity'];
                $product->save();
            }
        }

        return response()->json([
            'message' => 'Order placed successfully', 
            'order' => $order->load('items')
        ], 201);
    }

    public function getClientOrders(Request $request)
    {
        $clientId = $request->query('client_id', 1);
        $orders = Order::with(['items.product'])
            ->where('client_id', $clientId)
            ->latest()
            ->get()
            ->map(function($order) {
                return [
                    'id'        => $order->id,
                    'reference' => $order->reference,
                    'statut'    => $order->statut,
                    'total'     => $order->total,
                    'created_at'=> $order->created_at,
                    'products'  => $order->items->map(fn($i) => [
                        'nom'       => $i->product ? $i->product->nom : $i->description,
                        'prix'      => $i->prix_vente,
                        'quantite'  => $i->qte,
                        'pivot'     => ['prix' => $i->prix_vente, 'quantite' => $i->qte]
                    ])
                ];
            });

        return response()->json($orders);
    }
}
