# Flasher

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gnahotelsolutions/flasher.svg?style=flat-square)](https://packagist.org/packages/gnahotelsolutions/flasher)
[![Total Downloads](https://img.shields.io/packagist/dt/gnahotelsolutions/flasher.svg?style=flat-square)](https://packagist.org/packages/gnahotelsolutions/flasher)
![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)


The `gnahotelsolutions/flasher` package provides an easy way to interact with flashed messages in your Laravel application.

## Install

You can install the package via composer:

```bash
$ composer require gnahotelsolutions/flasher
```

## Usage

The messages are stored in the `notifications` session key.

All notifications have a default `duration` property set to 5 seconds. You can use this property in your JavaScript to make notifications disappear automatically.

### Creating notifications

```php
Flasher::info("Welcome, {$user->name}");

Flasher::error('Incorrect password');

Flasher::warning('Remember to change your password');

Flasher::success('Password changed!');
```

If you want to use custom types, you can use the method `createNotification`

```php
Flasher::createNotification('store', 'Someone bought a product!', null);
```

### Check if there are pending notifications

```php
@if (Flasher::any())
    <div class="alerts">
        ...
    </div>
@endif
``` 

### Iterating over notifications

```php
@foreach(Flasher::all() as $notification)
    <div class="alert alert-{{ $notification->getType() }}" data-duration="{{ $notification->getDuration() }}">
        {{ $notification->getMessage() }}
    </div> 
@endforeach
```

If you're using [Bootstrap](https://getbootstrap.com) in your project, you can use `getBootstrapClass()` method. 
It will replace `error` with `danger` to match the framework's CSS class.

## Testing

``` bash
phpunit
```

## Security

If you discover any security related issues, please email dllop@gna.es instead of using the issue tracker.

## License

The MIT License (MIT).
