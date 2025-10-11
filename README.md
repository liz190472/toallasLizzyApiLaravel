# API Toallas Lizzy - Laravel

- Proyecto – _Comercializadora de Toallas Lizzy_
- Curso: _ADSO 2025_
- Ficha: _2983215_
- Estudiante: _Elizabeth Hernandez Aroca_

---

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

| Componente         | Versión              | Estado                    | Ubicación Principal  |
|------------        |--------------------- |-------- ----------------  |---------------------|
| **Servidor Local** | XAMPP 8.2.12-0 Linux | ✅ Instalado y Corriendo  | `/opt/lampp/` |
| **Servidor Web**   | Apache               | ✅ OK | Panel de XAMPP    |
| **Base de Datos**  | MySQL/MariaDB        | ✅ OK | Panel de XAMPP    |
| **Lenguaje**       | PHP 8.2              | ✅ OK | Incluido en XAMPP |
| **Framework**      | Laravel 11.x         | ✅ OK | Proyecto actual   |
| **Administrador de Paquetes** | Composer  | ✅ Instalado Globalmente  | `/usr/local/bin/composer`  |
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

### . Instalar Dependencias

```bash
composer install
```

### . Configurar Variables de Entorno

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

###  Generar Key de Aplicación

```bash
/opt/lampp/bin/php artisan key:generate
```

###  Ejecutar Migraciones

```bash
/opt/lampp/bin/php artisan migrate
```

### Iniciar Servidor de Desarrollo

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