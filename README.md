# Vilt Menu

VILT Menu manager and generator for Database

## Installation

You can install the package via composer:

```bash
composer require queents/menu-module
```

Add Module to `modules_statuses.json` if not exists

```json
{
    "Menu": true
}
```

Install the package

```bash
php artisan menu:install
```

and now clear cache

```bash
php artisan optimize:clear
```


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Queen Tech Solutions](https://github.com/queents)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
