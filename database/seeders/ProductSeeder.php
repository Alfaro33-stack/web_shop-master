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
            // Productos de Frutas
            [
                'name' => 'Manzanas Rojas',
                'description' => 'Manzanas rojas frescas y jugosas, perfectas para comer solas o en ensaladas.',
                'price' => 8.99,
                'stock' => 50,
                'category_id' => $categories->where('name', 'Frutas')->first()->id,
                'image' => 'manzanas-rojas.jpg'
            ],
            [
                'name' => 'Plátanos',
                'description' => 'Plátanos frescos y dulces, ricos en potasio y energía natural.',
                'price' => 5.99,
                'stock' => 80,
                'category_id' => $categories->where('name', 'Frutas')->first()->id,
                'image' => 'platanos.jpg'
            ],
            [
                'name' => 'Naranjas Dulces',
                'description' => 'Naranjas dulces y jugosas, fuente natural de vitamina C.',
                'price' => 6.99,
                'stock' => 60,
                'category_id' => $categories->where('name', 'Frutas')->first()->id,
                'image' => 'naranjas-dulces.jpg'
            ],

            // Productos de Verduras
            [
                'name' => 'Tomates Frescos',
                'description' => 'Tomates frescos y jugosos, perfectos para ensaladas y salsas.',
                'price' => 4.99,
                'stock' => 40,
                'category_id' => $categories->where('name', 'Verduras')->first()->id,
                'image' => 'tomates-frescos.jpg'
            ],
            [
                'name' => 'Lechuga Romana',
                'description' => 'Lechuga romana fresca y crujiente, ideal para ensaladas.',
                'price' => 3.99,
                'stock' => 30,
                'category_id' => $categories->where('name', 'Verduras')->first()->id,
                'image' => 'lechuga-romana.jpg'
            ],
            [
                'name' => 'Zanahorias Orgánicas',
                'description' => 'Zanahorias orgánicas frescas, ricas en vitamina A y fibra.',
                'price' => 5.99,
                'stock' => 45,
                'category_id' => $categories->where('name', 'Verduras')->first()->id,
                'image' => 'zanahorias-organicas.jpg'
            ],

            // Productos de Abarrotes
            [
                'name' => 'Arroz Integral',
                'description' => 'Arroz integral de grano largo, rico en fibra y nutrientes.',
                'price' => 12.99,
                'stock' => 25,
                'category_id' => $categories->where('name', 'Abarrotes')->first()->id,
                'image' => 'arroz-integral.jpg'
            ],
            [
                'name' => 'Aceite de Oliva Extra Virgen',
                'description' => 'Aceite de oliva extra virgen de primera prensada, ideal para cocinar.',
                'price' => 24.99,
                'stock' => 20,
                'category_id' => $categories->where('name', 'Abarrotes')->first()->id,
                'image' => 'aceite-oliva.jpg'
            ],
            [
                'name' => 'Frijoles Negros',
                'description' => 'Frijoles negros secos, fuente de proteína vegetal y fibra.',
                'price' => 8.99,
                'stock' => 35,
                'category_id' => $categories->where('name', 'Abarrotes')->first()->id,
                'image' => 'frijoles-negros.jpg'
            ],

            // Productos de Lácteos
            [
                'name' => 'Leche Entera',
                'description' => 'Leche entera fresca, rica en calcio y vitaminas.',
                'price' => 6.99,
                'stock' => 40,
                'category_id' => $categories->where('name', 'Lácteos')->first()->id,
                'image' => 'leche-entera.jpg'
            ],
            [
                'name' => 'Queso Fresco',
                'description' => 'Queso fresco suave y cremoso, perfecto para ensaladas.',
                'price' => 15.99,
                'stock' => 25,
                'category_id' => $categories->where('name', 'Lácteos')->first()->id,
                'image' => 'queso-fresco.jpg'
            ],
            [
                'name' => 'Yogurt Natural',
                'description' => 'Yogurt natural sin azúcar, rico en probióticos.',
                'price' => 4.99,
                'stock' => 30,
                'category_id' => $categories->where('name', 'Lácteos')->first()->id,
                'image' => 'yogurt-natural.jpg'
            ],

            // Productos de Carnes
            [
                'name' => 'Pollo Entero',
                'description' => 'Pollo entero fresco, perfecto para asar o cocinar.',
                'price' => 18.99,
                'stock' => 15,
                'category_id' => $categories->where('name', 'Carnes')->first()->id,
                'image' => 'pollo-entero.jpg'
            ],
            [
                'name' => 'Carne de Res Molida',
                'description' => 'Carne de res molida magra, ideal para hamburguesas y pastas.',
                'price' => 22.99,
                'stock' => 20,
                'category_id' => $categories->where('name', 'Carnes')->first()->id,
                'image' => 'carne-res-molida.jpg'
            ],
            [
                'name' => 'Salmón Fresco',
                'description' => 'Salmón fresco rico en omega-3, perfecto para la salud cardiovascular.',
                'price' => 35.99,
                'stock' => 10,
                'category_id' => $categories->where('name', 'Carnes')->first()->id,
                'image' => 'salmon-fresco.jpg'
            ],

            // Productos de Bebidas
            [
                'name' => 'Jugo de Naranja Natural',
                'description' => 'Jugo de naranja 100% natural, sin conservantes.',
                'price' => 7.99,
                'stock' => 25,
                'category_id' => $categories->where('name', 'Bebidas')->first()->id,
                'image' => 'jugo-naranja.jpg'
            ],
            [
                'name' => 'Agua Mineral',
                'description' => 'Agua mineral natural con minerales esenciales.',
                'price' => 2.99,
                'stock' => 100,
                'category_id' => $categories->where('name', 'Bebidas')->first()->id,
                'image' => 'agua-mineral.jpg'
            ],
            [
                'name' => 'Té Verde Orgánico',
                'description' => 'Té verde orgánico con antioxidantes naturales.',
                'price' => 9.99,
                'stock' => 30,
                'category_id' => $categories->where('name', 'Bebidas')->first()->id,
                'image' => 'te-verde.jpg'
            ],

            // Productos de Panadería
            [
                'name' => 'Pan Integral',
                'description' => 'Pan integral fresco, rico en fibra y nutrientes.',
                'price' => 5.99,
                'stock' => 40,
                'category_id' => $categories->where('name', 'Panadería')->first()->id,
                'image' => 'pan-integral.jpg'
            ],
            [
                'name' => 'Croissants Clásicos',
                'description' => 'Croissants clásicos horneados diariamente, suaves y deliciosos.',
                'price' => 3.99,
                'stock' => 25,
                'category_id' => $categories->where('name', 'Panadería')->first()->id,
                'image' => 'croissants.jpg'
            ],
            [
                'name' => 'Baguette Francesa',
                'description' => 'Baguette francesa tradicional, crujiente por fuera y suave por dentro.',
                'price' => 4.99,
                'stock' => 20,
                'category_id' => $categories->where('name', 'Panadería')->first()->id,
                'image' => 'baguette.jpg'
            ],

            // Productos de Pastelería
            [
                'name' => 'Tarta de Chocolate',
                'description' => 'Tarta de chocolate casera con cobertura de chocolate negro.',
                'price' => 28.99,
                'stock' => 8,
                'category_id' => $categories->where('name', 'Pastelería')->first()->id,
                'image' => 'tarta-chocolate.jpg'
            ],
            [
                'name' => 'Cupcakes de Vainilla',
                'description' => 'Cupcakes de vainilla con frosting de crema, decorados artísticamente.',
                'price' => 4.99,
                'stock' => 15,
                'category_id' => $categories->where('name', 'Pastelería')->first()->id,
                'image' => 'cupcakes-vainilla.jpg'
            ],
            [
                'name' => 'Galletas de Mantequilla',
                'description' => 'Galletas de mantequilla caseras, crujientes y deliciosas.',
                'price' => 12.99,
                'stock' => 30,
                'category_id' => $categories->where('name', 'Pastelería')->first()->id,
                'image' => 'galletas-mantequilla.jpg'
            ],
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