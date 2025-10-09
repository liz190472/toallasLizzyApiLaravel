# API Toallas Lizzy - Laravel

## 📋 Descripción del Proyecto

API RESTful desarrollada con Laravel para la gestión de productos y autenticación de usuarios del sistema Toallas Lizzy. Este proyecto forma parte del componente formativo "Construcción de API" y cumple con los requerimientos de diseño y desarrollo de servicios web.

## 🎯 Objetivos del Proyecto

- Implementar servicios web RESTful siguiendo las mejores prácticas
- Gestionar autenticación segura de usuarios
- Administrar el CRUD completo de productos
- Documentar todos los endpoints de la API
- Utilizar control de versiones con Git

---

## 🛠️ Entorno Instalado y Configuración

### Componentes del Sistema

| Componente         | Versión              | Estado                    | Ubicación Principal |
|------------        |--------------------- |-------- ----------------  |---------------------|
| **Servidor Local** | XAMPP 8.2.12-0 Linux | ✅ Instalado y Corriendo  | `/opt/lampp/` |
| **Servidor Web**   | Apache               | ✅ OK | Panel de XAMPP    |
| **Base de Datos**  | MySQL/MariaDB        | ✅ OK | Panel de XAMPP    |
| **Lenguaje**       | PHP 8.2              | ✅ OK | Incluido en XAMPP |
| **Framework**      | Laravel 11.x         | ✅ OK | Proyecto actual   |
| **Administrador de Paquetes** | Composer  | ✅ Instalado Globalmente  | `/usr/local/bin/composer` |
| **Editor de Código** | Visual Studio Code | ✅ OK                     | - |
| **Control de Versiones** | Git | ✅ OK | - |

---

## 📦 Instalación Inicial del Entorno

### 1. Instalación de XAMPP (Primera Vez)

```bash
# Dar permisos de ejecución al instalador
chmod +x xampp-linux-x64-8.2.12-0-installer.run

# Ejecutar el instalador
sudo ./xampp-linux-x64-8.2.12-0-installer.run
```

### 2. Instalación de Composer

```bash
# Descargar el instalador de Composer
/opt/lampp/bin/php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

# Instalar Composer globalmente
sudo /opt/lampp/bin/php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Verificar instalación
composer --version
```

### 3. Configuración del Alias PHP (Opcional pero Recomendado)

```bash
# Editar archivo bashrc
nano ~/.bashrc

# Agregar al final del archivo:
alias php='/opt/lampp/bin/php'

# Aplicar cambios
source ~/.bashrc
```

---

## 🚀 Instalación del Proyecto

### 1. Clonar el Repositorio

```bash
git clone <URL_DEL_REPOSITORIO>
cd toallas-lizzy-apiLaravel
```

### 2. Instalar Dependencias

```bash
composer install
```

### 3. Configurar Variables de Entorno

```bash
# Copiar archivo de ejemplo
cp .env.example .env

# Editar archivo .env con tus configuraciones
nano .env
```

Configuración de base de datos en `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=toallas_lizzy
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generar Key de Aplicación

```bash
/opt/lampp/bin/php artisan key:generate
```

### 5. Ejecutar Migraciones

```bash
/opt/lampp/bin/php artisan migrate
```

### 6. Iniciar Servidor de Desarrollo

```bash
/opt/lampp/bin/php artisan serve
```

El servidor estará disponible en: `http://127.0.0.1:8001`

---

## 📚 Módulos del Sistema

### 🔐 Módulo de Inicio de Sesión

El sistema ofrece una interfaz de inicio de sesión segura con las siguientes características:

**Funcionalidades:**
- Autenticación mediante nombre de usuario y contraseña encriptada
- Validación robusta de credenciales
- Mensajes de confirmación o error según corresponda
- Redirección automática tras inicio exitoso
- Opción de recuperación de contraseña en caso de error

**Endpoint:**
```
POST /api/login
```

**Validaciones:**
- Campos obligatorios: email y password
- Formato de email válido
- Contraseña encriptada con bcrypt

### 📦 Módulo de Gestión de Productos

Sistema CRUD completo para la administración de productos con las siguientes operaciones:

**Funcionalidades:**
- **Listar productos**:  Visualización en formato lista de todos los productos
- **Crear producto**:    Formulario para registro de nuevos productos
- **Editar producto**:   Modificación de información existente
- **Eliminar producto**: Eliminación de registros

**Campos del Producto:**
- EAN (Código de barras)
- Tipo
- Referencia
- Gramos
- Tamaño
- Color
- Valor Unitario
- Imagen del producto

---

## 🔌 Documentación de Endpoints

### Autenticación

#### Login
```http
POST /api/login
Content-Type: application/json

{
  "email": "usuario@ejemplo.com",
  "password": "contraseña123"
}
```

**Respuesta Exitosa (200):**
```json
{
  "success": true,
  "message": "Inicio de sesión exitoso",
  "token": "token_de_acceso",
  "user": {
    "id": 1,
    "name": "Usuario",
    "email": "usuario@ejemplo.com"
  }
}
```

---

### Productos

#### Listar Todos los Productos
```http
GET /api/productos
```

**Respuesta (200):**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "ean": "7501234567890",
      "tipo": "Toalla de baño",
      "referencia": "TB-001",
      "gramos": 450,
      "tamaño": "Grande",
      "color": "Azul",
      "valor_unitario": 25000,
      "imagen": "url_de_imagen"
    }
  ]
}
```

#### Crear Producto
```http
POST /api/productos
Content-Type: application/json

