# 📝 To-Do List Colaborativa

Aplicación web de gestión de tareas con posibilidad de compartir tareas con otros usuarios.  
Desarrollada con **Laravel**, **TailwindCSS** y **Vite**.

---

## ⚡ Requisitos

-   PHP >= 8.1
-   Composer
-   Node.js + NPM
-   SQLite
-   Laravel 10+

---

## 🚀 Instalación

Clona el repositorio:

```bash
git clone https://github.com/RaulColomer/gestorTareasColaborativas.git
cd gestorTareasColaborativas
```

## Instalar dependencias

```bash
composer install
npm install
```

## Copiar el archivo de entorno y configura:

cp .env.example .env

## Edita .env y configura la conexión de base de datos para SQLite:

```bash
DB_CONNECTION=sqlite
DB_DATABASE=/ruta/absoluta/a/database/database.sqlite
```

## Creamos la DB vacía usando el comando:

```bash
Windows: New-Item database/database.sqlite
Linux/Mac: touch database/database.sqlite
```

## Genera la clave de la app:

php artisan key:generate

## Ejecuta las migraciones:

php artisan migrate

## Ejecuta los seeders:

php artisan db:seed

## Compila los assets:

npm run dev

## Inicia el servidor:

php artisan serve

## Abre en el navegador:

http://127.0.0.1:8000

## 🧑‍💻 Usuario de prueba

Puedes usar estos usuarios para acceder a la aplicación:

-   **Email:** test@gmail.com
-   **Contraseña:** password123

-   **Email:** admin@gmail.com
-   **Contraseña:** password123

(Se generan con los seeders del proyecto.)
