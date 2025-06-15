<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->command->info('No hay categorías disponibles. Por favor, ejecute CategorySeeder primero.');
            return;
        }

        $products = [
            [
                'name' => 'Lámpara LED Moderna',
                'description' => 'Lámpara LED de diseño moderno con ajuste de intensidad y temperatura de color. Perfecta para cualquier espacio.',
                'price' => 299.99,
                'stock' => 15,
                'category_id' => $categories->where('name', 'Home')->first()->id,
                'image' => 'lampara-led-moderna.jpg'
            ],
            [
                'name' => 'Set de Sábanas Premium',
                'description' => 'Set de sábanas de algodón egipcio con 600 hilos, incluye funda de almohada y sábana bajera.',
                'price' => 199.99,
                'stock' => 20,
                'category_id' => $categories->where('name', 'Home')->first()->id,
                'image' => 'set-de-sabanas-premium.jpg'
            ],
            [
                'name' => 'Yoga Mat Premium',
                'description' => 'Alfombrilla de yoga de alta densidad con diseño antideslizante y portátil.',
                'price' => 599.99,
                'stock' => 10,
                'category_id' => $categories->where('name', 'Wellbeing')->first()->id,
                'image' => 'yoga-mat-premium.jpg'
            ],
            [
                'name' => 'Smart Watch Series 5',
                'description' => 'Reloj inteligente con seguimiento de actividad física, ritmo cardíaco y sueño.',
                'price' => 899.99,
                'stock' => 8,
                'category_id' => $categories->where('name', 'Wellbeing')->first()->id,
                'image' => 'smart-watch-series-5.jpg'
            ],
            [
                'name' => 'Laptop Ultra Pro',
                'description' => 'Laptop ultradelgada con procesador de última generación y pantalla 4K.',
                'price' => 1299.99,
                'stock' => 5,
                'category_id' => $categories->where('name', 'Technology')->first()->id,
                'image' => 'laptop-ultra-pro.jpg'
            ],
            [
                'name' => 'Smartphone XYZ Pro',
                'description' => 'Smartphone de gama alta con cámara profesional y batería de larga duración.',
                'price' => 999.99,
                'stock' => 12,
                'category_id' => $categories->where('name', 'Technology')->first()->id,
                'image' => 'smartphone-xyz-pro.jpg'
            ],
            [
                'name' => 'Juego de Ollas Antiadherentes',
                'description' => 'Set de 5 ollas antiadherentes con revestimiento cerámico y mango ergonómico.',
                'price' => 699.99,
                'stock' => 7,
                'category_id' => $categories->where('name', 'Home')->first()->id,
                'image' => 'juego-de-ollas-antiadherentes.jpg'
            ],
            [
                'name' => 'Tablet Ultra HD',
                'description' => 'Tablet de alta gama con lápiz digital y teclado incluido.',
                'price' => 799.99,
                'stock' => 9,
                'category_id' => $categories->where('name', 'Technology')->first()->id,
                'image' => 'tablet-ultra-hd.jpg'
            ],
            [
                'name' => 'Set de Meditación',
                'description' => 'Set completo para meditación incluye cojín, manta y campana tibetana.',
                'price' => 399.99,
                'stock' => 15,
                'category_id' => $categories->where('name', 'Wellbeing')->first()->id,
                'image' => 'set-de-meditacion.jpg'
            ],
            [
                'name' => 'Monitor Gaming 4K',
                'description' => 'Monitor gaming de 27" con 144Hz y tecnología G-Sync.',
                'price' => 499.99,
                'stock' => 6,
                'category_id' => $categories->where('name', 'Technology')->first()->id,
                'image' => 'monitor-gaming-4k.jpg'
            ],
            [
                'name' => 'Alfombra Decorativa',
                'description' => 'Alfombra decorativa de lana natural con diseño moderno.',
                'price' => 399.99,
                'stock' => 8,
                'category_id' => $categories->where('name', 'Home')->first()->id,
                'image' => 'alfombra-decorativa.jpg'
            ],
            [
                'name' => 'Auriculares Inalámbricos Premium',
                'description' => 'Auriculares inalámbricos con cancelación de ruido y 30 horas de batería.',
                'price' => 299.99,
                'stock' => 20,
                'category_id' => $categories->where('name', 'Technology')->first()->id,
                'image' => 'auriculares-inalambricos-premium.jpg'
            ]
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'description' => $product['description'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'category_id' => $product['category_id'],
                'image' => 'products/' . $product['image'],
                'active' => true
            ]);
        }

        $this->command->info('Productos creados exitosamente.');
    }
} 