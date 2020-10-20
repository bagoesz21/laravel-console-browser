# Laravel Console Browser

In-browser console for Laravel PHP framework.

This package is a re-published, re-organised and maintained version of [teepluss/laravel-console](https://github.com/teepluss/laravel-console), which isn't maintained anymore.

This package executes your code within `ConsoleController@postExecute` context, and displays the produced output.

The purpose is to easily test your stuff without creating garbage routes and controllers just to run something, ...
I'm sure you know what I'm talking about :)

This package is intended for a local testing, and **shouldn't get nowhere near your production servers!**

## Screenshots

## Installation

### Laravel

To install through composer, simply run the following command:

```
php composer require bagoesz21/laravel-console-browser
```

If you don't use Laravel 5.5+ and its [package discovery](https://laravel.com/docs/5.5/packages#package-discovery) feature, register the console service provider in `config/app.php`:

```php
'providers' => [
	...
	Bagoesz21\ConsoleBrowser\ConsoleBrowserServiceProvider::class,
];
```

Then publish the package assets:

```
php artisan vendor:publish --provider="Bagoesz21\ConsoleBrowser\ConsoleBrowserServiceProvider"
```

And you are done! Open the console in:

```
yourdomain.com/console
```

The default username and password is `username:password`
> You can change on config/console.php

