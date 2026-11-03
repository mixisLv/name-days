# Latvian Name Day Calendar

[![Build Status](https://travis-ci.org/mixisLv/name-days.svg?branch=master)](https://travis-ci.org/mixisLv/name-days)
[![GitHub license](https://img.shields.io/github/license/mixisLv/name-days.svg)](https://github.com/mixisLv/name-days/blob/master/LICENSE)
[![GitHub release](https://img.shields.io/github/release/mixisLv/name-days.svg)](https://github.com/mixisLv/name-days/releases/latest)
[![Coverage Status](https://coveralls.io/repos/github/mixisLv/name-days/badge.svg?branch=master)](https://coveralls.io/github/mixisLv/name-days?branch=master)

Latvian name day calendar data. The names are taken from the [Latvian State Language Center's](https://www.vvc.gov.lv/lv/kalendarvardu-ekspertu-komisija) official name day calendar.

## Requirements

- PHP >= 8.4
- ext-json
- ext-mbstring

## Installation

You can install `name-days` via [Composer](https://getcomposer.org/):

```shell
composer require "mixislv/name-days"
```

Or add it to your `composer.json`:

```json
{
    "require": {
        "mixislv/name-days": "^2.1"
    }
}
```

## Data Sources

The library provides two datasets:

| Source | Description |
| --- | --- |
| `name-days-lv` (default) | Official Latvian name day calendar. |
| `name-days-lv-extended` | Extended list with additional name variants. |

## Usage

### Basic Usage

```php
<?php

require 'vendor/autoload.php';

use mixisLv\NameDays\NameDays;

$nameDays = new NameDays();

// Get names for current date
$names = $nameDays->getNames();
echo $names->toString(); // e.g. "Mārtiņš"

// Get names for a specific date (MM-DD format)
$names = $nameDays->getNames('09-29');
print_r($names->toArray());
// ['Miķelis', 'Mikus', 'Miks', 'Mihails', 'Jumis']

// Also accepts full dates (YYYY-MM-DD) - only the MM-DD part is used
$names = $nameDays->getNames('2019-09-29');
echo $names->toString();

// Get the date key
echo $names->key(); // '09-29'
```

### Using the Extended Dataset

```php
<?php

use mixisLv\NameDays\NameDays;

$nameDays = new NameDays('name-days-lv-extended');

$names = $nameDays->getNames('09-24');
print_r($names->toArray());
// ['Agrits', 'Agrons', 'Steidzīte', 'Steiga']
```

### Getting Only Extended Names

`getExtendedNames()` returns only the names that are present in the extended dataset but not in the default dataset:

```php
<?php

use mixisLv\NameDays\NameDays;

$nameDays = new NameDays();

$names = $nameDays->getExtendedNames('09-24');
print_r($names->toArray());
// ['Agrits', 'Agrons', 'Steidzīte', 'Steiga']
```

The method behaves the same regardless of which dataset the `NameDays` instance was constructed with.

### Finding a Name Day by Name

```php
<?php

use mixisLv\NameDays\NameDays;

$nameDays = new NameDays();

// Case-insensitive lookup
$date = $nameDays->getDate('mikuss');
echo $date; // '09-29'

// Include the current year
$dateWithYear = $nameDays->getDate('MiKuS', true);
echo $dateWithYear; // '2026-09-29'

// Returns null if the name is not found
$nameDays->getDate('name-not-found'); // null
```

### The Names Object

`getNames()` returns an instance of `mixisLv\NameDays\Names` with the following methods:

| Method | Return Type | Description |
| --- | --- | --- |
| `key()` | `string` | Returns the date key in `MM-DD` format. |
| `toArray()` | `array<int, string>` | Returns an array of names for this date. |
| `toString()` | `string` | Returns names as a comma-separated string. |

### Handling Missing Dates

If there are no name days for a given date, the library returns a placeholder:

```php
$nameDays = new NameDays();
$names = $nameDays->getNames('02-29');
$names->toString(); // '–'
$names->toArray();  // ['–']
```

## Examples

Check out the [examples directory](/examples) for more usage examples.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
