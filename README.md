# Latvian Name Day Calendar
[![Build Status](https://travis-ci.org/mixisLv/name-days.svg?branch=master)](https://travis-ci.org/mixisLv/name-days)
[![GitHub license](https://img.shields.io/github/license/mixisLv/name-days.svg)](https://github.com/mixisLv/name-days/blob/master/LICENSE)
[![Packagist](https://img.shields.io/packagist/v/mixisLv/name-days.svg)]()
[![Coverage Status](https://coveralls.io/repos/github/mixisLv/name-days/badge.svg?branch=master)](https://coveralls.io/github/mixisLv/name-days?branch=master)

Latvian name day calendar data. I took names from [Latvian State Language Center's](http://vvc.gov.lv/index.php?route=product/category&path=193_199_200) official website.

## Requirements

* PHP >= 7.0.0

## Installation 

You can install name-days via Composer with:
```shell
composer require "mixislv/name-days"
```    
Or by adding the following to your composer.json:
```shell    
"require": {
    "mixislv/name-days": "^1.0"
}
```

## Usage

```php
use mixisLv\NameDays\NameDays;

$nameDays = new NameDays();

var_dump($nameDays->names("09-29"));
var_dump($nameDays->names("09-29")->toArray());
var_dump($nameDays->names("09-29")->toString());
var_dump($nameDays->date("MiKuS")->key());
```

Check out [examples directory](/examples) for usage examples