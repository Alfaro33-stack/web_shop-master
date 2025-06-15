# Web Shop

Sistema de tienda en línea desarrollado con Laravel.

## Requisitos Previos

- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Node.js y NPM (para assets)
- Git

## Pasos de Instalación

1. **Clonar el repositorio**
   ```bash
   git clone <url-del-repositorio>
   cd web_shop-master
   ```

2. **Instalar dependencias de PHP**
   ```bash
   composer install
   ```

3. **Configurar el archivo .env**
   ```bash
   cp .env.example .env
   ```
   Editar el archivo `.env` y configurar:
   - `DB_CONNECTION=mysql`
   - `DB_HOST=127.0.0.1`
   - `DB_PORT=3306`
   - `DB_DATABASE=web_shop`
   - `DB_USERNAME=tu_usuario`
   - `DB_PASSWORD=tu_contraseña`

4. **Generar clave de aplicación**
   ```bash
   php artisan key:generate
   ```

5. **Crear la base de datos**
   ```bash
   mysql -u root -p
   CREATE DATABASE web_shop;
   exit;
   ```

6. **Ejecutar migraciones y seeders**
   ```bash
   php artisan migrate:fresh --seed
   ```
   Esto creará:
   - Tablas necesarias
   - Usuario administrador
   - Categorías de ejemplo
   - Productos de ejemplo

7. **Crear enlace simbólico para el almacenamiento**
   ```bash
   php artisan storage:link
   ```

8. **Instalar dependencias de Node.js (opcional, si se modificarán los assets)**
   ```bash
   npm install
   npm run dev
   ```

9. **Iniciar el servidor de desarrollo**
   ```bash
   php artisan serve
   ```

## Credenciales de Acceso

### Usuario Administrador
- Email: admin@admin.com
- Contraseña: password

## Estructura del Proyecto

- `app/` - Código fuente principal
  - `Http/Controllers/` - Controladores
  - `Models/` - Modelos de la base de datos
  - `Http/Middleware/` - Middleware de la aplicación
- `database/` - Migraciones y seeders
- `resources/` - Vistas y assets
- `routes/` - Definición de rutas
- `storage/` - Archivos subidos y generados
- `public/` - Punto de entrada y assets públicos

## Características Principales

- Catálogo de productos
- Categorías de productos
- Carrito de compras
- Sistema de pedidos
- Panel de administración
- Gestión de usuarios
- Gestión de productos
- Gestión de categorías

## Comandos Útiles

- `php artisan serve` - Iniciar servidor de desarrollo
- `php artisan migrate` - Ejecutar migraciones
- `php artisan migrate:fresh --seed` - Reiniciar base de datos y ejecutar seeders
- `php artisan storage:link` - Crear enlace simbólico para storage
- `php artisan make:controller NombreController` - Crear nuevo controlador
- `php artisan make:model NombreModel -m` - Crear nuevo modelo con migración

## Solución de Problemas Comunes

1. **Error de permisos en storage**
   ```bash
   chmod -R 775 storage
   chmod -R 775 bootstrap/cache
   ```

2. **Error de composer**
   ```bash
   composer dump-autoload
   ```

3. **Error de caché**
   ```bash
   php artisan cache:clear
   php artisan config:clear
   php artisan view:clear
   ```

## Contribuir

1. Fork el proyecto
2. Crear una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abrir un Pull Request

## Licencia

Este proyecto está bajo la Licencia MIT.
