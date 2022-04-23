# Latvian Name Day Calendar
[![Build Status](https://travis-ci.org/mixisLv/name-days.svg?branch=master)](https://travis-ci.org/mixisLv/name-days)
[![GitHub license](https://img.shields.io/github/license/mixisLv/name-days.svg)](https://github.com/mixisLv/name-days/blob/master/LICENSE)
[![GitHub release](https://img.shields.io/github/release/mixisLv/name-days.svg)](https://github.com/mixisLv/name-days/releases/latest)
[![Coverage Status](https://coveralls.io/repos/github/mixisLv/name-days/badge.svg?branch=master)](https://coveralls.io/github/mixisLv/name-days?branch=master)

Latvian name day calendar data. I took names from [Latvian State Language Center's](https://vvc.gov.lv/index.php?route=product/category&path=193_199) official website.

## Requirements

* PHP >= 7.3.0

## Installation 

You can install name-days via Composer with:
```shell
composer require "mixislv/name-days"
```
Or by adding the following to your composer.json:
```shell    
"require": {
    "mixislv/name-days": "^2.1"
}
```

## Usage

```php
use mixisLv\NameDays\NameDays;

$nameDays = new NameDays();

var_dump($nameDays->getNames());
var_dump($nameDays->getNames("09-29"));
var_dump($nameDays->getNames("2019-09-29"));
var_dump($nameDays->getNames("09-29")->toArray());
var_dump($nameDays->getNames("09-29")->toString());
var_dump($nameDays->getDate("MiKuS"));
var_dump($nameDays->getDate("MiKuS", true));
```

Check out [examples directory](/examples) for usage examples
