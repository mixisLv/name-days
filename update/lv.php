<!doctype html>
<html lang="en">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>Latvian Name Days DB update</title>
</head>
<body>

<pre>
<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

function getJsonString(string $url): bool|string
{
    $data = file_get_contents($url);

    $nameDays = [];
    if($data) {
        $nameDays = parseNames(explode("\n", $data));
    }

    return json_encode($nameDays, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

/**
 * @param array<int, string> $rows
 * @return array<string, array<int, string>>
 */
function parseNames(array $rows): array
{
    $nameDays = [];
    foreach ($rows as $row) {
        $data = explode(";", $row);
        $date = explode(".", $data[0]);
        if (isset($date[0],$date[1])) {
            $nameDays[sprintf("%'.02d", $date[1]) . "-" . sprintf("%'.02d", $date[0])] = array_map(
                'trim',
                explode(' ', $data[1])
            );
        }
    }

    return $nameDays;
}

$lastUpdate = "/** Last updated: " . date('Y-m-d H:i:s') . " */\n\n";

echo $lastUpdate;

$jsonLvStd = getJsonString('https://www.vvc.gov.lv/lv/media/157/download');
file_put_contents('./../data/name-days-lv.json', $jsonLvStd);

$jsonLvExtended = getJsonString('https://www.vvc.gov.lv/lv/media/156/download');
file_put_contents('./../data/name-days-lv-extended.json', $jsonLvExtended);

?>
</pre>
</body>
</html>
