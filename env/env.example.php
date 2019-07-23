<?php
$variables = [
    'KEY 1' => 'VALUE 1',
    'KEY 2' => 'VALUE 2',
    'KEY 3' => 'VALUE 3'
];

foreach ($variables as $key => $value) {
    putenv("$key=$value");
}
