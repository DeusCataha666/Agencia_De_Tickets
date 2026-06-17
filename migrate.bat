@echo off
cd /d c:\xampp\htdocs\proyecto
php artisan migrate --force
pause
