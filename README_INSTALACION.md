# FONDO ROTATIVO PASAJES AÉREOS ESNACE - Sistema SYED 2026

## Instalación en nuevo servidor / webhosting

1. Clonar repo:
git clone https://github.com/TU_USUARIO/fondo-rotativo-esnace.git
cd fondo-rotativo-esnace

2. Instalar dependencias:
composer install --no-dev --optimize-autoloader
npm install && npm run build (si usa vite)

3. Configurar entorno:
cp .env.example .env
php artisan key:generate

Editar .env:
APP_NAME="Fondo Rotativo ESNACE"
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fondo_rotativo_esnace
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_clave

4. Migrar BD e importar respaldo:
php artisan migrate
mysql -u tu_usuario -p fondo_rotativo_esnace < docs/db/backup_bd_2026_10_16.sql

5. Permisos storage:
chmod -R 775 storage bootstrap/cache
php artisan storage:link

6. Logos:
Verificar que existan:
public/images/logo_armada.png
public/images/logo_coopna.png

7. DomPDF:
composer require barryvdh/laravel-dompdf
En config/dompdf.php: isRemoteEnabled => true, isPhpEnabled => true

8. Iniciar:
php artisan serve --host=0.0.0.0 --port=8000
o en hosting: apuntar dominio a /public

Rutas:
- /cierres-mensuales
- /cierres-mensuales/1
- /cierres-mensuales/1/pdf -> PDF OFICIAL VERTICAL FULL una pagina completa

Cierre SEP 2026: Inicial $10,000.00 - Final $431.55 - Reponer $9,568.45
