#!/bin/bash

echo "=== 1. Arreglando permisos ==="
chmod -R 777 /var/www/storage
chmod -R 777 /var/www/bootstrap/cache

echo "=== 2. Iniciando PHP-FPM ==="
php-fpm &

sleep 3

echo "=== 3. Limpiando caché ==="
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo "=== 4. Generando key ==="
php artisan key:generate --force

echo "=== 5. Link storage ==="
php artisan storage:link --force

echo "=== 6. AGREGANDO COLUMNA user_type (usando DB facade) ==="
php artisan tinker --execute="try { DB::statement('ALTER TABLE users ADD COLUMN IF NOT EXISTS user_type VARCHAR(255) DEFAULT 'user''); echo 'Columna agregada o ya existe'; } catch(Exception \$e) { echo 'Error: ' . \$e->getMessage(); }"

echo "=== 7. Ejecutando migraciones ==="
php artisan migrate --force

echo "=== 8. Cacheando ==="
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "=== 9. Iniciando Nginx ==="
nginx -g "daemon off;"