# Laravel Layout
Quản lý Layout cho Laravel Application

## Install

* **Thêm vào file composer.json của app**
```json
	"repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/datlv/laravel-layout"
        }
    ],
    "require": {
        "datlv/laravel-layout": "dev-master"
    }
```
``` bash
$ composer update
```

* **Thêm vào file config/app.php => 'providers'**
```php
	Datlv\Layout\ServiceProvider::class,
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
