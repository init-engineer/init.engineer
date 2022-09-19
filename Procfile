web: vendor/bin/heroku-php-nginx -C nginx.conf public/
worker: php artisan queue:restart && php artisan queue:work database --daemon --sleep=3 --tries=3 --timeout=60 --queue=highest,high,medium,low,lowest,default
