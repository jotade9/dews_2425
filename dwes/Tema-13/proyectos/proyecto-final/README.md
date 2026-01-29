# 📌 Proyecto Final DWES (PHP + MVC)

Aplicación web desarrollada en **PHP con arquitectura MVC**, que permite gestionar entidades a través de un sistema de roles con autenticación.  
Incluye **CRUD completo**, gestión de usuarios, sesiones y validación de formularios.  

---

## 🚀 Demo  

Este proyecto está pensado para correr en **local con XAMPP**.  
👉 No tiene despliegue online por el momento.  

---

## 🛠️ Tecnologías utilizadas  

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)  
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)  
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)  
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)  
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)  

---

## ⚙️ Funcionalidades  

- ✅ Arquitectura MVC (Modelo - Vista - Controlador)  
- ✅ Programación Orientada a Objetos (POO)  
- ✅ CRUD sobre base de datos MySQL  
- ✅ Gestión de usuarios con roles y autenticación  
- ✅ Sesiones de usuario  
- ✅ Validación de formularios  
- ✅ Diseño responsive básico  

---
## 👥 Niveles de Acceso y Roles

El sistema utiliza **Control de Acceso Basado en Roles (RBAC)** para proteger las rutas y acciones. Los permisos están distribuidos de la siguiente forma:

### 👑 Rol: Administrador
Es el perfil con control total sobre la aplicación.
- **Capacidades:** CRUD completo en todas las tablas, gestión de usuarios y asignación de privilegios.
- **Captura de Gestión:**
  ![Index de Administración](screenshots/admin/indexAdmin.png)
  *(Aquí puedes poner la captura donde se ven Inmaculada y Juan Diego con sus botones de acción)*

### 📝 Rol: Editor
Perfil intermedio para el mantenimiento de datos.
- **Capacidades:** Puede añadir nuevos libros, autores o editoriales y modificar los existentes.
- **Restricción:** No tiene acceso al menú de "Usuarios" ni permisos para eliminar registros críticos.
- **Vista Principal:**
  ![Index de Gestión](screenshots/editor/indexEditor.png)
  *(Usa la captura del listado de libros que me pasaste al principio)*

### 👤 Rol: Registrado
Perfil de consulta para usuarios finales.
- **Capacidades:** Visualización del catálogo de libros y fichas de autores.
- **Restricción:** Interfaz simplificada sin botones de edición, creación o borrado.
- **Vista de Consulta:**
  ![Vista de Usuario Registrado](screenshots/registrado/index.png)

---

## 📦 Instalación y ejecución en local  

### 1️⃣ Requisitos previos  
- Tener instalado **XAMPP** (incluye Apache + MySQL).  
- Tener el servicio de **Apache** y **MySQL** corriendo.  

### 2️⃣ Clonar el proyecto  
Clona este repositorio dentro de la carpeta `htdocs` de tu instalación de XAMPP:  
```bash
git clone https://github.com/jotade9/dews_2425.git
```

### 3️⃣ Configurar la Base de Datos

El script para crear la base de datos, sus tablas y los datos iniciales se encuentra en la carpeta `bd/`.

#### Método recomendado: Importar desde MySQL Workbench

1.  Abre **MySQL Workbench** y conéctate a tu servidor local.
2.  En el menú superior, ve a `Server` > `Data Import`.
3.  Selecciona la opción `Import from Self-Contained File`.
4.  Busca y selecciona el archivo `.sql` que se encuentra dentro de la carpeta `bd/` del proyecto.
5.  En `Default Target Schema`, haz clic en `New...` para crear una nueva base de datos. Dale un nombre (por ejemplo, `proyecto_dwes`).
6.  Haz clic en **Start Import** para ejecutar el script. Al finalizar, tendrás la base de datos lista.

#### Método alternativo: Copiar y ejecutar el script

1.  Abre el archivo `.sql` de la carpeta `bd/` con un editor como **Visual Studio Code**.
2.  Selecciona todo el contenido (`Ctrl+A` o `Cmd+A`) y cópialo (`Ctrl+C` o `Cmd+C`).
3.  En **MySQL Workbench**, crea una nueva base de datos desde el panel izquierdo (clic derecho > `Create Schema...`).
4.  Abre una nueva pestaña de script (`SQL Query Tab`) para esa base de datos.
5.  Pega el contenido del archivo y ejecuta el script completo (haz clic en el icono del rayo ⚡).

---

### 4️⃣ ¡Ejecutar el proyecto!

Una vez clonado el repositorio y configurada la base de datos, abre tu navegador web y accede a:

http://localhost/dews_2425/

*(Reemplaza `dews_2425` por el nombre de la carpeta del proyecto si lo has cambiado).*




