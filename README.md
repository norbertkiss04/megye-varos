
## Követelmények

 - PHP 8.2
 - Composer
 - Ezek a PHP bővítmények engedélyezése/letöltése: `fileinfo, pdo_mysql, mysqli`

## Futtatás menete

    git clone https://github.com/norbertkiss04/megye-varos/
    cd megye-varos
    composer update
    composer install

`.env` létrehozása `.env.example` ből és az adatbázis konfigurálása

    php artisan key:generate
    php artisan migrate
    php artisan db:seed --class=MegyeSeeder
    php artisan db:seed --class=VarosSeeder
    php artisan serve

