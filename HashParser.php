<?php

if (!isset($argv[1])) {
    echo "No plain password provided.";

    die();
}

$plainPassword = $argv[1];
$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

echo "Prefix: " . substr($hashedPassword, 1, 2) . PHP_EOL;
echo "Log Rounds: " . substr($hashedPassword, 4, 2) . PHP_EOL;
echo "Salt: " . substr($hashedPassword, 7, 22) . PHP_EOL;
echo "Hash: " . substr($hashedPassword, 29) . PHP_EOL;
echo "Bcrypt: " . $hashedPassword . PHP_EOL;
