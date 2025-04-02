# Auladell App - Tienda de Joyería Personalizada

Sistema de gestión integral para una tienda de joyería que permite a los clientes personalizar sus propias piezas de joyería y realizar pedidos de manera segura.
Además, permite al usuario administrador gestionar los materiales en tiempo real.

## Características Principales

### Comercio Electrónico
- Catálogo de productos personalizables
- Sistema de carrito de compras
- Proceso de checkout con personalización
- Sistema de pagos
- Gestión de órdenes y estados

### Personalización de Productos
- Sistema de personalizaciones por producto
- Opciones de material base
- Opciones de incrustación
- Opciones de bañado
- Cálculo dinámico de precios según opciones seleccionadas

### Gestión de Inventario
- Control de materiales
- Gestión de stock por material
- Alertas de stock bajo
- Registro de cambios en el inventario
- Sistema de reducción automática de stock al realizar pedidos

### Sistema de Usuarios
- Registro de usuarios
- Autenticación
- Perfil de usuario
- Historial de pedidos
- Gestión de direcciones de envío

### Administración
- Panel de administración
- Gestión de productos
- Gestión de materiales
- Gestión de órdenes
- Generación de reportes
- Control de inventario

## Stack Tecnológico

**Frontend:**
- Blade Templates
- TailwindCSS
- JavaScript
- HTML5/CSS3

**Backend:**
- PHP 8.2
- Laravel 11
- MySQL

## Instalación

1. Clona el repositorio

	```bash
	git clone https://github.com/1Kyotto/auladell-app.git
	cd auladell-app
	```

2. Instala las dependencias

	```bash
	composer install
	npm install
	```

3. Configura el entorno

	```bash
	cp .env.example .env
	php artisan key:generate
	```

4. Configura la base de datos en el archivo .env

	```env
	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=auladell_app
	DB_USERNAME=root
	DB_PASSWORD=
	```

5. Ejecuta las migraciones y seeders

	```bash
	php artisan migrate --seed
	```

## Ejecución Local

1. Inicia el servidor de desarrollo

	```bash
	php artisan serve
	```

2. Compila los assets (en una nueva terminal)

	```bash
	npm run dev
	```

3. Accede a la aplicación en `http://localhost:8000`

## Variables de Entorno

Las principales variables de entorno que necesitas configurar son:

```env
APP_NAME=Auladell App
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=auladell_app
DB_USERNAME=
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=
MAIL_USERNAME=#email
MAIL_PASSWORD=#password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=#"email"
MAIL_FROM_NAME="${APP_NAME}"
```

## Estructura del Proyecto
### Controladores

- `app/Http/Controllers/`
  - `Admin/` - Controladores de administración
  - `Cart/` - Controladores del carrito
  - `Materials/` - Controladores de materiales
  - `Orders/` - Controladores de órdenes
  - `Payments/` - Controladores de pagos
  - `Products/` - Controladores de productos
  - `Reports/` - Controladores de reportes
  - `Users/` - Controladores de usuarios

### Seeders

- `database/seeders/`
  - `UserSeeder` - Datos de usuarios de prueba
  - `ProductsSeeder` - Catálogo de productos
  - `MaterialSeeder` - Materiales disponibles
  - `MaterialProductSeeder` - Relación de materiales con productos
  - `CustomizationsSeeder` - Opciones de personalización
  - `CustomizationProductsSeeder` - Relación de personalizaciones con productos
  - `CustomizationOptionSeeder` - Opciones para cada personalización
  - `CustomizationMaterialSeeder` - Materiales requeridos por personalizaciones
  - `DatabaseSeeder` - Seeder principal que ejecuta todos los anteriores

### Modelos

- `app/Models/`
  - `Auth/` - Modelos de autenticación
  - `Carts/` - Modelos del carrito
  - `Customizations/` - Modelos de personalización
  - `Inventory/` - Modelos de inventario
  - `Materials/` - Modelos de materiales
  - `Orders/` - Modelos de órdenes
  - `Products/` - Modelos de productos
  - `ShippingAddresses/` - Modelos de direcciones de envío
  - `Archives/` - Modelos de archivos/archivos

### Otros Componentes

- `app/Http/Middleware/` - Middleware de la aplicación
- `app/Events/` - Eventos del sistema
- `app/Exports/` - Exportaciones de datos
- `app/Helpers/` - Funciones auxiliares
- `app/Providers/` - Proveedores de servicios

### Recursos

- `resources/views/` - Vistas de la aplicación
- `resources/lang/` - Archivos de idioma
- `resources/js/` - JavaScript
- `resources/css/` - Estilos CSS
- `resources/sass/` - SASS/SCSS

### Configuración

- `.env` - Variables de entorno
- `routes/` - Rutas de la aplicación

## Autores

- [@1Kyotto](https://github.com/1Kyotto)
- [@Guilmon-Kyo](https://github.com/Guilmon-Kyo)