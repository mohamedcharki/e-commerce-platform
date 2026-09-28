<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClothesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Supprimer les anciennes données
        DB::table('cmd_produits')->delete();
        DB::table('produits')->delete();
        DB::table('categories')->delete();

        // Créer les catégories exclusivement féminines
        $categories = [
            ['nom' => 'Robes', 'description' => 'Robes de soirée, casual et élégantes'],
            ['nom' => 'Hauts', 'description' => 'Chemisiers, blouses et tops premium'],
            ['nom' => 'Jupes', 'description' => 'Jupes courtes, mi-longues et longues'],
            ['nom' => 'Vestes Femme', 'description' => 'Vestes, blazers et manteaux pour femme'],
        ];

        $catIds = [];
        foreach ($categories as $cat) {
            $catIds[$cat['nom']] = DB::table('categories')->insertGetId([
                'nom' => $cat['nom'],
                'description' => $cat['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Créer les produits (Mode Femme) avec variantes de couleurs et IMAGES FIABLES
        $produits = [
            // --- ROBES ---
            [
                'nom' => 'Robe Longue en Soie Blanche',
                'description' => 'Robe longue luxueuse en soie véritable avec coupe ajustée.',
                'qte' => 50,
                'prix_vente' => 1200.00,
                'prix_achat' => 500.00,
                'reference' => 'RB-SOIE-BL',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1495385794356-15371f348c31?auto=format&fit=crop&q=80&w=800', // White
                    'https://images.unsplash.com/photo-1566150905458-1bf1fc113f0d?auto=format&fit=crop&q=80&w=800'  // Black
                ]),
                'colors' => json_encode(['White', 'Black']),
                'categorie_id' => $catIds['Robes'],
            ],
            [
                'nom' => 'Robe de Soirée Noire',
                'description' => "L'indémodable petite robe noire, élégante et raffinée.",
                'qte' => 120,
                'prix_vente' => 850.00,
                'prix_achat' => 300.00,
                'reference' => 'RB-SOIR-NR',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1539008835657-9e8e9680c956?auto=format&fit=crop&q=80&w=800', // Red
                    'https://images.unsplash.com/photo-1566150905458-1bf1fc113f0d?auto=format&fit=crop&q=80&w=800'  // Black
                ]),
                'colors' => json_encode(['Red', 'Black']),
                'categorie_id' => $catIds['Robes'],
            ],
            [
                'nom' => 'Robe Fleurie Estivale',
                'description' => "Robe légère avec motifs floraux délicats, parfaite pour l'été.",
                'qte' => 80,
                'prix_vente' => 450.00,
                'prix_achat' => 180.00,
                'reference' => 'RB-FLR-01',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&q=80&w=800', // Sky Blue
                    'https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&q=80&w=800'  // Pink
                ]),
                'colors' => json_encode(['SkyBlue', 'Pink']),
                'categorie_id' => $catIds['Robes'],
            ],

            // --- HAUTS ---
            [
                'nom' => 'Chemisier en Satin Blanc',
                'description' => 'Chemisier fluide en satin pour un look professionnel et chic.',
                'qte' => 150,
                'prix_vente' => 350.00,
                'prix_achat' => 150.00,
                'reference' => 'HT-SAT-BL',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1598554747436-c9293d6a588f?auto=format&fit=crop&q=80&w=800', // White
                    'https://images.unsplash.com/photo-1585487000160-6ebcfceb0d03?auto=format&fit=crop&q=80&w=800'  // Blue
                ]),
                'colors' => json_encode(['White', 'Blue']),
                'categorie_id' => $catIds['Hauts'],
            ],
            [
                'nom' => 'Top Décolleté en Dentelle',
                'description' => 'Top noir élégant orné de dentelle fine.',
                'qte' => 100,
                'prix_vente' => 280.00,
                'prix_achat' => 120.00,
                'reference' => 'HT-DENT-NR',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?auto=format&fit=crop&q=80&w=800', // Black
                    'https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&q=80&w=800'  // White
                ]),
                'colors' => json_encode(['Black', 'White']),
                'categorie_id' => $catIds['Hauts'],
            ],

            // --- JUPES ---
            [
                'nom' => 'Jupe Plissée Midi',
                'description' => 'Jupe mi-longue plissée, couleur beige pastel.',
                'qte' => 90,
                'prix_vente' => 400.00,
                'prix_achat' => 160.00,
                'reference' => 'JP-PLIS-BG',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1582142407894-ec85a1260a46?auto=format&fit=crop&q=80&w=800', // Beige
                    'https://images.unsplash.com/photo-1582142306909-195724d33ffc?auto=format&fit=crop&q=80&w=800'  // Gray
                ]),
                'colors' => json_encode(['Beige', 'Gray']),
                'categorie_id' => $catIds['Jupes'],
            ],
            [
                'nom' => 'Jupe Courte en Cuir',
                'description' => 'Jupe noire en cuir véritable pour un style audacieux.',
                'qte' => 60,
                'prix_vente' => 650.00,
                'prix_achat' => 280.00,
                'reference' => 'JP-CUIR-NR',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1583337130417-3346a1be7dee?auto=format&fit=crop&q=80&w=800', // Black Leather
                    'https://images.unsplash.com/photo-1552874869-5c39ec9288dc?auto=format&fit=crop&q=80&w=800'  // Brown variant
                ]),
                'colors' => json_encode(['Black', 'Brown']),
                'categorie_id' => $catIds['Jupes'],
            ],

            // --- VESTES FEMME ---
            [
                'nom' => 'Blazer Cintrée Marine',
                'description' => 'Blazer élégant bleu marine avec boutons dorés.',
                'qte' => 70,
                'prix_vente' => 890.00,
                'prix_achat' => 350.00,
                'reference' => 'VS-BLAZ-MR',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?auto=format&fit=crop&q=80&w=800', // Blazer Model
                    'https://images.unsplash.com/photo-1534653299134-96a171b61581?auto=format&fit=crop&q=80&w=800'  // Alt view
                ]),
                'colors' => json_encode(['Navy', 'Grey']),
                'categorie_id' => $catIds['Vestes Femme'],
            ],
            [
                'nom' => 'Manteau en Laine Beige',
                'description' => "Manteau long et chaud en laine mélangée, parfait pour l'hiver.",
                'qte' => 45,
                'prix_vente' => 1350.00,
                'prix_achat' => 600.00,
                'reference' => 'VS-MANT-BG',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1539533018447-63fcce2678e3?auto=format&fit=crop&q=80&w=800', // Beige
                    'https://images.unsplash.com/photo-1543163521-1bf539c55dd2?auto=format&fit=crop&q=80&w=800'  // Camel
                ]),
                'colors' => json_encode(['Beige', 'BurlyWood']),
                'categorie_id' => $catIds['Vestes Femme'],
            ]
        ];

        foreach ($produits as $produit) {
            DB::table('produits')->insert(array_merge($produit, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
