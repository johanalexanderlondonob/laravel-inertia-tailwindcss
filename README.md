# Laravel + Inertia + Tailwind — Portafolio

> ⚠️ **Proyecto personal y educativo.** Este repositorio forma parte de mi portafolio y fue desarrollado con fines de aprendizaje y práctica. No está pensado para uso en producción.

## Descripción

Aplicación web de tipo *backoffice* construida con **Laravel** en el backend y **Vue 2 + Inertia.js** en el frontend, sin necesidad de exponer una API REST separada. Sirve como ejercicio práctico para reforzar conceptos de arquitectura en capas (modelos, repositorios y controladores), autenticación con Jetstream y maquetado con Tailwind CSS.

El dominio simulado es el de una gestión de **hojas de trabajo** (worksheets) asociadas a un cliente y un período, compuestas por **procesos** y **subprocesos**, junto con el manejo de **terceros** (clientes/proveedores) con sus datos de ubicación (ciudad, departamento), tipo de identificación y régimen tributario.

## Características

- Autenticación completa con **Laravel Jetstream** (registro, login, verificación de correo, autenticación de dos factores, gestión de perfil y sesiones).
- Gestión de **tokens de API** vía Jetstream/Sanctum.
- Navegación SPA con **Inertia.js**, sin recargas de página ni necesidad de exponer endpoints REST para el frontend.
- Módulo de **hojas de trabajo**: creación por cliente/período y asociación de procesos.
- Módulo de **terceros**: registro con tipo de identificación, ciudad, departamento y régimen tributario.
- Organización del dominio bajo el namespace `App\Arketops`, separando modelos y repositorios por módulo.
- Interfaz estilizada con **Tailwind CSS**.

## Stack técnico

| Capa       | Tecnología |
|------------|------------|
| Backend    | PHP 7.4 · Laravel 8 |
| Auth       | Laravel Jetstream · Laravel Sanctum · Fortify |
| Frontend   | Vue 2 · Inertia.js |
| Estilos    | Tailwind CSS |
| Build      | Vite |
| Base de datos | MySQL |

## Requisitos

- PHP 7.4
- Composer
- Node.js y npm
- MySQL (u otra base de datos compatible)

## Instalación

```bash
# 1. Clonar el repositorio
git clone <url-del-repositorio>
cd laravel-inertia-tailwindcss

# 2. Instalar dependencias de backend
composer install

# 3. Configurar variables de entorno
cp .env.example .env
php artisan key:generate

# 4. Configurar la conexión a base de datos en .env y ejecutar migraciones
php artisan migrate

# 5. Instalar dependencias de frontend
npm install

# 6. Compilar assets (desarrollo)
npm run dev

# 7. Levantar el servidor
php artisan serve
```

## Estructura relevante

```
app/
├── Arketops/            # Dominio de negocio: modelos y repositorios por módulo
│   ├── Worksheet/
│   ├── WorksheetProcess/
│   ├── Third/
│   ├── Customer/
│   ├── Process/
│   └── ...
└── Http/
    ├── Controllers/     # Controladores que orquestan Inertia + repositorios
    └── Resources/       # Transformación de datos para las vistas

resources/js/
├── Pages/               # Vistas Inertia (Vue 2) por módulo
├── Layouts/
└── Components/
```

## Contexto

Este proyecto fue construido a modo de práctica personal para explorar la integración de Laravel con Inertia.js y Vue, así como el uso de Jetstream para autenticación. Se comparte como evidencia de experiencia técnica en un contexto de portafolio/currículum.
