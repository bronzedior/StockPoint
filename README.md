## BNCC LnT Backend Final Project

### How to run
1. Clone this repository

2. Create local .env file by copy this code<br />
This is the .env file
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:k83Z2Qdei0ZG/p2iifs2tQlWc866pXFhheFHzdK8dNo=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql #REPLACEABLE
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=stockpoint #REPLACEABLE
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp #REPLACEABLE
MAIL_SCHEME=null
MAIL_HOST="sandbox.smtp.mailtrap.io" #REPLACEABLE
MAIL_PORT=2525 #REPLACEABLE
MAIL_USERNAME=aaab1db951e8b3 #REPLACEABLE
MAIL_PASSWORD=5f6b5ec514fd33 #REPLACEABLE
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
```

3. Install dependencies
```
composer install
```

4. Run terminal
```
php artisan serve
```

built-in admin account 
email: admin@stockpoint.com
password: password123
