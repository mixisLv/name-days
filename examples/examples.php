<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use mixisLv\NameDays\NameDays;

echo '<pre>';
$nameDays = new NameDays();

var_dump($nameDays->names("09-29"));
var_dump($nameDays->names("09-29")->toArray());
var_dump($nameDays->names("09-29")->toString());
var_dump($nameDays->date("MiKuS")->key());

$nameDays = new NameDays('name-days-lv-extended');
var_dump($nameDays->names("09-29"));
var_dump($nameDays->names("09-29")->toarray());
var_dump($nameDays->names("09-29")->toString());
var_dump($nameDays->date("MiKuS")->key());
echo '</pre>';
