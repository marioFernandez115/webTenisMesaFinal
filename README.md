# 🏓 Web Tenis de Mesa Rivas

Bienvenido/a a la web oficial del **Club de Tenis de Mesa Rivas**.  
Esta plataforma está diseñada para gestionar y compartir toda la información relevante sobre nuestro club, jugadores, partidos, eventos y noticias.

## 🚀 Características principales

- **Gestión de usuarios**: Registro, edición y roles personalizados (usuario, mantenimiento, admin de noticias, capitán).
- **Gestión de partidos**: Creación de partidos, actas detalladas, historial de partidos por jugador.
- **Noticias y eventos**: Publicación y edición de noticias y eventos con imágenes.
- **Panel de administración**: Acceso restringido según rol para la gestión de contenidos (usuario, mantenimiento,admin_events, Capitan).
- **Animaciones y diseño responsive**: Experiencia moderna y adaptable a cualquier dispositivo.
- **Validaciones avanzadas**: Formularios seguros y adaptados a los datos españoles (teléfono, nombres, etc).

## ⚙️ Instalación

1. Clona el repositorio:
    ```bash
    git clone https://github.com/marioFernandez115/webTenisMesaFinal.git
    ```
2. Instala dependencias:
    ```bash
    composer install
    npm install && npm run dev , composer install 
    ```
3. Configura tu archivo `.env` y la base de datos.
    ```bash
    php artisan key:generate

4. Ejecuta migraciones y seeders:
    ```bash
    php artisan migrate --seed , php artisan migrate
    ```
5. Inicia el servidor:
    ```bash
    php artisan serve
    ```

## 📁 Estructura de carpetas destacada

- `public/img/ImagenNoticiasEventos/` — Imágenes de noticias y eventos.
- `resources/views/` — Vistas Blade de la aplicación.
- `app/Http/Controllers/` — Controladores principales.

## 👤 Créditos

Desarrollado por Mario Fernandez Rodriguez.  
Si tienes dudas o sugerencias, contactame!! (Contacto Github Num: 645742447).

---

¡Gracias por visitar nuestra web y apoyar el tenis de mesa.