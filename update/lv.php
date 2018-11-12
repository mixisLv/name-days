<!doctype html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>Latvian Name Days Examples DB update</title>
</head>
<body>

<pre>
<?php

function getJsonString($url) {

    $vvcHtml = file_get_contents($url);

    $dom = new DOMDocument;
    libxml_use_internal_errors(true);
    $dom->loadHTML($vvcHtml);
    libxml_clear_errors();

    $content  = $dom->getElementById('tab_content');
    $nameDays = parseNames($content->getElementsByTagName("tr"));

    return json_encode($nameDays, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

}

function parseNames($rows) {
    $month = 0;
    $nameDays = [];
    foreach ($rows as $row) {
        $data = explode(".", $row->nodeValue);
        if (isset($data[1])) {
            $nameDays[sprintf("%'.02d", $month) . "-" . sprintf("%'.02d", $data[0])] = array_map(
                    'trim', explode(',', $data[1])
            );
        } else {
            if (strlen(trim($data[0])) < 4) { // kaut kas nav labi ar mēnešiem
                continue;
            }
            $month++;
        }
    }

    return $nameDays;
}

$lastUpdate = "/** Last updated: " . date('Y-m-d H:i:s') . " */\n\n";

echo $lastUpdate;

$jsonLvStd = getJsonString('http://vvc.gov.lv/index.php?route=product/category&path=193_199_200');
file_put_contents('./../data/name-days-lv.json', $jsonLvStd);

?>
</pre>
</body>
</html>
