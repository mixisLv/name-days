<!doctype html>
<html lang="en">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>Latvian Name Days Examples</title>
</head>
<body>

<h1>Latvian Name Days</h1>

<?php
    $file = file_get_contents('./examples.php');
    if ($file) {
        highlight_string($file);
    }
?>

</body>
</html>
