<?php
// File database dummy
$file = __DIR__ . "/data.json";

function readData() {
    global $file;
    if (!file_exists($file)) {
        file_put_contents($file, json_encode([]));
    }
    $data = json_decode(file_get_contents($file), true);
    return $data ?? [];
}

function saveData($data) {
    global $file;
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}
