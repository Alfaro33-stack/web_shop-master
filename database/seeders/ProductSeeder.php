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

        // Eliminar productos anteriores de la categoría Frutas
        $frutasCategory = $categories->where('name', 'Frutas')->first();
        if ($frutasCategory) {
            Product::where('category_id', $frutasCategory->id)->delete();
        }

        // Productos de Frutas (nueva lista)
        $frutas = [
            ['name' => 'Maracuyá', 'price' => 7.59, 'unit' => 'kg'],
            ['name' => 'Lúcuma Madura', 'price' => 14.60, 'unit' => 'kg'],
            ['name' => 'Uva Roja con Pepa', 'price' => 12.60, 'unit' => 'kg'],
            ['name' => 'Mix Arándanos y Aguaymantos', 'price' => 9.90, 'unit' => 'un'],
            ['name' => 'Mix Arándanos y Frambuesa', 'price' => 9.45, 'unit' => 'un'],
            ['name' => 'Cocona', 'price' => 11.45, 'unit' => 'kg'],
            ['name' => 'Higos Negros Empacados', 'price' => 12.50, 'unit' => 'un'],
            ['name' => 'Piña Golden', 'price' => 5.20, 'unit' => 'kg'],
            ['name' => 'Uva Verde sin Pepa', 'price' => 13.99, 'unit' => 'kg'],
            ['name' => 'Aguaymanto', 'price' => 5.99, 'unit' => 'un'],
            ['name' => 'Mamey', 'price' => 14.99, 'unit' => 'kg'],
            ['name' => 'Pitahaya Roja', 'price' => 10.99, 'unit' => 'kg'],
            ['name' => 'Manzana Opal', 'price' => 10.80, 'unit' => 'kg'],
            ['name' => 'Plátano Bellaco', 'price' => 1.49, 'unit' => 'un'],
            ['name' => 'Manzana Crispy Pink', 'price' => 9.20, 'unit' => 'kg'],
            ['name' => 'Uva Verde sin Pepa', 'price' => 13.99, 'unit' => 'kg'],
            ['name' => 'Manzana Delicia', 'price' => 4.19, 'unit' => 'kg'],
            ['name' => 'Limón Tahití', 'price' => 3.90, 'unit' => 'kg'],
            ['name' => 'Manzana Nacional', 'price' => 4.50, 'unit' => 'kg'],
            ['name' => 'Tangelo Selva', 'price' => 6.40, 'unit' => 'kg'],
            ['name' => 'Carambola', 'price' => 8.70, 'unit' => 'kg'],
            ['name' => 'Mango en trozos', 'price' => 11.60, 'unit' => 'un'],
            ['name' => 'Piña madura Golden', 'price' => 15.60, 'unit' => 'un'],
            ['name' => 'Tumbo', 'price' => 8.10, 'unit' => 'un'],
            ['name' => 'Melón coquito', 'price' => 3.59, 'unit' => 'kg'],
            ['name' => 'Sandía en trozos', 'price' => 5.50, 'unit' => 'un'],
            ['name' => 'Manzana Granny Smith importada', 'price' => 9.99, 'unit' => 'kg'],
            ['name' => 'Aguaymanto orgánico', 'price' => 8.40, 'unit' => 'un'],
            ['name' => 'Naranja de jugo norte', 'price' => 5.25, 'unit' => 'kg'],
            ['name' => 'Sandía amarilla', 'price' => 2.89, 'unit' => 'kg'],
            ['name' => 'Tuna Mix', 'price' => 9.60, 'unit' => 'kg'],
            ['name' => 'Arándanos Empaque 250g', 'price' => 10.90, 'unit' => 'un'],
            ['name' => 'Plátano de Isla', 'price' => 1.29, 'unit' => 'un'],
            ['name' => 'Manzana Royal Gala importada', 'price' => 8.39, 'unit' => 'kg'],
            ['name' => 'Palta madura', 'price' => 15.00, 'unit' => 'kg'],
            ['name' => 'Pera Packhams', 'price' => 8.49, 'unit' => 'kg'],
            ['name' => 'Palta Hass', 'price' => 9.89, 'unit' => 'kg'],
            ['name' => 'Manzana Santa Rosa', 'price' => 7.40, 'unit' => 'kg'],
            ['name' => 'Piña Hawai', 'price' => 3.20, 'unit' => 'kg'],
            ['name' => 'Pitahaya', 'price' => 17.49, 'unit' => 'kg'],
            ['name' => 'Arándanos Premium Bandeja 500g', 'price' => 19.90, 'unit' => 'un'],
            ['name' => 'Plátano Biscocho', 'price' => 6.80, 'unit' => 'kg'],
            ['name' => 'Durazno Premium', 'price' => 12.90, 'unit' => 'kg'],
            ['name' => 'Manzana Israel', 'price' => 4.59, 'unit' => 'kg'],
            ['name' => 'Mandarina sin pepa', 'price' => 6.79, 'unit' => 'kg'],
            ['name' => 'Manzana Roja importada', 'price' => 8.25, 'unit' => 'kg'],
            ['name' => 'Naranja de jugo premium', 'price' => 4.49, 'unit' => 'kg'],
            ['name' => 'Papaya premium', 'price' => 5.49, 'unit' => 'kg'],
            ['name' => 'Arándanos premium Bandeja 125g', 'price' => 5.90, 'unit' => 'un'],
            ['name' => 'Palta fuerte premium', 'price' => 10.39, 'unit' => 'kg'],
            ['name' => 'Mango Kent', 'price' => 3.50, 'unit' => 'kg'],
            ['name' => 'Sandía rayada', 'price' => 1.69, 'unit' => 'kg'],
            ['name' => 'Granadilla premium', 'price' => 1.49, 'unit' => 'un'],
            ['name' => 'Limón sutil', 'price' => 4.39, 'unit' => 'kg'],
            ['name' => 'Plátano de seda extra', 'price' => 3.59, 'unit' => 'kg'],
        ];
        $frutasProductos = [];
        foreach ($frutas as $i => $fruta) {
            $frutasProductos[] = [
                'name' => $fruta['name'],
                'slug' => Str::slug($fruta['name']) . '-' . ($i+1),
                'description' => 'Deliciosa ' . strtolower($fruta['name']) . ' fresca, seleccionada y de la mejor calidad. Ideal para tu mesa y recetas saludables.',
                'price' => $fruta['price'],
                'stock' => rand(20, 100),
                'category_id' => $frutasCategory ? $frutasCategory->id : 1,
                'image' => 'products/fruta' . ($i+1) . '.png',
                'active' => true
            ];
        }
        // Insertar los productos de frutas
        foreach ($frutasProductos as $producto) {
            Product::create($producto);
        }

        // Eliminar productos anteriores de la categoría Verduras
        $verdurasCategory = $categories->where('name', 'Verduras')->first();
        if ($verdurasCategory) {
            Product::where('category_id', $verdurasCategory->id)->delete();
        }

        // Productos de Verduras (nueva lista con imágenes exactas según el usuario)
        $verduras = [
            ['name' => 'Pepinillo', 'price' => 2.99, 'unit' => 'kg', 'image' => 'verdura1.png'],
            ['name' => 'Zanahoria', 'price' => 3.99, 'unit' => 'kg', 'image' => 'verdura2.png'],
            ['name' => 'Lechuga Americana', 'price' => 2.69, 'unit' => 'un', 'image' => 'verdura3.png'],
            ['name' => 'Espinaca 400g', 'price' => 6.29, 'unit' => 'un', 'image' => 'verdura4.png'],
            ['name' => 'Apio', 'price' => 4.99, 'unit' => 'un', 'image' => 'verdura5.png'],
            ['name' => 'Lechuga Crespa', 'price' => 2.49, 'unit' => 'un', 'image' => 'verdura6.png'],
            ['name' => 'Vainita Americana', 'price' => 6.90, 'unit' => 'kg', 'image' => 'verdura7.png'],
            ['name' => 'Cebolla Roja', 'price' => 3.29, 'unit' => 'kg', 'image' => 'verdura8.png'],
            ['name' => 'Brócoli', 'price' => 7.89, 'unit' => 'kg', 'image' => 'verdura9.png'],
            ['name' => 'Ají Amarillo', 'price' => 8.30, 'unit' => 'kg', 'image' => 'verdura10.png'],
            ['name' => 'Pimiento Morrón', 'price' => 14.19, 'unit' => 'kg', 'image' => 'verdura11.png'],
            ['name' => 'Zapallo Italiano', 'price' => 2.49, 'unit' => 'un', 'image' => 'verdura12.png'],
            ['name' => 'Cebollita China', 'price' => 2.49, 'unit' => 'un', 'image' => 'verdura13.png'],
            ['name' => 'Maíz Morado', 'price' => 8.90, 'unit' => 'kg', 'image' => 'verdura14.png'],
            ['name' => 'Culantro Manantiales x 60g', 'price' => 2.09, 'unit' => 'un', 'image' => 'verdura15.png'],
            ['name' => 'Cebolla Blanca', 'price' => 3.29, 'unit' => 'kg', 'image' => 'verdura17.png'],
            ['name' => 'Ajo Entero sin Pelar', 'price' => 22.90, 'unit' => 'kg', 'image' => 'verdura18.png'],
            ['name' => 'Kion', 'price' => 12.90, 'unit' => 'kg', 'image' => 'verdura19.png'],
            ['name' => 'Poro', 'price' => 2.49, 'unit' => 'un', 'image' => 'verdura20.png'],
            ['name' => 'Perejil', 'price' => 1.29, 'unit' => 'un', 'image' => 'verdura21.png'],
            ['name' => 'Arveja Americana', 'price' => 11.90, 'unit' => 'kg', 'image' => 'verdura22.png'],
            ['name' => 'Coliflor', 'price' => 7.99, 'unit' => 'un', 'image' => 'verdura23.png'],
            ['name' => 'Lechuga Hidropónica', 'price' => 4.65, 'unit' => 'un', 'image' => 'verdura24.png'],
            ['name' => 'Albahaca', 'price' => 4.50, 'unit' => 'un', 'image' => 'verdura25.png'],
            ['name' => 'Cebolla Roja Orgánica', 'price' => 6.40, 'unit' => 'kg', 'image' => 'verdura26.png'],
            ['name' => 'Arvejita Bandeja 200g', 'price' => 10.90, 'unit' => 'un', 'image' => 'verdura27.png'],
            ['name' => 'Lechuga Seda', 'price' => 3.60, 'unit' => 'un', 'image' => 'verdura28.png'],
            ['name' => 'Mix Lechuga Crespa', 'price' => 3.50, 'unit' => 'un', 'image' => 'verdura29.png'],
            ['name' => 'Espinaca Baby Deshojada', 'price' => 6.90, 'unit' => 'un', 'image' => 'verdura30.png'],
            ['name' => 'Rabanito', 'price' => 5.90, 'unit' => 'un', 'image' => 'verdura31.png'],
            ['name' => 'Rocoto', 'price' => 2.49, 'unit' => 'un', 'image' => 'verdura32.png'],
            ['name' => 'Caihua', 'price' => 1.29, 'unit' => 'un', 'image' => 'verdura33.png'],
            ['name' => 'Lechuga Crespa', 'price' => 3.20, 'unit' => 'un', 'image' => 'verdura34.png'],
            ['name' => 'Cebolla Blanca Orgánica', 'price' => 6.40, 'unit' => 'kg', 'image' => 'verdura35.png'],
            ['name' => 'Esparragos 250 g', 'price' => 7.30, 'unit' => 'un', 'image' => 'verdura36.png'],
            ['name' => 'Mix de col y zanahoria en juliana', 'price' => 4.79, 'unit' => 'un', 'image' => 'verdura37.png'],
            ['name' => 'Col corazón en mitad', 'price' => 4.90, 'unit' => 'un', 'image' => 'verdura38.png'],
            ['name' => 'Esparragos 450g', 'price' => 13.60, 'unit' => 'un', 'image' => 'verdura39.png'],
            ['name' => 'Verduras para sopa mixta', 'price' => 6.80, 'unit' => 'un', 'image' => 'verdura40.png'],
            ['name' => 'Pimiento verde', 'price' => 17.90, 'unit' => 'kg', 'image' => 'verdura41.png'],
            ['name' => 'Masa de wantan', 'price' => 5.50, 'unit' => 'un', 'image' => 'verdura43.png'],
            ['name' => 'Berenjena', 'price' => 2.49, 'unit' => 'un', 'image' => 'verdura44.png'],
            ['name' => 'Alcachofa', 'price' => 3.90, 'unit' => 'un', 'image' => 'verdura45.png'],
            ['name' => 'Verduras para arroz con pollo', 'price' => 7.50, 'unit' => 'un', 'image' => 'verdura46.png'],
            ['name' => 'Brócoli floretes', 'price' => 5.50, 'unit' => 'un', 'image' => 'verdura47.png'],
            ['name' => 'Pepinillo holandés hidropónico', 'price' => 4.20, 'unit' => 'un', 'image' => 'verdura48.png'],
            ['name' => 'Zanahoria orgánica', 'price' => 5.50, 'unit' => 'kg', 'image' => 'verdura49.png'],
            ['name' => 'Ensalada mix Personal', 'price' => 5.50, 'unit' => 'un', 'image' => 'verdura50.png'],
            ['name' => 'Cebolla picada', 'price' => 6.50, 'unit' => 'un', 'image' => 'verdura51.png'],
            ['name' => 'Fideos Chinos especiales', 'price' => 5.50, 'unit' => 'un', 'image' => 'verdura52.png'],
            ['name' => 'Acelga', 'price' => 4.90, 'unit' => 'un', 'image' => 'verdura53.png'],
            ['name' => 'Albahaca deshojada', 'price' => 6.80, 'unit' => 'un', 'image' => 'verdura54.png'],
            ['name' => 'Caihua chilena', 'price' => 2.99, 'unit' => 'un', 'image' => 'verdura55.png'],
            ['name' => 'Verduras para aguadito', 'price' => 7.40, 'unit' => 'un', 'image' => 'verdura56.png'],
            ['name' => 'Pepinillo holandés orgánico', 'price' => 5.80, 'unit' => 'un', 'image' => 'verdura57.png'],
            ['name' => 'Acelga hidropónico 500g', 'price' => 2.79, 'unit' => 'un', 'image' => 'verdura58.png'],
            ['name' => 'Arúgula 160g', 'price' => 6.30, 'unit' => 'un', 'image' => 'verdura59.png'],
            ['name' => 'Ensalada mix con espinaca', 'price' => 5.90, 'unit' => 'un', 'image' => 'verdura60.png'],
            ['name' => 'Lechuga Morada 200g', 'price' => 3.40, 'unit' => 'un', 'image' => 'verdura61.png'],
            ['name' => 'Apio entero', 'price' => 4.50, 'unit' => 'un', 'image' => 'verdura62.png'],
        ];
        $verdurasProductos = [];
        foreach ($verduras as $i => $verdura) {
            $verdurasProductos[] = [
                'name' => $verdura['name'],
                'slug' => Str::slug($verdura['name']) . '-' . ($i+1),
                'description' => 'Fresca ' . strtolower($verdura['name']) . ' seleccionada y de la mejor calidad. Ideal para tu mesa y recetas saludables.',
                'price' => $verdura['price'],
                'stock' => rand(20, 100),
                'category_id' => $verdurasCategory ? $verdurasCategory->id : 1,
                'image' => 'products/' . $verdura['image'],
                'active' => true
            ];
        }
        // Insertar los productos de verduras
        foreach ($verdurasProductos as $producto) {
            Product::create($producto);
        }

        // Eliminar productos anteriores de la categoría Abarrotes
        $abarrotesCategory = $categories->where('name', 'Abarrotes')->first();
        if ($abarrotesCategory) {
            Product::where('category_id', $abarrotesCategory->id)->delete();
        }

        // Productos de Abarrotes (nueva lista)
        $abarrotes = [
            ['name' => 'Aceite Vegetal 900ml', 'price' => 6.90, 'unit' => 'un'],
            ['name' => 'Arroz Extra 5kg', 'price' => 23.40, 'unit' => 'un'],
            ['name' => 'Fideo Cabello de Ángel 250g', 'price' => 1.70, 'unit' => 'un'],
            ['name' => 'Lenteja Bebé Menestra 500g', 'price' => 5.70, 'unit' => 'un'],
            ['name' => 'Maíz Pop Corn Menestra 1kg', 'price' => 7.40, 'unit' => 'un'],
            ['name' => 'Fideos Caracol 250g', 'price' => 1.70, 'unit' => 'un'],
            ['name' => 'Arveja Partida Menestra 500g', 'price' => 4.00, 'unit' => 'un'],
            ['name' => 'Trigo Mote Menestra 500g', 'price' => 4.60, 'unit' => 'un'],
            ['name' => 'Mostaza 220g', 'price' => 3.60, 'unit' => 'un'],
            ['name' => 'Aceite de Oliva Extra Virgen 500ml', 'price' => 36.90, 'unit' => 'un'],
            ['name' => 'Fideos Corbata 250g', 'price' => 1.70, 'unit' => 'un'],
            ['name' => 'Macaroni & Cheese 226g', 'price' => 4.90, 'unit' => 'un'],
            ['name' => 'Arroz Extra Añejo 750g', 'price' => 4.30, 'unit' => 'un'],
            ['name' => 'Vinagre Blanco Botella 500 mL', 'price' => 3.30, 'unit' => 'un'],
            ['name' => 'Huancaína 85g', 'price' => 2.90, 'unit' => 'un'],
            ['name' => 'Ajonjolí 20g', 'price' => 2.10, 'unit' => 'un'],
            ['name' => 'Fettuccine 500g', 'price' => 5.40, 'unit' => 'un'],
            ['name' => 'Aceite Vegetal Botella 5L', 'price' => 33.60, 'unit' => 'un'],
            ['name' => 'Mayonesa 475g', 'price' => 9.10, 'unit' => 'un'],
            ['name' => 'Aceite Orgánico de Coco Extra Virgen 300 mL', 'price' => 21.90, 'unit' => 'un'],
            ['name' => 'Romero 10g', 'price' => 2.50, 'unit' => 'un'],
            ['name' => 'Arroz Superior 750g', 'price' => 3.75, 'unit' => 'un'],
            ['name' => 'Arroz Integral 5kg', 'price' => 23.90, 'unit' => 'un'],
            ['name' => 'Aceite de Oliva Extra Virgen 2L', 'price' => 102.90, 'unit' => 'un'],
            ['name' => 'Salsa BBQ Picante 510g', 'price' => 9.90, 'unit' => 'un'],
            ['name' => 'Quinua Menestra 1kg', 'price' => 17.80, 'unit' => 'un'],
            ['name' => 'Duraznos en Mitades 820g', 'price' => 9.90, 'unit' => 'un'],
            ['name' => 'Canela Entera 5g', 'price' => 2.10, 'unit' => 'un'],
            ['name' => 'Harina Sin Preparar 1kg', 'price' => 6.90, 'unit' => 'un'],
            ['name' => 'Clavo Entero 10g', 'price' => 2.90, 'unit' => 'un'],
            ['name' => 'Pasta de Ají Panca 205g', 'price' => 5.40, 'unit' => 'un'],
            ['name' => 'Vinagre Tinto Botella 500 mL', 'price' => 3.30, 'unit' => 'un'],
            ['name' => 'Ketchup 100g', 'price' => 2.10, 'unit' => 'un'],
            ['name' => 'Pasta de Ají Amarillo 205g', 'price' => 5.60, 'unit' => 'un'],
            ['name' => 'Frijol Negro Menestra 500g', 'price' => 6.50, 'unit' => 'un'],
            ['name' => 'Frijol Canario Menestra 500g', 'price' => 7.70, 'unit' => 'un'],
            ['name' => 'Sal de Maras Gruesa Molinillo 100g', 'price' => 15.20, 'unit' => 'un'],
            ['name' => 'Aceite de Soya 900 mL', 'price' => 6.10, 'unit' => 'un'],
            ['name' => 'Frijol con Tocino 425g', 'price' => 7.80, 'unit' => 'un'],
            ['name' => 'Ajos en Polvo 50g', 'price' => 7.00, 'unit' => 'un'],
            ['name' => 'Hongos Secos 10g', 'price' => 2.00, 'unit' => 'un'],
            ['name' => 'Pimienta Blanca Molida 60g', 'price' => 8.00, 'unit' => 'un'],
            ['name' => 'Vinagre de Manzana 500mL', 'price' => 8.30, 'unit' => 'un'],
            ['name' => 'Pasta Linguini Bolsa 950g', 'price' => 5.40, 'unit' => 'un'],
            ['name' => 'Sémola 200g', 'price' => 1.10, 'unit' => 'un'],
            ['name' => 'Garbanzos Menestra 500g', 'price' => 7.20, 'unit' => 'un'],
            ['name' => 'Sólido de Atún en Aceite 140g', 'price' => 5.80, 'unit' => 'un'],
            ['name' => 'Aceituna Botija sin Pepa 240g', 'price' => 11.30, 'unit' => 'un'],
            ['name' => 'Pallar con Tocino 425g', 'price' => 7.80, 'unit' => 'un'],
            ['name' => 'Laurel Entero 7g', 'price' => 2.50, 'unit' => 'un'],
            ['name' => 'Vinagreta Clásica Light 237g', 'price' => 4.90, 'unit' => 'un'],
            ['name' => 'Puré de Papas 125g', 'price' => 4.20, 'unit' => 'un'],
            ['name' => 'Mostaza Dulce y Picante 280g', 'price' => 9.90, 'unit' => 'un'],
            ['name' => 'Salsa Blanca en Polvo 36g', 'price' => 2.00, 'unit' => 'un'],
            ['name' => 'Fideos Fusilli 500g', 'price' => 5.40, 'unit' => 'un'],
            ['name' => 'Sillao 500 mL', 'price' => 3.90, 'unit' => 'un'],
            ['name' => 'Salsa de Rocoto Molido 370g', 'price' => 8.90, 'unit' => 'un'],
            ['name' => 'Vinagreta Italiana 240g', 'price' => 4.90, 'unit' => 'un'],
        ];
        $abarrotesProductos = [];
        foreach ($abarrotes as $i => $abarrote) {
            $abarrotesProductos[] = [
                'name' => $abarrote['name'],
                'slug' => Str::slug($abarrote['name']) . '-' . ($i+1),
                'description' => 'Producto de abarrotes: ' . strtolower($abarrote['name']) . '. Calidad garantizada para tu despensa.',
                'price' => $abarrote['price'],
                'stock' => rand(20, 100),
                'category_id' => $abarrotesCategory ? $abarrotesCategory->id : 1,
                'image' => 'products/abarrote' . ($i+1) . '.png',
                'active' => true
            ];
        }
        // Insertar los productos de abarrotes
        foreach ($abarrotesProductos as $producto) {
            Product::create($producto);
        }

        // Eliminar productos anteriores de la categoría Lácteos
        $lacteosCategory = $categories->where('name', 'Lácteos')->first();
        if ($lacteosCategory) {
            Product::where('category_id', $lacteosCategory->id)->delete();
        }

        // Productos de Lácteos (nueva lista)
        $lacteos = [
            ['name' => 'Manteqilla pote 390g', 'price' => 21.50, 'unit' => 'un'],
            ['name' => 'Yogurt parcialmente descremado sabor fresa botella 1.7kg', 'price' => 10.80, 'unit' => 'un'],
            ['name' => 'Queso Edam 180g', 'price' => 10.95, 'unit' => 'un'],
            ['name' => 'Mezcla láctea cremosita 6 pack', 'price' => 24.00, 'unit' => 'un'],
            ['name' => 'Mezcla sin lactosa 480g x6', 'price' => 23.40, 'unit' => 'un'],
            ['name' => 'Leche UHT light 3x1L', 'price' => 16.50, 'unit' => 'un'],
            ['name' => 'Mantequilla con sal 180g', 'price' => 12.90, 'unit' => 'un'],
            ['name' => 'Queso crema 180g', 'price' => 12.50, 'unit' => 'un'],
            ['name' => 'Yogurt vainilla 1.7kg', 'price' => 10.80, 'unit' => 'un'],
            ['name' => 'Queso Gouda 180g', 'price' => 10.95, 'unit' => 'un'],
            ['name' => 'Yogurt Yoleit Slim 1.7kg', 'price' => 10.80, 'unit' => 'un'],
            ['name' => 'Mezcla Bonlé 6 pack 480g', 'price' => 22.20, 'unit' => 'un'],
            ['name' => 'Mozzarella Bonlé', 'price' => 13.50, 'unit' => 'un'],
            ['name' => 'Yogur Yoleit Fresa 1.7kg', 'price' => 10.80, 'unit' => 'un'],
            ['name' => 'Mezcla Láctea Light 6 pack', 'price' => 21.90, 'unit' => 'un'],
            ['name' => 'Mantequilla con sal', 'price' => 6.90, 'unit' => 'un'],
            ['name' => 'Yogurt Durazno 1.7kg', 'price' => 10.80, 'unit' => 'un'],
            ['name' => 'Yogurt Griego Frutos del Bosque 1kg', 'price' => 14.50, 'unit' => 'un'],
            ['name' => 'Leche Semidescremada 800 mL', 'price' => 4.50, 'unit' => 'un'],
            ['name' => 'Queso Edam Bonlé 500g', 'price' => 24.50, 'unit' => 'un'],
            ['name' => 'Margarina Barra 200g', 'price' => 4.50, 'unit' => 'un'],
            ['name' => 'Yogurt Skyr 500g', 'price' => 17.70, 'unit' => 'un'],
            ['name' => 'Margarina Clásica 300g', 'price' => 5.60, 'unit' => 'un'],
            ['name' => 'Yogurt Griego Natural 1kg', 'price' => 14.50, 'unit' => 'un'],
            ['name' => 'Bebida de Almendra sin Azúcar 946mL', 'price' => 12.50, 'unit' => 'un'],
            ['name' => 'Leche Reconstituida 170g x6', 'price' => 12.90, 'unit' => 'un'],
            ['name' => 'Bebida de Chocolate 800mL', 'price' => 3.45, 'unit' => 'un'],
            ['name' => 'Tri Pack Leche 900mL', 'price' => 15.20, 'unit' => 'un'],
            ['name' => 'Margarina Untable', 'price' => 7.90, 'unit' => 'un'],
            ['name' => 'Queso Mozzarella Bola 240g', 'price' => 12.90, 'unit' => 'un'],
            ['name' => 'Mezcla Láctea Amanecer 390g x6', 'price' => 20.80, 'unit' => 'un'],
            ['name' => 'Yogurt Aguaymanto 900g', 'price' => 11.90, 'unit' => 'un'],
            ['name' => 'Yogurt Griego Frutos Rojos 800g', 'price' => 7.90, 'unit' => 'un'],
            ['name' => 'Yogurt Frutado Bosque 900g', 'price' => 12.00, 'unit' => 'un'],
            ['name' => 'Chocolate UHT 800mL', 'price' => 3.35, 'unit' => 'un'],
            ['name' => 'Queso Parmesano 35g', 'price' => 4.70, 'unit' => 'un'],
            ['name' => 'Leche Evaporada 410g', 'price' => 4.00, 'unit' => 'un'],
            ['name' => 'Queso Fresco kg', 'price' => 30.90, 'unit' => 'kg'],
            ['name' => 'Yogurt Griego Natural 420g', 'price' => 12.79, 'unit' => 'un'],
            ['name' => 'Yogurt Griego 240g', 'price' => 12.79, 'unit' => 'un'],
            ['name' => 'Leche Light Sin Lactosa 390g x6', 'price' => 24.40, 'unit' => 'un'],
            ['name' => 'Yogurt con Fresa 1.7kg', 'price' => 11.50, 'unit' => 'un'],
            ['name' => 'Yogurt Griego Frutos Rojos 120g', 'price' => 2.20, 'unit' => 'un'],
            ['name' => 'Leche Sin Lactosa 900mL', 'price' => 4.80, 'unit' => 'un'],
            ['name' => 'Yogurt Battishake Fresa 120g', 'price' => 1.67, 'unit' => 'un'],
            ['name' => 'Biodefensa Fresa/Frambuesa', 'price' => 6.20, 'unit' => 'un'],
            ['name' => 'Yogurt Natural 900g', 'price' => 12.00, 'unit' => 'un'],
            ['name' => 'Queso Parmesano Rallado 35g', 'price' => 5.20, 'unit' => 'un'],
            ['name' => 'Yogurt Fresa Vaso Yopi 80g', 'price' => 0.90, 'unit' => 'un'],
            ['name' => 'Crema de Leche UHT 200mL', 'price' => 8.95, 'unit' => 'un'],
            ['name' => 'Leche Chocolatada 1L', 'price' => 6.20, 'unit' => 'un'],
            ['name' => 'Queso Fresco Sbelt kg', 'price' => 33.51, 'unit' => 'kg'],
        ];
        $lacteosProductos = [];
        foreach ($lacteos as $i => $lacteo) {
            $lacteosProductos[] = [
                'name' => $lacteo['name'],
                'slug' => Str::slug($lacteo['name']) . '-' . ($i+1),
                'description' => 'Producto lácteo: ' . strtolower($lacteo['name']) . '. Frescura y calidad para tu mesa.',
                'price' => $lacteo['price'],
                'stock' => rand(20, 100),
                'category_id' => $lacteosCategory ? $lacteosCategory->id : 1,
                'image' => 'products/lacteos' . ($i+1) . '.png',
                'active' => true
            ];
        }
        // Insertar los productos de lácteos
        foreach ($lacteosProductos as $producto) {
            Product::create($producto);
        }

        // Eliminar productos anteriores de la categoría Carnes
        $carnesCategory = $categories->where('name', 'Carnes')->first();
        if ($carnesCategory) {
            Product::where('category_id', $carnesCategory->id)->delete();
        }

        // Productos de Carnes (nueva lista)
        $carnes = [
            ['name' => 'Carne molida de res corte clásico', 'price' => 14.90, 'unit' => 'un'],
            ['name' => 'Pollos fresco con menudencia', 'price' => 9.40, 'unit' => 'kg'],
            ['name' => 'Bisteck molido de res corte clásico', 'price' => 18.90, 'unit' => 'un'],
            ['name' => 'Bisteck', 'price' => 39.90, 'unit' => 'kg'],
            ['name' => 'Pollo entero trozado', 'price' => 11.90, 'unit' => 'kg'],
            ['name' => 'Saltadito de cerdo', 'price' => 8.90, 'unit' => 'un'],
            ['name' => 'Pechuga especial de pollo', 'price' => 17.50, 'unit' => 'kg'],
            ['name' => 'Guiso económico', 'price' => 34.90, 'unit' => 'kg'],
            ['name' => 'Guiso especial', 'price' => 39.90, 'unit' => 'kg'],
            ['name' => 'Hígado de res', 'price' => 13.90, 'unit' => 'kg'],
            ['name' => 'Muslo de pollo congelado', 'price' => 16.50, 'unit' => 'kg'],
            ['name' => 'Pechuga con ala de pollo congelado', 'price' => 16.90, 'unit' => 'kg'],
            ['name' => 'Chuleta parrilla de cerdo', 'price' => 22.50, 'unit' => 'kg'],
            ['name' => 'Pechuga de pavita congelada en trozos', 'price' => 17.90, 'unit' => 'kg'],
            ['name' => 'Churrasco aguja de res', 'price' => 36.90, 'unit' => 'kg'],
            ['name' => 'Bisteck cadera', 'price' => 54.90, 'unit' => 'kg'],
            ['name' => 'Pollo entero sin menudencia', 'price' => 11.90, 'unit' => 'kg'],
            ['name' => 'Brazuelo en rodajas de pavita', 'price' => 14.50, 'unit' => 'kg'],
            ['name' => '- Pack ahorrador hígado de pollo', 'price' => 8.90, 'unit' => 'kg'],
            ['name' => 'Filete de pechuga de pollo corte mariposa congelado', 'price' => 24.90, 'unit' => 'kg'],
            ['name' => 'Chuleta de pierna de cerdo', 'price' => 21.90, 'unit' => 'kg'],
            ['name' => 'Medallón de pavita', 'price' => 22.90, 'unit' => 'kg'],
            ['name' => 'Carne molida de cerdo', 'price' => 10.90, 'unit' => 'un'],
            ['name' => 'Pack ahorrador mollejitas de pollo', 'price' => 13.90, 'unit' => 'kg'],
            ['name' => 'Sangrecita criolla', 'price' => 6.40, 'unit' => 'un'],
            ['name' => 'Ossobuco de res', 'price' => 25.90, 'unit' => 'kg'],
            ['name' => 'Milanesa de pollo', 'price' => 24.90, 'unit' => 'kg'],
            ['name' => 'Chuleta de lomo de cerdo', 'price' => 21.90, 'unit' => 'kg'],
            ['name' => 'Pierna de pollo congelado', 'price' => 15.90, 'unit' => 'kg'],
            ['name' => 'Pack ahorrador alitas de pollo', 'price' => 14.90, 'unit' => 'kg'],
            ['name' => 'Pollo fresco entero sin menudencia', 'price' => 11.90, 'unit' => 'kg'],
            ['name' => 'Malaya', 'price' => 36.90, 'unit' => 'kg'],
            ['name' => 'Mondongo corte cau cau', 'price' => 7.90, 'unit' => 'un'],
            ['name' => 'Panceta sin piel de cerdo', 'price' => 36.90, 'unit' => 'kg'],
            ['name' => 'Chanfainita congelada', 'price' => 6.50, 'unit' => 'un'],
            ['name' => 'Mondongo corte italiano', 'price' => 7.90, 'unit' => 'un'],
            ['name' => 'Bisteck Molido', 'price' => 34.90, 'unit' => 'kg'],
            ['name' => 'Suprema de pollo', 'price' => 22.90, 'unit' => 'kg'],
            ['name' => 'Sancochado de res', 'price' => 24.90, 'unit' => 'kg'],
            ['name' => 'Asado pejerrey en mitades', 'price' => 44.90, 'unit' => 'kg'],
            ['name' => 'Alitas de pavita', 'price' => 14.90, 'unit' => 'kg'],
            ['name' => 'Chuleta de punta de lomo', 'price' => 16.50, 'unit' => 'kg'],
            ['name' => 'Pack ahorrador patitas de pollo', 'price' => 7.90, 'unit' => 'kg'],
            ['name' => 'Asado de tira con hueso', 'price' => 36.90, 'unit' => 'kg'],
            ['name' => 'Chuleta de pavita', 'price' => 28.90, 'unit' => 'kg'],
            ['name' => 'Pierna de cerdo sin piel y sin hueso', 'price' => 24.90, 'unit' => 'kg'],
            ['name' => 'Pack ahorrador corazón de pollo', 'price' => 12.90, 'unit' => 'kg'],
            ['name' => 'Churrasco largo', 'price' => 36.90, 'unit' => 'kg'],
            ['name' => 'Lomo fino nacional', 'price' => 94.90, 'unit' => 'kg'],
            ['name' => 'Tomahawk steak de res corte especial', 'price' => 59.90, 'unit' => 'kg'],
            ['name' => 'Sangrecita sin condimentos', 'price' => 5.90, 'unit' => 'un'],
            ['name' => 'Bife ancho de res corte clásico', 'price' => 52.90, 'unit' => 'kg'],
            ['name' => 'Pernil de cerdo', 'price' => 18.90, 'unit' => 'kg'],
            ['name' => 'Lomo fino medallones', 'price' => 99.90, 'unit' => 'kg'],
            ['name' => 'Hamburguesa de res', 'price' => 21.90, 'unit' => 'un'],
            ['name' => 'Bife angosto de res corte clásico', 'price' => 52.90, 'unit' => 'kg'],
            ['name' => 'Brazuelo de cerdo', 'price' => 21.90, 'unit' => 'kg'],
            ['name' => 'Hamburguesa la redondita de pollo', 'price' => 13.90, 'unit' => 'un'],
            ['name' => 'Chorizo miel de maple 400g', 'price' => 16.50, 'unit' => 'un'],
            ['name' => 'Chorizo parrillero 500g', 'price' => 17.50, 'unit' => 'un'],
            ['name' => 'Filete de trucha fresca x kg', 'price' => 49.90, 'unit' => 'kg'],
            ['name' => 'Chorizo finas hierbas empaque 400g', 'price' => 16.90, 'unit' => 'un'],
            ['name' => 'Trucha entera eviscerada congelada', 'price' => 25.90, 'unit' => 'un'],
            ['name' => 'Chorizo aleman precocido salchichería alemana 500g', 'price' => 18.90, 'unit' => 'un'],
            ['name' => 'Nuggets de tilapia marina', 'price' => 19.90, 'unit' => 'un'],
        ];
        $carnesProductos = [];
        foreach ($carnes as $i => $carne) {
            $carnesProductos[] = [
                'name' => $carne['name'],
                'slug' => Str::slug($carne['name']) . '-' . ($i+1),
                'description' => 'Producto cárnico: ' . strtolower($carne['name']) . '. Calidad y frescura para tu mesa.',
                'price' => $carne['price'],
                'stock' => rand(20, 100),
                'category_id' => $carnesCategory ? $carnesCategory->id : 1,
                'image' => 'products/carne' . ($i+1) . '.png',
                'active' => true
            ];
        }
        // Insertar los productos de carnes
        foreach ($carnesProductos as $producto) {
            Product::create($producto);
        }

        // Eliminar productos anteriores de la categoría Bebidas
        $bebidasCategory = $categories->where('name', 'Bebidas')->first();
        if ($bebidasCategory) {
            Product::where('category_id', $bebidasCategory->id)->delete();
        }

        // Productos de Bebidas (nueva lista)
        $bebidas = [
            ['name' => 'Coca cola Six pack gaseosa sin azucar 300 mL', 'price' => 10.00, 'unit' => 'un'],
            ['name' => 'Coca cola + inca kola pack x 2unid 3L', 'price' => 21.70, 'unit' => 'un'],
            ['name' => 'Inca kola Six pack gaseosa sin azucar 300 mL', 'price' => 10.00, 'unit' => 'un'],
            ['name' => 'Coca cola tripack gaseosa + inca cola + fanta 3L', 'price' => 27.70, 'unit' => 'un'],
            ['name' => 'Fanta tripack gaseosas naranja kola inglesa y sprite x 3unid', 'price' => 18.90, 'unit' => 'un'],
            ['name' => 'Zero pack x2 Unid 1.5L', 'price' => 12.90, 'unit' => 'un'],
            ['name' => 'Six pack gaseosa lima limon 500 mL x6 Unid', 'price' => 13.50, 'unit' => 'un'],
            ['name' => 'Six pack gaseosa zero sin azucar 500 mL x6 Unid', 'price' => 15.50, 'unit' => 'un'],
            ['name' => 'Sprite gaseosa sin azucar 500 mL', 'price' => 2.70, 'unit' => 'un'],
            ['name' => 'Coca cola gaseosa 500 mL', 'price' => 3.00, 'unit' => 'un'],
            ['name' => 'Cola roja fresh 1.5 L', 'price' => 3.90, 'unit' => 'un'],
            ['name' => 'Guarana gaseosa guarana 3L', 'price' => 7.90, 'unit' => 'un'],
            ['name' => 'Cola negra fresh 3L', 'price' => 5.50, 'unit' => 'un'],
            ['name' => 'Lata 355 mL', 'price' => 5.50, 'unit' => 'un'],
            ['name' => 'Sprite gaseosa 3L', 'price' => 7.00, 'unit' => 'un'],
            ['name' => 'Guarana gaseosa 450 mL', 'price' => 2.50, 'unit' => 'un'],
            ['name' => 'Pepsi gaseosa cola 1.5 L', 'price' => 5.50, 'unit' => 'un'],
            ['name' => 'Pepsi gaseosa cola 600 mL', 'price' => 2.50, 'unit' => 'un'],
            ['name' => 'Pepsi gaseosa cola 1 L', 'price' => 3.50, 'unit' => 'un'],
            ['name' => 'Pepsi gaseosa cola 2 L', 'price' => 4.50, 'unit' => 'un'],
            ['name' => 'Inca kola two pack 1L', 'price' => 8.70, 'unit' => 'un'],
            ['name' => 'Pepsi two pack cola gaseosa 3L', 'price' => 16.90, 'unit' => 'un'],
            ['name' => 'Pepsi two pack gaseosas cola + 7Up 3L', 'price' => 14.90, 'unit' => 'un'],
            ['name' => 'Coca cola gaseosa pack 2 Unid 3L', 'price' => 21.70, 'unit' => 'un'],
            ['name' => 'Inca kola gaseosa pack 2 Unid 3L', 'price' => 21.70, 'unit' => 'un'],
            ['name' => 'Agua mineral sin gas bidón 20L', 'price' => 25.90, 'unit' => 'un'],
            ['name' => 'Agua alcalina 650 mL', 'price' => 1.90, 'unit' => 'un'],
            ['name' => 'Agua mineral sin gas 600 mL', 'price' => 2.20, 'unit' => 'un'],
            ['name' => 'Agua manzana 500mL', 'price' => 2.00, 'unit' => 'un'],
            ['name' => 'San Luis Agua mineral con gas 2.5L', 'price' => 3.20, 'unit' => 'un'],
            ['name' => 'Agua pera 500mL', 'price' => 2.30, 'unit' => 'un'],
            ['name' => 'Bebida rosada gasificada de toronja 200mL', 'price' => 6.50, 'unit' => 'un'],
            ['name' => 'Agua 2.5L six pack', 'price' => 16.20, 'unit' => 'un'],
            ['name' => 'Cielo Agua mineral sin gas 2.5L', 'price' => 2.90, 'unit' => 'un'],
            ['name' => 'Fourpack tónica light 200mL', 'price' => 23.90, 'unit' => 'un'],
            ['name' => 'Bebida con esencia kion sabor piña 625 mL', 'price' => 2.20, 'unit' => 'un'],
            ['name' => 'San Luis Agua mineral sin gas 2.5L', 'price' => 3.90, 'unit' => 'un'],
            ['name' => 'San Carlos sin gas x 20 Unid', 'price' => 13.90, 'unit' => 'un'],
            ['name' => 'San Mateo agua sin gas pack x 6 Unid 600 mL', 'price' => 11.20, 'unit' => 'un'],
            ['name' => 'San Luis sin gas pack x6 Unid 2.5L', 'price' => 16.90, 'unit' => 'un'],
            ['name' => 'Cielo agua mineral sin gas bidón descartable 7L', 'price' => 8.20, 'unit' => 'un'],
            ['name' => 'San Luis agua mineral sin gas 2.5L', 'price' => 3.20, 'unit' => 'un'],
            ['name' => 'San Luis agua mineral con gas 625 mL', 'price' => 1.90, 'unit' => 'un'],
            ['name' => 'Volt bebida energizante regular pack x6 Unid 300mL', 'price' => 12.50, 'unit' => 'un'],
            ['name' => 'Monster bebida ultra energizante 473mL', 'price' => 8.00, 'unit' => 'un'],
            ['name' => 'Red Bull four pack sin azúcar 250mL', 'price' => 28.50, 'unit' => 'un'],
            ['name' => 'Red Bull bebida energizante pack x4 Unid 250mL', 'price' => 28.50, 'unit' => 'un'],
            ['name' => 'Red Bull bebida tropical pack x4 Unid 250mL', 'price' => 28.50, 'unit' => 'un'],
            ['name' => 'Volt gamer 473mL', 'price' => 5.00, 'unit' => 'un'],
            ['name' => 'Volt blueberry con maca 300 mL', 'price' => 2.50, 'unit' => 'un'],
            ['name' => 'Red Bull ambar edition 250 mL', 'price' => 7.90, 'unit' => 'un'],
            ['name' => 'Red Bull green edition 250 mL', 'price' => 7.90, 'unit' => 'un'],
            ['name' => 'Red Bull sin azúcar 250 mL', 'price' => 7.90, 'unit' => 'un'],
            ['name' => 'Red Bull red edition 250 mL', 'price' => 7.90, 'unit' => 'un'],
            ['name' => 'Red Bull tropical 250 mL', 'price' => 7.90, 'unit' => 'un'],
            ['name' => 'Red Bull 350 mL', 'price' => 9.90, 'unit' => 'un'],
            ['name' => 'Electrolight cero piña 475 mL', 'price' => 2.20, 'unit' => 'un'],
            ['name' => 'Sporade tropical 1L', 'price' => 4.50, 'unit' => 'un'],
            ['name' => 'Powerade maracuyá 600 mL', 'price' => 2.40, 'unit' => 'un'],
            ['name' => 'Powerade multifrutas 1.5 L', 'price' => 5.50, 'unit' => 'un'],
            ['name' => 'Sporade mandarina 500 mL', 'price' => 2.40, 'unit' => 'un'],
            ['name' => 'Sporade tropical 1.5 L', 'price' => 5.50, 'unit' => 'un'],
        ];
        $bebidasProductos = [];
        foreach ($bebidas as $i => $bebida) {
            $bebidasProductos[] = [
                'name' => $bebida['name'],
                'slug' => Str::slug($bebida['name']) . '-' . ($i+1),
                'description' => 'Bebida: ' . strtolower($bebida['name']) . '. Refrescante y perfecta para cualquier ocasión.',
                'price' => $bebida['price'],
                'stock' => rand(20, 100),
                'category_id' => $bebidasCategory ? $bebidasCategory->id : 1,
                'image' => 'products/bebidas' . ($i+1) . '.png',
                'active' => true
            ];
        }
        // Insertar los productos de bebidas
        foreach ($bebidasProductos as $producto) {
            Product::create($producto);
        }

        // Eliminar productos anteriores de la categoría Panadería
        $panaderiaCategory = $categories->where('name', 'Panadería')->first();
        if ($panaderiaCategory) {
            Product::where('category_id', $panaderiaCategory->id)->delete();
        }

        // Productos de Panadería (nueva lista)
        $panaderia = [
            ['name' => 'Pan Ciabatta precocido congelado 440g', 'price' => 4.50, 'unit' => 'un'],
            ['name' => 'Croissant congelado 460g', 'price' => 8.90, 'unit' => 'un'],
            ['name' => 'Pan francés precocido congelado 6 UN', 'price' => 4.50, 'unit' => 'un'],
            ['name' => 'Semi baguette multisemillas', 'price' => 6.90, 'unit' => 'un'],
            ['name' => 'De jamón y queso paria x6 Unid', 'price' => 24.90, 'unit' => 'un'],
            ['name' => 'Semi baguette ajo y perejil precocido congelado 360g', 'price' => 6.90, 'unit' => 'un'],
            ['name' => 'Semi baguette clásico precocido congelado 360g', 'price' => 5.90, 'unit' => 'un'],
            ['name' => 'Media hogaza multigrano', 'price' => 9.20, 'unit' => 'un'],
            ['name' => 'Pan mini baguette Molinos del Mundo', 'price' => 12.20, 'unit' => 'un'],
            ['name' => 'Pan de queso Forno de Minas tradicional x 400g', 'price' => 18.90, 'unit' => 'un'],
            ['name' => 'De aceitunas botija x6 Unid', 'price' => 24.90, 'unit' => 'un'],
            ['name' => 'De queso paria x6 Unid', 'price' => 24.90, 'unit' => 'un'],
            ['name' => 'Semi baguette dulce 420g', 'price' => 6.90, 'unit' => 'un'],
            ['name' => 'Enrollado hot dog', 'price' => 2.90, 'unit' => 'un'],
            ['name' => 'Cachito de mantequilla 6 Unid', 'price' => 9.50, 'unit' => 'un'],
            ['name' => 'Pan de molde integral multicereal 510g', 'price' => 9.90, 'unit' => 'un'],
            ['name' => 'Pan de hamburguesa brioche artesano 4P bolsa x360g', 'price' => 10.00, 'unit' => 'un'],
            ['name' => 'Pan integral sin gluten Molinos 480g', 'price' => 21.00, 'unit' => 'un'],
            ['name' => 'Pan de abuelo 400g', 'price' => 5.90, 'unit' => 'un'],
            ['name' => 'Pan mini baguette Molinos del Mundo 200g', 'price' => 12.20, 'unit' => 'un'],
            ['name' => 'Pan integral 6 Unid', 'price' => 3.40, 'unit' => 'un'],
            ['name' => 'Pan de la casa blanco 350g', 'price' => 4.70, 'unit' => 'un'],
            ['name' => 'Pan de yema 6 unidades', 'price' => 7.90, 'unit' => 'un'],
            ['name' => 'Pan hamburguesa brioche 600g', 'price' => 11.90, 'unit' => 'un'],
            ['name' => 'Pan de molde multicereal vital con chía y linaza 360g', 'price' => 10.50, 'unit' => 'un'],
            ['name' => 'Pan de molde blanco sin gluten Molino 480g', 'price' => 17.20, 'unit' => 'un'],
            ['name' => 'Pan de molde integral con frutos secos 510g', 'price' => 12.90, 'unit' => 'un'],
            ['name' => 'Pan de la casa integral 6 semillas 510g', 'price' => 11.90, 'unit' => 'un'],
            ['name' => 'Pan ciabatta clásico de masa madre', 'price' => 3.40, 'unit' => 'un'],
            ['name' => 'Pan francés 6 Unid', 'price' => 3.40, 'unit' => 'un'],
            ['name' => 'Karamanduka chips 6 Unid', 'price' => 3.10, 'unit' => 'un'],
            ['name' => 'Karamanduka 6 Unid', 'price' => 3.10, 'unit' => 'un'],
            ['name' => 'Pan cachito 6 Unid', 'price' => 3.90, 'unit' => 'un'],
            ['name' => 'Mini tostadas integrales x 110g', 'price' => 6.90, 'unit' => 'un'],
            ['name' => 'Tostadas integrales 230g', 'price' => 7.90, 'unit' => 'un'],
            ['name' => 'Pan chancay x 12 Unid', 'price' => 6.50, 'unit' => 'un'],
            ['name' => 'Pan de camote x210g', 'price' => 14.90, 'unit' => 'un'],
        ];
        $panaderiaProductos = [];
        foreach ($panaderia as $i => $pan) {
            // Saltar panaderia2.png (no existe)
            $imgIndex = $i < 1 ? 1 : $i + 2;
            $panaderiaProductos[] = [
                'name' => $pan['name'],
                'slug' => Str::slug($pan['name']) . '-' . ($i+1),
                'description' => 'Producto de panadería: ' . strtolower($pan['name']) . '. Delicioso y recién horneado.',
                'price' => $pan['price'],
                'stock' => rand(20, 100),
                'category_id' => $panaderiaCategory ? $panaderiaCategory->id : 1,
                'image' => 'products/panaderia' . $imgIndex . '.png',
                'active' => true
            ];
        }
        // Insertar los productos de panadería
        foreach ($panaderiaProductos as $producto) {
            Product::create($producto);
        }

        // Eliminar productos anteriores de la categoría Pastelería
        $pasteleriaCategory = $categories->where('name', 'Pastelería')->first();
        if ($pasteleriaCategory) {
            Product::where('category_id', $pasteleriaCategory->id)->delete();
        }

        // Productos de Pastelería (nueva lista, con imagen según el código proporcionado)
        $pasteleria = [
            ['name' => 'Torta cumpleañera sabor chocolate', 'price' => 34.90, 'unit' => 'un', 'image' => 'products/pasteleria1.png'],
            ['name' => 'Torta tres leches vainilla mediana', 'price' => 60.90, 'unit' => 'un', 'image' => 'products/pasteleria2.png'],
            ['name' => 'Torta tematica mini campana', 'price' => 23.90, 'unit' => 'un', 'image' => 'products/pasteleria3.png'],
            ['name' => 'Torta tres leches vainilla grande', 'price' => 69.90, 'unit' => 'un', 'image' => 'products/pasteleria4.png'],
            ['name' => 'Mini torta selva negra', 'price' => 32.90, 'unit' => 'un', 'image' => 'products/pasteleria6.png'],
            ['name' => 'Torta con masa fondant en forma de corazon', 'price' => 32.90, 'unit' => 'un', 'image' => 'products/pasteleria7.png'],
            ['name' => 'Pack compañero', 'price' => 54.90, 'unit' => 'un', 'image' => 'products/pasteleria8.png'],
            ['name' => 'Torta con frutas', 'price' => 99.90, 'unit' => 'un', 'image' => 'products/pasteleria9.png'],
            ['name' => 'Torta fudge corazon mediana', 'price' => 59.90, 'unit' => 'un', 'image' => 'products/pasteleria10.png'],
            ['name' => 'Torta cumpleañera blanca con grageas', 'price' => 34.90, 'unit' => 'un', 'image' => 'products/pasteleria11.png'],
            ['name' => 'Torta tres leches coco mediana', 'price' => 60.90, 'unit' => 'un', 'image' => 'products/pasteleria12.png'],
            ['name' => 'Torta tres leches vainilla chica', 'price' => 48.90, 'unit' => 'un', 'image' => 'products/pasteleria14.png'],
            ['name' => 'Torta tres leches lucuma mediana', 'price' => 60.90, 'unit' => 'un', 'image' => 'products/pasteleria15.png'],
            ['name' => 'Torta berries corazon', 'price' => 59.90, 'unit' => 'un', 'image' => 'products/pasteleria16.png'],
            ['name' => 'Torta alemana', 'price' => 48.90, 'unit' => 'un', 'image' => 'products/pasteleria17.png'],
            ['name' => 'Torta tres leches fresa chica', 'price' => 48.90, 'unit' => 'un', 'image' => 'products/pasteleria18.png'],
            ['name' => 'Keke de platano rectangular', 'price' => 9.90, 'unit' => 'un', 'image' => 'products/pasteleria19.png'],
            ['name' => 'Keke de platano redondo', 'price' => 16.90, 'unit' => 'un', 'image' => 'products/pasteleria20.png'],
            ['name' => 'Keke marmoleado rectangular', 'price' => 9.90, 'unit' => 'un', 'image' => 'products/pasteleria21.png'],
            ['name' => 'Keke naranja rectangular', 'price' => 9.90, 'unit' => 'un', 'image' => 'products/pasteleria22.png'],
            ['name' => 'Keke de limon con glase rectangular', 'price' => 15.90, 'unit' => 'un', 'image' => 'products/pasteleria23.png'],
            ['name' => 'Keke marmoleado redondo', 'price' => 16.90, 'unit' => 'un', 'image' => 'products/pasteleria24.png'],
            ['name' => 'Chifon sabor a naranja', 'price' => 21.90, 'unit' => 'un', 'image' => 'products/pasteleria25.png'],
            ['name' => 'Keke de chocolate rectangular', 'price' => 9.90, 'unit' => 'un', 'image' => 'products/pasteleria26.png'],
            ['name' => 'Keke de vainilla 430g', 'price' => 9.90, 'unit' => 'un', 'image' => 'products/pasteleria27.png'],
            ['name' => 'Keke de naranja redondo', 'price' => 16.90, 'unit' => 'un', 'image' => 'products/pasteleria28.png'],
            ['name' => 'Keke con zanahoria y frosting 470g', 'price' => 15.90, 'unit' => 'un', 'image' => 'products/pasteleria29.png'],
            ['name' => 'Keke ingles redondo', 'price' => 16.90, 'unit' => 'un', 'image' => 'products/pasteleria30.png'],
            ['name' => 'Carrot cake naked', 'price' => 85.00, 'unit' => 'un', 'image' => 'products/pasteleria31.png'],
            ['name' => 'Keke cumpleañero redondo con cobertura y grageas', 'price' => 22.90, 'unit' => 'un', 'image' => 'products/pasteleria32.png'],
            ['name' => 'Orejitas x 25 Unid', 'price' => 13.50, 'unit' => 'un', 'image' => 'products/pasteleria33.png'],
            ['name' => 'Pack mini brownies x 18 Unid', 'price' => 13.90, 'unit' => 'un', 'image' => 'products/pasteleria34.png'],
            ['name' => 'Cachitos de nuez chocolate x 115 g', 'price' => 9.90, 'unit' => 'un', 'image' => 'products/pasteleria35.png'],
            ['name' => 'Empanaditas x 24 Unid', 'price' => 11.90, 'unit' => 'un', 'image' => 'products/pasteleria36.png'],
            ['name' => 'Lenguitas de gato x 100g', 'price' => 8.90, 'unit' => 'un', 'image' => 'products/pasteleria37.png'],
            ['name' => 'Pionono x 12 Unid', 'price' => 14.90, 'unit' => 'un', 'image' => 'products/pasteleria38.png'],
            ['name' => 'Galletas de salvado y surtidas', 'price' => 13.90, 'unit' => 'un', 'image' => 'products/pasteleria39.png'],
            ['name' => 'Rosquitas x 20 Unid', 'price' => 10.50, 'unit' => 'un', 'image' => 'products/pasteleria40.png'],
            ['name' => 'Alfajores relleno con manjar x 16 Unid', 'price' => 14.90, 'unit' => 'un', 'image' => 'products/pasteleria41.png'],
            ['name' => 'Galleta forma de palito con linaza y salvado x Unid', 'price' => 6.90, 'unit' => 'un', 'image' => 'products/pasteleria42.png'],
            ['name' => 'Turrón de Doña Pepa 500g', 'price' => 11.90, 'unit' => 'un', 'image' => 'products/pasteleria43.png'],
            ['name' => 'Pack galletones vainilla chips x 10 Unid', 'price' => 14.90, 'unit' => 'un', 'image' => 'products/pasteleria44.png'],
            ['name' => 'Rosquitas de mantequilla', 'price' => 11.90, 'unit' => 'un', 'image' => 'products/pasteleria45.png'],
            ['name' => 'Cuernitos con manjar x 7 Unid', 'price' => 11.90, 'unit' => 'un', 'image' => 'products/pasteleria46.png'],
            ['name' => 'Rosquitas tradicionales', 'price' => 11.90, 'unit' => 'un', 'image' => 'products/pasteleria47.png'],
        ];
        $pasteleriaProductos = [];
        foreach ($pasteleria as $i => $pastel) {
            $pasteleriaProductos[] = [
                'name' => $pastel['name'],
                'slug' => Str::slug($pastel['name']) . '-' . ($i+1),
                'description' => 'Producto de pastelería: ' . strtolower($pastel['name']) . '. Dulce y delicioso.',
                'price' => $pastel['price'],
                'stock' => rand(20, 100),
                'category_id' => $pasteleriaCategory ? $pasteleriaCategory->id : 1,
                'image' => $pastel['image'],
                'active' => true
            ];
        }
        // Insertar los productos de pastelería
        foreach ($pasteleriaProductos as $producto) {
            Product::create($producto);
        }

        $this->command->info('Productos creados exitosamente.');
    }
} 