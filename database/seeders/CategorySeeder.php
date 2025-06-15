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
                'name' => 'Home',
                'description' => 'Productos para el hogar y la vida diaria.',
                'image' => 'https://picsum.photos/400/400?random=11',
            ],
            [
                'name' => 'Wellbeing',
                'description' => 'Bienestar, salud y fitness.',
                'image' => 'https://picsum.photos/400/400?random=12',
            ],
            [
                'name' => 'Technology',
                'description' => 'Tecnología y gadgets.',
                'image' => 'https://picsum.photos/400/400?random=13',
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