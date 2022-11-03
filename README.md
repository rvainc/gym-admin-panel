# U.S.A

---

<img alt="drawing" src="public/usa-logo.png" width="300"/>


## Get Started for Developers

> You will need to have ```php8.1``` and ```composer```.
### Composer
- Installing all composer packages ```composer install```

### .env
1. duplicate file ```.env.example``` with name ```.env```
2. Insert in ```.env```
```APP_NAME=Laravel
   APP_ENV=local
   APP_KEY=base64:ZM19Ef6n1zyF+KRIrOiqEPHWQMqlQgXOFA/FZVbiFLw=
   APP_DEBUG=true
   APP_URL=http://usa.localhost

    LOG_CHANNEL=stack
    LOG_DEPRECATIONS_CHANNEL=null
    LOG_LEVEL=debug

    DB_CONNECTION=pgsql
    DB_HOST=pgsql
    DB_PORT=5432
    DB_DATABASE= // insert your credentials here
    DB_USERNAME= // here
    DB_PASSWORD= // and here
    
    BROADCAST_DRIVER=log
    CACHE_DRIVER=file
    FILESYSTEM_DISK=local
    QUEUE_CONNECTION=sync
    SESSION_DRIVER=file
    SESSION_LIFETIME=120
    
    MEMCACHED_HOST=127.0.0.1
    
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379
    
    MAIL_MAILER=smtp
    MAIL_HOST=mailhog
    MAIL_PORT=1025
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS="hello@example.com"
    MAIL_FROM_NAME="${APP_NAME}"
    
    AWS_ACCESS_KEY_ID=
    AWS_SECRET_ACCESS_KEY=
    AWS_DEFAULT_REGION=us-east-1
    AWS_BUCKET=
    AWS_USE_PATH_STYLE_ENDPOINT=false
    
    PUSHER_APP_ID=
    PUSHER_APP_KEY=
    PUSHER_APP_SECRET=
    PUSHER_HOST=
    PUSHER_PORT=443
    PUSHER_SCHEME=https
    PUSHER_APP_CLUSTER=mt1
    
    VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
    VITE_PUSHER_HOST="${PUSHER_HOST}"
    VITE_PUSHER_PORT="${PUSHER_PORT}"
    VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
    VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

> You will need to have ```pdo``` ```pgsql``` ```pdo_pgsql```.

### Database
 1. run ```php artisan migrate```

### Node
 - Install ```npm install```

### How to run?

1. Configure nginx  
example: 
```server {
    listen 80;
    server_name usa.localhost;
    error_log /var/log/admin.error.log;
    access_log /var/log/admin.access.log;
    root /var/www/html/public;

    location / {
        try_files $uri /index.php$is_args$args;
    }

    location ~ \.php {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param SCRIPT_NAME $fastcgi_script_name;
        fastcgi_index index.php;
        fastcgi_pass php:9000;
    }

    client_max_body_size 30M;
}
```
2. run ```npm run dev```

### Deploying 
Coming soon...

