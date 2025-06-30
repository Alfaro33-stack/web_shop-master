<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Frutas',
                'description' => 'Frutas frescas y de temporada para una alimentación saludable.',
                'image' => 'https://picsum.photos/400/400?random=1',
            ],
            [
                'name' => 'Verduras',
                'description' => 'Verduras frescas y orgánicas para una dieta balanceada.',
                'image' => 'https://picsum.photos/400/400?random=2',
            ],
            [
                'name' => 'Abarrotes',
                'description' => 'Productos básicos para el hogar y la cocina.',
                'image' => 'https://picsum.photos/400/400?random=3',
            ],
            [
                'name' => 'Lácteos',
                'description' => 'Productos lácteos frescos y derivados.',
                'image' => 'https://picsum.photos/400/400?random=4',
            ],
            [
                'name' => 'Carnes',
                'description' => 'Carnes frescas y procesadas de la mejor calidad.',
                'image' => 'https://picsum.photos/400/400?random=5',
            ],
            [
                'name' => 'Bebidas',
                'description' => 'Bebidas naturales, jugos y refrescos.',
                'image' => 'https://picsum.photos/400/400?random=6',
            ],
            [
                'name' => 'Panadería',
                'description' => 'Productos de panadería frescos y artesanales.',
                'image' => 'https://picsum.photos/400/400?random=7',
            ],
            [
                'name' => 'Pastelería',
                'description' => 'Pasteles, dulces y productos de repostería.',
                'image' => 'https://picsum.photos/400/400?random=8',
            ],
        ];

        foreach ($categories as $category) {
            $imageUrl = $category['image'];
            $imageName = Str::slug($category['name']) . '.jpg';
            $imagePath = public_path('images/categories/' . $imageName);

            // Asegurarse de que el directorio existe
            if (!File::exists(public_path('images/categories'))) {
                File::makeDirectory(public_path('images/categories'), 0755, true);
            }

            // Descargar y guardar la imagen
            if (!File::exists($imagePath)) {
                $imageContent = file_get_contents($imageUrl);
                File::put($imagePath, $imageContent);
            }

            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'image' => 'categories/' . $imageName,
                'active' => true,
            ]);
        }

        $this->command->info('Categorías creadas exitosamente con imágenes.');
    }
} 