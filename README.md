The following process will be used to install admin dashboard using package manager.

Server Requirements: https://laravel.com/docs/10.x/deployment#server-requirements

Install php package manager Composer : Please install latest version of composer from https://getcomposer.org

This project is using Laravel version 10.x. https://laravel.com/docs/10.x

Install Node.js : Please install latest version of Node.js from: https://nodejs.org

Copy laravel folder from themeforest bundle and extract to your suitable directory or folder..

Open terminal or command prompt with installation directory/folder.

Install PHP dependencies: composer install

Create new .env file from copying .env.example

Generate laravel app key php artisan key:generate

Install node dependencies: npm install

Run command npm run dev to start vite development.

Run command npm run build to build for production.

Run command php artisan serve to start php server which will run laravel or if you are using other server apps like WAMP, XAMPP or MAMP, you can follow that guide.

