<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use mixisLv\NameDays\NameDays;

echo '<pre>';
$nameDays = new NameDays();

var_dump($nameDays->getNames());
var_dump($nameDays->getNames("09-29"));
var_dump($nameDays->getNames("2019-09-29"));
var_dump($nameDays->getNames("09-29")->toArray());
var_dump($nameDays->getNames("09-29")->toString());
var_dump($nameDays->getDate("MiKuS"));
var_dump($nameDays->getDate("MiKuS", true));

var_dump($nameDays->getDate("name-not-found"));

$nameDays = new NameDays('name-days-lv-extended');
var_dump($nameDays->getNames());
var_dump($nameDays->getNames("09-29"));
var_dump($nameDays->getNames("2019-09-29"));
var_dump($nameDays->getNames("09-29")->toarray());
var_dump($nameDays->getNames("09-29")->toString());
var_dump($nameDays->getDate("MiKuS"));
var_dump($nameDays->getDate("MiKuS", true));

echo '</pre>';
