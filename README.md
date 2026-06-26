# Introduction

**Laravel Locale Kit** provides locale metadata for Laravel applications. It allows you to retrieve locale-specific information such as writing direction, number symbols, punctuation, calendar system, and other locale definitions.

The package also supports custom locale definitions and locale aliases.

# Installation

Install the package via Composer:

```shell
composer require mohammad-zarifiyan/laravel-locale-kit:^1.0
```

# Publishing Locale Definitions

To publish the predefined locale definition files into your application:

```shell
php artisan vendor:publish --provider="MohammadZarifiyan\LaravelLocaleKit\LocaleKitProvider" --tag="locale-kit-locales"
```

The files will be published to `locales` directory. You can edit the published files or add your own locale definitions.

Each locale definition file must be named using a locale identifier in the following format:

language_COUNTRY.json

Examples:

```text
en_US.json
en_GB.json
fa_IR.json
fa_AF.json
ar_SA.json
```

You can edit the published files or add your own locale definition files.

# Usage

## alias()

Registers an alias for a locale identifier.

```php
use MohammadZarifiyan\LaravelLocaleKit\LocaleKit;

LocaleKit::alias('fa', 'fa_IR');
LocaleKit::alias('en', 'en_US');
LocaleKit::alias('ar', 'ar_SA');
```

In this example, `fa`, `en`, and `ar` become aliases for the locale identifiers `fa_IR`, `en_US`, and `ar_SA`.

After registering an alias, any method that accepts a locale can use either the alias or the full locale identifier.

For example:

```php
use MohammadZarifiyan\LaravelLocaleKit\LocaleKit;

LocaleKit::get('direction', 'fa');
```

is equivalent to:

```php
use MohammadZarifiyan\LaravelLocaleKit\LocaleKit;

LocaleKit::get('direction', 'fa_IR');
```
---

## getIdentifier()

Returns the locale identifier for a locale or alias.

```php
use MohammadZarifiyan\LaravelLocaleKit\LocaleKit;

LocaleKit::getIdentifier('fa'); // fa_IR
LocaleKit::getIdentifier('en'); // en_US
LocaleKit::getIdentifier('fa_AF'); // fa_AF
```

---

## locales()

Returns all application locales available in Laravel's `lang` directory.

```php
use MohammadZarifiyan\LaravelLocaleKit\LocaleKit;

$locales = LocaleKit::locales();
```

Example result:

```php
[
    'en',
    'fa',
    'ar',
]
```

---

## definedLocales()

Returns all locale definition files available to the package, including custom locale definitions.

```php
use MohammadZarifiyan\LaravelLocaleKit\LocaleKit;

$locales = LocaleKit::definedLocales();
```

Example result:

```php
[
    'en_US',
    'en_GB',
    'fa_IR',
    'ar_SA',
]
```

---

## get()

Returns a value from a locale definition.
```php
use MohammadZarifiyan\LaravelLocaleKit\LocaleKit;

LocaleKit::get('calendar_system', 'en_US');
```

Result:

```php
'gregorian'
```