{
  "ean": "7501234567890",
  "tipo": "Toalla de baño",
  "referencia": "TB-001",
  "gramos": 450,
  "tamaño": "Grande",
  "color": "Azul",
  "valor_unitario": 25000
}
```

**Respuesta (201):**
```json
{
  "success": true,
  "message": "Producto 7501234567890 creado exitosamente",
  "data": {
    "id": 1,
    "ean": "7501234567890",
    "tipo": "Toalla de baño",
    "referencia": "TB-001",
    "gramos": 450,
    "tamaño": "Grande",
    "color": "Azul",
    "valor_unitario": 25000
  }
}
```

#### Obtener Producto por ID
```http
GET /api/productos/{id}
```

**Respuesta (200):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "ean": "7501234567890",
    "tipo": "Toalla de baño",
    "referencia": "TB-001",
    "gramos": 450,
    "tamaño": "Grande",
    "color": "Azul",
    "valor_unitario": 25000
  }
}
```

#### Actualizar Producto
```http
PUT /api/productos/{id}
Content-Type: application/json

{
  "tipo": "Toalla de mano",
  "tamaño": "Mediano",
  "valor_unitario": 18000
}
```

**Respuesta (200):**
```json
{
  "success": true,
  "message": "Producto TB-001 editado exitosamente",
  "data": {
    "id": 1,
    "ean": "7501234567890",
    "tipo": "Toalla de mano",
    "referencia": "TB-001",
    "tamaño": "Mediano",
    "valor_unitario": 18000
  }
}
```

#### Eliminar Producto
```http
DELETE /api/productos/{id}
```

**Respuesta (200):**
```json
{
  "success": true,
  "message": "Producto eliminado exitosamente"
}
```

---

## 🧪 Pruebas con cURL

### Probar Login
```bash
curl -X POST http://127.0.0.1:8001/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "admin@toallas.com",
    "password": "password123"
  }'
```

### Listar Productos
```bash
curl http://127.0.0.1:8001/api/productos
```

### Crear Producto
```bash
curl -X POST http://127.0.0.1:8001/api/productos \
  -H "Content-Type: application/json" \
  -d '{
    "ean": "7501234567890",
    "tipo": "Toalla de baño",
    "referencia": "TB-001",
    "gramos": 450,
    "tamaño": "Grande",
    "color": "Azul",
    "valor_unitario": 25000
  }'
```

### Actualizar Producto
```bash
curl -X PUT http://127.0.0.1:8001/api/productos/1 \
  -H "Content-Type: application/json" \
  -d '{
    "valor_unitario": 28000
  }'
```

### Eliminar Producto
```bash
curl -X DELETE http://127.0.0.1:8001/api/productos/1
```

---

## 🗂️ Estructura del Proyecto

```
toallas-lizzy-apiLaravel/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AuthController.php
│   │       └── ProductoController.php
│   └── Models/
│       ├── User.php
│       └── Producto.php
├── bootstrap/
│   └── app.php (Configuración de rutas API)
├── config/
├── database/
│   └── migrations/
├── routes/
│   ├── api.php (Rutas de la API)
│   └── web.php
├── .env
├── composer.json
└── README.md
```

---

## 🔧 Comandos Útiles de Laravel

### Limpiar Caché
```bash
/opt/lampp/bin/php artisan cache:clear
/opt/lampp/bin/php artisan config:clear
/opt/lampp/bin/php artisan route:clear
```

### Ver Rutas Disponibles
```bash
/opt/lampp/bin/php artisan route:list
```

### Crear Migraciones
```bash
/opt/lampp/bin/php artisan make:migration create_productos_table
```

### Crear Controladores
```bash
/opt/lampp/bin/php artisan make:controller ProductoController
```

### Crear Modelos
```bash
/opt/lampp/bin/php artisan make:model Producto -m
```

---

## 🔐 Seguridad

- Las contraseñas se almacenan encriptadas con bcrypt
- Validación de datos en todas las entradas de usuario
- Mensajes de error claros sin exponer información sensible
- CORS configurado según necesidades del frontend

---

## 📝 Validaciones Implementadas

### Login
- Email: requerido, formato válido
- Password: requerido, mínimo 6 caracteres

### Productos
- EAN: requerido, único, formato numérico
- Tipo: requerido, string
- Referencia: requerida, única
- Gramos: requerido, numérico, positivo
- Tamaño: requerido
- Color: requerido
- Valor Unitario: requerido, numérico, positivo

---


### Puerto en uso

**Problema:** `Address already in use` al iniciar el servidor

**Solución:** Usar un puerto diferente:
```bash
/opt/lampp/bin/php artisan serve --port=8001
```
---

## 👥 Equipo de Desarrollo

- **Desarrollador:** Elizabeth Hernandez
- **Framework:** Laravel 11.x
- **Fecha de Inicio:** 2025

---

## 📄 Licencia

Este proyecto es parte de un componente formativo educativo.

---

## 🔄 Control de Versiones

Este proyecto utiliza Git para control de versiones. Comandos básicos:

```bash
# Inicializar repositorio
git init

# Agregar archivos
git add .

# Commit
git commit -m "Mensaje descriptivo"

# Conectar con repositorio remoto
git remote add origin <URL_REPOSITORIO>

# Push
git push -u origin main
```

---

**Última actualización:** Octubre 2025