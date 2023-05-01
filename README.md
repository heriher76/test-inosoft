## Instalasi 

1. Clone Project
```js
git clone https://github.com/heriher76/test-inosoft.git
```

2. Masuk Folder Proejk dan Lakukan Install Dependencies
```js
composer install --ignore-platform-reqs
```

3. Copy .env.example dan rename menjadi .env

4. Publish Config
```js
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
```

5. Generate JWT Secret Key
```js
php artisan jwt:secret
```

6. Generate App Key
```js
php artisan key:generate
```

7. Migrasi Database, Tabel dan Data
```js
php artisan migrate:fresh --seed
```

8. Jalankan
```js
php artisan serve
```

## API Resource 
Import file api_urls.json ke postman