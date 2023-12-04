<?php

// Le nom du fichier est le premier paramètre donné au programme.
$filename = $argv[1] ?? null;

if ($filename === null) {
    fwrite(STDERR, "[ERR] You must pass a filename as parameter" . PHP_EOL);
    return 1;
}

// Lecture de l'input
$lines = file($filename, FILE_IGNORE_NEW_LINES);

// Mise en place du tableau de résultat
$results = [];

// On parcours le contenu du fichier
foreach ($lines as $line) {
    // Récupération des nombres
    $numbers = preg_replace("/[^0-9]+/", "", $line);
    // $first_number === Le premier élément de la string
    $first_number = (string)$numbers[0];
    // $last_number === La dernière lettre de la chaine de caractère
    $last_number = (string)($numbers[strlen($numbers) - 1]);
    $results[] = "$first_number$last_number";
}

foreach ($results as $i => $result) {
    echo "Line $i : $result" . PHP_EOL;
}

echo "Result : " . array_sum($results) . PHP_EOL;