<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $phones = Category::where('nom', 'Phones')->first();
        $laptops = Category::where('nom', 'Laptops')->first();
        $tablets = Category::where('nom', 'Tablets')->first();
        $accessories = Category::where('nom', 'Accessories')->first();

        $fallbackCategoryId = Category::first() ? Category::first()->id : 1;

        $products = [
            // Phones
            ['nom' => 'iPhone 15 Pro Max', 'description' => 'Titanium design. A17 Pro chip.', 'cat' => $phones, 'prix' => 1199.00, 'img' => 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?auto=format&fit=crop&w=800'],
            ['nom' => 'iPhone 15 Pro', 'description' => 'The ultimate iPhone.', 'cat' => $phones, 'prix' => 999.00, 'img' => 'https://images.unsplash.com/photo-1696446701796-da61225697cc?auto=format&fit=crop&w=800'],
            ['nom' => 'iPhone 15', 'description' => 'New camera. New design. Newphoria.', 'cat' => $phones, 'prix' => 799.00, 'img' => 'https://images.unsplash.com/photo-1696423737213-9b2f67623912?auto=format&fit=crop&w=800'],
            ['nom' => 'iPhone 14', 'description' => 'As amazing as ever.', 'cat' => $phones, 'prix' => 699.00, 'img' => 'https://images.unsplash.com/photo-1663465373809-7d0ec2e48227?auto=format&fit=crop&w=800'],
            ['nom' => 'iPhone SE', 'description' => 'Serious power. Serious value.', 'cat' => $phones, 'prix' => 429.00, 'img' => 'https://images.unsplash.com/photo-1594032158022-de90d0fa8fb4?auto=format&fit=crop&w=800'],
            
            // Laptops
            ['nom' => 'MacBook Pro 16"', 'description' => 'Mind-blowing head-turning.', 'cat' => $laptops, 'prix' => 2499.00, 'img' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&w=800'],
            ['nom' => 'MacBook Pro 14"', 'description' => 'M3 Pro or M3 Max chips.', 'cat' => $laptops, 'prix' => 1999.00, 'img' => 'https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?auto=format&fit=crop&w=800'],
            ['nom' => 'MacBook Air M3', 'description' => 'Lean. Mean. M3 machine.', 'cat' => $laptops, 'prix' => 1099.00, 'img' => 'https://images.unsplash.com/photo-1593642632823-8f785ba67e45?auto=format&fit=crop&w=800'],
            ['nom' => 'MacBook Air M2', 'description' => 'Supercharged by M2.', 'cat' => $laptops, 'prix' => 999.00, 'img' => 'https://images.unsplash.com/photo-1606248897732-2a07c3017a52?auto=format&fit=crop&w=800'],
            ['nom' => 'iMac 24"', 'description' => 'Packed with more juice.', 'cat' => $laptops, 'prix' => 1299.00, 'img' => 'https://images.unsplash.com/photo-1589561084283-930aa7b1ce50?auto=format&fit=crop&w=800'],
            
            // Tablets
            ['nom' => 'iPad Pro 12.9"', 'description' => 'The ultimate iPad experience.', 'cat' => $tablets, 'prix' => 1099.00, 'img' => 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?auto=format&fit=crop&w=800'],
            ['nom' => 'iPad Pro 11"', 'description' => 'Astonishing performance.', 'cat' => $tablets, 'prix' => 799.00, 'img' => 'https://images.unsplash.com/photo-1588665046200-e1b9bafa7915?auto=format&fit=crop&w=800'],
            ['nom' => 'iPad Air', 'description' => 'Light. Bright. Full of might.', 'cat' => $tablets, 'prix' => 599.00, 'img' => 'https://images.unsplash.com/photo-1594966679541-e40e34080986?auto=format&fit=crop&w=800'],
            ['nom' => 'iPad mini', 'description' => 'Mega power. Mini size.', 'cat' => $tablets, 'prix' => 499.00, 'img' => 'https://images.unsplash.com/photo-1502845610603-b0972d02951e?auto=format&fit=crop&w=800'],
            ['nom' => 'iPad 10th Gen', 'description' => 'Lovable. Drawable. Magical.', 'cat' => $tablets, 'prix' => 449.00, 'img' => 'https://images.unsplash.com/photo-1561154464-82e9adf32764?auto=format&fit=crop&w=800'],

            // Accessories
            ['nom' => 'AirPods Pro 2', 'description' => 'Magic remade.', 'cat' => $accessories, 'prix' => 249.00, 'img' => 'https://images.unsplash.com/photo-1600294037681-c80b4cb5b434?auto=format&fit=crop&w=800'],
            ['nom' => 'AirPods Max', 'description' => 'A radically original composition.', 'cat' => $accessories, 'prix' => 549.00, 'img' => 'https://images.unsplash.com/photo-1613040809024-b4ef7ba99bc3?auto=format&fit=crop&w=800'],
            ['nom' => 'Apple Watch Ultra 2', 'description' => 'Next level adventure.', 'cat' => $accessories, 'prix' => 799.00, 'img' => 'https://images.unsplash.com/photo-1617305943964-b816f1a8eebd?auto=format&fit=crop&w=800'],
            ['nom' => 'Apple Watch Series 9', 'description' => 'Smarter. Brighter. Mightier.', 'cat' => $accessories, 'prix' => 399.00, 'img' => 'https://images.unsplash.com/photo-1579586337278-3befd40fd17a?auto=format&fit=crop&w=800'],
            ['nom' => 'Apple Pencil (2nd Gen)', 'description' => 'The perfect tool for artists.', 'cat' => $accessories, 'prix' => 129.00, 'img' => 'https://images.unsplash.com/photo-1632314545042-32a22ccafdf6?auto=format&fit=crop&w=800'],
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(['nom' => $p['nom']], [
                'description' => $p['description'],
                'qte' => rand(10, 100),
                'prix_vente' => $p['prix'],
                'prix_achat' => $p['prix'] * 0.7,
                'reference' => 'APP-' . strtoupper(Str::random(6)),
                'images' => [$p['img']],
                'statut' => 1,
                'categorie_id' => $p['cat'] ? $p['cat']->id : $fallbackCategoryId
            ]);
        }
    }
}
