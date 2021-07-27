web: vendor/bin/heroku-php-nginx -C nginx.conf public/
worker: php artisan queue:restart && php artisan queue:work database --sleep=3 --tries=3 --daemon
