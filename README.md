# Laravel + PHP 8.1 + MySQL + Arquitectura Hexagonal Template

Esta plantilla backend cuenta con Laravel implementando Arquitectura Hexagonal (Ports & Adapters), diseñada para proporcionar una base sólida y escalable con separación clara de responsabilidades entre las capas de dominio, aplicación e infraestructura.

## Configuración inicial de la plantilla
### Requisitos

- PHP versión >= 8.1
- Composer versión >= 2.0
- Node.js versión >= 18.0 (para assets)
- PostgreSQL >= 13.0

### Instalación
1 - Clonar el repositorio.
```
git clone https://github.com/DevAngelCrow/hexagonal-laravel.git
cd hexagonal-laravel
```

2 - Configurar el .env
```
cp .env.example .env.local
```

Configura las variables de entorno del archivo .env de acuerdo a tu necesidad.
Inicialmente cuenta con las variables principales:
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=hexagonal_laravel
DB_USERNAME=postgres
DB_PASSWORD=

3 - Procedemos a instalar dependencias, ejecutamos en consola dentro del directorio del repositorio el comando siguiente
composer install
4 - Generar clave de aplicación
php artisan key:generate
5 - Procedemos a ejecutar las migraciones y seeders para configurar la base de datos:
php artisan migrate --seed
6 - Ejecutamos el comando siguiente para iniciar la ejecución del proyecto en modo desarrollo
php artisan serve

# Estructura general del directorio de carpetas y archivos del proyecto
hexagonal-laravel/
├── .husky/                  # Git hooks para pre-commit
├── app/                     # Código fuente de la aplicación
├── bootstrap/               # Archivos de bootstrap de Laravel
├── config/                  # Archivos de configuración
├── database/                # Migraciones, seeders y factories
├── public/                  # Punto de entrada público y assets
├── resources/               # Vistas, assets sin compilar y localizaciones
├── routes/                  # Definición de rutas
├── src/                     # Código fuente de la aplicación (hexagonal)
├── storage/                 # Logs, cache y archivos generados
├── tests/                   # Pruebas automatizadas
├── vendor/                  # Dependencias de Composer
├── .editorconfig            # Configuración del editor
├── .env                     # Variables de entorno (copia de .env.example)
├── .env.example             # Plantilla de variables de entorno
├── .gitattributes           # Configuración de Git
├── .gitignore               # Archivos ignorados por Git
├── artisan                  # CLI de Laravel
├── composer.json            # Dependencias de PHP y autoload
├── composer.lock            # Versiones exactas de dependencias
├── deptrac.yaml             # Configuración de análisis de dependencias
├── package.json             # Dependencias de Node.js
├── package-lock.json        # Versiones exactas de dependencias JS
├── phpunit.xml              # Configuración de PHPUnit
├── README.md                # Documentación principal
└── vite.config.js           # Configuración de Vite para assets

# Descripcion de carpetas y archivos de los directorios.

Carpeta app

📂 Models/: Contiene los modelos Eloquent que representan las entidades de la base de datos.
📂 Http/Controllers/: Contiene los controladores HTTP que manejan las peticiones web y API.
📂 Http/Requests/: Define las reglas de validación para las peticiones HTTP entrantes.
📂 Http/Resources/: Transforma los modelos y colecciones para las respuestas API.
📂 Http/Middleware/: Contiene middleware personalizado para filtrar peticiones HTTP.

Carpeta src --- Modules (Arquitectura Hexagonal)

📂 Auth/: Módulo de autenticación y gestión de usuarios (mnt_user).
📂 Catalogs/: Módulo de catálogos globales del sistema (ctl_global_status).
📂 Profile/: Módulo de gestión de perfiles de personas (mnt_people).
📂 Security/: Módulo de roles, permisos y seguridad (mnt_rol).
📂 Storage/: Módulo de gestión de archivos y almacenamiento.

Estructura de cada módulo (Hexagonal Architecture)
Application/

📂 UseCases/: Contiene los casos de uso que definen la lógica de aplicación.
📂 DTOs/: Data Transfer Objects para transferir datos entre capas.
📂 Services/: Servicios de aplicación que coordinan los casos de uso.

Domain/

📂 Entities/: Entidades del dominio con reglas de negocio.
📂 Repositories/: Interfaces de repositorios (contratos).
📂 ValueObjects/: Objetos de valor inmutables.
📂 Events/: Eventos del dominio.

Infrastructure/

📂 Controllers/: Controladores específicos del módulo.
📂 Repositories/: Implementaciones concretas de repositorios.
📂 Persistence/: Entidades de persistencia (Eloquent).
📂 Routes/: Rutas específicas del módulo.

Carpeta database

📂 migrations/: Contiene las migraciones para crear y modificar la estructura de la base de datos.
📂 seeders/: Contiene los seeders para poblar la base de datos con datos iniciales.
📂 factories/: Define factories para generar datos de prueba.

Carpeta routes

📄 api.php: Define las rutas de la API RESTful.
📄 web.php: Define las rutas web de la aplicación.
📄 console.php: Define comandos personalizados de Artisan.


Archivos del directorio raíz

📄 artisan: Archivo ejecutable que proporciona la interfaz de línea de comandos de Laravel.
📄 composer.json: Archivo que define las dependencias PHP del proyecto y configuraciones de Composer.
📄 .env.example: Archivo de ejemplo para definir variables de entorno necesarias para el proyecto.
📄 .gitignore: Archivo que contiene las extensiones y carpetas que se omiten al momento de realizar commit.
📄 package.json: Archivo que define las dependencias de Node.js para compilación de assets.

Scripts y comandos disponibles
Comandos de desarrollo
bash# Iniciar servidor de desarrollo
php artisan serve

# Limpiar todos los caches
php artisan optimize:clear

# Refrescar base de datos con seeders
php artisan migrate:refresh --seed
Comandos de base de datos
