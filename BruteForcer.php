<?php

/**
 * Brute force the given password with the given file.
 *
 * @param  int  $mode
 * @param  string  $file
 * @param  string  $password
 *
 * @return void
 */
function bruteForce(int $mode, string $file, string $password) : void
{
    $source = fopen(__DIR__ . '/' . $file, 'r');
    $match = false;
    $row = 0;
    $text = $mode === 1 ? 'Plain' : 'Hashed';

    if (!$source) {
        die("File doesn't exist / Can't be opened!");
    }

    while (($eachLine = fgets($source)) !== false) {
        $line = trim($eachLine);
        $row++;

        if ($mode === 1) {
            $match = password_verify($line, $password);
        } else {
            $match = password_verify($password, $line);
        }

        if ($match) {
            echo "${text} Password: ${line} (line ${row})";

            break;
        }
    }

    fclose($source);

    if (!$match) {
        echo "No ${text} Password Found!";
    }

    die();
}

/**
 * Brute force the given database with the given dictionary.
 *
 * @param  string  $sourceFile
 * @param  string  $targetFile
 *
 * @return void
 */
function bruteForceFile($sourceFile, $targetFile) : void
{
    $source = fopen(__DIR__ . '/' . $sourceFile, 'r');
    $target = fopen(__DIR__ . '/' . $targetFile, 'r');
    $match = false;
    $rowSource = 0;
    $rowTarget = 0;

    if (!$source) {
        die("File Database doesn't exist / Can't be opened!");
    } elseif (!$target) {
        die("File Dictionary doesn't exist / Can't be opened!");
    }

    while (($eachSourceLine = fgets($source)) !== false) {
        $rowSource++;

        while (($eachTargetLine = fgets($target)) !== false) {
            $sourceLine = trim($eachSourceLine);
            $targetLine = trim($eachTargetLine);
            $match = password_verify($targetLine, $sourceLine);
            $rowTarget++;

            if ($match) {
                echo "${sourceLine} (line ${rowSource}) => ${targetLine} (line ${rowTarget})" . PHP_EOL;

                break;
            }
        }
    }

    fclose($target);
    fclose($source);

    if (!$match) {
        echo "No Data Found!";
    }

    die();
}

$option = $argv[1];

if ($option === '-h') {
    if (!isset($argv[2])) {
        echo "No dictionary provided.";

        die();
    } elseif (!isset($argv[3])) {
        echo "No hashed password provided.";

        die();
    }

    $dictionary = $argv[2];
    $hashedPassword = $argv[3];

    bruteForce(1, $dictionary, $hashedPassword);
} elseif ($option === '-p') {
    if (!isset($argv[2])) {
        echo "No database provided.";

        die();
    } elseif (!isset($argv[3])) {
        echo "No plain password provided.";

        die();
    }

    $database = $argv[2];
    $plainPassword = $argv[3];

    bruteForce(2, $database, $plainPassword);
} elseif ($option === '-f') {
    if (!isset($argv[2])) {
        echo "No database provided.";

        die();
    } elseif (!isset($argv[3])) {
        echo "No dictionary provided.";

        die();
    }

    $database = $argv[2];
    $dictionary = $argv[3];

    bruteForceFile($database, $dictionary);
} else {
    echo "Invalid Option";

    exit;
}
