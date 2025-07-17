<?php
header('Content-Type: application/json');
$data_file = 'data.txt';
echo file_exists($data_file) ? file_get_contents($data_file) : json_encode([]);
