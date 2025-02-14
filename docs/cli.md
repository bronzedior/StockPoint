php artisan serve
php artisan migrate:fresh

composer require livewire/livewire
php artisan make:livewire ContactForm
php artisan make:mail ContactUsMail -m

php artisan route:clear
php artisan view:clear
php artisan cache:clear
php artisan config:clear

php artisan make:controller Catalog -m -c
php artisan key:generate
php artisan make:middleware AuthenticationMiddleware
php artisan make:middleware AdminMiddleware
php artisan make:controller AdminController
php artisan make:seeder AdminSeeder
php artisan db:seed

php artisan make:seeder CategorySeeder
php artisan make:model Category

php artisan make:model Invoice -m

problem:
- overlapped login  
- image using storage:link not base64
- admin can view checkout and invoice
