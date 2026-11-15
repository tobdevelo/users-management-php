# CRUD Usuarios y Noticias: Arquitectura Hexagonal con DDD y CQRS

Aplicación web PHP para la gestión de usuarios y noticias: registro, listado, visualización, edición, eliminación, autenticación con sesión y recuperación de contraseña por correo electrónico.

## Despliegue en Producción (Railway)

- **URL de la aplicación:** `https://tu-dominio.up.railway.app` *(reemplaza con tu enlace público de Railway)*
- **Plataforma:** Railway (contenedor Docker `php:8.2-cli` + MySQL)

---

## Tecnologías

- PHP 8.2 / 8.3
- MySQL (PDO con Prepared Statements)
- Docker (`php:8.2-cli` + `router.php`) y Apache `mod_rewrite` (entorno local)
- Resend HTTP API (`cURL`) para envío transaccional de correos

---

## Funcionalidades

### Gestión de Usuarios
- Crear, listar, ver, editar y eliminar usuarios
- Autenticación con sesión (`login` / `logout`) y contraseñas encriptadas (`Bcrypt`)
- Recuperación de contraseña mediante contraseña temporal enviada por correo vía API HTTP de Resend
- Envío de notificaciones por correo electrónico

### Gestión de Noticias (Ejercicio 29)
- Crear, listar, ver detalle, editar y eliminar noticias
- Validación de campos (categoría, fechas, ubicación geográfica, periodista, programa, descripción y nivel de público)

### Seguridad y Enrutamiento
- Protección de rutas privadas según estado de autenticación
- Protección contra acceso directo a archivos y listado de directorios
- Enrutador frontal (`router.php`) para servir recursos estáticos (CSS/JS) y redirigir peticiones hacia `public/index.php`

---

## Conceptos aplicados

### Arquitectura general
- Arquitectura Hexagonal (Ports & Adapters)
- DDD (Domain-Driven Design)
- CQRS (Commands y Queries)
- Capas: `Domain` / `Application` / `Infrastructure` / `Entrypoints`
- Front Controller · Single Entry Point

### Capa de Dominio
- Rich Domain Model & Value Objects inmutables
- Named Constructors y Domain Exceptions
- Enumerations (`UserRoleEnum`, `UserStatusEnum`, `NivelPublicoEnum`)
- Ubiquitous Language, Fail-fast validation y encapsulación de reglas de negocio

### Capa de Aplicación
- Use Cases y Application Services
- Ports In (interfaces de casos de uso) y Ports Out (`UserRepositoryPort`, `NoticiaRepositoryPort`, `EmailSenderPort`)
- Commands, Queries, DTOs y Application Mappers

### Capa de Infraestructura
- Repository Pattern y Data Mapper
- Persistence DTO y Persistence Entity
- PDO con Prepared Statements
- Adapter Pattern (`EmailSenderService` integrado con Resend HTTP API)

### Entrypoints / Presentación
- Enrutamiento por query string (`?route=`)
- PRG (Post-Redirect-Get) y Flash Messages
- Autenticación basada en sesiones
- Web Mappers, Web DTOs (`WebRequest` / `Response`) y `View::render`

---

## Configuración y Despliegue

### Variables de entorno requeridas
Configurar en el archivo `.env` local o en la pestaña **Variables** de Railway:

```env
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=nombre_base_datos
DB_USERNAME=usuario_db
DB_PASSWORD=contrasena_db
DB_CHARSET=utf8mb4

SMTP_PASSWORD=re_tu_api_key_de_resend
SMTP_FROM_ADDRESS=onboarding@resend.dev
SMTP_FROM_NAME="Gestion de Usuarios"
