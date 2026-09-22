# Laravel + Inertia + Tailwind — Portafolio

> ⚠️ **Proyecto personal y educativo.** Este repositorio forma parte de mi portafolio y fue desarrollado con fines de aprendizaje y práctica. No está pensado para uso en producción.

## Descripción

Aplicación web de tipo *backoffice* construida con **Laravel** en el backend y **Vue 3 + Inertia.js** en el frontend, sin necesidad de exponer una API REST separada. Sirve como ejercicio práctico para reforzar conceptos de arquitectura en capas (modelos, repositorios y controladores), autenticación con Jetstream y maquetado con Tailwind CSS.

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
| Frontend   | Vue 3 (Options API) · Inertia.js (`@inertiajs/vue3`) |
| Estilos    | Tailwind CSS 3 |
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

# 4. Configurar la conexión a base de datos en .env y ejecutar migraciones + seeders
#    (crea el catálogo de referencia y un usuario admin — ver SEED_ADMIN_* en .env.example)
php artisan migrate --seed

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

## Migración a Vue 3 y saneamiento de seguridad

El proyecto originalmente mezclaba Vue 2 (Jetstream) con Vuetify 2 en el módulo de hojas de trabajo, y tenía varios problemas de seguridad y datos que ya se corrigieron:

- **Frontend migrado a Vue 3 + `@inertiajs/vue3`**, unificado en un solo entrypoint (`resources/js/app.js`). Se eliminó Vuetify, `portal-vue`, `v-click-outside` y `vue-router` (no se usaba). Los diálogos usan `<Teleport>` nativo y el click-outside es una directiva propia (`resources/js/directives/clickOutside.js`).
- **Rutas de la API (`routes/api.php`) protegidas** con `auth:sanctum` — antes cualquiera podía consultar clientes, hojas de trabajo y terceros sin sesión. Se añadió `EnsureFrontendRequestsAreStateful` al grupo `api` (sin esto, `auth:sanctum` nunca reconoce la sesión del navegador) y hay que declarar `SANCTUM_STATEFUL_DOMAINS` en `.env` con el dominio real de la app.
- **CORS restringido** a `APP_URL` (antes `allowed_origins => ['*']` en todas las rutas).
- **Esquema de base de datos movido a migraciones versionadas** (`database/migrations`) en vez de los dumps SQL crudos `database/00-general.sql` / `01-customers.sql`, que contenían PII real (nombres, NIT, teléfonos, correos) y **ya estaban commiteados en un repositorio público de GitHub**. Los datos de catálogo (ciudades, tipos de identificación, procesos, etc.) ahora se siembran desde `database/seeders/ReferenceDataSeeder.php`, sin PII.
  - ⚠️ **Pendiente de decisión tuya:** esos datos siguen en el historial de git de GitHub. Arreglar solo "hacia adelante" no los borra de commits anteriores; si quieres purgarlos del historial hace falta reescribirlo (`git filter-repo` o similar), lo cual reescribe el repo remoto y es irreversible — por eso no lo hice sin tu confirmación explícita.
  - El seeder de usuario admin ya no trae un correo/clave reales hardcodeados; usa `SEED_ADMIN_EMAIL` / `SEED_ADMIN_PASSWORD` (ver `.env.example`).
- **Bug de datos corregido:** el trigger de MySQL `trigger_generate_worksheet_detail` (que generaba el detalle de subprocesos al asociar un proceso a una hoja de trabajo) no existía en ningún archivo versionado — solo vivía en el dump SQL. Esa lógica ahora está en `WorksheetProcessRepository::create()`, en PHP, portable entre motores de base de datos.
- **Relación rota corregida:** `WorksheetProcess::worksheetDetails()` apuntaba a una columna (`worksheets_details.id_worksheet_process`) que nunca existió en el esquema, y al estar en `$with` rompía *cualquier* consulta sobre una hoja de trabajo. Se quitó esa relación y el `$with`.
- `WorksheetController::create()` y `ThirdController::create()` ya no pasan `$request->all()` directo al `create()` del repositorio (mass assignment); solo los campos validados.
- Se eliminaron archivos de modelo duplicados/generados por accidente (`app/Models/app/Modules/*`, `app/Modules/Worksheet`) y un import roto en `ThirdController`.
- **Bug funcional corregido:** crear un tercero "como cliente" nunca creaba el registro en `customers` (la variable `thirdAs` se validaba pero no se usaba) — un cliente creado así jamás aparecía en el módulo de hojas de trabajo. Ya crea el `Customer` y redirige a `worksheet.index`; "crear como usuario" sigue el flujo original hacia `user.new`.

## Próximos pasos / funcionalidades pendientes

En orden aproximado de importancia:

1. **Ejecución y seguimiento de subprocesos.** El esquema ya tiene `statuses` y `considerations` (con hasta 9 imágenes de evidencia por detalle), pero no existe ningún controlador ni vista para que un usuario marque el avance de un subproceso o suba una consideración. Hoy la app solo cubre la *configuración* de una hoja de trabajo (crear cliente/período, asociar procesos con fecha), no su ejecución — que parece ser el propósito real del sistema a juzgar por el esquema.
2. **Tests del dominio.** Solo existen los tests de Jetstream que vienen de fábrica; no hay ningún test de `Worksheet`, `Third`, `Customer` ni de los repositorios.
3. **Autorización/Policies.** No hay ninguna regla de "quién puede ver o editar qué" — cualquier usuario autenticado ve todos los clientes y hojas de trabajo.
4. **CI.** No hay pipeline (`.github/workflows`); `.styleci.yml` existe pero no se ejecuta en ningún lado.
5. Decidir qué hacer con el historial de git público (ver sección anterior).
6. Completar `/about`, `/services`, `/contact` (hoy renderizan el Dashboard como placeholder).
7. Evaluar actualizar PHP 7.4 → 8.x y Laravel 8 → una versión con soporte (ambos están en fin de vida); se dejó fuera de esta migración a propósito para no mezclar un upgrade mayor de framework con el cambio de frontend.
8. Componentes de Jetstream ya migrados a Vue 3 pero sin reescribir a Composition API (siguen en Options API, que es 100% válido en Vue 3): todo `resources/js/Pages/Auth`, `Pages/Profile`, `Pages/API` y `resources/js/Jetstream/*`. Las páginas del dominio (`Worksheet*`, `WorksheetProcess*`, `Third*`, layouts) sí se reescribieron con foco en Vue 3.

## Contexto

Este proyecto fue construido a modo de práctica personal para explorar la integración de Laravel con Inertia.js y Vue, así como el uso de Jetstream para autenticación. Se comparte como evidencia de experiencia técnica en un contexto de portafolio/currículum.
