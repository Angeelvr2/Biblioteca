#!/bin/bash

# Reforzar permisos (importante)
chmod -R 775 /var/www/storage
chmod -R 775 /var/www/bootstrap/cache

# Iniciar PHP-FPM en background
php-fpm &

# Esperar un poco
sleep 3

# Limpiar caché primero
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Generar key si no existe
php artisan key:generate --force

# Link storage
php artisan storage:link --force

# Migraciones
php artisan migrate:fresh --force

# Cachear para producción
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Iniciar nginx
nginx -g "daemon off;"