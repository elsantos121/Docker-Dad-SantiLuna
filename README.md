Diseño y Arquitectura de Despliegue  
Ivo Giuliano Cappetto  
**Fecha:** 05/05/2026

  ## Ejemplo 1:
Se configuró un contenedor basado en **PHP 8.2-Apache**. Se practicó la edición interna con el editor `vi` y la conexión remota mediante VS Code.

###  Captura: 
<img width="607" height="219" alt="Ejemplo 1" src="https://github.com/user-attachments/assets/6fb7b972-12ff-40bd-86fd-3b98d3e24a35" />

## Ejemplo 2:
Se implementó un flujo de trabajo mediante un script de Bash (`run.sh`) que gestiona el ciclo de vida del contenedor (build, stop, rm y run) en el puerto **8081**.

### Captura:
<img width="593" height="290" alt="Ejemplo 2" src="https://github.com/user-attachments/assets/49b4749b-43ab-49a5-aa76-b58a6a056292" />

---

## Uso:
Para ejecutar el segundo ejemplo:
1. Abrir terminal en la carpeta raíz.
2. Ejecutar: `sh "ejemplo 2/run.sh"`
3. Acceder a: `http://localhost:8081`

 ## Ejemplo 3: 
### Correr `run.sh` 
- Crea la carpeta `wordpress`, la red `mi-network`, el contenedor **MariaDB** (volumen `wordpress-db`) y **WordPress** enlazado a la base, publicado en **http://localhost:8080**.
- Hace falta tener **Docker en ejecución** (en Windows: **Docker Desktop** abierto).
- En **Windows + Git Bash**, el contenedor de **MariaDB puede fallar** por la conversión de rutas de MSYS (`/var/lib/mysql` se transforma mal).
- **Alternativa:** ejecutar los mismos `docker` desde **PowerShell**, o en Git Bash: `export MSYS_NO_PATHCONV=1` y luego `./run.sh`.
<img width="882" height="692" alt="ejemplo3" src="https://github.com/user-attachments/assets/7dcb593d-f843-4e4a-a742-7489751e4a92" />

### Inconvenientes de scripts de S.O. (portabilidad, etc.)
- **Shell:** el script usa Bash; en Windows no existe “de fábrica” (Git Bash, WSL, etc.).
- **Rutas:** `$(pwd)` y *bind mounts* cambian según SO y terminal; en Windows/Git Bash hay casos donde Docker recibe rutas incorrectas.
- **Re-ejecución:** sin limpiar antes, pueden fallar `mkdir wordpress`, `docker network create` y `docker run` por nombres ya usados.
- **Dependencias:** Docker instalado, daemon activo, imágenes y puertos disponibles.
- **Seguridad:** contraseñas en claro en el script.
- **Docker:** uso de `--link` (enfoque legado frente a DNS en redes de usuario).

## Ejemplo 7 (LEMP con Docker Compose)

Stack **Linux + Nginx + MariaDB + PHP-FPM** y **phpMyAdmin**, el `docker-compose` usa **rutas relativas**

### Qué incluye

- **MariaDB 10.5** con datos en `./mariadb/data` e inicialización SQL en `./mariadb/sql/init-db.sql`.
- **PHP 8.2-FPM** (imagen local `ejem07-php-fpm:local`) con extensiones PDO/MySQL; código en `./code/myapp`.
- **Nginx** sirviendo la app y enviando PHP a FPM.
- **phpMyAdmin** contra el servicio `mariadb`.

### URLs 
<img width="581" height="628" alt="ejemplo 7" src="https://github.com/user-attachments/assets/2a03396f-8600-454b-b3b4-dbb931be99ab" />

| Servicio     | URL / acceso |
|-------------|----------------|
| Aplicación  | http://localhost:8880/ |
| phpMyAdmin  | http://localhost:8881/ |
| MariaDB (desde el host) | `localhost:3307` → contenedor `3306` |

### Uso

1. Abrir **Docker Desktop** (o el motor Docker).
2. En la carpeta del ejemplo (`ejem07`):

   **PowerShell / CMD**

   ```text
   docker compose up -d --build
