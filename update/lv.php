<!doctype html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>Latvian Name Days Examples DB update</title>
</head>
<body>

<pre>
<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

function getJsonString($url)
{
    // Parse PDF file and build necessary objects.
    $parser   = new \Smalot\PdfParser\Parser();
    $pdf      = $parser->parseFile($url);
    $nameDays = parseNames(explode("\n", $pdf->getText()));

    return json_encode($nameDays, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

function parseNames($rows)
{
    $month    = 0;
    $nameDays = [];
    foreach ($rows as $row) {
        $data = explode(".", $row);
        if (isset($data[1]) && (int)$data[0] > 0) {
            $nameDays[sprintf("%'.02d", $month) . "-" . sprintf("%'.02d", $data[0])] = array_map(
                'trim',
                explode(',', str_replace(" ", "", $data[1]))
            );
        } else {
            if (strlen(trim($data[0])) < 4 || strlen(trim($data[0])) > 40) { // kaut kas nav labi ar mēnešiem
                continue;
            }
            $month++;
        }
    }

    return $nameDays;
}


function getJsonStringExt($url)
{
    // Parse PDF file and build necessary objects.
    $parser   = new \Smalot\PdfParser\Parser();
    $pdf      = $parser->parseFile($url);
    $nameDays = parseNamesExt(explode("\n", $pdf->getText()));

    return json_encode($nameDays, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

function parseNamesExt($rows)
{
    $month = 0;
    $date  = 0;

    $nameDays = [];

    array_shift($rows);
    array_shift($rows);

    foreach ($rows as $row) {
        $data  = explode(".", $row);
        $value = str_replace([" ", "\t"], "", $data[0]);

        //print_r([$value]);
        if (in_array(trim($value), ['JANVĀRIS', 'FEBRUĀRIS', 'MARTS', 'APRĪLIS', 'MAIJS', 'JŪNIJS', 'JŪLIJS', 'AUGUSTS', 'SEPTEMBRIS', 'OKTOBRIS', 'NOVEMBRIS', 'DECEMBRIS'])) {
            $month++;
            //print_r([$month, $value]);
        } else {
            if ((int)$value > 0) {
                $date = (int)$value;
            } else {
                $key    = sprintf("%'.02d", $month) . "-" . sprintf("%'.02d", $date);
                $values = array_filter(array_map('trim', explode(',', $value)), 'strlen');

                if (isset($nameDays[$key])) {
                    $nameDays[$key] = array_merge($nameDays[$key], $values);
                } else {
                    $nameDays[$key] = $values;
                }
            }
        }
    }

    return $nameDays;
}

$lastUpdate = "/** Last updated: " . date('Y-m-d H:i:s') . " */\n\n";

echo $lastUpdate;

$jsonLvStd = getJsonString('http://vvc.gov.lv/advantagecms/export/docs/komisijas/tradic_v%C4%81rdadienu_saraksts_2022.pdf');
file_put_contents('./../data/name-days-lv.json', $jsonLvStd);

$jsonLvExtended = getJsonStringExt('http://vvc.gov.lv/advantagecms/export/docs/komisijas/paplasinatais_saraksts.pdf');
file_put_contents('./../data/name-days-lv-extended.json', $jsonLvExtended);

?>
</pre>
</body>
</html>
