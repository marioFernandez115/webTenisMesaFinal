# 🏓 Web Tenis de Mesa Rivas

Bienvenido/a a la web oficial del **Club de Tenis de Mesa Rivas**.  
Esta plataforma está diseñada para gestionar y compartir toda la información relevante sobre nuestro club, jugadores, partidos, eventos y noticias.

---

## 📸 Título y Vista Previa

**Web Tenis de Mesa Rivas**  
![Vista previa](public/img/Prevista.png)
---

## 📝 Descripción

**Propósito:**  
Ofrecer una plataforma integral para la gestión del club, permitiendo la administración de usuarios, partidos, noticias y eventos, así como la consulta de historiales y resultados.

**Funcionalidades principales:**
- Gestión de usuarios y roles (usuario, mantenimiento, admin_events, capitán)
- Creación y edición de partidos con actas detalladas
- Publicación de noticias y eventos con imágenes
- Historial de partidos por jugador
- Panel de administración seguro y restringido por roles
- Animaciones y diseño responsive

---

## 🚀 Demo en Vivo
Proximamente...
[Ver demo en GitHub Pages / Netlify / tu hosting]() 

---

## 🛠️ Tecnologías

- **Backend:** PHP 8+, Laravel 10
- **Frontend:** Blade, HTML5, CSS3, Bootstrap 5, JavaScript
- **Base de datos:** MySQL/MariaDB
- **Animaciones:** Animate.css
- **Otros:** Composer, NPM

---

## ⚙️ Instalación

1. Clona el repositorio:
    ```bash
    git clone https://github.com/marioFernandez115/webTenisMesaFinal.git
    ```
2. Instala dependencias:
    ```bash
    composer install
    npm install && npm run dev
    ```
3. Configura tu archivo `.env` y la base de datos:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
4. Ejecuta migraciones y seeders:
    ```bash
    php artisan migrate --seed
    ```
5. Inicia el servidor:
    ```bash
    php artisan serve
    ```

---

## 📁 Estructura de Archivos

- `public/img/ImagenNoticiasEventos/` — Imágenes de noticias y eventos
- `resources/views/` — Vistas Blade de la aplicación
- `app/Http/Controllers/` — Controladores principales
- `routes/web.php` — Rutas de la aplicación

---

## ✨ Características

- Registro y edición de usuarios con validaciones avanzadas
- Gestión de partidos y actas
- Publicación y edición de noticias y eventos con imágenes
- Historial de partidos por jugador
- Panel de administración con control de roles
- Animaciones visuales y experiencia responsive

---

## 📱 Responsive Design

- Totalmente adaptado a móviles, tablets y escritorio
- Probado en resoluciones comunes y dispositivos actuales

---

## 👤 Créditos

Desarrollado por **Mario Fernandez Rodriguez**  
Contacto: [GitHub](https://github.com/marioFernandez115) | Teléfono: 645742447

---

## 📄 Licencia

Este proyecto está bajo la licencia MIT.  
Consulta el archivo [LICENSE](LICENSE) para más información.

---

¡Gracias por visitar nuestra web y apoyar el tenis de mesa!