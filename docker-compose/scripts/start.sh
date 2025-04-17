#!/bin/sh
echo "Esperando a MySQL..."
while ! nc -z mysql 3306; do sleep 1; done  # Bucle infinito hasta éxito
php spark migrate
php-fpm