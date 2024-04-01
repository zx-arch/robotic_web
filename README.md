<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Laravel Usage Guide

- Make sure you have PHP, Composer, and other necessary dependencies installed.
- Clone the Laravel project repository.
- Navigate to the project directory.
- Run composer install to install project dependencies.
- Export DB MySQL 'robotic_web_db.sql' to Local, and run 'php artisan migrate'
- Run Seeder User Tabel with 'php artisan db:seed --class=UserSeeder'
- Run Seeder Master Status Tabel with 'php artisan db:seed --class=MasterStatusSeeder'.
- Run Seeder Category Tutorial Tabel with 'php artisan db:seed --class=CategoryTutorialSeeder'.
- Change the DB connection in the .env file, adjust the connection on your local.
- Run project with command 'php artisan serve'.
- Open your browser and search 'localhost:8000'.
