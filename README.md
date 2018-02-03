# Lumen HTTP helpers

A set of helper classes to segregate the validation and transformation logic from controller to separate dedicated classes.

## Installation

Add the package to the dependencies of your Lumen application

```
composer require michielkempen/lumen-http-helpers
```

Add the service provider in `bootstrap/app.php`

```
$app->register(MichielKempen\LumenHttpHelpersServiceProvider::class);
```

## Security

If you discover any security related issues, please email kempenmichiel@gmail.com instead of using the issue tracker.

## Credits

- [Michiel Kempen](https://github.com/michielkempen)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
