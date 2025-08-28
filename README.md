# Aplicación de Búsqueda de Películas (Laravel)

Esta es una aplicación web construida con Laravel 11 que permite a los usuarios registrarse, buscar películas consumiendo la API de OMDb, y gestionar una lista personal de favoritos. Incluye un sistema de roles para administradores, una API interna segura con Laravel Sanctum y una interfaz de usuario creada con Blade y Tailwind CSS.

## Requisitos

-   PHP 8.2+
-   Composer
-   Node.js y npm
-   Un servidor de base de datos (MySQL, MariaDB, etc.)
-   Una API Key de [OMDb API](https://www.omdbapi.com/apikey.aspx)

## Instalación

1.  **Clonar el repositorio:**
    ```bash
    git clone [https://github.com/lajolari/laravel-ucompensar-test.git](https://github.com/lajolari/laravel-ucompensar-test.git)
    cd laravel-ucompensar-test
    ```

2.  **Instalar dependencias de PHP:**
    ```bash
    composer install
    ```

3.  **Instalar dependencias de Node.js y compilar assets:**
    ```bash
    npm install
    npm run build
    ```

4.  **Configurar el archivo de entorno:**
    Crea una copia del archivo `.env.example` y renómbrala a `.env`.
    ```bash
    cp .env.example .env
    ```

5.  **Generar la clave de la aplicación:**
    ```bash
    php artisan key:generate
    ```

6.  **Configurar las variables de entorno en el archivo `.env`:**
    Abre el archivo `.env` y configura las siguientes variables:
    -   **Base de Datos:** Ajusta las variables `DB_*` con los datos de tu base de datos local (ej: `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
    -   **API de OMDb:** Añade tu API Key y la URL base.
        ```ini
        OMDB_API_KEY=tu_api_key_aqui
        OMDB_BASE_URL=[http://www.omdbapi.com/](http://www.omdbapi.com/)
        ```

7.  **Ejecutar las migraciones y los seeders:**
    Este comando creará todas las tablas necesarias en la base de datos y generará el usuario administrador por defecto.
    ```bash
    php artisan migrate --seed
    ```

## Ejecución

Para iniciar el servidor de desarrollo local, ejecuta el siguiente comando:

```bash
php artisan serve
