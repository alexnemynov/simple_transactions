<?php

declare(strict_types=1);

// Your code
function getTransactionFiles(string $dirPath): array
{
    $files = [];

    foreach (scandir($dirPath) as $file) {
        if (is_dir($file)) {
            continue;
        } else {
            $files[] = $dirPath . $file;
        }
    }
    return $files;
}

function getTransactions(string $fileName)
{
    if (! file_exists($fileName)) {
        trigger_error('File "' . $fileName . '" does not exist', E_USER_ERROR);
    }

    $file = fopen($fileName, 'r');
    $transactions = [];

    fgetcsv($file);
    while (($transaction = fgetcsv($file)) !== false) {
        $transactions[] = $transaction;
    }
    fclose($file);
    return $transactions;
}
